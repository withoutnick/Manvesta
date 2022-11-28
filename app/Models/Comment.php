<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'post_id',
        'parent_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns a string containing how much time before the comment was
     * created
     *
     * @return string 
     */
    public function postedBefore()
    {
        return \Carbon\Carbon::parse($this->updated_at)->diffForHumans();
    }

        /**
     * Returns a string containing how much time before the comment was
     * created
     *
     * @return string 
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
