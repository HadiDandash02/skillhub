<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    // Allow mass-assignment for these fields
    protected $fillable = [
        'title',
        'description',
        'start_button_text',
        'instructions',
        'code_placeholder',
        'expected_output',
        'course_id',
        'difficulty',
        'time_limit',
        'memory_limit',
        'test_function_name',
        'is_active',
        'language_id', // Judge0 language ID (e.g., 63 for JavaScript, 71 for Python)
        'language_name', // Human readable language name (e.g., 'javascript', 'python')
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'time_limit' => 'integer',
        'memory_limit' => 'integer'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function testCases()
    {
        return $this->hasMany(ChallengeTestCase::class);
    }

    public function submissions()
    {
        return $this->hasMany(ChallengeSubmission::class);
    }

    public function userSubmissions($userId)
    {
        return $this->submissions()->where('user_id', $userId);
    }

    public function latestSubmission($userId)
    {
        return $this->userSubmissions($userId)->latest()->first();
    }

    public function successfulSubmissions($userId)
    {
        return $this->userSubmissions($userId)->where('status', 'passed');
    }

    public function isCompletedBy($userId)
    {
        return $this->successfulSubmissions($userId)->exists();
    }

    public function getSuccessRateAttribute()
    {
        $totalSubmissions = $this->submissions()->count();
        if ($totalSubmissions === 0) return 0;
        
        $successfulSubmissions = $this->submissions()->where('status', 'passed')->count();
        return round(($successfulSubmissions / $totalSubmissions) * 100);
    }

    public function getAttemptsAttribute()
    {
        return $this->submissions()->count();
    }

    public function getAverageTimeAttribute()
    {
        return $this->submissions()
            ->where('status', 'passed')
            ->avg('execution_time') ?? 0;
    }
}