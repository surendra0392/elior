<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Installer\Database\Seeders\DatabaseSeeder as BagistoDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Run Base Bagisto Core Architecture & System Seeders
        $this->call(BagistoDatabaseSeeder::class);

        // 2. Run ELIOR Botanical Storefront Configuration & Content Seeders
        $this->call(EliorConfigSeeder::class);
        $this->call(EliorGSTSeeder::class);
        $this->call(ShippingSeeder::class);
        $this->call(EliorCatalogSeeder::class);
        $this->call(EliorPromotionSeeder::class);
        $this->call(EliorHeroSliderSeeder::class);
        $this->call(EliorCMSSeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(EliorMenuSeeder::class);
        $this->call(EliorThemeCustomizationSeeder::class);
    }
}
