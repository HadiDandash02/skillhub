<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CareerAdvice;

class JobListingController extends Controller
{
    public function index()
    {
        $jobListings = JobListing::all();
        $careerAdvices = CareerAdvice::all()->groupBy('category');
        return view('careerservices', compact('jobListings','careerAdvices'));
    }

    public function careerlogin()
    {
        return redirect()->route('careerservices');
    }


    // Show individual job details
    public function show($id)
    {
        $job = JobListing::findOrFail($id);
        
        // Check if user already applied for this job
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = JobApplication::where('job_listing_id', $id)
                                      ->where('user_id', Auth::id())
                                      ->exists();
        }
        
        return view('job/job-details', compact('job', 'hasApplied'));
    }


   /* public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        JobListing::create($request->all());

        return redirect()->back()->with('success', 'Job listing added successfully!');
    }*/

    // Handle applying for a job
     public function apply(Request $request, $jobId)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to apply!');
        }

        // Validate the application form
        $request->validate([
            'cover_letter' => 'required|string|max:2000',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'phone' => 'required|string|max:20',
            'linkedin_url' => 'nullable|url',
            'portfolio_url' => 'nullable|url',
            'availability' => 'required|string',
            'salary_expectation' => 'nullable|string',
        ]);

        // Find the job listing by ID
        $jobListing = JobListing::findOrFail($jobId);
        $userId = Auth::id();

        // Check if the user has already applied for this job
        $existingApplication = JobApplication::where('job_listing_id', $jobListing->id)
                                             ->where('user_id', $userId)
                                             ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this job!');
        }

        // Handle file upload
        $cvPath = null;
        if ($request->hasFile('cv_file')) {
            $cvPath = $request->file('cv_file')->store('cvs', 'public');
        }

        // Create a new job application with additional data
        JobApplication::create([
            'job_listing_id' => $jobListing->id,
            'user_id' => $userId,
            'status' => 'Applied',
            'cover_letter' => $request->cover_letter,
            'cv_path' => $cvPath,
            'phone' => $request->phone,
            'linkedin_url' => $request->linkedin_url,
            'portfolio_url' => $request->portfolio_url,
            'availability' => $request->availability,
            'salary_expectation' => $request->salary_expectation,
        ]);

        return back()->with('success', 'Your application has been submitted successfully!');
    }
    
}

