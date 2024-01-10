<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words(10, true);
        return [
            'user_id' => 1,
            'post_category_id' => $this->faker->numberBetween(1,2),
            'name'=> $name,
            'description'=> $this->faker->sentence(200),
            'image' =>'post-image-'.$this->faker->numberBetween(1, 9).'.jpg',
            'slug' => Str::slug($name).'-'.Str::random(8),
            'isPublished'=>true,
        ];
    }
}
