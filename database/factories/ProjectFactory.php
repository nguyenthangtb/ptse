<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Solution;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'client' => fake()->company(),
            'location' => fake()->city() . ', Việt Nam',
            'image' => fake()->imageUrl(800, 600, 'business'),
            'gallery' => [
                fake()->imageUrl(800, 600, 'business'),
                fake()->imageUrl(800, 600, 'business'),
                fake()->imageUrl(800, 600, 'business'),
            ],
            'short_description' => fake()->paragraph(),
            'description' => fake()->paragraphs(3, true),
            // 'solution' => fake()->paragraphs(2, true),
            // 'results' => fake()->paragraphs(2, true),
            'meta_title' => fake()->sentence(),
            'meta_description' => fake()->sentence(10),
            'meta_keywords' => implode(', ', fake()->words(5)),
            // 'solution_id' => Solution::inRandomOrder()->first()?->id,
            'completion_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'is_featured' => fake()->boolean(20),
            'is_active' => fake()->boolean(90),
            // 'testimonials' => fake()->paragraph(),
            'status' => 'active',
            'order' => fake()->numberBetween(1, 100),
            'created_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}