<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'description',
        'requirements',
        'responsibilities',
        'benefits',
        'salary_range',
        'employment_type',
        'experience_level',
        'skills_required',
        'posted_date',
        'deadline',
        'remote_option',
        'company_logo',
        'company_description',
        'career_manager_id',
    ];

    protected $casts = [
        'posted_date' => 'datetime',
        'deadline' => 'datetime',
        'remote_option' => 'boolean',
        'skills_required' => 'array',
    ];

    // Relationship with JobApplications
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    // Get formatted salary range
    public function getFormattedSalaryAttribute()
    {
        return $this->salary_range ?: 'Competitive salary';
    }

    // Check if job is still accepting applications
    public function isActive()
    {
        return $this->deadline ? $this->deadline > now() : true;
    }
}