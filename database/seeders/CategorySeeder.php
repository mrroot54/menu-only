<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Starters', 'order' => 1],
            ['name' => 'Salads', 'order' => 2],
            ['name' => 'Fast Food', 'order' => 3],
            ['name' => 'Main Course', 'order' => 4],
            ['name' => 'Breads', 'order' => 5],
            ['name' => 'Rice & Biryani', 'order' => 6],
            ['name' => 'Drinks', 'order' => 7],
            ['name' => 'Desserts', 'order' => 8],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}