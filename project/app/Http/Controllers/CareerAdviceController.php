<?php

namespace App\Http\Controllers;
use App\Models\CareerAdvice;
use Illuminate\Http\Request;

class CareerAdviceController extends Controller
{
    public function show($id)
    {
        // Load the advice with the career manager relationship
        $advice = CareerAdvice::with('careerManager')->findOrFail($id);
        return view('careerAdvice.show', compact('advice'));
    }
}
    

