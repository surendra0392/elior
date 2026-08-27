<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Recipe\Database\Seeders\RecipeTableSeeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RecipeTableSeeder::class);
    }
}
