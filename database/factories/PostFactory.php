<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::inRandomOrder()->first();

        return [
            'category_id'      => $category->id,
            'slug'             => $this->faker->unique()->slug,
            'title'            => $this->faker->realText(10),
            'seo_title'        => $this->faker->realText(20),
            'excerpt'          => $this->faker->realText(50),
            'body'             => $this->faker->realText(200),
            'image'            => $this->faker->randomElement(['posts/post1.jpg', 'posts/post2.jpg', 'posts/post3.jpg', 'posts/post4.jpg']),
            'meta_description' => $this->faker->sentence(),
            'meta_keywords'    => collect([$this->faker->word(), $this->faker->word(), $this->faker->word()])->implode(','),
            'status'           => $this->faker->randomElement(['PUBLISHED', 'DRAFT', 'PENDING']),
        ];
    }
}
