<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 25) -> make() -> each(function($post){
            $category = Category::inRandomOrder() -> limit(1) -> first();
            $post -> category() -> associate($category);
            $post -> save();
        });
    }
}
