<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\News;
use App\Models\Product;
use App\Models\Solution;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // Create 20 News
        for ($i = 0; $i < 20; $i++) {
            News::create([
                'title' => $faker->sentence(),
                'slug' => $faker->slug(),
                'excerpt' => $faker->paragraph(),
                'content' => $faker->paragraphs(5, true),
                'image' => 'https://picsum.photos/800/600?random=' . $i,
                'is_active' => true,
                'published_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }

        // Create 20 Products
        for ($i = 0; $i < 20; $i++) {
            Product::create([
                'name' => $faker->words(3, true),
                'slug' => $faker->slug(),
                'short_description' => $faker->paragraph(),
                'description' => $faker->paragraphs(5, true),
                'image' => 'https://picsum.photos/800/600?random=' . ($i + 20),
                'category_id' => rand(1,2), // Assuming you have 4 categories: 'Điện thoại', 'Laptop', 'Phụ kiện', 'Máy tính xách tay'
                'is_featured' => $faker->boolean(20),
                'is_active' => true,
            ]);
        }

        // Create 20 Solutions
        for ($i = 0; $i < 20; $i++) {
            Solution::create([
                'title' => $faker->words(3, true),
                'slug' => $faker->slug(),
                'short_description' => $faker->paragraph(),
                'description' => $faker->paragraphs(5, true),
                'image' => 'https://picsum.photos/800/600?random=' . ($i + 40),
                'is_featured' => $faker->boolean(20),
                'is_active' => true,
            ]);
        }

        // Create 20 Careers
        for ($i = 0; $i < 20; $i++) {
            Career::create([
                'title' => 'Tuyển ' . $faker->jobTitle(),
                'slug' => $faker->slug(),
                'short_description' => $faker->paragraph(),
                'description' => $faker->paragraphs(5, true),
                'department' => $faker->randomElement(['Marketing', 'IT', 'HR', 'Finance']),
                'type' => $faker->randomElement(['Full-time', 'Part-time', 'Contract']),
                'requirements' => $faker->paragraphs(3, true),
                'location' => $faker->city(),
                'deadline' => $faker->dateTimeBetween('now', '+3 months'),
                'is_active' => true,
            ]);
        }
    }
}
