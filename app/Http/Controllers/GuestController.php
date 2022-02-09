<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;

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


        if ($request -> has('tags')) {
            $tags = Tag::findOrFail($request -> get('tags'));
            $post ->tags() ->attach($tags);
            $post -> save();
        }
    
        return redirect() -> route('home');
    }

    public function edit($id){

        $categories = Category::all();
        $tags = Tag::all();
        $post = Post:: findOrFail($id);
        
        return view('pages.edit', compact('categories', 'tags', 'post'));
    }

    public function update(Request $request, $id){

        $data = $request -> validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        $user = Auth:: user();
        $data['author'] = $user -> name;
        
        $post = Post::findOrFail($id);
        $post -> update($data);

        $category = Category::findOrFail($request -> get('category_id'));
        $post -> category() -> associate($category);
        $post -> save();

        $tags = [];
        if ($request -> has('tags'))
            $tags = Tag::findOrFail($request -> get('tags'));

        // $tags = Tag::findOrFail($request -> get('tags'));
        $post ->tags() ->sync($tags);
        $post -> save();

        return redirect() -> route('home');
    }

    public function delete($id){

        $post = Post::findOrFail($id);
        $post -> tags() -> sync([]);
        $post -> save();

        $post -> delete();

        return redirect() -> route('home');

    }
}
