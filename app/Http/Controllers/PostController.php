<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Post;
use App\Events\PostUpdated;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        /**
         * Logged in users can see their private posts, so we only use caching for guests 
         * to avoid displaying cached results from logged-in users with their private content.
         */ 
        if(!Auth::check())
        {
            $posts = Cache::tags('posts')->remember('posts_' . $page, config('posts.ttl'), function() {
                return Post::public()->orderBy('updated_at', 'desc')->simplePaginate(config('posts.frontend_posts_per_page'));
            });
        }
        else {
            $posts = Post::public()->orderBy('updated_at', 'desc')->simplePaginate(config('posts.frontend_posts_per_page'));
        }

        return view('post.public-posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('post.create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $post = auth()->user()->posts()->create($request->except('_token'));

        return redirect()->route('post.edit', $post->id)->with('status', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $post = Cache::remember('post' . $id, config('posts.ttl'), function () use ($id) {
            return Post::findOrFail($id);
        });
        
        $this->authorize('view', $post);

        $comments = Cache::remember('comments_' . $id, config('posts.ttl'), function() use ($post) {
            return $post->comments()->orderBy('created_at', 'desc')->get();
        });

        return view('post.single', ['post' => $post, 'comments' => $comments]);
    }   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {   
        $this->authorize('update', $post);
        return view('post.edit-post', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->private = ($request->has('private')) ? 1 : 0;
        $post->save();

        PostUpdated::dispatch($post);

        return redirect()->back()->with('status', 'Post updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);
        $post->delete();

        return redirect()->route('dashboard')->with('status', 'Post "' . $post->title . '" deleted');
    }
}
