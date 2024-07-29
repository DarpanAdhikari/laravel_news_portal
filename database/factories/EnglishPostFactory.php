<?php

namespace Database\Factories;

use App\Models\EnglishPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EnglishPostFactory extends Factory
{
    public function definition(): array
    {
        $subCategories = ['interview', 'national', 'blog', 'technologies', 'international'];
        return [
            'author' => 1,
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'feature_img' => $this->faker->imageUrl($width = 800, $height = 500),
            'keywords' => $this->faker->words(5, true),
            'tags' => $this->faker->words(5, true),
            'meta_description' => $this->faker->sentence,
            'category' => $this->faker->numberBetween(1, 7),
            'sub_category' => $subCategories[array_rand($subCategories)],
            'content' => $this->faker->paragraphs(15, true),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
