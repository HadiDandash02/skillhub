<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pdf extends Model
{
    use HasFactory;

    protected $fillable = ['chapter_id', 'title', 'pdf_path'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
