<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Post;
use App\Tag;

class GuestController extends Controller
{
    public function home(){

        $posts = Post::all();
        $tags = Tag::all();
        
        return view('pages.home', compact('posts', 'tags'));
    }

    public function create(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('pages.create', compact('categories', 'tags'));
    }

    public function store(Request $request) {
        
        $data = $request -> validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'release_date' => 'required|date',
            'description' => 'required|string|max:255',
            'category_id' => 'required|string'
        ]);

        $post = Post::make($data);
        $category = Category::findOrFail($request -> get('category_id'));
        

        $post -> category() -> associate($category);
        $post -> save();

        $tags = Tag::findOrFail($request -> get('tags'));
        $post ->tags() ->attach($tags);
        $post -> save();

        return redirect() -> route('home');
    }
}
