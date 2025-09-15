<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'description'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function pdfs()
    {
        return $this->hasMany(Pdf::class);
    }
}
