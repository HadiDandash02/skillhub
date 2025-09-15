<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_name', // Added company_name to fillable array
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    /**
     * Check if user is a career manager
     *
     * @return bool
     */
    public function isCareerManager(): bool
    {
        return $this->role === 'careerM';
    }

    /**
     * Get the company name for career managers
     *
     * @return string|null
     */
    public function getCompanyName(): string
    {
        // If user is a career manager and has company_name, return it
        if ($this->isCareerManager() && $this->company_name) {
            return $this->company_name;
        }
        
        // If user is a career manager but no company_name, return a default
        if ($this->isCareerManager()) {
            return 'My Company';
        }
        
        // For non-career managers, return a generic name
        return 'Default Company';
    }

    public function jobListings()
{
    return $this->hasMany(JobListing::class, 'career_manager_id');
}

public function careerAdvices()
{
    return $this->hasMany(CareerAdvice::class, 'career_manager_id');
}
}