<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('homepage');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.single');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::resource('post', PostController::class)->except([
        'index', 'show'
    ]);
});

Route::middleware('auth')->group(function() {
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
});

require __DIR__.'/auth.php';
