<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EliorCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('=== ELIOR Catalog Seeder ===');

        // ──────────────────────────────────────────────
        // Step 1: Clean up all demo products
        // ──────────────────────────────────────────────
        $this->command->info('Cleaning demo products...');

        // Delete product-related data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_flat')->truncate();
        DB::table('product_attribute_values')->delete();
        DB::table('product_categories')->delete();
        DB::table('product_inventories')->delete();
        DB::table('product_images')->delete();
        DB::table('product_videos')->delete();
        DB::table('product_up_sells')->delete();
        DB::table('product_cross_sells')->delete();
        DB::table('product_relations')->delete();
        DB::table('product_ordered_inventories')->delete();
        DB::table('product_price_indices')->truncate();
        DB::table('product_inventory_indices')->truncate();
        DB::table('product_super_attributes')->delete();

        // Must delete children (variants) before parents
        DB::table('products')->whereNotNull('parent_id')->delete();
        DB::table('products')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Clean product channel mapping
        DB::table('product_channels')->delete();

        // Try to clean customer group prices if table exists
        if (DB::getSchemaBuilder()->hasTable('product_customer_group_prices')) {
            DB::table('product_customer_group_prices')->delete();
        }

        $this->command->info('Demo products cleaned.');

        // ──────────────────────────────────────────────
        // Step 2: Clean up demo categories (keep Root)
        // ──────────────────────────────────────────────
        $this->command->info('Cleaning demo categories...');

        // Delete all category translations except Root (id=1)
        DB::table('category_translations')->where('category_id', '!=', 1)->delete();

        // Delete categories except Root
        // Must delete children first (deeper levels)
        $childCats = DB::table('categories')
            ->where('id', '!=', 1)
            ->whereNotNull('parent_id')
            ->where('parent_id', '!=', 1)
            ->pluck('id');

        if ($childCats->count()) {
            DB::table('category_filterable_attributes')
                ->whereIn('category_id', $childCats)
                ->delete();
            DB::table('categories')
                ->whereIn('id', $childCats)
                ->delete();
        }

        // Now delete level-1 children
        $level1Cats = DB::table('categories')
            ->where('id', '!=', 1)
            ->pluck('id');

        if ($level1Cats->count()) {
            DB::table('category_filterable_attributes')
                ->whereIn('category_id', $level1Cats)
                ->delete();
            DB::table('categories')
                ->whereIn('id', $level1Cats)
                ->delete();
        }

        $this->command->info('Demo categories cleaned.');

        // ──────────────────────────────────────────────
        // Step 3: Create ELIOR categories
        // ──────────────────────────────────────────────
        $this->command->info('Creating ELIOR categories...');

        $rootId = 1;
        $channelId = 1;

        // Update Root category name to ELIOR
        DB::table('category_translations')
            ->where('category_id', $rootId)
            ->where('locale', 'en')
            ->update(['name' => 'ELIOR', 'slug' => 'elior']);

        // Fix NestedSet positions on root
        DB::table('categories')
            ->where('id', $rootId)
            ->update(['_lft' => 1, '_rgt' => 10, 'position' => 1, 'status' => 1]);

        $categories = [
            [
                'name' => 'Botanical Powders',
                'slug' => 'botanical-powders',
                'description' => 'Pure, single-origin dehydrated plant powders for daily nutrition and culinary creativity.',
                'position' => 1,
            ],
            [
                'name' => 'Functional Blends',
                'slug' => 'functional-blends',
                'description' => 'Expertly formulated multi-ingredient blends designed for specific wellness goals.',
                'position' => 2,
            ],
            [
                'name' => 'Culinary Ingredients',
                'slug' => 'culinary-ingredients',
                'description' => 'Premium plant-based ingredients for cooking, baking, and recipe enhancement.',
                'position' => 3,
            ],
            [
                'name' => 'Wellness Essentials',
                'slug' => 'wellness-essentials',
                'description' => 'Daily wellness supplements and nutrient-dense superfood formulations.',
                'position' => 4,
            ],
            [
                'name' => 'All Products',
                'slug' => 'products',
                'description' => 'Browse our complete range of cold-dehydrated single-origin botanical powders and nutrient-dense functional blends.',
                'position' => 5,
            ],
        ];

        $categoryIds = [];
        $lft = 2;

        foreach ($categories as $catData) {
            $catId = DB::table('categories')->insertGetId([
                'parent_id' => $rootId,
                'position' => $catData['position'],
                'status' => 1,
                '_lft' => $lft,
                '_rgt' => $lft + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('category_translations')->insert([
                'category_id' => $catId,
                'locale' => 'en',
                'name' => $catData['name'],
                'slug' => $catData['slug'],
                'description' => '<p>'.$catData['description'].'</p>',
                'meta_title' => $catData['name'].' | ELIOR Botanicals',
                'meta_description' => $catData['description'],
            ]);

            $categoryIds[$catData['slug']] = $catId;
            $lft += 2;

            $this->command->info("  Created category: {$catData['name']} (ID: {$catId})");
        }

        // Update root _rgt to encompass all children
        DB::table('categories')
            ->where('id', $rootId)
            ->update(['_rgt' => $lft]);

        $this->command->info('ELIOR categories created.');

        // ──────────────────────────────────────────────
        // Step 4: Create 10 ELIOR products
        // ──────────────────────────────────────────────
        $this->command->info('Creating ELIOR products...');

        $attributeFamilyId = 1; // Default

        $products = [
            // === Botanical Powders (4 products) ===
            [
                'sku' => 'elior-moringa-powder',
                'type' => 'simple',
                'name' => 'Organic Moringa Leaf Powder',
                'url_key' => 'organic-moringa-leaf-powder',
                'price' => 599.00,
                'special_price' => 499.00,
                'weight' => 0.25,
                'short_desc' => 'Sustainably harvested, shade-dried moringa leaves ground into a fine, nutrient-dense powder. Rich in vitamins A, C, iron and calcium.',
                'description' => '<h2>ELIOR Organic Moringa Leaf Powder</h2><p>Our moringa leaves are hand-harvested from certified organic farms in South India, carefully shade-dried to preserve maximum nutrient density, then stone-ground into a silky-fine powder.</p><h3>Key Benefits</h3><ul><li>Rich in Vitamins A, C, E and K</li><li>Complete amino acid profile</li><li>Natural source of iron and calcium</li><li>Supports immune function and energy</li></ul><h3>How to Use</h3><p>Add 1 teaspoon to smoothies, warm water with lemon, soups, or sprinkle over salads. Best consumed in the morning for sustained energy.</p><h3>Specifications</h3><p>Net Weight: 250g | Servings: ~50 | Origin: Tamil Nadu, India | Certification: India Organic, USDA Organic</p>',
                'categories' => ['botanical-powders', 'products'],
                'meta_title' => 'Organic Moringa Leaf Powder | ELIOR Botanicals',
                'meta_desc' => 'Premium organic moringa leaf powder. Shade-dried, stone-ground. Rich in vitamins A, C, iron & calcium. 250g.',
                'new' => 1,
                'featured' => 1,
                'qty' => 200,
            ],
            [
                'sku' => 'elior-beetroot-powder',
                'type' => 'simple',
                'name' => 'Dehydrated Beetroot Powder',
                'url_key' => 'dehydrated-beetroot-powder',
                'price' => 449.00,
                'special_price' => null,
                'weight' => 0.20,
                'short_desc' => 'Vibrant ruby-red beetroot powder made from slow-dehydrated farm-fresh beets. Natural source of dietary nitrates and antioxidants.',
                'description' => '<h2>ELIOR Dehydrated Beetroot Powder</h2><p>Sourced from premium Indian beetroot, our powder is created through a gentle low-temperature dehydration process that preserves the deep ruby colour, earthy sweetness, and full nutritional profile.</p><h3>Key Benefits</h3><ul><li>Natural source of dietary nitrates</li><li>Supports cardiovascular health</li><li>Rich in folate and manganese</li><li>Natural food colouring for baking</li></ul><h3>How to Use</h3><p>Mix 1-2 teaspoons into smoothies, juices, lattes, or baked goods. Use as a natural food colourant for pastas, breads, and desserts.</p><h3>Specifications</h3><p>Net Weight: 200g | Servings: ~40 | Origin: Maharashtra, India | Processing: Low-temperature dehydration</p>',
                'categories' => ['botanical-powders', 'products'],
                'meta_title' => 'Dehydrated Beetroot Powder | ELIOR Botanicals',
                'meta_desc' => 'Pure dehydrated beetroot powder. Low-temperature processed. Natural nitrates & antioxidants. 200g.',
                'new' => 0,
                'featured' => 1,
                'qty' => 150,
            ],
            [
                'sku' => 'elior-amla-powder',
                'type' => 'simple',
                'name' => 'Wild-Harvested Amla Powder',
                'url_key' => 'wild-harvested-amla-powder',
                'price' => 399.00,
                'special_price' => null,
                'weight' => 0.20,
                'short_desc' => 'Wild-harvested Indian gooseberry (amla) gently dried and ground. One of nature richest sources of vitamin C and powerful antioxidants.',
                'description' => '<h2>ELIOR Wild-Harvested Amla Powder</h2><p>Our amla is wild-harvested from ancient gooseberry groves in Rajasthan and Madhya Pradesh. Each berry is hand-selected at peak ripeness, carefully deseeded, and gently dried to preserve its extraordinary vitamin C content.</p><h3>Key Benefits</h3><ul><li>One of nature richest sources of Vitamin C</li><li>Powerful antioxidant protection</li><li>Supports hair, skin, and nail health</li><li>Aids digestion and metabolism</li></ul><h3>How to Use</h3><p>Dissolve 1 teaspoon in warm water with honey, blend into juices, or mix into yogurt. Also excellent as a hair mask ingredient.</p><h3>Specifications</h3><p>Net Weight: 200g | Servings: ~40 | Origin: Rajasthan, India | Harvest: Wild-collected</p>',
                'categories' => ['botanical-powders', 'wellness-essentials', 'products'],
                'meta_title' => 'Wild-Harvested Amla Powder | ELIOR Botanicals',
                'meta_desc' => 'Wild-harvested amla (Indian gooseberry) powder. Richest natural vitamin C source. 200g.',
                'new' => 0,
                'featured' => 0,
                'qty' => 180,
            ],
            [
                'sku' => 'elior-turmeric-powder',
                'type' => 'simple',
                'name' => 'Lakadong Turmeric Powder',
                'url_key' => 'lakadong-turmeric-powder',
                'price' => 699.00,
                'special_price' => 599.00,
                'weight' => 0.20,
                'short_desc' => 'Ultra-premium Lakadong turmeric from Meghalaya with 7-9% curcumin content — the highest natural curcumin concentration available.',
                'description' => '<h2>ELIOR Lakadong Turmeric Powder</h2><p>Lakadong turmeric is the world rarest and most potent turmeric variety, grown exclusively in the Jaintia Hills of Meghalaya. With 7-9% natural curcumin content (vs 2-3% in standard turmeric), this is nature most powerful anti-inflammatory spice.</p><h3>Key Benefits</h3><ul><li>7-9% natural curcumin content</li><li>Potent anti-inflammatory properties</li><li>Superior bioavailability</li><li>Deep golden colour and rich aroma</li></ul><h3>How to Use</h3><p>Use in golden milk, curries, smoothies, or warm water. Combine with black pepper and healthy fats for maximum curcumin absorption.</p><h3>Specifications</h3><p>Net Weight: 200g | Servings: ~100 | Origin: Meghalaya, India | Curcumin: 7-9%</p>',
                'categories' => ['botanical-powders', 'culinary-ingredients', 'products'],
                'meta_title' => 'Lakadong Turmeric Powder | ELIOR Botanicals',
                'meta_desc' => 'Ultra-premium Lakadong turmeric with 7-9% curcumin. The world most potent natural turmeric. 200g.',
                'new' => 1,
                'featured' => 1,
                'qty' => 120,
            ],

            // === Functional Blends (3 products) ===
            [
                'sku' => 'elior-green-vitality',
                'type' => 'simple',
                'name' => 'Green Vitality Superblend',
                'url_key' => 'green-vitality-superblend',
                'price' => 899.00,
                'special_price' => 799.00,
                'weight' => 0.30,
                'short_desc' => 'A synergistic blend of 8 organic greens — moringa, spirulina, wheatgrass, chlorella, spinach, matcha, ashwagandha and tulsi — for comprehensive daily nutrition.',
                'description' => '<h2>ELIOR Green Vitality Superblend</h2><p>Our signature daily greens formula combines eight of the world most nutrient-dense plants into one easy serving. Each ingredient is individually sourced, tested for purity, and blended in precise ratios for optimal synergy.</p><h3>Ingredients</h3><ul><li>Organic Moringa Leaf</li><li>Spirulina</li><li>Wheatgrass</li><li>Chlorella (broken cell wall)</li><li>Organic Spinach</li><li>Ceremonial Grade Matcha</li><li>KSM-66 Ashwagandha</li><li>Holy Basil (Tulsi)</li></ul><h3>How to Use</h3><p>Blend 1 scoop (10g) into water, coconut water, or your morning smoothie. Best taken on an empty stomach.</p><h3>Specifications</h3><p>Net Weight: 300g | Servings: 30 | Blend Ratio: Proprietary | Testing: Heavy metal tested</p>',
                'categories' => ['functional-blends', 'products'],
                'meta_title' => 'Green Vitality Superblend | ELIOR Botanicals',
                'meta_desc' => '8-ingredient organic greens superblend. Moringa, spirulina, wheatgrass, chlorella & more. 300g, 30 servings.',
                'new' => 1,
                'featured' => 1,
                'qty' => 100,
            ],
            [
                'sku' => 'elior-golden-immunity',
                'type' => 'simple',
                'name' => 'Golden Immunity Elixir Blend',
                'url_key' => 'golden-immunity-elixir-blend',
                'price' => 749.00,
                'special_price' => null,
                'weight' => 0.25,
                'short_desc' => 'A warming Ayurvedic-inspired blend of Lakadong turmeric, ginger, black pepper, cinnamon, cardamom and saffron for immune support and inflammation defence.',
                'description' => '<h2>ELIOR Golden Immunity Elixir Blend</h2><p>Inspired by the ancient Ayurvedic tradition of golden milk, our elixir blend combines premium Lakadong turmeric with synergistic warming spices and bio-enhancers for maximum curcumin absorption.</p><h3>Ingredients</h3><ul><li>Lakadong Turmeric (7% curcumin)</li><li>Organic Ginger Root</li><li>Black Pepper Extract (BioPerine)</li><li>Ceylon Cinnamon</li><li>Green Cardamom</li><li>Kashmir Saffron</li></ul><h3>How to Use</h3><p>Stir 1 teaspoon into warm milk (dairy or plant-based) with a touch of honey. Perfect as an evening wind-down ritual.</p><h3>Specifications</h3><p>Net Weight: 250g | Servings: ~50 | Features: BioPerine enhanced absorption</p>',
                'categories' => ['functional-blends', 'wellness-essentials', 'products'],
                'meta_title' => 'Golden Immunity Elixir Blend | ELIOR Botanicals',
                'meta_desc' => 'Ayurvedic golden milk blend with Lakadong turmeric, saffron, BioPerine. Immune support. 250g.',
                'new' => 0,
                'featured' => 1,
                'qty' => 130,
            ],
            [
                'sku' => 'elior-beauty-bloom',
                'type' => 'simple',
                'name' => 'Beauty Bloom Collagen Booster',
                'url_key' => 'beauty-bloom-collagen-booster',
                'price' => 999.00,
                'special_price' => 849.00,
                'weight' => 0.25,
                'short_desc' => 'A plant-based beauty blend of amla, hibiscus, rose petal, aloe vera, vitamin E-rich moringa and biotin-rich bamboo shoot for radiant skin, hair and nails.',
                'description' => '<h2>ELIOR Beauty Bloom Collagen Booster</h2><p>A 100% plant-based beauty supplement that works from within. Our proprietary formula combines traditional Ayurvedic beauty botanicals with modern nutritional science to support natural collagen production.</p><h3>Ingredients</h3><ul><li>Amla (Vitamin C for collagen synthesis)</li><li>Hibiscus Flower</li><li>Rose Petal Extract</li><li>Aloe Vera</li><li>Moringa Leaf (Vitamin E)</li><li>Bamboo Shoot Extract (natural Biotin + Silica)</li></ul><h3>How to Use</h3><p>Mix 1 scoop (8g) into water, juice, or a smoothie. Take daily for visible results in 4-6 weeks.</p><h3>Specifications</h3><p>Net Weight: 250g | Servings: ~30 | Type: Plant-based, no animal collagen</p>',
                'categories' => ['functional-blends', 'wellness-essentials', 'products'],
                'meta_title' => 'Beauty Bloom Collagen Booster | ELIOR Botanicals',
                'meta_desc' => 'Plant-based beauty blend for skin, hair & nails. Amla, hibiscus, rose petal, aloe vera. 250g.',
                'new' => 1,
                'featured' => 0,
                'qty' => 90,
            ],

            // === Culinary Ingredients (2 products) ===
            [
                'sku' => 'elior-curry-leaf-powder',
                'type' => 'simple',
                'name' => 'Sun-Dried Curry Leaf Powder',
                'url_key' => 'sun-dried-curry-leaf-powder',
                'price' => 349.00,
                'special_price' => null,
                'weight' => 0.15,
                'short_desc' => 'Aromatic sun-dried curry leaves from Kerala, stone-ground to a fine powder. Retains the intense flavour and iron content of fresh leaves year-round.',
                'description' => '<h2>ELIOR Sun-Dried Curry Leaf Powder</h2><p>Sourced directly from organic curry leaf farms in Kerala, our leaves are picked at dawn for maximum aromatic oil content, sun-dried within hours, and stone-ground into a fragrant fine powder.</p><h3>Key Benefits</h3><ul><li>Intense natural flavour — better than dried leaves</li><li>Excellent source of iron and folic acid</li><li>Rich in antioxidants</li><li>Traditional hair and skin tonic</li></ul><h3>How to Use</h3><p>Add to tempering (tadka), rice dishes, chutneys, rasam, sambar, buttermilk, or smoothies. Sprinkle over yogurt or dals for instant flavour.</p><h3>Specifications</h3><p>Net Weight: 150g | Origin: Kerala, India | Processing: Sun-dried, stone-ground</p>',
                'categories' => ['culinary-ingredients', 'products'],
                'meta_title' => 'Sun-Dried Curry Leaf Powder | ELIOR Botanicals',
                'meta_desc' => 'Premium Kerala curry leaf powder. Sun-dried, stone-ground. Rich iron source. 150g.',
                'new' => 0,
                'featured' => 0,
                'qty' => 160,
            ],

            // === Wellness Essentials (1 product) ===
            [
                'sku' => 'elior-ashwagandha-powder',
                'type' => 'simple',
                'name' => 'KSM-66 Ashwagandha Root Powder',
                'url_key' => 'ksm-66-ashwagandha-root-powder',
                'price' => 799.00,
                'special_price' => 699.00,
                'weight' => 0.20,
                'short_desc' => 'Premium KSM-66 ashwagandha root extract powder — the world most clinically studied ashwagandha, standardised to 5% withanolides for stress relief and vitality.',
                'description' => '<h2>ELIOR KSM-66 Ashwagandha Root Powder</h2><p>We use only the gold-standard KSM-66 ashwagandha extract, produced through a unique proprietary process that uses no alcohol or chemical solvents, preserving the natural balance of active compounds.</p><h3>Key Benefits</h3><ul><li>Standardised to 5% withanolides</li><li>Clinically proven stress and cortisol reduction</li><li>Supports muscle strength and recovery</li><li>Enhances cognitive function and memory</li><li>Improves sleep quality</li></ul><h3>How to Use</h3><p>Mix 1 teaspoon (3g) into warm milk, water, or a smoothie. Best taken in the evening. Can be combined with black pepper for enhanced absorption.</p><h3>Specifications</h3><p>Net Weight: 200g | Servings: ~66 | Extract: KSM-66 | Withanolides: 5% | Origin: Rajasthan, India</p>',
                'categories' => ['wellness-essentials', 'products'],
                'meta_title' => 'KSM-66 Ashwagandha Root Powder | ELIOR Botanicals',
                'meta_desc' => 'Premium KSM-66 ashwagandha. 5% withanolides. Clinically studied for stress relief & vitality. 200g.',
                'new' => 0,
                'featured' => 1,
                'qty' => 140,
            ],
            [
                'sku' => 'elior-spirulina-powder',
                'type' => 'simple',
                'name' => 'Artisanal Spirulina Powder',
                'url_key' => 'artisanal-spirulina-powder',
                'price' => 649.00,
                'special_price' => null,
                'weight' => 0.20,
                'short_desc' => 'Farm-fresh spirulina cultivated in pristine freshwater ponds in Tamil Nadu. Air-dried at low temperatures to preserve phycocyanin and complete protein.',
                'description' => '<h2>ELIOR Artisanal Spirulina Powder</h2><p>Our spirulina is cultivated in carefully maintained freshwater ponds in Tamil Nadu, harvested daily, and immediately air-dried at temperatures below 40 degrees C to preserve the delicate phycocyanin pigment and complete amino acid profile.</p><h3>Key Benefits</h3><ul><li>60-70% complete protein by weight</li><li>Rich in phycocyanin (blue pigment antioxidant)</li><li>Excellent source of B-vitamins and iron</li><li>Supports energy and endurance</li></ul><h3>How to Use</h3><p>Start with 1/2 teaspoon and work up to 1-2 teaspoons daily. Best added to smoothies, juices, or energy balls. Avoid adding to hot liquids.</p><h3>Specifications</h3><p>Net Weight: 200g | Servings: ~40 | Protein: 65% | Origin: Tamil Nadu, India | Drying: Low-temperature air-dried</p>',
                'categories' => ['botanical-powders', 'wellness-essentials', 'products'],
                'meta_title' => 'Artisanal Spirulina Powder | ELIOR Botanicals',
                'meta_desc' => 'Farm-fresh spirulina. 65% complete protein. Low-temperature dried. Phycocyanin-rich. 200g.',
                'new' => 0,
                'featured' => 0,
                'qty' => 110,
            ],
        ];

        $inventorySourceId = 1; // Default inventory source

        foreach ($products as $productData) {
            // Step 4a: Create the product record
            $productId = DB::table('products')->insertGetId([
                'type' => $productData['type'],
                'sku' => $productData['sku'],
                'attribute_family_id' => $attributeFamilyId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Step 4b: Attach to default channel
            DB::table('product_channels')->insert([
                'product_id' => $productId,
                'channel_id' => $channelId,
            ]);

            // Step 4c: Attach to categories
            foreach ($productData['categories'] as $catSlug) {
                if (isset($categoryIds[$catSlug])) {
                    DB::table('product_categories')->insert([
                        'product_id' => $productId,
                        'category_id' => $categoryIds[$catSlug],
                    ]);
                }
            }

            // Step 4d: Save attribute values
            $attributeValues = [
                // General group
                ['attribute_id' => 1, 'text_value' => $productData['sku']],           // sku
                ['attribute_id' => 2, 'text_value' => $productData['name']],           // name
                ['attribute_id' => 3, 'text_value' => $productData['url_key']],        // url_key

                // Description group
                ['attribute_id' => 9, 'text_value' => $productData['short_desc']],     // short_description
                ['attribute_id' => 10, 'text_value' => $productData['description']],   // description

                // Price group
                ['attribute_id' => 11, 'float_value' => $productData['price']],        // price

                // Meta group
                ['attribute_id' => 16, 'text_value' => $productData['meta_title']],    // meta_title
                ['attribute_id' => 18, 'text_value' => $productData['meta_desc']],     // meta_description

                // Shipping group
                ['attribute_id' => 22, 'text_value' => (string) $productData['weight']], // weight

                // Settings group
                ['attribute_id' => 5, 'boolean_value' => $productData['new']],         // new
                ['attribute_id' => 6, 'boolean_value' => $productData['featured']],    // featured
                ['attribute_id' => 7, 'boolean_value' => 1],                           // visible_individually
                ['attribute_id' => 8, 'boolean_value' => 1],                           // status
                ['attribute_id' => 26, 'boolean_value' => 1],                          // guest_checkout
            ];

            // Add special_price if set
            if ($productData['special_price'] !== null) {
                $attributeValues[] = ['attribute_id' => 13, 'float_value' => $productData['special_price']];
            }

            foreach ($attributeValues as $attrVal) {
                $record = [
                    'product_id' => $productId,
                    'attribute_id' => $attrVal['attribute_id'],
                    'locale' => 'en',
                    'channel' => 'default',
                ];

                // Determine which value column to use
                if (isset($attrVal['text_value'])) {
                    $record['text_value'] = $attrVal['text_value'];
                } elseif (isset($attrVal['float_value'])) {
                    $record['float_value'] = $attrVal['float_value'];
                } elseif (isset($attrVal['boolean_value'])) {
                    $record['boolean_value'] = $attrVal['boolean_value'];
                } elseif (isset($attrVal['integer_value'])) {
                    $record['integer_value'] = $attrVal['integer_value'];
                }

                // Check if attribute is channel/locale specific
                $attribute = DB::table('attributes')->where('id', $attrVal['attribute_id'])->first();
                if ($attribute) {
                    if (! $attribute->value_per_locale) {
                        $record['locale'] = null;
                    }
                    if (! $attribute->value_per_channel) {
                        $record['channel'] = null;
                    }
                }

                DB::table('product_attribute_values')->insert($record);
            }

            // Step 4e: Set inventory
            DB::table('product_inventories')->insert([
                'qty' => $productData['qty'],
                'product_id' => $productId,
                'inventory_source_id' => $inventorySourceId,
                'vendor_id' => 0,
            ]);

            // Step 4f: Create product_flat entry
            DB::table('product_flat')->insert([
                'product_id' => $productId,
                'sku' => $productData['sku'],
                'type' => $productData['type'],
                'name' => $productData['name'],
                'short_description' => $productData['short_desc'],
                'description' => $productData['description'],
                'url_key' => $productData['url_key'],
                'price' => $productData['price'],
                'special_price' => $productData['special_price'],
                'weight' => $productData['weight'],
                'new' => $productData['new'],
                'featured' => $productData['featured'],
                'status' => 1,
                'visible_individually' => 1,
                'locale' => 'en',
                'channel' => 'default',
                'product_number' => null,
                'meta_title' => $productData['meta_title'],
                'meta_description' => $productData['meta_desc'],
                'attribute_family_id' => $attributeFamilyId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

                        // Step 4g: Attach product image
            $imageSrc = base_path('packages/Webkul/Installer/src/Resources/assets/images/seeders/elior_products/' . $productData['sku'] . '.jpg');
            if (file_exists($imageSrc)) {
                $relPath = 'products/' . $productId . '/' . $productData['sku'] . '.jpg';
                $destDir = storage_path('app/public/products/' . $productId);
                if (! file_exists($destDir)) {
                    mkdir($destDir, 0777, true);
                }
                copy($imageSrc, $destDir . '/' . $productData['sku'] . '.jpg');

                $pubDir = public_path('storage/products/' . $productId);
                if (! file_exists($pubDir)) {
                    mkdir($pubDir, 0777, true);
                }
                copy($imageSrc, $pubDir . '/' . $productData['sku'] . '.jpg');

                DB::table('product_images')->insert([
                    'path'       => $relPath,
                    'product_id' => $productId,
                    'position'   => 1,
                ]);
            }

            $this->command->info("  Created product: {$productData['name']} (ID: {$productId})");
        }

        // Step 5: Run Indexers for inventory, prices, and search
        app(\Webkul\Product\Helpers\Indexers\Inventory::class)->reindexFull();
        app(\Webkul\Product\Helpers\Indexers\Price::class)->reindexFull();
        \Illuminate\Support\Facades\Artisan::call('indexer:index');

        $this->command->info('');
        $this->command->info('=== ELIOR Catalog Seeder Complete ===');
        $this->command->info('Categories: '.count($categoryIds));
        $this->command->info('Products: '.count($products));
        $this->command->info('Inventory & Price Indexing: COMPLETED');
    }
}
