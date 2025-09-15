<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeTestCase;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\CourseTutorial;
use App\Models\Pdf;
use App\Models\Quiz;
use App\Services\Judge0Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class InstructorController extends Controller
{
    protected $judge0Service;

    public function __construct(Judge0Service $judge0Service)
    {
        $this->judge0Service = $judge0Service;
    }

    /**
     * Store a new language-specific challenge with test cases
     */
    public function storeChallenge(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'nullable|string',
            'code_placeholder' => 'nullable|string',
            'expected_output' => 'nullable|string',
            'difficulty' => 'nullable|string|in:easy,medium,hard',
            'time_limit' => 'nullable|integer|min:1|max:20',
            'test_function_name' => 'nullable|string|max:100',
            'language_name' => 'required|string',
            'language_id' => 'required|integer',
            'test_cases' => 'required|array|min:1',
            'test_cases.*.input' => 'required|string',
            'test_cases.*.expected_output' => 'required|string',
            'test_cases.*.description' => 'nullable|string|max:255',
            'test_cases.*.is_hidden' => 'boolean'
        ]);

        // Create the language-specific challenge
        $challenge = Challenge::create([
            'title' => $request->title,
            'description' => $request->description,
            'instructions' => $request->instructions,
            'code_placeholder' => $request->code_placeholder,
            'expected_output' => $request->expected_output,
            'course_id' => $request->course_id,
            'difficulty' => $request->difficulty ?? 'medium',
            'time_limit' => $request->time_limit ?? 10,
            'memory_limit' => 128,
            'test_function_name' => $request->test_function_name,
            'language_id' => $request->language_id,
            'language_name' => $request->language_name,
            'is_active' => true
        ]);

        // Create test cases
        foreach ($request->test_cases as $index => $testCaseData) {
            ChallengeTestCase::create([
                'challenge_id' => $challenge->id,
                'input' => $testCaseData['input'],
                'expected_output' => $testCaseData['expected_output'],
                'description' => $testCaseData['description'] ?? "Test case " . ($index + 1),
                'is_hidden' => isset($testCaseData['is_hidden']) ? (bool)$testCaseData['is_hidden'] : false,
                'weight' => 1
            ]);
        }

        return redirect("/instructor/courses/$request->course_id/edit")
            ->with('success', "Challenge '{$challenge->title}' created successfully for {$request->language_name} with " . count($request->test_cases) . " test cases!");
    }

    /**
     * Update language-specific challenge with test cases
     */
    public function updateChallenge(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'code_placeholder' => 'required|string',
            'expected_output' => 'required|string',
            'difficulty' => 'nullable|string|in:easy,medium,hard',
            'time_limit' => 'nullable|integer|min:1|max:20',
            'test_function_name' => 'nullable|string|max:100',
            'test_cases' => 'required|array|min:1',
            'test_cases.*.input' => 'required|string',
            'test_cases.*.expected_output' => 'required|string',
            'test_cases.*.description' => 'nullable|string|max:255',
            'test_cases.*.is_hidden' => 'boolean'
        ]);

        $challenge = Challenge::findOrFail($id);
        
        // Update challenge
        $challenge->update([
            'title' => $request->title,
            'description' => $request->description,
            'instructions' => $request->instructions,
            'code_placeholder' => $request->code_placeholder,
            'expected_output' => $request->expected_output,
            'difficulty' => $request->difficulty ?? 'medium',
            'time_limit' => $request->time_limit ?? 10,
            'test_function_name' => $request->test_function_name,
        ]);

        // Delete existing test cases and create new ones
        $challenge->testCases()->delete();

        foreach ($request->test_cases as $index => $testCaseData) {
            ChallengeTestCase::create([
                'challenge_id' => $challenge->id,
                'input' => $testCaseData['input'],
                'expected_output' => $testCaseData['expected_output'],
                'description' => $testCaseData['description'] ?? "Test case " . ($index + 1),
                'is_hidden' => isset($testCaseData['is_hidden']) ? (bool)$testCaseData['is_hidden'] : false,
                'weight' => 1
            ]);
        }

        return redirect("/instructor/courses/{$challenge->course_id}/edit")
            ->with('success', "Challenge '{$challenge->title}' updated successfully!");
    }

    /**
     * Edit challenge with test cases
     */
    public function editChallenge($id)
    {
        $challenge = Challenge::with('testCases')->findOrFail($id);
        
        // Ensure instructor can only edit their own challenges
        if (auth()->user()->role === 'instructor') {
            $course = $challenge->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to edit this challenge.');
            }
        }
        
        return view('instructor.challenges.edit', compact('challenge'));
    }

    /**
     * Delete challenge and its test cases
     */
    public function deleteChallenge($id)
    {
        $challenge = Challenge::findOrFail($id);
        $courseId = $challenge->course_id;
        
        // Check permissions
        if (auth()->user()->role === 'instructor') {
            $course = $challenge->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to delete this challenge.');
            }
        }
        
        // Delete test cases first (due to foreign key constraint)
        $challenge->testCases()->delete();
        
        // Delete challenge
        $challenge->delete();

        return redirect("/instructor/courses/$courseId/edit")
            ->with('success', 'Challenge and its test cases deleted successfully!');
    }

    /**
     * Preview test case execution using Judge0 (AJAX endpoint)
     */
    public function previewTestCase(Request $request, $challengeId)
    {
        $request->validate([
            'code' => 'required|string|max:10000',
            'test_case_input' => 'required|string',
            'test_case_output' => 'required|string'
        ]);

        try {
            $challenge = Challenge::findOrFail($challengeId);
            
            // Check permissions
            if (auth()->user()->role === 'instructor') {
                $course = $challenge->course;
                if ($course && $course->instructor_id !== auth()->id()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Unauthorized to preview this challenge.'
                    ], 403);
                }
            }

            // Create a temporary test case for preview
            $tempTestCase = new ChallengeTestCase([
                'challenge_id' => $challenge->id,
                'input' => $request->test_case_input,
                'expected_output' => $request->test_case_output,
                'description' => 'Preview test case'
            ]);

            // Use Judge0Service to execute the code
            $results = $this->judge0Service->execute(
                $request->code,
                collect([$tempTestCase]),
                $challenge->language_id,
                $challenge->test_function_name,
                $challenge->time_limit ?? 10
            );

            // Get the first (and only) test result
            $testResult = $results['test_results'][0] ?? null;

            if (!$testResult) {
                return response()->json([
                    'success' => false,
                    'test_result' => [
                        'input' => $request->test_case_input,
                        'expected' => $request->test_case_output,
                        'actual' => 'No output',
                        'passed' => false,
                        'error' => 'Failed to execute test case'
                    ]
                ]);
            }

            return response()->json([
                'success' => true,
                'test_result' => [
                    'input' => $testResult['input'],
                    'expected' => $testResult['expected'],
                    'actual' => $testResult['actual'],
                    'passed' => $testResult['passed'],
                    'execution_time' => $testResult['execution_time'],
                    'memory_used' => $testResult['memory_used'],
                    'error' => $testResult['error']
                ]
            ]);

        } catch (\Exception $e) {
            Log::error("Challenge preview error: " . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'test_result' => [
                    'input' => $request->test_case_input,
                    'expected' => $request->test_case_output,
                    'actual' => 'Error occurred',
                    'passed' => false,
                    'error' => 'An error occurred while testing: ' . $e->getMessage()
                ]
            ]);
        }
    }

    // 📌 Manage Courses
    public function manageCourses()
{
    $query = Course::query();

    // If user is instructor, only show their courses
    if (auth()->user()->role === 'instructor') {
        $query->where('instructor_id', auth()->id());
    }

    // Get all courses without pagination
    $courses = $query->get();

    

    return view('instructor.courses.index', compact('courses'));
}

    // 📌 Create a Course
    public function createCourse()
    {
        return view('instructor.courses.create');
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'instructor' => 'required|string',
            'category' => 'required|string',
            'difficulty' => 'required|string',
        ]);

        $validated['instructor_id'] = auth()->id();
        $course = Course::create($validated);

        // Save Chapters and PDFs
        if ($request->chapters) {
            foreach ($request->chapters as $chapterData) {
                $chapter = $course->chapters()->create([
                    'title' => $chapterData['title'],
                    'description' => $chapterData['description'] ?? null
                ]);

                if (isset($chapterData['pdfs'])) {
                    foreach ($chapterData['pdfs'] as $pdfData) {
                        if ($pdfData['pdf_file']) {
                            $path = $pdfData['pdf_file']->store('pdfs', 'public');
                            
                            $chapter->pdfs()->create([
                                'title' => $pdfData['title'],
                                'pdf_path' => $path
                            ]);
                        }
                    }
                }
            }
        }

        // Save Tutorials
        if ($request->tutorials) {
            foreach ($request->tutorials as $tutorialData) {
                if ($tutorialData['link']) {
                    $course->tutorials()->create([
                        'link' => $tutorialData['link']
                    ]);
                }
            }
        }

        return redirect()->route('instructor.courses')->with('success', 'Course created successfully!');
    }

    // 📌 Edit a Course
    public function editCourse($id)
    {
        $course = Course::findOrFail($id);

        if (auth()->user()->role === 'instructor' && $course->instructor_id !== auth()->id()) {
            abort(403); // Unauthorized
        }

        $playlistId = $this->extractPlaylistId($course->link ?? '');
        return view('instructor.courses.edit', compact('course','playlistId'));
    }

    private function extractPlaylistId($url)
    {
        if (empty($url)) return '';
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        return $query['list'] ?? '';
    }
    
    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        if (auth()->user()->role === 'instructor' && $course->instructor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|string',
            'difficulty' => 'required|string',
            'link' => 'nullable|url',
        ]);

        $course->update($request->all());

        return redirect()->back()->with('success', 'Course updated successfully!');
    }

    // 📌 Delete a Course
    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);

        if (auth()->user()->role === 'instructor' && $course->instructor_id !== auth()->id()) {
            abort(403);
        }

        $course->delete();

        return redirect()->route('instructor.dashboard')->with('success', 'Course deleted.');
    }

    // Manage Challenges
    

    public function createChallenge(Request $request)
    {
        $courseId = $request->query('course_id'); 
        $course = null;
        if ($courseId) {
            $course = Course::findOrFail($courseId);
            
            // Check permissions
            if (auth()->user()->role === 'instructor' && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to create challenges for this course.');
            }
        }
        return view('instructor.challenges.create',compact('course'));
    }

  
  

    public function createQuiz(Request $request)
    {
        $courseId = $request->query('course_id');

        $course = null;
        if ($courseId) {
            $course = Course::findOrFail($courseId);
            
            // Check permissions
            if (auth()->user()->role === 'instructor' && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to create quizzes for this course.');
            }
        }

        return view('instructor.quizzes.create', compact('course'));
    }

    public function storeQuiz(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_button_text' => 'nullable|string|max:255',
            'questions' => 'required|json',
            'answers' => 'required|json',
        ]);
    
        Quiz::create($request->all());
    
        return redirect("/instructor/courses/$request->course_id/edit")->with('success', 'Quiz created successfully!');
    }

    public function editQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        
        // Check permissions
        if (auth()->user()->role === 'instructor') {
            $course = $quiz->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to edit this quiz.');
            }
        }
        
        return view('instructor.quizzes.edit', compact('quiz'));
    }

    public function updateQuiz(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_button_text' => 'nullable|string|max:255',
            'questions' => 'required|json',
            'answers' => 'required|json',
        ]);

        $quiz = Quiz::findOrFail($id);
        
        // Check permissions
        if (auth()->user()->role === 'instructor') {
            $course = $quiz->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to edit this quiz.');
            }
        }
        
        $quiz->update($request->all());

        return redirect("/instructor/courses/$request->course_id/edit")->with('success', 'Quiz updated successfully!');
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $courseId = $quiz->course_id; 
        
        // Check permissions
        if (auth()->user()->role === 'instructor') {
            $course = $quiz->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to delete this quiz.');
            }
        }
        
        $quiz->delete();

        return redirect("/instructor/courses/$courseId/edit")->with('success', 'Quiz deleted successfully!');
    }

    public function deleteTutorial($id)
    {
        $tutorial = CourseTutorial::findOrFail($id);
        
        // Check permissions
        if (auth()->user()->role === 'instructor') {
            $course = $tutorial->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to delete this tutorial.');
            }
        }
        
        $tutorial->delete();

        return redirect()->back()->with('success', 'Tutorial removed successfully.');
    }

    public function addTutorial($courseId, Request $request)
    {
        $request->validate([
            'tutorial_link' => 'required|url|max:255',
        ]);

        $course = Course::findOrFail($courseId);
        
        // Check permissions
        if (auth()->user()->role === 'instructor' && $course->instructor_id !== auth()->id()) {
            abort(403, 'Unauthorized to add tutorials to this course.');
        }

        CourseTutorial::create([
            'course_id' => $courseId,
            'link' => $request->tutorial_link,
        ]);

        return redirect()->back()->with('success', 'Tutorial added.');
    }

    public function storeChapter(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480', // max 20MB
        ]);

        $course = Course::findOrFail($request->course_id);
        
        // Check permissions
        if (auth()->user()->role === 'instructor' && $course->instructor_id !== auth()->id()) {
            abort(403, 'Unauthorized to add chapters to this course.');
        }

        // Create the chapter first
        $chapter = Chapter::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Handle the PDF upload
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('pdfs', $filename, 'public');

            // Save PDF record linked to chapter
            Pdf::create([
                'chapter_id' => $chapter->id,
                'title' => $request->title,
                'pdf_path' => $filename,
            ]);
        }

        return redirect()->back()->with('success', 'Chapter added successfully!');
    }

    public function updateChapter(Request $request, Chapter $chapter)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Check permissions
        if (auth()->user()->role === 'instructor') {
            $course = $chapter->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to update this chapter.');
            }
        }

        $chapter->update($request->only(['title', 'description']));

        return redirect()->back()->with('success', 'Chapter updated successfully!');
    }

    public function destroyChapter(Chapter $chapter)
    {
        // Check permissions
        if (auth()->user()->role === 'instructor') {
            $course = $chapter->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to delete this chapter.');
            }
        }
        
        $chapter->delete();
        return redirect()->back()->with('success', 'Chapter deleted successfully!');
    }

    public function storePdf(Request $request)
    {
        $request->validate([
            'chapter_id' => 'required|exists:chapters,id',
            'title' => 'required|string|max:255',
            'pdf_file' => 'required|file|mimes:pdf|max:2048', // 2MB max
        ]);

        $chapter = Chapter::findOrFail($request->chapter_id);
        
        // Check permissions
        if (auth()->user()->role === 'instructor') {
            $course = $chapter->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to add PDFs to this chapter.');
            }
        }

        // Store in storage/app/public/pdfs
        $file = $request->file('pdf_file');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('pdfs', $filename, 'public');

        Pdf::create([
            'chapter_id' => $request->chapter_id,
            'title' => $request->title,
            'pdf_path' => $filename,
        ]);

        return back()->with('success', 'PDF uploaded successfully!');
    }

    public function destroyPdf(Pdf $pdf)
    {
        // Check permissions
        if (auth()->user()->role === 'instructor') {
            $chapter = $pdf->chapter;
            $course = $chapter->course;
            if ($course && $course->instructor_id !== auth()->id()) {
                abort(403, 'Unauthorized to delete this PDF.');
            }
        }
        
        // Delete from storage/app/public/pdfs
        Storage::disk('public')->delete('pdfs/'.$pdf->pdf_path);
        $pdf->delete();
        
        return back()->with('success', 'PDF deleted successfully!');
    }

    public function showPdf(Pdf $pdf)
    {
        $path = storage_path('app/public/pdfs/'.$pdf->pdf_path);
        return response()->file($path);
    }
}