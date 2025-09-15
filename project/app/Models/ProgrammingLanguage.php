<?php
// File: app/Models/ProgrammingLanguage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'file_extensions',
        'runner_command',
        'version',
        'compile_command',
        'boilerplate',
        'safety_rules',
        'editor_mode',
        'supports_compilation',
        'supports_debugging',
        'timeout_default',
        'memory_limit',
        'popular_frameworks',
        'difficulty_level',
        'is_active',
        'sort_order',
        'metadata'
    ];

    protected $casts = [
        'file_extensions' => 'array',
        'compile_command' => 'array',
        'safety_rules' => 'array',
        'popular_frameworks' => 'array',
        'supports_compilation' => 'boolean',
        'supports_debugging' => 'boolean',
        'is_active' => 'boolean',
        'metadata' => 'array'
    ];

    /**
     * Get the CS fields that use this programming language
     */
    public function csFields()
    {
        return $this->belongsToMany(CsField::class, 'cs_field_programming_language')
                    ->withPivot('is_primary', 'popularity_rank', 'specific_config')
                    ->withTimestamps();
    }

    /**
     * Get challenges that use this language
     */
    public function challenges()
    {
        return $this->hasMany(Challenge::class, 'primary_language', 'code');
    }

    /**
     * Scope for active languages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered languages
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope by difficulty level
     */
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty_level', $difficulty);
    }

    /**
     * Get the file extension for this language
     */
    public function getMainExtensionAttribute()
    {
        return $this->file_extensions[0] ?? 'txt';
    }
}