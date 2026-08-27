<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webkul\Category\Models\Category;
use Webkul\CMS\Models\Page;
use Webkul\Core\Models\CoreConfig;

class EliorMenuSeeder extends Seeder
{
    public function run()
    {
        // 1. Ensure CMS Pages are correct
        $aboutPage = Page::whereHas('translations', function ($q) {
            $q->where('url_key', 'about-us');
        })->first();

        if ($aboutPage) {
            DB::table('cms_page_translations')->where('cms_page_id', $aboutPage->id)->update([
                'page_title' => 'About Us'
            ]);
        }

        $qualityPage = Page::whereHas('translations', function ($q) {
            $q->where('url_key', 'quality');
        })->first();

        if ($qualityPage) {
            DB::table('cms_page_translations')->where('cms_page_id', $qualityPage->id)->update([
                'page_title' => 'Quality'
            ]);
        }

        // 2. Build the Custom Menu Items array
        $menuItems = [
            [
                'type' => 'category',
                'id' => 97, // We checked that category_translations ID 97 (category_id 88) is "All Products"
                'title' => 'Products'
            ],
            [
                'type' => 'cms',
                'id' => 'about-us',
                'title' => 'About Us'
            ],
            [
                'type' => 'cms',
                'id' => 'quality',
                'title' => 'Quality'
            ],
            [
                'type' => 'custom',
                'id' => 'custom_recipes',
                'title' => 'Recipes',
                'url' => url('/recipes')
            ],
            [
                'type' => 'custom',
                'id' => 'custom_contact',
                'title' => 'Contact',
                'url' => url('/contact-us')
            ]
        ];
        
        $productsCategory = Category::whereHas('translations', function ($q) {
            $q->where('slug', 'products');
        })->first();

        $menuItems[0]['id'] = $productsCategory ? $productsCategory->id : 1;

        // 3. Set the Core Config for Custom Menu
        $configKey = 'general.design.categories.custom_menu_items';
        
        $config = CoreConfig::where('code', $configKey)->first();
        if ($config) {
            $config->value = json_encode($menuItems);
            $config->save();
        } else {
            CoreConfig::create([
                'code' => $configKey,
                'value' => json_encode($menuItems),
                'channel_code' => 'default',
                'locale_code' => null
            ]);
        }
        
        // Also ensure category_view is custom
        $viewConfigKey = 'general.design.categories.category_view';
        $viewConfig = CoreConfig::where('code', $viewConfigKey)->first();
        if ($viewConfig) {
            $viewConfig->value = 'custom';
            $viewConfig->save();
        } else {
            CoreConfig::create([
                'code' => $viewConfigKey,
                'value' => 'custom',
                'channel_code' => 'default',
                'locale_code' => null
            ]);
        }
    }
}
