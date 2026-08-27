<?php

namespace Webkul\Recipe\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webkul\Recipe\Models\Recipe;
use Webkul\Recipe\Models\RecipeTranslation;
use Webkul\Product\Models\Product;

class RecipeTableSeeder extends Seeder
{
    /**
     * Seed the recipes table.
     *
     * @return void
     */
    public function run()
    {
        $recipesData = [
            [
                'featured_image' => 'recipes/moringa_smoothie.jpg',
                'prep_time'      => 5,
                'cook_time'      => 0,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'organic-moringa-leaf-powder',
                'translations'   => [
                    'name'             => 'Moringa Green Morning Smoothie',
                    'url_key'          => 'moringa-green-morning-smoothie',
                    'description'      => 'A vibrant, nutrient-dense morning smoothie featuring organic moringa, fresh greens, and subtle sweetness to start your day beautifully.',
                    'ingredients'      => [
                        '1 tsp ELIOR Organic Moringa Leaf Powder',
                        '1 ripe banana, frozen',
                        '1/2 cup fresh spinach',
                        '1 cup oat milk',
                        'A sprig of fresh mint',
                    ],
                    'instructions'     => [
                        'Add all ingredients to a high-speed blender.',
                        'Blend on high until completely smooth and vibrant green.',
                        'Pour into a chilled glass and garnish with a fresh mint sprig.',
                    ],
                    'meta_title'       => 'Moringa Green Morning Smoothie | ELIOR Botanical Recipes',
                    'meta_description' => 'A vibrant, nutrient-dense morning smoothie featuring organic moringa, fresh greens, and subtle sweetness to start your day beautifully.',
                    'meta_keywords'    => 'recipe, botanical, elior, moringa green morning smoothie',
                ],
            ],
            [
                'featured_image' => 'recipes/turmeric_drink.jpg',
                'prep_time'      => 5,
                'cook_time'      => 5,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'lakadong-turmeric-powder',
                'translations'   => [
                    'name'             => 'Golden Turmeric Morning Drink',
                    'url_key'          => 'golden-turmeric-morning-drink',
                    'description'      => 'A soothing, warming tonic using pure Lakadong Turmeric, perfect for quiet mornings or gentle evening rituals.',
                    'ingredients'      => [
                        '1/2 tsp ELIOR Lakadong Turmeric Powder',
                        '1 cup warm almond milk',
                        '1/4 tsp ground cinnamon',
                        '1 tsp raw honey',
                        'A pinch of black pepper',
                    ],
                    'instructions'     => [
                        'In a small saucepan, gently warm the almond milk.',
                        'Whisk in the turmeric, cinnamon, and black pepper until dissolved.',
                        'Remove from heat, stir in honey, and serve immediately with a cinnamon stick.',
                    ],
                    'meta_title'       => 'Golden Turmeric Morning Drink | ELIOR Botanical Recipes',
                    'meta_description' => 'A soothing, warming tonic using pure Lakadong Turmeric, perfect for quiet mornings or gentle evening rituals.',
                    'meta_keywords'    => 'recipe, botanical, elior, golden turmeric morning drink',
                ],
            ],
            [
                'featured_image' => 'recipes/beetroot_smoothie.jpg',
                'prep_time'      => 5,
                'cook_time'      => 0,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'dehydrated-beetroot-powder',
                'translations'   => [
                    'name'             => 'Beetroot Berry Breakfast Smoothie',
                    'url_key'          => 'beetroot-berry-breakfast-smoothie',
                    'description'      => 'A gorgeous, deep-hued smoothie blending earthy beetroot powder with sweet mixed berries for a refreshing start.',
                    'ingredients'      => [
                        '1 tsp ELIOR Dehydrated Beetroot Powder',
                        '1 cup frozen mixed berries (strawberries, raspberries)',
                        '1/2 cup plain coconut yogurt',
                        '1/2 cup coconut water',
                        '1 tbsp chia seeds',
                    ],
                    'instructions'     => [
                        'Combine the beetroot powder, berries, yogurt, and coconut water in a blender.',
                        'Blend until smooth and creamy.',
                        'Stir in chia seeds, let sit for 2 minutes to thicken, and serve.',
                    ],
                    'meta_title'       => 'Beetroot Berry Breakfast Smoothie | ELIOR Botanical Recipes',
                    'meta_description' => 'A gorgeous, deep-hued smoothie blending earthy beetroot powder with sweet mixed berries for a refreshing start.',
                    'meta_keywords'    => 'recipe, botanical, elior, beetroot berry breakfast smoothie',
                ],
            ],
            [
                'featured_image' => 'recipes/amla_cooler.jpg',
                'prep_time'      => 3,
                'cook_time'      => 0,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'wild-harvested-amla-powder',
                'translations'   => [
                    'name'             => 'Amla Citrus Morning Cooler',
                    'url_key'          => 'amla-citrus-morning-cooler',
                    'description'      => 'A bright, crisp hydration ritual combining vitamin C-rich Amla with fresh lemon and mint over ice.',
                    'ingredients'      => [
                        '1/2 tsp ELIOR Wild-Harvested Amla Powder',
                        '1 glass filtered water (or sparkling water)',
                        'Juice of half a lemon',
                        'Fresh mint leaves',
                        'Ice cubes',
                    ],
                    'instructions'     => [
                        'Dissolve the Amla powder in a small splash of warm water first.',
                        'Fill a tall glass with ice and pour in the Amla mixture.',
                        'Top with filtered water, lemon juice, and stir gently with fresh mint.',
                    ],
                    'meta_title'       => 'Amla Citrus Morning Cooler | ELIOR Botanical Recipes',
                    'meta_description' => 'A bright, crisp hydration ritual combining vitamin C-rich Amla with fresh lemon and mint over ice.',
                    'meta_keywords'    => 'recipe, botanical, elior, amla citrus morning cooler',
                ],
            ],
            [
                'featured_image' => 'recipes/green_vitality.jpg',
                'prep_time'      => 5,
                'cook_time'      => 0,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'green-vitality-superblend',
                'translations'   => [
                    'name'             => 'Green Vitality Smoothie',
                    'url_key'          => 'green-vitality-smoothie',
                    'description'      => 'The ultimate superblend green smoothie, designed for comprehensive nourishment with cucumber and spinach.',
                    'ingredients'      => [
                        '1 scoop ELIOR Green Vitality Superblend',
                        '1/2 cucumber, sliced',
                        '1 green apple, cored',
                        '1 cup coconut water',
                        'A squeeze of fresh lime',
                    ],
                    'instructions'     => [
                        'Add cucumber, apple, Green Vitality Superblend, and coconut water to a blender.',
                        'Blend until smooth and frothy.',
                        'Serve immediately with a squeeze of fresh lime.',
                    ],
                    'meta_title'       => 'Green Vitality Smoothie | ELIOR Botanical Recipes',
                    'meta_description' => 'The ultimate superblend green smoothie, designed for comprehensive nourishment with cucumber and spinach.',
                    'meta_keywords'    => 'recipe, botanical, elior, green vitality smoothie',
                ],
            ],
            [
                'featured_image' => 'recipes/golden_oat_bowl.jpg',
                'prep_time'      => 5,
                'cook_time'      => 10,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'lakadong-turmeric-powder',
                'translations'   => [
                    'name'             => 'Golden Oat Breakfast Bowl',
                    'url_key'          => 'golden-oat-breakfast-bowl',
                    'description'      => 'Warm, comforting oatmeal infused with turmeric, topped with fresh bananas and walnuts for a nourishing breakfast.',
                    'ingredients'      => [
                        '1/2 tsp ELIOR Lakadong Turmeric Powder',
                        '1/2 cup rolled oats',
                        '1 cup milk of choice',
                        '1/2 banana, sliced',
                        'Chopped walnuts and a drizzle of maple syrup',
                    ],
                    'instructions'     => [
                        'Cook the oats in milk on a stovetop over medium heat.',
                        'Once thickened, stir in the turmeric powder until the oats turn a beautiful golden color.',
                        'Transfer to a bowl and arrange sliced bananas, walnuts, and maple syrup on top.',
                    ],
                    'meta_title'       => 'Golden Oat Breakfast Bowl | ELIOR Botanical Recipes',
                    'meta_description' => 'Warm, comforting oatmeal infused with turmeric, topped with fresh bananas and walnuts for a nourishing breakfast.',
                    'meta_keywords'    => 'recipe, botanical, elior, golden oat breakfast bowl',
                ],
            ],
            [
                'featured_image' => 'recipes/moringa_bowl.jpg',
                'prep_time'      => 5,
                'cook_time'      => 0,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'organic-moringa-leaf-powder',
                'translations'   => [
                    'name'             => 'Moringa Coconut Yogurt Bowl',
                    'url_key'          => 'moringa-coconut-yogurt-bowl',
                    'description'      => 'A visually stunning bright green yogurt bowl topped with toasted coconut, berries, and seeds.',
                    'ingredients'      => [
                        '1 tsp ELIOR Organic Moringa Leaf Powder',
                        '1 cup plain coconut yogurt',
                        '2 tbsp toasted coconut flakes',
                        'Fresh blueberries',
                        '1 tbsp pumpkin seeds',
                    ],
                    'instructions'     => [
                        'In a beautiful ceramic bowl, gently fold the Moringa powder into the coconut yogurt until evenly mixed.',
                        'Smooth the surface with a spoon.',
                        'Artfully arrange the coconut flakes, blueberries, and pumpkin seeds on top.',
                    ],
                    'meta_title'       => 'Moringa Coconut Yogurt Bowl | ELIOR Botanical Recipes',
                    'meta_description' => 'A visually stunning bright green yogurt bowl topped with toasted coconut, berries, and seeds.',
                    'meta_keywords'    => 'recipe, botanical, elior, moringa coconut yogurt bowl',
                ],
            ],
            [
                'featured_image' => 'recipes/beetroot_chocolate.jpg',
                'prep_time'      => 5,
                'cook_time'      => 0,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'dehydrated-beetroot-powder',
                'translations'   => [
                    'name'             => 'Beetroot Chocolate Smoothie',
                    'url_key'          => 'beetroot-chocolate-smoothie',
                    'description'      => 'A rich, decadent smoothie pairing earthy beetroot with dark cocoa and sweet dates.',
                    'ingredients'      => [
                        '1 tsp ELIOR Dehydrated Beetroot Powder',
                        '1 tbsp raw cocoa powder',
                        '2 Medjool dates, pitted',
                        '1 cup oat milk',
                        '1/2 frozen banana',
                    ],
                    'instructions'     => [
                        'Combine all ingredients in a blender.',
                        'Blend on high until completely smooth, ensuring dates are fully broken down.',
                        'Pour into a glass and lightly dust with extra cocoa powder.',
                    ],
                    'meta_title'       => 'Beetroot Chocolate Smoothie | ELIOR Botanical Recipes',
                    'meta_description' => 'A rich, decadent smoothie pairing earthy beetroot with dark cocoa and sweet dates.',
                    'meta_keywords'    => 'recipe, botanical, elior, beetroot chocolate smoothie',
                ],
            ],
            [
                'featured_image' => 'recipes/amla_refresher.jpg',
                'prep_time'      => 3,
                'cook_time'      => 0,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'wild-harvested-amla-powder',
                'translations'   => [
                    'name'             => 'Amla Mint Refresher',
                    'url_key'          => 'amla-mint-refresher',
                    'description'      => 'A crisp, cooling herbal water infusion, perfect for afternoon hydration.',
                    'ingredients'      => [
                        '1/2 tsp ELIOR Wild-Harvested Amla Powder',
                        '1 cup sparkling water',
                        'Fresh mint leaves',
                        'Ice cubes',
                    ],
                    'instructions'     => [
                        'In a small glass, whisk the Amla powder with 1 tbsp of warm water to dissolve.',
                        'Fill a serving glass with ice and bruised mint leaves.',
                        'Pour the Amla liquid over ice and top with sparkling water. Stir gently.',
                    ],
                    'meta_title'       => 'Amla Mint Refresher | ELIOR Botanical Recipes',
                    'meta_description' => 'A crisp, cooling herbal water infusion, perfect for afternoon hydration.',
                    'meta_keywords'    => 'recipe, botanical, elior, amla mint refresher',
                ],
            ],
            [
                'featured_image' => 'recipes/turmeric_latte.jpg',
                'prep_time'      => 5,
                'cook_time'      => 5,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'lakadong-turmeric-powder',
                'translations'   => [
                    'name'             => 'Turmeric Ginger Oat Latte',
                    'url_key'          => 'turmeric-ginger-oat-latte',
                    'description'      => 'A spiced, creamy oat milk latte featuring the warmth of Lakadong turmeric and fresh ginger.',
                    'ingredients'      => [
                        '1/2 tsp ELIOR Lakadong Turmeric Powder',
                        '1/4 tsp ground ginger (or grated fresh ginger)',
                        '1 cup barista-style oat milk',
                        '1 tsp maple syrup',
                    ],
                    'instructions'     => [
                        'Heat the oat milk in a saucepan or use a milk frother.',
                        'Whisk in the turmeric, ginger, and maple syrup until perfectly smooth and frothy.',
                        'Pour into your favorite mug and enjoy warm.',
                    ],
                    'meta_title'       => 'Turmeric Ginger Oat Latte | ELIOR Botanical Recipes',
                    'meta_description' => 'A spiced, creamy oat milk latte featuring the warmth of Lakadong turmeric and fresh ginger.',
                    'meta_keywords'    => 'recipe, botanical, elior, turmeric ginger oat latte',
                ],
            ],
            [
                'featured_image' => 'recipes/green_toast.jpg',
                'prep_time'      => 7,
                'cook_time'      => 3,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'organic-moringa-leaf-powder',
                'translations'   => [
                    'name'             => 'Green Herb Avocado Toast',
                    'url_key'          => 'green-herb-avocado-toast',
                    'description'      => 'A savory twist on a classic, elevating avocado toast with a sprinkle of nutrient-dense greens.',
                    'ingredients'      => [
                        '1/4 tsp ELIOR Organic Moringa Leaf Powder',
                        '1 slice artisan sourdough bread',
                        '1/2 ripe avocado',
                        'Lemon zest',
                        'Sea salt, black pepper, and mixed seeds',
                    ],
                    'instructions'     => [
                        'Toast the sourdough slice to your liking.',
                        'Mash the avocado and gently fold in the Moringa powder.',
                        'Spread the mixture evenly on the toast and top with lemon zest, salt, pepper, and seeds.',
                    ],
                    'meta_title'       => 'Green Herb Avocado Toast | ELIOR Botanical Recipes',
                    'meta_description' => 'A savory twist on a classic, elevating avocado toast with a sprinkle of nutrient-dense greens.',
                    'meta_keywords'    => 'recipe, botanical, elior, green herb avocado toast',
                ],
            ],
            [
                'featured_image' => 'recipes/golden_banana_shake.jpg',
                'prep_time'      => 5,
                'cook_time'      => 0,
                'difficulty'     => 1,
                'servings'       => 1,
                'status'         => 1,
                'product_slug'   => 'lakadong-turmeric-powder',
                'translations'   => [
                    'name'             => 'Golden Banana Breakfast Shake',
                    'url_key'          => 'golden-banana-breakfast-shake',
                    'description'      => 'A quick, satisfying breakfast shake combining creamy banana with the subtle earthiness of turmeric.',
                    'ingredients'      => [
                        '1/2 tsp ELIOR Lakadong Turmeric Powder',
                        '1 frozen banana',
                        '1 cup whole milk or almond milk',
                        '1 tbsp almond butter',
                        'A dash of cinnamon',
                    ],
                    'instructions'     => [
                        'Place the banana, milk, almond butter, turmeric, and cinnamon in a blender.',
                        'Blend on high for 30 seconds until creamy and fully combined.',
                        'Serve immediately in a tall glass.',
                    ],
                    'meta_title'       => 'Golden Banana Breakfast Shake | ELIOR Botanical Recipes',
                    'meta_description' => 'A quick, satisfying breakfast shake combining creamy banana with the subtle earthiness of turmeric.',
                    'meta_keywords'    => 'recipe, botanical, elior, golden banana breakfast shake',
                ],
            ],
        ];

        // Disable foreign key checks for clean seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('recipe_products')->truncate();
        DB::table('recipe_translations')->truncate();
        DB::table('recipes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $locales = ['ar', 'bn', 'ca', 'de', 'en', 'es', 'fa', 'fr', 'he', 'hi_IN', 'id', 'it', 'ja', 'nl', 'pl', 'pt_BR', 'ru', 'sin', 'tr', 'uk', 'zh_CN'];

        foreach ($recipesData as $data) {
            $recipeId = DB::table('recipes')->insertGetId([
                'status'         => $data['status'],
                'featured_image' => $data['featured_image'],
                'prep_time'      => $data['prep_time'],
                'cook_time'      => $data['cook_time'],
                'difficulty'     => $data['difficulty'],
                'servings'       => $data['servings'],
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            $trans = $data['translations'];

            foreach ($locales as $locale) {
                DB::table('recipe_translations')->insert([
                    'recipe_id'        => $recipeId,
                    'locale'           => $locale,
                    'name'             => $trans['name'],
                    'url_key'          => $trans['url_key'],
                    'description'      => $trans['description'],
                    'ingredients'      => json_encode($trans['ingredients'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                    'instructions'     => json_encode($trans['instructions'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                    'meta_title'       => $trans['meta_title'],
                    'meta_description' => $trans['meta_description'],
                    'meta_keywords'    => $trans['meta_keywords'],
                ]);
            }

            // Associate linked product
            if (! empty($data['product_slug'])) {
                $product = DB::table('product_flat')
                    ->where('url_key', $data['product_slug'])
                    ->first();

                if ($product) {
                    DB::table('recipe_products')->insert([
                        'recipe_id'  => $recipeId,
                        'product_id' => $product->product_id,
                    ]);
                }
            }
        }
    }
}
