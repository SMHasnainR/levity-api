<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
     // GET api/posts
     public function index()
     {
        $posts = Post::getAllFormattedData();
        return response()->json(['data' => $posts], 200);
     }
     
     // POST api/posts
     public function store(Request $request)
     {
         $post = Post::create($request->all());
         return response()->json(['data' => $post], 201);
     }
 
     // GET api/posts/{id}
     public function show($id)
     {
        $post = Post::find($id);
        $post =  $post->getFormatData();
         if (!$post) {
             return response()->json(['message' => 'Post not found'], 404);
         }
        //  dd($post->toArray());

        return response()->json(['data' => $post], 200);
     }
 
     // PUT api/posts/{id}
     public function update(Request $request, $id)
     {
         $post = Post::find($id);
         if (!$post) {
             return response()->json(['message' => 'Post not found'], 404);
         }
         $post->update($request->all());
         return response()->json(['data' => $post], 200);
     }
 
     // DELETE api/posts/{id}
     public function destroy($id)
     {
         $post = Post::find($id);
         if (!$post) {
             return response()->json(['message' => 'Post not found'], 404);
         }
         $post->delete();
         return response()->json(['message' => 'Post deleted'], 200);
     }
 
     // GET api/posts/{id}/comments
     public function showComments($id)
     {
         $post = Post::find($id);
         if (!$post) {
             return response()->json(['message' => 'Post not found'], 404);
         }
         $comments = $post->comments;
         return response()->json(['data' => $comments], 200);
     }
 
     // POST api/posts/{id}/comments
     public function storeComment(Request $request, $id)
     {
         $post = Post::find($id);
         if (!$post) {
             return response()->json(['message' => 'Post not found'], 404);
         }
         $comment = $post->comments()->create($request->all());
         return response()->json(['data' => $comment], 201);
     }
}
