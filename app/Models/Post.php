<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'private'
    ];

    protected $casts = [
        'private' => 'boolean',
    ];

    /**
     * Scope a query to only include posts that are not marked as private
     * or belongs to a currently logged-in user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {       
        if (Auth::check()) {
            return $query->where('private', '!=', 1)->orWhere('user_id', Auth::id());
        }

        return $query->where('private', '!=', 1);
    }
    
    /**
     * Creates a short excerpt of the post's content
     *
     * @param int $numberOfWords
     * @return string 
     */
    public function excerpt($numberOfWords)
    {
        return Str::words(strip_tags($this->content), $numberOfWords);
    }

    /**
     * Returns a string containing how much time before the post was updated 
     * the last time
     *
     * @return string 
     */
    public function updatedBefore()
    {
        return \Carbon\Carbon::parse($this->updated_at)->diffForHumans();
    }

    /**
     * Get the user that owns the pos.
     * 
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post's comments
     * 
     * @return App\Models\User
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
