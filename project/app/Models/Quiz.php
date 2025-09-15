<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_button_text',
        'questions',
        'answers',
        'course_id',
    ];

    public function course()
{
    return $this->belongsTo(Course::class);
}


    // You may also want to define relationships and other methods here if needed.
}
