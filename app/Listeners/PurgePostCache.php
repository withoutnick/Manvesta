<?php

namespace App\Listeners;

use App\Events\PostUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class PurgePostCache
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EventUpdated  $event
     * @return void
     */
    public function handle(PostUpdated $event)
    {   
        Cache::forget('post' . $event->post->id);
        Cache::forget('api_post_' . $event->post->id);
        Cache::tags('posts')->flush();
    }
}
