<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller {
    public function store(Request $request, $courseId) {
    $request->validate(['rating' => 'required|integer|min:1|max:5']);

    // Check if rating already exists
    $existingRating = Rating::where('user_id', Auth::id())
                          ->where('course_id', $courseId)
                          ->first();

    $isUpdate = $existingRating !== null;

    // Update or create rating
    $rating = Rating::updateOrCreate(
        ['user_id' => Auth::id(), 'course_id' => $courseId],
        ['rating' => $request->rating]
    );

    $course = Course::find($courseId);
    $newAverageRating = $course->averageRating(); // 🔥 Calculate new average
    $message = $isUpdate ? 'Rating updated successfully!' : 'Rating submitted successfully!';

    // Return JSON for AJAX requests with the new average
    if ($request->expectsJson() || $request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'action' => $isUpdate ? 'updated' : 'created',
            'rating' => $request->rating,
            'average_rating' => $newAverageRating, // 🔥 Include new average
            'total_ratings' => $course->ratings()->count()
        ]);
    }

    // For regular form submission, redirect back
    return redirect()->back()->with('success', $message);
}

// ADD THIS METHOD for fetching rating info:
public function getRatingInfo($courseId) {
    $course = Course::find($courseId);
    
    if (!$course) {
        return response()->json(['success' => false, 'message' => 'Course not found'], 404);
    }
    
    return response()->json([
        'success' => true,
        'average_rating' => $course->averageRating(),
        'total_ratings' => $course->ratings()->count(),
        'course_id' => $courseId
    ]);
}
}