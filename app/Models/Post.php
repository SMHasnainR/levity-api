<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function user(){
        return $this->belongsTo(User::class);
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
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return PostFactory::new();
    }
}
