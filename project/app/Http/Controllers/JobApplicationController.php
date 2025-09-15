<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    // HR dashboard: list all job applications
    public function index()
    {
        $companyName = auth()->user()->getCompanyName();
        $applications = JobApplication::whereHas('jobListing', function($query) use ($companyName) {
            $query->where('company', $companyName);
        })->with(['jobListing', 'user'])->latest()->get();
        
        return view('careerManager.applications', compact('applications'));
    }

    // HR updates the status of a job application
    public function updateStatus(Request $request, JobApplication $application)
    {
        $request->validate([
            'status' => 'required|in:Applied,Pending,Accepted,Rejected',
        ]);

        $application->status = $request->status;
        $application->save();

        return redirect()->route('careerM.applications')->with('success', 'Application status updated!');
    }

    /**
     * Get detailed application information for modal display
     * NEW METHOD FOR ENHANCED FUNCTIONALITY
     */
    public function getApplicationDetails($applicationId)
    {
        try {
            $application = JobApplication::with(['user', 'jobListing'])
                ->findOrFail($applicationId);
            
            // Check if the career manager can access this application
            $companyName = auth()->user()->getCompanyName();
            if ($application->jobListing->company !== $companyName) {
                return response()->json([
                    'error' => 'Unauthorized access to this application'
                ], 403);
            }
            
            // Format the application data for the frontend
            $applicationData = [
                'id' => $application->id,
                'status' => $application->status,
                'cover_letter' => $application->cover_letter ?? 'No cover letter provided',
                'cv_path' => $application->cv_path,
                'phone' => $application->phone,
                'linkedin_url' => $application->linkedin_url,
                'portfolio_url' => $application->portfolio_url,
                'availability' => $application->availability ?? 'Not specified',
                'salary_expectation' => $application->salary_expectation,
                'created_at' => $application->created_at->toISOString(),
                'updated_at' => $application->updated_at->toISOString(),
                'user' => [
                    'id' => $application->user->id,
                    'name' => $application->user->name,
                    'email' => $application->user->email,
                ],
                'job_listing' => [
                    'id' => $application->jobListing->id,
                    'title' => $application->jobListing->title,
                    'company' => $application->jobListing->company,
                    'location' => $application->jobListing->location,
                    'employment_type' => $application->jobListing->employment_type,
                    'salary_range' => $application->jobListing->salary_range,
                ]
            ];
            
            return response()->json($applicationData);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Application not found or error occurred',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}