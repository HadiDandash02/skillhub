<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeTestCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'challenge_id',
        'input',
        'expected_output',
        'is_hidden',
        'description',
        'weight'
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
        'weight' => 'integer'
    ];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}