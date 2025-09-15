<?php

// In LmsController.php
namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\Rating;
use App\Models\SkillLevel;
use App\Models\Interest;
use Illuminate\Http\Request;

class LmsController extends Controller
{
    public function lmslogin()
    {
        return redirect()->route('lms');
    }

    public function index(Request $request)
{

    // Get all unique categories from courses - DYNAMIC
        $categories = Course::select('category')
        ->distinct()
        ->whereNotNull('category')
        ->where('category', '!=', '')
        ->pluck('category');
    // Get filter inputs
    $category = $request->input('category', 'all');
    $difficulty = $request->input('difficulty', 'all');
    //$search = $request->input('search', '');

    // Start building the query
    $query = Course::query();

    // Apply category filter if it's not "all"
    if ($category !== 'all') {
        $query->where('category', $category);
    }

    // Apply difficulty filter if it's not "all"
    if ($difficulty !== 'all') {
        $query->where('difficulty', $difficulty);
    }

    // Apply search filter
    // if (!empty($search)) {
    //     $query->where('title', 'like', '%' . $search . '%')
    //         ->orWhere('description', 'like', '%' . $search . '%');
    // }

    // Get the filtered courses and eager load ratings
   $courses = $query->with('ratings')->paginate(6)->appends($request->query());

    // Fetch challenges, quizzes, and other necessary data
    $challenges = Challenge::all();
    $quizzes = Quiz::all();
    $interests = Interest::all();
    $skillLevels = SkillLevel::all();

    // Calculate average rating for each course
    foreach ($courses as $course) {
        $ratings = $course->ratings()->where('course_id', $course->id)->get(); // Fetch ratings for the specific course

        $ratingSum = $ratings->sum('rating'); // Use the correct field name 'rating'
        $ratingCount = $ratings->count();  // Count of all ratings

        // Calculate average rating (if there are ratings)
        $averageRating = $ratingCount > 0 ? $ratingSum / $ratingCount : 0;

        $course->average_rating = $averageRating; // Assign the calculated average rating to the course
        $course->rating_count = $ratingCount;
        $course->views = $course->views ?? 0;
        $isRated = Rating::where("course_id", $course->id)->where("user_id", auth()->id())->first();
        $course->isRated = $isRated ? true : false;
    }

    // Return the view with the data
    return view('lms', compact('challenges', 'quizzes', 'courses', 'interests', 'skillLevels', 'categories', ));
}




    // Handle the form submission and display filtered courses
    public function handleLearningPaths(Request $request)
    {
        $selectedInterests = $request->input('interests', []);
        $selectedSkillLevelId = $request->input('skill_level');
        
        // Fetch the skill level name from the skill_levels table
        $selectedSkillLevel = SkillLevel::find($selectedSkillLevelId)->level;

       // Fetch courses based on selected interests and skill level
        $courses = Course::whereIn('category', $selectedInterests)
        ->where('difficulty', $selectedSkillLevel)
        ->get();

        // Return the LMS page with the filtered courses
        return view('learningPathsResults', ['courses' => $courses]);
    }

    private function getFilteredCourses($selectedInterests, $selectedSkillLevel)
    {
        // Here, query your database for courses based on interests and skill level.
        // For example:
        return Course::whereIn('category', $selectedInterests)
                     ->where('difficulty', $selectedSkillLevel)
                     ->get();
    }
}
