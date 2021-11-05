<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(100)->create();
        \App\Models\Category::factory(100)->create();
        \App\Models\Tag::factory(100)->create();
        \App\Models\Ad::factory(100)->create();
        \App\Models\AdTag::factory(100)->create();

    }
}
