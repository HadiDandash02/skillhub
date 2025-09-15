<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challenge_id',
        'code',
        'language', // Add this field
        'status',
        'execution_time',
        'memory_used',
        'test_results',
        'error_message',
        'score',
        'submitted_at'
    ];

    protected $casts = [
        'test_results' => 'array',
        'execution_time' => 'float',
        'memory_used' => 'float',
        'score' => 'integer',
        'submitted_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function isPassed()
    {
        return $this->status === 'passed';
    }

    public function isFailed()
    {
        return in_array($this->status, ['failed', 'error', 'timeout']);
    }

    public function getPassedTestsCountAttribute()
    {
        if (!$this->test_results) return 0;
        return collect($this->test_results)->where('passed', true)->count();
    }

    public function getTotalTestsCountAttribute()
    {
        if (!$this->test_results) return 0;
        return count($this->test_results);
    }
}