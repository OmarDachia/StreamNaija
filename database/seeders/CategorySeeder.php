<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create(['name' => 'Education', 'description' => 'Tutorials and learning content']);
        Category::create(['name' => 'Entertainment', 'description' => 'Funny and entertaining videos']);
        Category::create(['name' => 'Technology', 'description' => 'Tech reviews and news']);
        
    }
}
