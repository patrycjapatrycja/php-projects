<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $name = 'John Doe';
        User::factory()->create([
            'name' => $name,
            'username' => Str::slug($name),
            'email' => 'j.doe@example.com',
        ]);

        $categories = [
            'Technology',
            'Health',
            'Science',
            'Sport',
            'Politics',
            'Entertainment',
        ];

        foreach($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

        //Post::factory(100)->create();
    }
}
