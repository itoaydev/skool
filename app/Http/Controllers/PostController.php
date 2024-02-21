<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])->get();

        return response()->json($posts);
    }
    public function store(Request $request)
    {
        $request->validate([
            'post_title' => 'required',
            'post_description' => 'required',
            'group_id' => 'nullable|exists:groups,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $post = Post::create($request->all());
        return response()->json(['message' => 'Post created successfully', 'post' => $post]);
    }
    public function show(string $id)
    {
        // Find all posts where group_id is equal to passed $id
        $posts = Post::where('group_id', $id)->latest()->get();

        return response()->json($posts);
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json($post);
    }

    public function destroy(string $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
    
    public function getPost(string $id)
    {
        $posts = Post::where('id', $id)->get();

        return response()->json($posts);
    }
    public function getlike(string $id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }
    public function like(string $id)
    {
        $post = Post::find($id);
        $value = $post->like;
        $post->like = $value+1;
        $post->save();
        return response()->json($post);
    }
    
}
