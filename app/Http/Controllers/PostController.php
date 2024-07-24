<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(){
        Auth::user();
        $posts = Auth::user()->posts;
        return view('posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post){
        if(Auth::id() != $post->user_id){
            abort(403);
        }
        return view('posts.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        if (Auth::id() != $post->user_id) {
            abort(403);
        }

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

}
