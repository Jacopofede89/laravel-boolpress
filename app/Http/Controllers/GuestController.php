<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Post;

class GuestController extends Controller
{
    public function home(){

        $posts = Post::all();
        
        return view('pages.home', compact('posts'));
    }

    public function create(){
        $categories = Category::all();
        
        return view('pages.create', compact('categories'));
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

        return redirect() -> route('home');
    }
}
