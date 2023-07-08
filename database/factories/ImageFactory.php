<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => 'https://cdn.shopify.com/s/files/1/0368/6065/articles/08d50421c28f25c4fcc4b30d22181d2c_large.jpg?v=1620756004',
            // 'imageable_type' => $this->faker->imageUrl(640,480),
        ];
    }
}
