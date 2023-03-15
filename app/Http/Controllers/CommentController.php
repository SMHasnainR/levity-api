<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
/**
     * Display a listing of the comments for a post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $comments = $post->comments;
        return response()->json($comments);
    }

    /**
     * Store a newly created comment for a post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->body = $validatedData['body'];
        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());
        $comment->save();

        return response()->json($comment, 201);
    }

    /**
     * Display the specified comment.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Comment $comment)
    {
        if ($comment->post_id !== $post->id) {
            return response()->json(['error' => 'Comment not found for this post.'], 404);
        }

        return response()->json($comment);
    }

    /**
     * Update the specified comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        if ($comment->post_id !== $post->id) {
            return response()->json(['error' => 'Comment not found for this post.'], 404);
        }

        $validatedData = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->body = $validatedData['body'];
        $comment->save();

        return response()->json($comment);
    }

    /**
     * Remove the specified comment from storage.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        if ($comment->post_id !== $post->id) {
            return response()->json(['error' => 'Comment not found for this post.'], 404);
        }

        $comment->delete();

        return response()->json(null, 204);
    }
}
