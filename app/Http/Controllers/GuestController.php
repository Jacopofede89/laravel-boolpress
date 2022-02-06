<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class GuestController extends Controller
{
    public function home(){

        $posts = Post::all();
        
        return view('pages.home', compact('posts'));
    }

    public function create(){
        
        return view('pages.create');
    }

    public function store(Request $request) {
        
        $data = $request -> validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'release_date' => 'required|date',
            'description' => 'required|string|max:255'
        ]);

        $post = Post::create($data);

        return redirect() -> route('home', $post -> id);
    }
}
