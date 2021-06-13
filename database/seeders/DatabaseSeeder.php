<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create(
            [
                'name' => 'diaa',
                'email' => 'diaa@insider.com',
                'password' => Hash::make('diaa@insider.com'),
            ]

        );

        Post::factory()->count(25)->create();
        Category::factory()->count(25)
            ->hasPosts(1)
            ->create();
        //User::factory()->count(25)->create();


    }
}
