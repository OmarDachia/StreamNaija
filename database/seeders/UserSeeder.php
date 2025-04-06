<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Haruna Ali',
            'email' => 'ali@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Bob Johnson',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Carol White',
            'email' => 'carol@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
