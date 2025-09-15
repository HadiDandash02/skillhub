<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillLevel extends Model
{
    use HasFactory;

    // Define the table name if it's different from the plural of the model
    protected $table = 'skill_levels'; // Adjust to your actual table name

    // Define fillable properties (optional)
    protected $fillable = ['name'];
}


