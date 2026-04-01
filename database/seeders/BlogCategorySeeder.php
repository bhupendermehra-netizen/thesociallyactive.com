<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology'],
            ['name' => 'Design'],
            ['name' => 'Development'],
            ['name' => 'Business'],
            ['name' => 'Lifestyle'],
            ['name' => 'Travel'],
            ['name' => 'Photography'],
            ['name' => 'Marketing'],
        ];

        foreach ($categories as $category) {
            BlogCategory::firstOrCreate(
                ['name' => $category['name']],
                ['slug' => \Illuminate\Support\Str::slug($category['name'])]
            );
        }
    }
}