<?php

namespace App\Http\Controllers;

use App\Models\CareerAdvice;
use App\Models\JobListing;
use Illuminate\Http\Request;

class CareerManagerController extends Controller
{
    // Display all job listings (only career manager's own listings)
    public function manageJobs()
    {
        $query = JobListing::query();

        // Always filter by career manager - only show their own listings
        $query->where('career_manager_id', auth()->id());

        $jobs = $query->get();
        return view('careerManager.jobs.index', compact('jobs'));
    }

    // Show Add Job Form
    public function createJob()
    {
         // Pass the career manager's company name to the view
        $careerManager = auth()->user();
        $companyName = $careerManager->getCompanyName();
        
        return view('careerManager.jobs.create-job', compact('companyName'));
    }

    // Store New Job
    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'salary_range' => 'nullable|string|max:255',
            'employment_type' => 'required|string|max:255',
            'experience_level' => 'nullable|string|max:255',
            'skills_required' => 'nullable|string',
            'deadline' => 'nullable|date',
            'remote_option' => 'boolean',
            'company_description' => 'nullable|string',
        ]);

        // Process skills - convert from comma-separated string to array
        $skills = [];
        if ($request->skills_required) {
            $skills = array_map('trim', explode(',', $request->skills_required));
        }

        JobListing::create([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'responsibilities' => $request->responsibilities,
            'benefits' => $request->benefits,
            'salary_range' => $request->salary_range,
            'employment_type' => $request->employment_type,
            'experience_level' => $request->experience_level,
            'skills_required' => $skills,
            'posted_date' => now(),
            'deadline' => $request->deadline,
            'remote_option' => $request->has('remote_option'),
            'company_description' => $request->company_description,
            'career_manager_id' => auth()->id(), // Add career manager ID
        ]);

        return redirect()->route('careerM.jobs')->with('success', 'New job listing created successfully!');
    }

    // Check authorization for all edit, update, delete methods
    public function editJob($id)
    {
        $job = JobListing::findOrFail($id);

        // Check if career manager can only edit their own job listings
        if ($job->career_manager_id !== auth()->id()) {
            abort(403, 'Unauthorized to edit this job listing.');
        }

        // Pass the career manager's company name to the view
        $careerManager = auth()->user();
        $companyName = $careerManager->getCompanyName();

        return view('careerManager.jobs.edit-job', compact('job', 'companyName'));
    }

    public function updateJob(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'salary_range' => 'nullable|string|max:255',
            'employment_type' => 'required|string|max:255',
            'experience_level' => 'nullable|string|max:255',
            'skills_required' => 'nullable|string',
            'deadline' => 'nullable|date',
            'remote_option' => 'boolean',
            'company_description' => 'nullable|string',
        ]);

        $job = JobListing::findOrFail($id);

        // Check if career manager can only update their own job listings
        if ($job->career_manager_id !== auth()->id()) {
            abort(403, 'Unauthorized to update this job listing.');
        }

        // Process skills - convert from comma-separated string to array
        $skills = [];
        if ($request->skills_required) {
            $skills = array_map('trim', explode(',', $request->skills_required));
        }

        $job->update([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'responsibilities' => $request->responsibilities,
            'benefits' => $request->benefits,
            'salary_range' => $request->salary_range,
            'employment_type' => $request->employment_type,
            'experience_level' => $request->experience_level,
            'skills_required' => $skills,
            'deadline' => $request->deadline,
            'remote_option' => $request->has('remote_option'),
            'company_description' => $request->company_description,
        ]);

        return redirect()->route('careerM.jobs')->with('success', 'Job listing updated successfully!');
    }

    public function deleteJob($id)
    {
        $job = JobListing::findOrFail($id);

        // Check if career manager can only delete their own job listings
        if ($job->career_manager_id !== auth()->id()) {
            abort(403, 'Unauthorized to delete this job listing.');
        }

        $job->delete();

        return redirect()->route('careerM.jobs')->with('success', 'Job listing deleted successfully!');
    }

    // 📌 Manage Career Advice (only career manager's own advice)
    public function manageCareerAdvice()
    {
        $query = CareerAdvice::query();

        // Always filter by career manager - only show their own advice
        $query->where('career_manager_id', auth()->id());

        $advices = $query->get();
        return view('careerManager.advices.index', compact('advices'));
    }

    // 📌 Show Create Career Advice Form
    public function createCareerAdvice()
    {
        $careerManager = auth()->user();
        $companyName = $careerManager->getCompanyName();
        return view('careerManager.advices.create', compact('companyName'));
    }

    // 📌 Store New Career Advice
    public function storeCareerAdvice(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['career_manager_id'] = auth()->id(); // Add career manager ID

        CareerAdvice::create($data);

        return redirect()->route('careerM.career-advice')->with('success', 'Career advice created successfully!');
    }

    public function editCareerAdvice($id)
    {
        $advice = CareerAdvice::findOrFail($id);

        // Check if career manager can only edit their own career advice
        if ($advice->career_manager_id !== auth()->id()) {
            abort(403, 'Unauthorized to edit this career advice.');
        }

        $careerManager = auth()->user();
        $companyName = $careerManager->getCompanyName();
        return view('careerManager.advices.edit', compact('advice', 'companyName'));
    }

    public function updateCareerAdvice(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
        ]);

        $advice = CareerAdvice::findOrFail($id);

        // Check if career manager can only update their own career advice
        if ($advice->career_manager_id !== auth()->id()) {
            abort(403, 'Unauthorized to update this career advice.');
        }

        $advice->update($request->all());

        return redirect()->route('careerM.career-advice')->with('success', 'Career advice updated successfully!');
    }

    public function deleteCareerAdvice($id)
    {
        $advice = CareerAdvice::findOrFail($id);

        // Check if career manager can only delete their own career advice
        if ($advice->career_manager_id !== auth()->id()) {
            abort(403, 'Unauthorized to delete this career advice.');
        }

        $advice->delete();

        return redirect()->route('careerM.career-advice')->with('success', 'Career advice deleted successfully!');
    }
}