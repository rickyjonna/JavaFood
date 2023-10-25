<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Category::create([
            'name' => 'Makanan',
            'slug' => 'makanan'
        ]);

        Category::create([
            'name' => 'Minuman',
            'slug' => 'minuman'
        ]);

        Category::create([
            'name' => 'Jajanan',
            'slug' => 'jajanan'
        ]);

        Sub_category::create([
            'name' => 'Ayam',
            'slug' => 'ayam'
        ]);

        Sub_category::create([
            'name' => 'Daging',
            'slug' => 'daging'
        ]);

        Sub_category::create([
            'name' => 'Mie',
            'slug' => 'mie'
        ]);

        Sub_category::create([
            'name' => 'Nasi',
            'slug' => 'nasi'
        ]);

        User::create([
            'name' => 'Ricky',
            'username' => 'rickyjonna',
            'email' => 'ricky.jonna@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
