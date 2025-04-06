<?php

namespace Database\Seeders;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Video::create([
            'category_id' => 1,
            'title' => 'Laravel Beginner Tutorial',
            'description' => 'Introduction to Laravel for beginners.',
            'video_url' => 'videos/laravel_tutorial.mp4',
            'thumbnail_url' => 'thumbnails/laravel_tutorial.jpg',
            'views' => 150,
            'is_published' => true,
        ]);

        Video::create([
            'category_id' => 1,
            'title' => 'Basic Math Tricks',
            'description' => 'Learn quick math hacks.',
            'video_url' => 'videos/math_tricks.mp4',
            'thumbnail_url' => 'thumbnails/math_tricks.jpg',
            'views' => 300,
            'is_published' => true,
        ]);

        Video::create([
            'category_id' => 2,
            'title' => 'Funny Cat Compilation',
            'description' => 'Cats doing hilarious things.',
            'video_url' => 'videos/funny_cats.mp4',
            'thumbnail_url' => 'thumbnails/funny_cats.jpg',
            'views' => 1000,
            'is_published' => true,
        ]);

        Video::create([
            'category_id' => 3,
            'title' => 'Top 5 Phones in 2025',
            'description' => 'Comparison of top smartphones.',
            'video_url' => 'videos/top_phones.mp4',
            'thumbnail_url' => 'thumbnails/top_phones.jpg',
            'views' => 500,
            'is_published' => true,
        ]);

        Video::create([
            'category_id' => 3,
            'title' => 'How AI is Changing the World',
            'description' => 'Discussion about Artificial Intelligence.',
            'video_url' => 'videos/ai_change.mp4',
            'thumbnail_url' => 'thumbnails/ai_change.jpg',
            'views' => 650,
            'is_published' => true,
        ]);
    }
}
