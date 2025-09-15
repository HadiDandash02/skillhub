<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display the interactive quiz details.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    
     public function index()
    {
        $quizzes = Quiz::all(); // Fetch all quizzes
        return view('lms', compact('quizzes')); // Pass quizzes to the view
    }
    public function show($id)
    {
        $quiz = Quiz::with('course')->findOrFail($id);
        $questions = json_decode($quiz->questions, true);

        return view('quiz.show', compact('quiz', 'questions'));
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

    // Decode the questions and answers from the database
    $questions = json_decode($quiz->questions, true);
    $userAnswers = $request->input('answers', []);

    $score = 0;

    foreach ($questions as $key => $question) {
        if (isset($userAnswers[$key]) && $userAnswers[$key] === $question['correct_answer']) {
            $score++;
        }
    }

        // Return the result (you can show the score or redirect the user to a results page)
        return redirect()->route('quiz.show', $id)->with('score', $score);
    }
}
