<!-- resources/views/learningPathsResults.blade.php -->
@extends('layouts.app')

@section('content')
<div class="learning-paths-results-container">
    <h2 class="results-title">Learning Paths Results</h2>

    <div class="courses-section">
        <h3>Courses Based on Your Interests and Skill Level</h3>
        @if($courses->isEmpty())
            <p class="no-results-message">No courses found based on your selection.</p>
        @else
            <div class="courses-list">
                @foreach ($courses as $course)
                    <div class="course-card">
                        <h4 class="course-title">{{ $course->title }}</h4>
                        <p class="course-category"><strong>Category:</strong> {{ $course->category }}</p>
                        <p class="course-difficulty"><strong>Difficulty:</strong> {{ ucfirst($course->difficulty) }}</p>
                        <p class="course-description">{{ $course->description }}</p>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary" id="LPS-button">Learn More</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
