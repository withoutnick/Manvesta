<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Events\NewComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|min:3|max:5000',
            'post_id' => 'required'
        ]);

        $comment = auth()->user()->comments()->create($request->except('_token'));

        NewComment::dispatch($comment->post);

        return redirect()->to(url()->previous() . '#' . $comment['id']);

    }

}
