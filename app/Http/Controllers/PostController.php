<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index()
    {
    	$posts = Post::latest()->get();

    	return Inertia::render('Post/Index', [
    		'posts' => $posts
    	]);
    }

    public function create()
    {
    	return Inertia::render('Post/Create');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'title' => 'required',
    		'content' => 'required'
     	]);

     	$post = Post::create([
     		'title' => $request->title,
     		'content' => $request->content,
     	]);

     	if($post){
     		return Redirect::route('posts.index')->with('message', 'Data berhasil disimpan');
     	}
    }

    public function show(Post $post)
    {
        return Inertia::render('Post/Edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if($post){
            return Redirect::route('posts.index')->with('message', 'Data berhasil diupdate');
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if($post){
            return Redirect::route('posts.index')->with('message', 'Data berhasil dihapus');
        }
    }
}
