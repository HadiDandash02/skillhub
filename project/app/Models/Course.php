<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'instructor',
        'category',
        'difficulty',
        'views',
        'instructor_id'
    ];

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function averageRating() {
        return $this->ratings()->avg('rating') ?? 0;
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function tutorials()
    {
        return $this->hasMany(CourseTutorial::class);
    }
    
   public function incrementViews(User $user)
{
    
    // Only increment if user hasn't viewed this course before
    if (!$this->viewedBy($user)) {
        $this->views++;
        $this->save();
        
        // Record that this user has viewed the course
        $this->viewers()->attach($user->id);
    }
}

    public function viewedBy(User $user)
    {
        return $this->viewers()->where('user_id', $user->id)->exists();
    }

    public function viewers()
    {
        return $this->belongsToMany(User::class, 'course_user_views')
                    ->withTimestamps();
    }

    public function getViewCount()
    {
        return $this->viewers()->count();
    }

    
    // Course.php
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }


     // Check if current user has rated this course
    public function getIsRatedAttribute() {
        if (!auth()->check()) {
            return false;
        }
        
        return $this->ratings()
                   ->where('user_id', auth()->id())
                   ->exists();
    }

    // Get current user's rating for this course  
    public function getUserRatingAttribute() {
        if (!auth()->check()) {
            return null;
        }
        
        $rating = $this->ratings()
                      ->where('user_id', auth()->id())
                      ->first();
        
        return $rating ? $rating->rating : null;
    }

}
