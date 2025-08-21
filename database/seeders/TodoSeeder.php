<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::pluck('id'); // Ambil semua user_id yang ada
        $categories = Category::pluck('id');

        Todo::factory(10)->create([
            'user_id' => fn () => $users->random(), 
            'category_id' => fn () => $categories->random(), 
        ]);
        
    }
}
