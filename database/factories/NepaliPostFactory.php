<?php

namespace Database\Factories;

use App\Models\NepaliPost;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class NepaliPostFactory extends Factory
{
    /**
     * The number of posts per category.
     */
    protected $postsPerCategory = 15;

    /**
     * The number of posts generated for each category.
     *
     * @var array<int>
     */
    protected $postsCountPerCategory = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('ne_NP');
        
        $content = $faker->paragraphs(15, true);

        $category = $this->getCategoryWithAvailablePosts();

        $this->incrementCategoryPostCount($category);
        $subCategories = ['अन्तर्वार्ता', 'राष्ट्रिय', 'ब्लग', 'सूचना-प्रविधि', 'अन्तर्राष्ट्रिय'];
        return [
            'author' => 1,
            'title' => $faker->sentence,
            'slug' => $faker->slug,
            'feature_img' => $faker->imageUrl($width = 800, $height = 500),
            'keywords' => $faker->words(3, true),
            'tags' => $faker->words(3, true),
            'meta_description' => $faker->sentence,
            'category' => $category,
            'sub_category' => $subCategories[array_rand($subCategories)],
            'content' => $content,
            'status' => $faker->randomElement([0, 1]),
        ];
    }

    /**
     * Get the category with available posts. If all categories have reached
     * their post limit, reset the post count for each category.
     *
     * @return int
     */
    protected function getCategoryWithAvailablePosts(): int
    {
        foreach (range(1, 7) as $category) {
            if (!isset($this->postsCountPerCategory[$category]) || $this->postsCountPerCategory[$category] < $this->postsPerCategory) {
                return $category;
            }
        }

        $this->resetPostsCountPerCategory();

        // Return the first category since all categories have reached their post limit
        return 1;
    }

    /**
     * Increment the post count for the given category.
     *
     * @param int $category
     * @return void
     */
    protected function incrementCategoryPostCount(int $category): void
    {
        if (!isset($this->postsCountPerCategory[$category])) {
            $this->postsCountPerCategory[$category] = 1;
        } else {
            $this->postsCountPerCategory[$category]++;
        }
    }

    /**
     * Reset the post count for each category.
     *
     * @return void
     */
    protected function resetPostsCountPerCategory(): void
    {
        $this->postsCountPerCategory = [];
    }
}
