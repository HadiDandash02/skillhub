<?php
// File: app/Models/CsField.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsField extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name', 
        'description',
        'supported_languages',
        'subcategories',
        'icon',
        'color',
        'sort_order',
        'is_active',
        'metadata'
    ];

    protected $casts = [
        'supported_languages' => 'array',
        'subcategories' => 'array',
        'metadata' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get the programming languages for this CS field
     */
    public function programmingLanguages()
    {
        return $this->belongsToMany(ProgrammingLanguage::class, 'cs_field_programming_language')
                    ->withPivot('is_primary', 'popularity_rank', 'specific_config')
                    ->withTimestamps();
    }

    /**
     * Get challenges in this CS field
     */
    public function challenges()
    {
        return $this->hasMany(Challenge::class, 'cs_field', 'code');
    }

    /**
     * Scope for active fields
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered fields
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}