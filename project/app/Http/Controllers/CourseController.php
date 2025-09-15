<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(Request $request) {
        $query = Course::query();
        
        // Retrieve filter parameters from the URL
        $category = $request->query('category', 'all'); // Default to 'all' if not provided
        $difficulty = $request->query('difficulty', 'all'); // Default to 'all' if not provided
        $search = $request->query('search', ''); // Default to empty string if not provided
        
        // Filter by category if provided
        if ($category !== 'all') {
            $query->where('category', $category);
        }
        
        // Filter by difficulty if provided
        if ($difficulty !== 'all') {
            $query->where('difficulty', $difficulty);
        }
        
        // Perform the search query if a search term is provided
        if (!empty($search)) {
            // Searching by title and description
            $query->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        // Get the filtered courses
        $courses = $query->get();

       
        // Pass the filtered courses to the view
        return view('lms', compact('courses'));
    }
    
   public function show($id)
{
    $course = Course::with(['chapters.pdfs', 'quizzes', 'challenges','tutorials'])
               ->withCount('viewers as view_count') // This adds view_count property
               ->findOrFail($id);
    
               if(Auth()->user()) {
                $course->incrementViews(auth()->user());
               }
    
               $tutorialLink = optional($course->tutorials->first())->link;
               $embedUrl = $this->convertToEmbedUrl($tutorialLink);
    // In your show method
return view('courses.show', [
    'course' => $course,
    'tutorialLink' => $tutorialLink,
    'embedUrl' => $embedUrl,
    'view_count' => $course->view_count // Explicitly pass it if needed
]);
}

 private function convertToEmbedUrl($url)
    {
        if (!$url) {
            return null;
        }
        
        // YouTube watch URL: https://www.youtube.com/watch?v=VIDEO_ID
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // YouTube short URL: https://youtu.be/VIDEO_ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // YouTube playlist URL: https://www.youtube.com/playlist?list=PLAYLIST_ID
        if (preg_match('/youtube\.com\/playlist\?list=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed?listType=playlist&list=' . $matches[1];
        }
        
        // Vimeo URL: https://vimeo.com/VIDEO_ID
        if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }
        
        // If it's already an embed URL or not a recognized video platform, return as is
        return $url;
    }
    
}
