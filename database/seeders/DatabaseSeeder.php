<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(50)->create()->each(function($u) {
            $u->posts()->saveMany(Post::factory()->count(rand(1,5))->make());
        });
  
        foreach (Post::public()->get() as $post) {
            $post->comments()->saveMany(Comment::factory()->count(1,3)->make());
        }
        \Artisan::call('cache:clear');
    }
}
