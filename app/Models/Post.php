<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends Model
{
    use HasFactory;


    protected $guarded = ['id', 'created_at'];

    // Has Many Comments Relationship
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Belongs to User relationship
    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    // belongs to category relationship
    public function category(){
        return $this->belongsTo(Category::class);
    }

    
     /**
     * The roles that belong to the user.
     */
    public function subcategories(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class,'post_subcategory','post_id','subcategory_id');
    }

     /**
     * Get the post's image.
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return PostFactory::new();
    }


    public static function getFormattedData()
    {
        return Post::select(['id', 'title', 'description', 'created_at'])
        ->with(['category', 'subcategories', 'author' => function ($query) {
            $query->select(['name']);
        }])
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'category' => $post->category->name,
                    'subCategory' => $post->subcategories->pluck('name'),
                    'description' => $post->description,
                    'authorName' => $post->author->name,
                    // 'authorAvatar' => $post->author->avatar,
                    'createdAt' => $post->created_at->format('F d, Y'),
                    // 'cover' => $post->cover,
                ];
            });
    }
}
