<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    
    /**
     * Displays users post list once logged in to the dashboard
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    function index(Request $request) 
    {   
        $posts = auth()->user()->posts()->paginate(config('app.dashboard_posts_per_page'));
        return view('dashboard', ['posts' => $posts]);
    }

}
