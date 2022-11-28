<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{   

    /**
     * Determine if the given post can be viewed by the user
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function view(?User $user, Post $post)
    {   
        // Allow access to the private resource if user is an author
        if ($user) {
            return !$post->private || $user->id == $post->user_id;
        }
        return !$post->private;    
    }

    /**
     * Determine if the given post can be updated by the user
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine if the given post can be deleted by the user
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function destroy(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
