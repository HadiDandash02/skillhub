<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    // Define the fields that are mass assignable
    protected $fillable = [
        'job_listing_id',
        'user_id',
        'status',
        'cover_letter',
        'cv_path',
        'phone',
        'linkedin_url',
        'portfolio_url',
        'availability',
        'salary_expectation',
        'applied_at',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($application) {
            $application->applied_at = now();
        });
    }

    // Relationship with JobListing (A JobApplication belongs to one JobListing)
    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }

    // Relationship with User (A JobApplication belongs to one User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get CV file URL
    public function getCvUrlAttribute()
    {
        return $this->cv_path ? asset('storage/' . $this->cv_path) : null;
    }
    public function careerManager()
{
    return $this->belongsTo(User::class, 'career_manager_id');
}

    // Get status with styling
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'Applied' => 'status-applied',
            'Pending' => 'status-pending',
            'Accepted' => 'status-accepted',
            'Rejected' => 'status-rejected',
            'Under Review' => 'status-pending',
        ];

        return $statuses[$this->status] ?? 'status-default';
    }

     // Accessors
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y \a\t g:i A');
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->format('M d, Y \a\t g:i A');
    }
}