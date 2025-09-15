<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Interest;
use App\Models\SkillLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    /**
     * Get AI-powered course recommendations with enhanced debugging
     */
    /**
 * Get AI-powered course recommendations with enhanced debugging
 */
public function getRecommendations(Request $request)
{
    Log::info('🤖 CHATBOT RECOMMENDATION REQUEST:', $request->all());
    
    try {
        $validated = $request->validate([
            'interests' => 'required|array',
            'skill_level' => 'required|string'
        ]);
        
        Log::info('✅ Validated data:', $validated);

        // 🔥 FIX 1: Normalize skill level to match database format
        $skillLevelMapping = [
            'beginner' => 'Beginner',
            'intermediate' => 'Intermediate', 
            'advanced' => 'Advanced'
        ];
        
        $normalizedSkillLevel = $skillLevelMapping[strtolower($validated['skill_level'])] ?? $validated['skill_level'];
        Log::info('🎯 Skill level mapping:', [
            'original' => $validated['skill_level'],
            'normalized' => $normalizedSkillLevel
        ]);

        // 🔥 STEP 1: Check for EXACT matches first
        $exactMatches = Course::whereIn('category', $validated['interests'])
            ->where('difficulty', $normalizedSkillLevel)
            ->withCount('ratings')
            ->withAvg('ratings', 'rating')
            ->orderByRaw('
                (CASE 
                    WHEN ratings_avg_rating >= 4.5 AND views >= 1 THEN 1000 + ratings_avg_rating + (views/1000)
                    WHEN ratings_avg_rating >= 4.0 AND views >= 1 THEN 500 + ratings_avg_rating + (views/1000)  
                    WHEN ratings_avg_rating >= 3.0 THEN 100 + ratings_avg_rating + (views/1000)
                    ELSE ratings_avg_rating + (views/1000)
                END) DESC
            ')
            ->orderByDesc('ratings_avg_rating')
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        Log::info('🎯 Exact matches found:', [
            'count' => $exactMatches->count(),
            'courses' => $exactMatches->map(function($course) {
                return [
                    'title' => $course->title,
                    'difficulty' => $course->difficulty,
                    'rating' => $course->ratings_avg_rating
                ];
            })->toArray()
        ]);

        if ($exactMatches->isNotEmpty()) {
            // 🔥 SUCCESS: Found exact matches
            $transformedCourses = $exactMatches->map(function($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'description' => $course->description,
                    'category' => $course->category,
                    'difficulty' => $course->difficulty,
                    'views' => $course->views ?? 0,
                    'average_rating' => round($course->ratings_avg_rating ?? 0, 1),
                    'rating_count' => $course->ratings_count ?? 0,
                    'url' => route('courses.show', $course->id),
                    'instructor' => $course->instructor ?: 'SkillHub',
                    'excerpt' => $this->generateCourseExcerpt($course),
                    'learning_outcomes' => $this->generateLearningOutcomes($course)
                ];
            });

            return response()->json([
                'success' => true,
                'courses' => $transformedCourses,
                'message' => "Here are the top-rated {$normalizedSkillLevel} courses for your interests:",
                'stats' => [
                    'total_found' => $exactMatches->count(),
                    'avg_rating' => round($exactMatches->avg('ratings_avg_rating'), 1),
                    'total_views' => $exactMatches->sum('views'),
                    'search_criteria' => [
                        'interests' => $validated['interests'],
                        'skill_level' => $normalizedSkillLevel
                    ]
                ],
                'recommendations_count' => $exactMatches->count()
            ]);
        }

        // 🔥 STEP 2: No exact matches - Check what levels ARE available
        $allCoursesInCategory = Course::where(function($query) use ($validated) {
            foreach ($validated['interests'] as $interest) {
                $query->orWhere('category', 'like', "%$interest%")
                      ->orWhere('title', 'like', "%$interest%");
            }
        })->get();

        Log::info('📚 All courses for this topic:', [
            'count' => $allCoursesInCategory->count(),
            'available_levels' => $allCoursesInCategory->pluck('difficulty')->unique()->values()->toArray()
        ]);

        if ($allCoursesInCategory->isNotEmpty()) {
            // 🔥 COURSES EXIST BUT NOT AT REQUESTED LEVEL - TRIGGER FRONTEND FALLBACK
            $availableLevels = $allCoursesInCategory->pluck('difficulty')->unique()->filter()->values();
            
            // Transform courses for frontend to use in fallback
            $transformedCourses = $allCoursesInCategory->map(function($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'description' => $course->description,
                    'category' => $course->category,
                    'difficulty' => $course->difficulty,
                    'views' => $course->views ?? 0,
                    'average_rating' => round($course->ratings_avg_rating ?? 0, 1),
                    'rating_count' => $course->ratings_count ?? 0,
                    'url' => route('courses.show', $course->id),
                    'instructor' => $course->instructor ?: 'SkillHub',
                    'excerpt' => $this->generateCourseExcerpt($course),
                    'learning_outcomes' => $this->generateLearningOutcomes($course)
                ];
            });

            return response()->json([
                'success' => true,
                'courses' => $transformedCourses,
                'skill_level_mismatch' => true, // 🔥 KEY FLAG FOR FRONTEND
                'requested_level' => $normalizedSkillLevel,
                'available_levels' => $availableLevels->toArray(),
                'message' => "No {$normalizedSkillLevel} level courses found, but other levels are available",
                'stats' => [
                    'total_found' => 0,
                    'exact_matches' => 0,
                    'available_courses' => $allCoursesInCategory->count(),
                    'search_criteria' => [
                        'interests' => $validated['interests'],
                        'skill_level' => $normalizedSkillLevel,
                        'available_levels' => $availableLevels->toArray()
                    ]
                ],
                'recommendations_count' => 0
            ]);
        }

        // 🔥 STEP 3: No courses found for this topic at all
        Log::info('❌ No courses found for this topic');
        return response()->json([
            'success' => false,
            'courses' => [],
            'message' => "No courses found for " . implode(', ', $validated['interests']),
            'error' => 'no_topic_match',
            'stats' => [
                'total_found' => 0,
                'search_criteria' => [
                    'interests' => $validated['interests'],
                    'skill_level' => $normalizedSkillLevel
                ]
            ],
            'recommendations_count' => 0
        ], 404);
        
    } catch (\Exception $e) {
        Log::error('❌ ERROR in getRecommendations: ' . $e->getMessage());
        Log::error('❌ Stack trace: ' . $e->getTraceAsString());
        
        return response()->json([
            'success' => false,
            'error' => 'Sorry, I\'m having trouble finding courses right now. Please try again.',
            'courses' => [],
            'message' => 'Service temporarily unavailable',
            'debug' => [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]
        ], 500);
    }
}

    /**
     * Get dynamic options from database
     */
    public function getOptions() 
    {
        try {
            // Get categories dynamically from courses table
            $categories = Course::select('category')
                ->distinct()
                ->whereNotNull('category')
                ->where('category', '!=', '')
                ->orderBy('category')
                ->pluck('category')
                ->values();

            // Get skill levels from courses
            $skillLevels = Course::select('difficulty')
                ->distinct()
                ->whereNotNull('difficulty')
                ->where('difficulty', '!=', '')
                ->orderByRaw("FIELD(difficulty, 'Beginner', 'Intermediate', 'Advanced')")
                ->pluck('difficulty')
                ->values();

            Log::info('📊 Dynamic options retrieved', [
                'categories_count' => $categories->count(),
                'categories' => $categories->toArray(),
                'skill_levels' => $skillLevels->toArray()
            ]);

            return response()->json([
                'success' => true,
                'categories' => $categories,
                'skillLevels' => $skillLevels,
                'total_courses' => Course::count(),
                'total_categories' => $categories->count()
            ]);
            
        } catch (\Exception $e) {
            Log::error('❌ Error getting options: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'categories' => [],
                'skillLevels' => ['Beginner', 'Intermediate', 'Advanced'],
                'error' => 'Could not load dynamic options'
            ], 500);
        }
    }

    /**
     * Enhanced interest validation with smart matching
     */
    public function validateInterests(Request $request)
    {
        try {
            $request->validate([
                'interests' => 'required|array'
            ]);
            
            Log::info('🔍 Validating interests:', $request->interests);
            
            // Get all available categories from courses
            $allCategories = Course::select('category')
                ->distinct()
                ->whereNotNull('category')
                ->where('category', '!=', '')
                ->pluck('category')
                ->toArray();
            
            Log::info('📚 Available categories:', $allCategories);
            
            $valid = [];
            $invalid = [];
            $suggestions = [];
            
            foreach ($request->interests as $interest) {
                $interest = trim($interest);
                $found = false;
                
                // Exact match (case insensitive)
                foreach ($allCategories as $category) {
                    if (strtolower($category) === strtolower($interest)) {
                        $valid[] = $category;
                        $found = true;
                        Log::info("✅ Exact match found: $interest -> $category");
                        break;
                    }
                }
                
                // Partial match if no exact match
                if (!$found) {
                    foreach ($allCategories as $category) {
                        if (stripos($category, $interest) !== false || stripos($interest, $category) !== false) {
                            $valid[] = $category;
                            $found = true;
                            Log::info("✅ Partial match found: $interest -> $category");
                            break;
                        }
                    }
                }
                
                if (!$found) {
                    $invalid[] = $interest;
                    Log::info("❌ No match found for: $interest");
                }
            }
            
            Log::info('🎯 Interest validation completed', [
                'valid' => $valid,
                'invalid' => $invalid
            ]);
            
            return response()->json([
                'success' => true,
                'valid' => array_unique($valid),
                'invalid' => $invalid,
                'suggestions' => $suggestions,
                'available_categories' => $allCategories
            ]);
            
        } catch (\Exception $e) {
            Log::error('❌ Error validating interests: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'valid' => [],
                'invalid' => $request->interests ?? [],
                'error' => 'Could not validate interests'
            ], 500);
        }
    }

    /**
     * Enhanced skill level validation
     */
    public function validateSkillLevel(Request $request)
    {
        try {
            $request->validate([
                'interests' => 'required|array',
                'skill_level' => 'required|string'
            ]);
            
            // Normalize skill level
            $skillLevelMapping = [
                'beginner' => 'Beginner',
                'intermediate' => 'Intermediate', 
                'advanced' => 'Advanced'
            ];
            
            $normalizedSkillLevel = $skillLevelMapping[strtolower($request->skill_level)] ?? $request->skill_level;
            
            // Check if courses exist for this combination
            $coursesExist = Course::whereIn('category', $request->interests)
                ->where('difficulty', $normalizedSkillLevel)
                ->exists();
                
            if ($coursesExist) {
                return response()->json([
                    'success' => true,
                    'valid' => true
                ]);
            }
            
            // Find available levels for these interests
            $availableLevels = Course::whereIn('category', $request->interests)
                ->distinct()
                ->pluck('difficulty')
                ->filter()
                ->values()
                ->toArray();
                
            return response()->json([
                'success' => true,
                'valid' => false,
                'available_levels' => $availableLevels,
                'message' => "No {$normalizedSkillLevel} courses found for your interests."
            ]);
            
        } catch (\Exception $e) {
            Log::error('❌ Error validating skill level: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'valid' => false,
                'error' => 'Could not validate skill level'
            ], 500);
        }
    }

    /**
     * Get popular courses for recommendations
     */
    public function getPopularCourses()
    {
        try {
            $popularCourses = Course::withCount('ratings')
                ->withAvg('ratings', 'rating')
                ->where('views', '>', 0)
                ->orderByDesc('views')
                ->orderByDesc('ratings_avg_rating')
                ->limit(10)
                ->get()
                ->map(function($course) {
                    return [
                        'id' => $course->id,
                        'title' => $course->title,
                        'category' => $course->category,
                        'difficulty' => $course->difficulty,
                        'average_rating' => round($course->ratings_avg_rating ?? 0, 1),
                        'views' => $course->views,
                        'url' => route('courses.show', $course->id),
                        'enrollment_count' => $course->ratings_count ?? 0
                    ];
                });

            return response()->json([
                'success' => true,
                'courses' => $popularCourses
            ]);
            
        } catch (\Exception $e) {
            Log::error('❌ Error getting popular courses: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'courses' => [],
                'error' => 'Could not load popular courses'
            ], 500);
        }
    }

    /**
     * Get course statistics for dashboard
     */
    public function getCourseStats()
    {
        try {
            $stats = [
                'total_courses' => Course::count(),
                'total_categories' => Course::distinct('category')->count('category'),
                'avg_rating' => round(Course::withAvg('ratings', 'rating')->avg('ratings_avg_rating'), 1),
                'total_views' => Course::sum('views'),
                'top_category' => Course::select('category')
                    ->groupBy('category')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()
                    ->category ?? 'Programming',
                'difficulty_distribution' => Course::select('difficulty', DB::raw('count(*) as count'))
                    ->groupBy('difficulty')
                    ->pluck('count', 'difficulty')
                    ->toArray()
            ];

            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);
            
        } catch (\Exception $e) {
            Log::error('❌ Error getting course stats: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'stats' => [],
                'error' => 'Could not load statistics'
            ], 500);
        }
    }

    /**
     * Generate course excerpt for display
     */
    private function generateCourseExcerpt($course)
    {
        if (strlen($course->description) > 150) {
            return substr($course->description, 0, 150) . '...';
        }
        
        return $course->description ?: 'Comprehensive course covering essential concepts and practical skills.';
    }

    /**
     * Generate learning outcomes based on course category
     */
    private function generateLearningOutcomes($course)
    {
        $outcomes = [
            'Python Programming' => "Master Python syntax and fundamentals\nBuild real-world projects\nUnderstand object-oriented programming\nWork with libraries and frameworks",
            'Web Development' => "Create responsive websites\nMaster HTML, CSS, and JavaScript\nBuild dynamic web applications\nUnderstand modern web technologies",
            'Data Science' => "Analyze complex datasets\nCreate data visualizations\nApply statistical methods\nBuild predictive models",
            'Machine Learning' => "Understand ML algorithms\nImplement machine learning models\nWork with real datasets\nDeploy ML solutions",
            'Cybersecurity' => "Identify security vulnerabilities\nImplement security measures\nUnderstand threat analysis\nMaster security best practices"
        ];
        
        return $outcomes[$course->category] ?? "Gain comprehensive knowledge in {$course->category}\nDevelop practical skills\nWork on hands-on projects\nMaster industry best practices";
    }
}