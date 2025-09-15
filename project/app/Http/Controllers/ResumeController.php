<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    // This method will handle the resume form submission
    public function generate(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:7,20',
            'summary' => 'required|string|min:10|max:1000',
        ], [
            // Custom error messages for 'name'
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name must not exceed 255 characters.',
            'name.regex' => 'The name may only contain letters, spaces, and hyphens.',
        
            // Custom error messages for 'email'
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email must not exceed 255 characters.',
        
            // Custom error messages for 'phone'
            'phone.required' => 'The phone field is required.',
            'phone.digits_between' => 'The phone number must be between 7 and 20 digits.',
        
            // Custom error messages for 'summary'
            'summary.required' => 'The summary field is required.',
            'summary.string' => 'The summary must be a valid string.',
            'summary.min' => 'The summary must be at least 10 characters long.',
            'summary.max' => 'The summary must not exceed 1000 characters.',
        ]);
        
        

        // Prepare the data to pass to the view
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'summary' => $request->summary,
        ];

        // Generate the PDF from a Blade view
        $pdf = Pdf::loadView('resume.pdf', $data);

        // Return the PDF as a download
        return $pdf->download('resume.pdf');
    }
}
