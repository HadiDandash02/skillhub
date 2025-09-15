<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeSubmission;
use App\Services\Judge0Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ChallengeController extends Controller
{
    protected $judge0Service;

    public function __construct(Judge0Service $judge0Service)
    {
        $this->judge0Service = $judge0Service;
    }

    /**
     * Display the challenge details
     */
    public function show($id)
    {
        $challenge = Challenge::with(['testCases' => function($query) {
            $query->where('is_hidden', false); // Only show public test cases
        }])->findOrFail($id);

        // Get user's latest submission if authenticated
        $latestSubmission = null;
        if (Auth::check()) {
            $latestSubmission = $challenge->latestSubmission(Auth::id());
        }

        return view('challenge.show', compact('challenge', 'latestSubmission'));
    }

    /**
     * Submit and evaluate the challenge solution using Judge0
     */
    public function submit(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:10000',
        ]);

        $challenge = Challenge::with('testCases')->findOrFail($id);

        // The challenge already has its language specified
        $languageId = $challenge->language_id;
        $languageName = $challenge->language_name;

        $startTime = microtime(true);

        try {
            // Create submission record
            $submission = ChallengeSubmission::create([
                'user_id' => Auth::id(),
                'challenge_id' => $challenge->id,
                'code' => $request->code,
                'language' => $languageName, // Store the language used
                'status' => 'pending',
                'submitted_at' => Carbon::now()
            ]);

            // Execute code against test cases using Judge0
            $results = $this->judge0Service->execute(
                $request->code,
                $challenge->testCases,
                $languageId, // Use the challenge's language ID
                $challenge->test_function_name,
                $challenge->time_limit ?? 5
            );

            $executionTime = microtime(true) - $startTime;

            // Calculate score and status
            $passedTests = collect($results['test_results'])->where('passed', true)->count();
            $totalTests = count($results['test_results']);
            $score = $totalTests > 0 ? round(($passedTests / $totalTests) * 100) : 0;
            
            $status = $results['success'] ? 'passed' : 'failed';
            if ($results['error_message']) {
                $status = strpos($results['error_message'], 'Time Limit') !== false ? 'timeout' : 'error';
            }

            // Update submission
            $submission->update([
                'status' => $status,
                'execution_time' => $results['total_execution_time'],
                'test_results' => $results['test_results'],
                'error_message' => $results['error_message'],
                'score' => $score
            ]);

            // Prepare response
            $response = [
                'success' => $results['success'],
                'status' => $status,
                'score' => $score,
                'passed_tests' => $passedTests,
                'total_tests' => $totalTests,
                'execution_time' => round($results['total_execution_time'] * 1000), // Convert to milliseconds
                'test_results' => $results['test_results'],
                'error_message' => $results['error_message'],
                'language' => $languageName,
                'submission_id' => $submission->id
            ];

            // Add celebration data if all tests passed
            if ($results['success']) {
                $response['celebration'] = [
                    'message' => "🎉 Congratulations! You solved this {$languageName} challenge!",
                    'rank' => $this->getUserRank($challenge, $results['total_execution_time']),
                    'improvement' => $this->getImprovement($challenge, Auth::id(), $results['total_execution_time'])
                ];
            }

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error("Challenge submission error for {$languageName}: " . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'status' => 'error',
                'error_message' => 'An unexpected error occurred while evaluating your code.',
                'test_results' => [],
                'language' => $languageName
            ], 500);
        }
    }

    /**
     * Get user's rank based on execution time
     */
    private function getUserRank($challenge, $executionTime)
    {
        $fasterSubmissions = ChallengeSubmission::where('challenge_id', $challenge->id)
            ->where('status', 'passed')
            ->where('execution_time', '<', $executionTime)
            ->count();

        return $fasterSubmissions + 1;
    }

    /**
     * Get improvement message
     */
    private function getImprovement($challenge, $userId, $currentTime)
    {
        $previousBest = ChallengeSubmission::where('challenge_id', $challenge->id)
            ->where('user_id', $userId)
            ->where('status', 'passed')
            ->where('execution_time', '<', $currentTime)
            ->orderBy('execution_time')
            ->first();

        if ($previousBest) {
            $improvement = $previousBest->execution_time - $currentTime;
            return "You improved by " . round($improvement * 1000) . "ms!";
        }

        return null;
    }
}