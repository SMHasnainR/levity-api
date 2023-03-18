<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
     // GET api/posts
     public function index()
     {
        $posts = Post::select(['id', 'title', 'description', 'created_at','user_id','category_id'])
        ->with(['category', 'subcategories', 'author.image','image'])
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'category' => $post->category->name,
                    'subCategory' => $post->subcategories->pluck('name'),
                    'description' => $post->description,
                    'authorName' => $post->author->name,
                    'authorAvatar' => $post->author->image->path,
                    'createdAt' => $post->created_at->format('F d, Y'),
                    'cover' => $post->image->path,
                ];
            });

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
         if (!$post) {
             return response()->json(['message' => 'Post not found'], 404);
         }
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
