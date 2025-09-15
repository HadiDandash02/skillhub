<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Str;

class ChatbotService
{
    public function processQuery(string $query)
    {
        // Step 1: Extract intent and parameters
        $params = $this->analyzeQuery($query);
        
        // Step 2: Fetch matching courses
        $courses = $this->getCourses(
            $params['interests'],
            $params['skill_level'],
            $params['sort_by'] ?? 'popular'
        );
        
        // Step 3: Generate natural response
        return [
            'response' => $this->generateResponse($courses, $params),
            'courses' => $courses
        ];
    }
    
    protected function analyzeQuery(string $query): array
    {
        $query = strtolower($query);
        
        // Detect skill level
        $skillLevel = 'beginner';
        if (Str::contains($query, ['advanced', 'expert', 'pro'])) {
            $skillLevel = 'advanced';
        } elseif (Str::contains($query, ['intermediate', 'medium'])) {
            $skillLevel = 'intermediate';
        }
        
        // Detect interests
        $interests = [];
        $categories = ['web development', 'programming', 'cybersecurity', 'ethical hacking'];
        foreach ($categories as $category) {
            if (Str::contains($query, $category)) {
                $interests[] = $category;
            }
        }
        
        // Default to all categories if none specified
        if (empty($interests)) {
            $interests = $categories;
        }
        
        // Detect sorting preference
        $sortBy = 'views'; // Default: popularity
        if (Str::contains($query, ['rating', 'rated'])) {
            $sortBy = 'ratings_avg_rating';
        }
        
        return [
            'interests' => $interests,
            'skill_level' => $skillLevel,
            'sort_by' => $sortBy
        ];
    }
    
    protected function getCourses(array $interests, string $skillLevel, string $sortBy)
    {
        return Course::query()
            ->whereIn('category', $interests)
            ->where('difficulty', $skillLevel)
            ->withAvg('ratings', 'rating')
            ->orderByDesc($sortBy)
            ->limit(5)
            ->get(['id', 'title', 'views', 'description', 'difficulty']);
    }
    
    protected function generateResponse($courses, $params): string
    {
        $interestList = implode(', ', $params['interests']);
        $count = $courses->count();
        
        if ($count === 0) {
            return "I couldn't find courses matching your request. Try broadening your criteria.";
        }
        
        $sortedBy = $params['sort_by'] === 'ratings_avg_rating' 
            ? 'highest rated' 
            : 'most popular';
        
        return sprintf(
            "Here are %d %s %s courses for %s level (sorted by %s):",
            $count,
            $interestList,
            $sortedBy,
            $params['skill_level'],
            $sortedBy
        );
    }
}