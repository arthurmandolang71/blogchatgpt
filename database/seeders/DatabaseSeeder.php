<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    
        // User::factory()->count(10)->create();

        // Category::factory()->count(5)->create();
    
        // Post::factory()->count(200)->create();

        User::create([
            'name' => 'administrator system',
            'username' => 'administrator',
            'password' =>  bcrypt('12345678'),
            'id_admin' => true,
        ]);

        User::create([
            'name' => 'Jonathan ',
            'username' => 'jonathan',
            'password' =>  bcrypt('12345678'),
            'id_admin' => false,
        ]);

        User::create([
            'name' => 'Elvina ',
            'username' => 'elvina',
            'password' =>  bcrypt('12345678'),
            'id_admin' => false,
        ]);

        User::create([
            'name' => 'Theodurus ',
            'username' => 'theodurus',
            'password' =>  bcrypt('12345678'),
            'id_admin' => false,
        ]);

        User::create([
            'name' => 'Tesanolika',
            'username' => 'the',
            'password' =>  bcrypt('12345678'),
            'id_admin' => false,
        ]);

        User::create([
            'name' => 'Diana',
            'username' => 'diana',
            'password' =>  bcrypt('12345678'),
            'id_admin' => false,
        ]);

        Category::create([
            'name' => 'Dunia',
            'slug' => 'dunia',
        ]);

        Category::create([
            'name' => 'Indoneisa',
            'slug' => 'indonesia',
        ]);

        Category::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',
        ]);

        Category::create([
            'name' => 'Desain',
            'slug' => 'desain',
        ]);

        Category::create([
            'name' => 'Budaya',
            'slug' => 'budaya',
        ]);

        Category::create([
            'name' => 'Bisnis',
            'slug' => 'bisnis',
        ]);

        Category::create([
            'name' => 'Pendidikan',
            'slug' => 'pendidikan',
        ]);

        Category::create([
            'name' => 'Sains',
            'slug' => 'sains',
        ]);

        Category::create([
            'name' => 'Kesehatan',
            'slug' => 'kesehatan',
        ]);

        Category::create([
            'name' => 'Wisata',
            'slug' => 'wisata',
        ]);
      
    }
}
