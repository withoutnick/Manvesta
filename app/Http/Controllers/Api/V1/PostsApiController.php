<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\SinglePostResource;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostsApiController extends Controller
{   

    /**
     * Displays a paginated list of available public posts
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $posts = Cache::tags('posts')->remember('api_posts_' . $page, config('posts.api_ttl'), function() {
            return new PostCollection(Post::public()->orderBy('updated_at', 'desc')->paginate(config('posts.api_posts_per_page')));
        });
        return $posts;
    }

    /**
     * Displays a paginated list of available public posts filtered by User ID
     *
     * @return \Illuminate\Http\Response
     */
    public function postsByAuthor(User $user)
    {   
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $posts = Cache::tags('posts')->remember('api_'  . $user->id . '_posts_page' . $page, config('posts.api_ttl'), function() use ($user) {
            return new PostCollection(
                $user->posts()->public()->orderBy('updated_at', 'desc')->paginate()
            );
        });
        return $posts;
    }

    /**
     * Displays a single post resource
     *
     * @return \Illuminate\Http\Response
     */
    public function single($id) 
    {

        $post = Cache::remember('api_post_' . $id, config('posts.api_ttl'), function() use ($id) {
            $post = Post::findOrFail($id);
            $this->authorize('view', $post);
            return new SinglePostResource($post);
        });

        return $post;
    }
}
