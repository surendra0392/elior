<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EliorThemeCustomizationSeeder extends Seeder
{
    /**
     * Seed ELIOR theme customizations.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->info('=== ELIOR Theme Customization Seeder ===');

        $now = Carbon::now();

        // 1. Deactivate default Bagisto demo theme carousels if they exist
        DB::table('theme_customizations')
            ->whereIn('id', [1, 2, 3, 4, 5, 6, 9, 10, 11, 12, 13, 14])
            ->update(['status' => 0]);

        // 2. Define ELIOR Custom Theme Blocks
        $customizations = [
            [
                'id'         => 16,
                'theme_code' => 'default',
                'type'       => 'static_content',
                'name'       => 'ELIOR Hero & Philosophy',
                'sort_order' => 1,
                'status'     => 1,
                'channel_id' => 1,
                'options'    => json_encode([
                    'css'  => '',
                    'html' => '<!-- SECTION 1: COMMANDING EDITORIAL HERO -->
<section class="relative overflow-hidden bg-[#FAF8F5] pt-16 pb-24 lg:pt-24 lg:pb-36 border-b border-elior-border/70">
    <div class="absolute -top-48 -left-48 w-[600px] h-[600px] rounded-full bg-elior-botanicalLight/50 blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/3 -right-48 w-[600px] h-[600px] rounded-full bg-[#F7EBE3]/50 blur-3xl pointer-events-none"></div>
    <div class="site-container relative">
        <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-7 space-y-7 lg:space-y-9">
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-elior-botanicalLight text-elior-botanical border border-elior-botanical/20 text-xs font-semibold tracking-widest uppercase">
                    <span class="h-2 w-2 rounded-full bg-elior-botanical"></span>
                    100% Dehydrated Whole Foods • Cold-Processed
                </div>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold tracking-tight text-elior-charcoal leading-[1.08]">
                    Pure Botanical Nutrition. <br class="hidden sm:inline">
                    <span class="italic text-elior-botanical font-normal">Zero Compromises.</span>
                </h1>
                <p class="text-base sm:text-lg lg:text-xl leading-relaxed text-elior-muted max-w-xl">
                    Concentrated plant food powders and functional botanical blends. Low-temperature dehydrated below 42°C to preserve active phytonutrients, living enzymes, and clean daily vitality.
                </p>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-2">
                    <a href="/products" class="elior-btn-primary !px-8 !py-4 text-xs tracking-widest shadow-elior-card">
                        Explore Formulations
                    </a>
                    <a href="/page/about-us" class="elior-btn-outline !px-8 !py-4 text-xs tracking-widest">
                        Our Formulation Standard
                    </a>
                </div>
                <div class="grid grid-cols-3 gap-8 pt-8 border-t border-elior-border/80 max-w-lg">
                    <div>
                        <p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">100%</p>
                        <p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Whole Plants</p>
                    </div>
                    <div>
                        <p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">&lt; 42°C</p>
                        <p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Cold Dehydrated</p>
                    </div>
                    <div>
                        <p class="font-serif text-2xl lg:text-3xl font-bold text-elior-charcoal">0%</p>
                        <p class="text-xs uppercase tracking-wider text-elior-muted font-medium mt-1">Synthetic Fillers</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-2xl bg-white p-8 sm:p-10 border border-elior-border shadow-elior-hover">
                    <div class="space-y-6">
                        <div class="aspect-4/3 overflow-hidden rounded-xl bg-[#F4EFEA] flex flex-col items-center justify-center p-8 border border-elior-border/60 text-center space-y-3">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-elior-botanical text-white text-2xl font-serif font-bold shadow-sm">
                                E
                            </div>
                            <h3 class="font-serif text-2xl font-bold text-elior-charcoal">Raw Botanical Harvests</h3>
                            <p class="text-xs sm:text-sm text-elior-muted max-w-xs leading-relaxed">
                                Cold-dehydrated fruits, wild supergreens, functional mushrooms, and adaptogenic roots gently reduced to ultra-fine ritual powders.
                            </p>
                        </div>
                        <div class="space-y-3 pt-2 text-xs sm:text-sm font-medium text-elior-slate">
                            <div class="flex items-center gap-3">
                                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-elior-botanical text-white text-[11px] font-bold">✓</span>
                                <span>Zero maltodextrins, silica, or anti-caking chemicals</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-elior-botanical text-white text-[11px] font-bold">✓</span>
                                <span>Single-origin & ethically sourced agricultural batches</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-elior-botanical text-white text-[11px] font-bold">✓</span>
                                <span>Third-party purity and heavy-metal verified</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>',
                ]),
            ],
            [
                'id'         => 18,
                'theme_code' => 'default',
                'type'       => 'static_content',
                'name'       => 'ELIOR Header Navigation',
                'sort_order' => 10,
                'status'     => 1,
                'channel_id' => 1,
                'options'    => json_encode([
                    'css'  => '',
                    'html' => '<nav class="flex items-center gap-7 lg:gap-8" aria-label="Primary Navigation">
    <a href="/botanical-powders" class="text-xs uppercase tracking-[0.14em] font-semibold text-elior-charcoal hover:text-elior-botanical transition-colors">
        Botanical Powders
    </a>
    <a href="/functional-blends" class="text-xs uppercase tracking-[0.14em] font-semibold text-elior-charcoal hover:text-elior-botanical transition-colors">
        Functional Blends
    </a>
    <a href="/recipes" class="text-xs uppercase tracking-[0.14em] font-semibold text-elior-charcoal hover:text-elior-botanical transition-colors">
        Recipes & Rituals
    </a>
    <a href="/page/quality" class="text-xs uppercase tracking-[0.14em] font-semibold text-elior-charcoal hover:text-elior-botanical transition-colors">
        Quality Standard
    </a>
    <a href="/page/about-us" class="text-xs uppercase tracking-[0.14em] font-semibold text-elior-charcoal hover:text-elior-botanical transition-colors">
        About Us
    </a>
</nav>',
                ]),
            ],
            [
                'id'         => 19,
                'theme_code' => 'default',
                'type'       => 'static_content',
                'name'       => 'ELIOR Popular Search Tags',
                'sort_order' => 11,
                'status'     => 1,
                'channel_id' => 1,
                'options'    => json_encode([
                    'css'  => '',
                    'html' => '<div class="mt-3.5 pt-3 border-t border-elior-border/60 flex items-center gap-1.5 flex-wrap text-[11px] text-elior-muted">
    <span class="font-medium mr-1 text-elior-charcoal">Trending Searches:</span>
    <a href="/search?query=Moringa" class="px-2.5 py-1 rounded-full bg-[#F5F2EC] hover:bg-elior-botanical hover:text-white transition-colors">Moringa</a>
    <a href="/search?query=Turmeric" class="px-2.5 py-1 rounded-full bg-[#F5F2EC] hover:bg-elior-botanical hover:text-white transition-colors">Lakadong Turmeric</a>
    <a href="/search?query=Beetroot" class="px-2.5 py-1 rounded-full bg-[#F5F2EC] hover:bg-elior-botanical hover:text-white transition-colors">Beetroot</a>
    <a href="/search?query=Ashwagandha" class="px-2.5 py-1 rounded-full bg-[#F5F2EC] hover:bg-elior-botanical hover:text-white transition-colors">Ashwagandha</a>
    <a href="/search?query=Spirulina" class="px-2.5 py-1 rounded-full bg-[#F5F2EC] hover:bg-elior-botanical hover:text-white transition-colors">Spirulina</a>
    <a href="/search?query=Immunity" class="px-2.5 py-1 rounded-full bg-[#F5F2EC] hover:bg-elior-botanical hover:text-white transition-colors">Immunity Blends</a>
</div>',
                ]),
            ],
            [
                'id'         => 7,
                'theme_code' => 'default',
                'type'       => 'footer_links',
                'name'       => 'Footer Links',
                'sort_order' => 11,
                'status'     => 1,
                'channel_id' => 1,
                'options'    => json_encode([
                    'column_1' => [
                        ['url' => '/botanical-powders', 'title' => 'Botanical Powders', 'sort_order' => 1],
                        ['url' => '/functional-blends', 'title' => 'Functional Blends', 'sort_order' => 2],
                        ['url' => '/culinary-ingredients', 'title' => 'Culinary Ingredients', 'sort_order' => 3],
                        ['url' => '/wellness-essentials', 'title' => 'Wellness Essentials', 'sort_order' => 4],
                        ['url' => '/products', 'title' => 'All Formulations', 'sort_order' => 5],
                    ],
                    'column_2' => [
                        ['url' => '/page/about-us', 'title' => 'Our Story & Philosophy', 'sort_order' => 1],
                        ['url' => '/page/quality', 'title' => 'Quality Standards', 'sort_order' => 2],
                        ['url' => '/recipes', 'title' => 'Daily Rituals & Recipes', 'sort_order' => 3],
                        ['url' => '/contact-us', 'title' => 'Contact Concierge', 'sort_order' => 4],
                        ['url' => '/page/customer-service', 'title' => 'Customer Care & SLAs', 'sort_order' => 5],
                    ],
                    'column_3' => [
                        ['url' => '/page/privacy-policy', 'title' => 'Privacy Policy', 'sort_order' => 1],
                        ['url' => '/page/terms-conditions', 'title' => 'Terms of Sale', 'sort_order' => 2],
                        ['url' => '/page/shipping-policy', 'title' => 'Shipping & Delivery', 'sort_order' => 3],
                        ['url' => '/page/return-policy', 'title' => 'Return & Replacement', 'sort_order' => 4],
                        ['url' => '/sitemap.xml', 'title' => 'XML Sitemap', 'sort_order' => 5],
                    ],
                    'social_links' => [
                        'twitter'   => 'https://twitter.com/elior_botanicals',
                        'youtube'   => 'https://youtube.com/@eliorbotanicals',
                        'facebook'  => 'https://facebook.com/eliorbotanicals',
                        'linkedin'  => 'https://linkedin.com/company/elior-nutrition',
                        'instagram' => 'https://instagram.com/elior.botanicals',
                    ],
                ]),
            ],
            [
                'id'         => 8,
                'theme_code' => 'default',
                'type'       => 'services_content',
                'name'       => 'Services Content',
                'sort_order' => 12,
                'status'     => 1,
                'channel_id' => 1,
                'options'    => json_encode([
                    'services' => [
                        [
                            'title'        => '100% Plant-Based Purity',
                            'description'  => 'Single-origin botanicals with zero synthetic fillers or flow agents',
                            'service_icon' => 'eco',
                        ],
                        [
                            'title'        => 'Cold-Dehydrated Freshness',
                            'description'  => 'Precision dehydrated under 42°C to preserve active phytonutrients',
                            'service_icon' => 'device_thermostat',
                        ],
                        [
                            'title'        => 'Free India Shipping',
                            'description'  => 'Fast 24–48hr dispatch and complimentary delivery on orders > ₹499',
                            'service_icon' => 'local_shipping',
                        ],
                        [
                            'title'        => 'Triple-Layer Packaging',
                            'description'  => 'Nitrogen-flushed UV & moisture barrier protection in every jar',
                            'service_icon' => 'shield',
                        ],
                    ],
                ]),
            ],
        ];

        foreach ($customizations as $item) {
            $options = $item['options'];
            unset($item['options']);

            DB::table('theme_customizations')->updateOrInsert(
                ['id' => $item['id']],
                array_merge($item, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ])
            );

            DB::table('theme_customization_translations')->updateOrInsert(
                [
                    'theme_customization_id' => $item['id'],
                    'locale'                 => 'en',
                ],
                [
                    'options' => $options,
                ]
            );
        }

        $this->command->info('ELIOR Theme Customizations seeded successfully.');
    }
}
