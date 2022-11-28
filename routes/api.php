<?php

use App\Http\Controllers\Api\V1\PostsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::get('/posts', [PostsApiController::class, 'index'])->name('v1.posts');
    Route::get('/posts/author/{user}', [PostsApiController::class, 'postsByAuthor'])->name('v1.posts-by-author');
    Route::get('/posts/{post}', [PostsApiController::class, 'single'])->name('v1.single-post');
});
