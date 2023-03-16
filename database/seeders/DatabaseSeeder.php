<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()
        ->has(Post::factory()
            ->sequence(fn() => ['category_id' => Category::factory()->create()])
            ->hasAttached(SubCategory::factory()->count(3))
            ->count(3)
        )
        ->create();

        // User::factory()
        // ->hasPosts(3,function (array $attributes,User $user) {

        //     return [
        //         'category_id' => Category::factory()->create()
        //     ];
        // })
        // ->create();

    }
}
