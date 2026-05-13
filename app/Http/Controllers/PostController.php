<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Postingan berhasil dibuat! 🎉');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Postingan berhasil diupdate! ✅');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Postingan berhasil dihapus! 🗑️');
    }
}