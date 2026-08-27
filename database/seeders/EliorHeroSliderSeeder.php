<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Webkul\Theme\Models\HeroLayer;
use Webkul\Theme\Models\HeroSlide;
use Webkul\Theme\Models\HeroSlider;

class EliorHeroSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws \RuntimeException
     */
    public function run()
    {
        // 1. Prepare and Copy Media Assets from package seeders
        $heroPackageDir = base_path('packages/Webkul/Installer/src/Resources/assets/images/seeders/hero');
        $storageHeroDir = storage_path('app/public/theme/hero/elior');
        $publicHeroDir = public_path('storage/theme/hero/elior');

        if (! File::exists($storageHeroDir)) {
            File::makeDirectory($storageHeroDir, 0777, true, true);
        }
        if (! File::exists($publicHeroDir)) {
            File::makeDirectory($publicHeroDir, 0777, true, true);
        }

        $heroFiles = [
            'elior-hero-botanical-desktop.webp',
            'elior-hero-botanical-mobile.webp',
            'elior-hero-quality-desktop.webp',
            'elior-hero-quality-mobile.webp',
            'elior-hero-discovery-desktop.webp',
            'elior-hero-discovery-mobile.webp',
        ];

        foreach ($heroFiles as $file) {
            $pkgFile = $heroPackageDir.'/'.$file;
            if (File::exists($pkgFile)) {
                File::copy($pkgFile, $storageHeroDir.'/'.$file);
                File::copy($pkgFile, $publicHeroDir.'/'.$file);
            }
        }

        // 2. Perform Seeding within Database Transaction (Idempotent)
        DB::transaction(function () {
            // Find or create the primary ELIOR Homepage Hero Slider
            $slider = HeroSlider::updateOrCreate(
                ['code' => 'elior-homepage-hero'],
                [
                    'name' => 'ELIOR Homepage Hero',
                    'status' => 1,
                    'placement' => 'homepage',
                    'settings' => [
                        'autoplay' => true,
                        'loop' => true,
                        'duration' => 6000,
                    ],
                ]
            );

            // Define 3 Production Slides with Complete Editorial Hierarchy
            $slidesData = [
                [
                    'name' => 'Botanical Nutrition',
                    'sort_order' => 0,
                    'media_type' => 'image',
                    'desktop_media' => 'theme/hero/elior/elior-hero-botanical-desktop.webp',
                    'mobile_media' => 'theme/hero/elior/elior-hero-botanical-mobile.webp',
                    'duration' => 6000,
                    'status' => 1,
                    'layers' => [
                        [
                            'type' => 'text',
                            'name' => 'Eyebrow',
                            'sort_order' => 0,
                            'content' => '<div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-elior-botanicalLight/90 text-elior-botanical border border-elior-botanical/30 text-xs font-semibold tracking-widest uppercase shadow-sm"><span class="material-symbols-outlined text-[15px]" aria-hidden="true" style="font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;">eco</span><span>100% Dehydrated Whole Foods • Cold-Processed</span></div>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'heading',
                            'name' => 'Headline',
                            'sort_order' => 1,
                            'content' => 'Pure Botanical Nutrition. <br class="hidden sm:inline"><span class="italic text-elior-botanical font-normal">Zero Compromises.</span>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'text',
                            'name' => 'Description',
                            'sort_order' => 2,
                            'content' => '<p class="text-base sm:text-lg lg:text-xl leading-relaxed text-elior-muted max-w-xl">Concentrated plant food powders and functional botanical blends. Low-temperature dehydrated below 42°C to preserve active phytonutrients, living enzymes, and clean daily vitality.</p>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'button',
                            'name' => 'CTAs',
                            'sort_order' => 3,
                            'content' => '<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-1"><a href="/products" class="elior-btn-primary !px-8 !py-4 text-xs tracking-widest shadow-elior-card">Explore Formulations</a><a href="/page/quality" class="elior-btn-outline !px-8 !py-4 text-xs tracking-widest">Our Quality Standard</a></div>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'text',
                            'name' => 'Metrics',
                            'sort_order' => 4,
                            'content' => '<div class="grid grid-cols-3 gap-6 pt-4 border-t border-elior-border/80 max-w-lg"><div><p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">100%</p><p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Whole Plants</p></div><div><p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">&lt; 42°C</p><p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Cold Dehydrated</p></div><div><p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">0%</p><p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Synthetic Fillers</p></div></div>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                    ],
                ],
                [
                    'name' => 'Carefully Processed',
                    'sort_order' => 1,
                    'media_type' => 'image',
                    'desktop_media' => 'theme/hero/elior/elior-hero-quality-desktop.webp',
                    'mobile_media' => 'theme/hero/elior/elior-hero-quality-mobile.webp',
                    'duration' => 6000,
                    'status' => 1,
                    'layers' => [
                        [
                            'type' => 'text',
                            'name' => 'Eyebrow',
                            'sort_order' => 0,
                            'content' => '<div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-elior-botanicalLight/90 text-elior-botanical border border-elior-botanical/30 text-xs font-semibold tracking-widest uppercase shadow-sm"><span class="material-symbols-outlined text-[15px]" aria-hidden="true" style="font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;">verified</span><span>From Whole Ingredient To Powder</span></div>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'heading',
                            'name' => 'Headline',
                            'sort_order' => 1,
                            'content' => 'Carefully Processed. <br class="hidden sm:inline"><span class="italic text-elior-botanical font-normal">Naturally Simple.</span>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'text',
                            'name' => 'Description',
                            'sort_order' => 2,
                            'content' => '<p class="text-base sm:text-lg lg:text-xl leading-relaxed text-elior-muted max-w-xl">Our botanical powders are made from single-origin agricultural harvests and gently dried below 42°C to preserve their natural aroma, phytonutrients, and living character.</p>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'button',
                            'name' => 'CTAs',
                            'sort_order' => 3,
                            'content' => '<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-1"><a href="/page/quality" class="elior-btn-primary !px-8 !py-4 text-xs tracking-widest shadow-elior-card">Discover Our Quality</a><a href="/products" class="elior-btn-outline !px-8 !py-4 text-xs tracking-widest">Explore Products</a></div>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'text',
                            'name' => 'Metrics',
                            'sort_order' => 4,
                            'content' => '<div class="grid grid-cols-3 gap-6 pt-4 border-t border-elior-border/80 max-w-lg"><div><p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">Single</p><p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Origin Harvests</p></div><div><p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">Micro</p><p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Milled Fine</p></div><div><p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">3rd Party</p><p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Purity Tested</p></div></div>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                    ],
                ],
                [
                    'name' => 'Explore Botanicals',
                    'sort_order' => 2,
                    'media_type' => 'image',
                    'desktop_media' => 'theme/hero/elior/elior-hero-discovery-desktop.webp',
                    'mobile_media' => 'theme/hero/elior/elior-hero-discovery-mobile.webp',
                    'duration' => 6000,
                    'status' => 1,
                    'layers' => [
                        [
                            'type' => 'text',
                            'name' => 'Eyebrow',
                            'sort_order' => 0,
                            'content' => '<div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-elior-botanicalLight/90 text-elior-botanical border border-elior-botanical/30 text-xs font-semibold tracking-widest uppercase shadow-sm"><span class="material-symbols-outlined text-[15px]" aria-hidden="true" style="font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;">spa</span><span>Explore The Botanical Collection</span></div>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'heading',
                            'name' => 'Headline',
                            'sort_order' => 1,
                            'content' => 'Simple Ingredients. <br class="hidden sm:inline"><span class="italic text-elior-botanical font-normal">Endless Possibilities.</span>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'text',
                            'name' => 'Description',
                            'sort_order' => 2,
                            'content' => '<p class="text-base sm:text-lg lg:text-xl leading-relaxed text-elior-muted max-w-xl">Discover concentrated whole plant powders and adaptogenic superblends crafted for effortless integration into your daily food and tonic rituals.</p>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'button',
                            'name' => 'CTAs',
                            'sort_order' => 3,
                            'content' => '<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-1"><a href="/products" class="elior-btn-primary !px-8 !py-4 text-xs tracking-widest shadow-elior-card">Shop All Powders</a><a href="/recipes" class="elior-btn-outline !px-8 !py-4 text-xs tracking-widest">Explore Recipes</a></div>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                        [
                            'type' => 'text',
                            'name' => 'Metrics',
                            'sort_order' => 4,
                            'content' => '<div class="grid grid-cols-3 gap-6 pt-4 border-t border-elior-border/80 max-w-lg"><div><p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">10+</p><p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Pure Powders</p></div><div><p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">12+</p><p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Daily Recipes</p></div><div><p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">Zero</p><p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Added Sugars</p></div></div>',
                            'desktop_settings' => ['x' => '0%', 'y' => '0%', 'width' => 'auto'],
                            'settings' => ['classes' => ''],
                        ],
                    ],
                ],
            ];

            // Sync slides and layers idempotently
            $existingSlideIds = [];

            foreach ($slidesData as $slideInfo) {
                $layersData = $slideInfo['layers'];
                unset($slideInfo['layers']);

                $slide = HeroSlide::updateOrCreate(
                    [
                        'hero_slider_id' => $slider->id,
                        'name' => $slideInfo['name'],
                    ],
                    $slideInfo
                );

                $existingSlideIds[] = $slide->id;

                // Sync layers
                $existingLayerIds = [];
                foreach ($layersData as $layerInfo) {
                    $layer = HeroLayer::updateOrCreate(
                        [
                            'hero_slide_id' => $slide->id,
                            'name' => $layerInfo['name'],
                        ],
                        $layerInfo
                    );

                    $existingLayerIds[] = $layer->id;
                }

                // Clean up any extraneous layers for this slide
                HeroLayer::where('hero_slide_id', $slide->id)
                    ->whereNotIn('id', $existingLayerIds)
                    ->delete();
            }

            // Remove any outdated seeded slides for this slider
            HeroSlide::where('hero_slider_id', $slider->id)
                ->whereNotIn('id', $existingSlideIds)
                ->delete();
        });

        $this->command?->info('ELIOR Hero Slider and Media Campaign seeded successfully!');
    }
}
