<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();  // Lấy tất cả các bài viết
        return view("home", compact("posts"));  // Trả về view với danh sách bài viết
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    Post::create([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()->route('posts.index');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $post = Post::findOrFail($id);
    return view('home', compact('post'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $post = Post::findOrFail($id);
    return view('edit', compact('post'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $post = Post::findOrFail($id);

    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    $post->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()->route('posts.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('posts.index');
}

}
