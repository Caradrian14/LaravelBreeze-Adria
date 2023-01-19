<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ganga;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GangaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->create();
        Category::factory()->count(3)->create();
        Ganga::factory()->count(3)->create();
    }
}
