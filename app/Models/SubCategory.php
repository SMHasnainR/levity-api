<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';
    
     /**
     * The roles that belong to the user.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class,'post_subcategory','post_id','subcategory_id');
    }
}
