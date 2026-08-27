<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EliorConfigSeeder extends Seeder
{
    /**
     * Seed ELIOR store core configuration, Indian Rupee (INR / ₹), Telangana defaults,
     * carrier settings, weight unit, and ELIOR branding assets.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->info('=== ELIOR Core Configuration & Branding Seeder ===');

        $now = Carbon::now();

        // 1. Ensure INR is configured as the primary currency
        DB::table('currencies')->updateOrInsert(
            ['code' => 'INR'],
            [
                'name'              => 'Indian Rupee',
                'symbol'            => '₹',
                'decimal'           => 2,
                'group_separator'   => ',',
                'decimal_separator' => '.',
                'currency_position' => 'left',
                'created_at'        => $now,
                'updated_at'        => $now,
            ]
        );

        $inrCurrency = DB::table('currencies')->where('code', 'INR')->first();
        $inrCurrencyId = $inrCurrency ? $inrCurrency->id : 1;

        // 2. Prepare Branding Asset directories in storage
        $publicAdminDir = storage_path('app/public/admin');
        if (! file_exists($publicAdminDir)) {
            mkdir($publicAdminDir, 0777, true);
        }
        $publicChannelDir = storage_path('app/public/channel/1');
        if (! file_exists($publicChannelDir)) {
            mkdir($publicChannelDir, 0777, true);
        }

        // Copy Official Elior Branding Assets from repository to storage
        $brandRepoDir = base_path('packages/Webkul/Installer/src/Resources/assets/images/seeders/brand');
        $logoSrc = $brandRepoDir . '/elior_logo_horizontal.png';
        $iconSrc = $brandRepoDir . '/elior_botanical_icon.png';
        $badgeSrc = $brandRepoDir . '/elior_app_badge.png';

        if (file_exists($logoSrc)) {
            copy($logoSrc, $publicAdminDir . '/logo.png');
            copy($logoSrc, $publicChannelDir . '/logo.png');
        }
        if (file_exists($iconSrc)) {
            copy($iconSrc, $publicAdminDir . '/favicon.png');
            copy($iconSrc, $publicChannelDir . '/favicon.png');
        }
        if (file_exists($badgeSrc)) {
            copy($badgeSrc, $publicChannelDir . '/app_badge.png');
        }

        // Also ensure public storage symlink directories exist
        $pubChannel1 = public_path('storage/channel/1');
        $pubAdmin = public_path('storage/admin');
        if (! file_exists($pubChannel1)) {
            mkdir($pubChannel1, 0777, true);
        }
        if (! file_exists($pubAdmin)) {
            mkdir($pubAdmin, 0777, true);
        }
        if (file_exists($logoSrc)) {
            copy($logoSrc, $pubAdmin . '/logo.png');
            copy($logoSrc, $pubChannel1 . '/logo.png');
        }
        if (file_exists($iconSrc)) {
            copy($iconSrc, $pubAdmin . '/favicon.png');
            copy($iconSrc, $pubChannel1 . '/favicon.png');
        }

        // 3. Set Channel 1 base currency, hostname, logo, and favicon
        DB::table('channels')->where('id', 1)->update([
            'theme'            => 'default',
            'hostname'         => config('app.url') ? parse_url(config('app.url'), PHP_URL_HOST) : null,
            'base_currency_id' => $inrCurrencyId,
            'logo'             => 'channel/1/logo.png',
            'favicon'          => 'channel/1/favicon.png',
        ]);

        DB::table('channel_currencies')->updateOrInsert(
            [
                'channel_id'  => 1,
                'currency_id' => $inrCurrencyId,
            ]
        );

        // Remove non-INR currencies from default channel
        DB::table('channel_currencies')
            ->where('channel_id', 1)
            ->where('currency_id', '!=', $inrCurrencyId)
            ->delete();

        // 4. Define Core Config Key-Value Pairs with exact channel & locale scoping
        $configs = [
            // Admin Logo & Favicon
            [
                'code'         => 'general.design.admin_logo.logo_image',
                'value'        => 'admin/logo.png',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'general.design.admin_logo.favicon',
                'value'        => 'admin/favicon.png',
                'channel_code' => null,
                'locale_code'  => null,
            ],

            // Top Header Announcement & Offer Configuration (Rupee ₹499)
            [
                'code'         => 'general.content.header_offer.title',
                'value'        => 'FREE SHIPPING ON ORDERS OVER ₹499 • 100% PURE BOTANICAL POWDERS • ZERO SYNTHETIC ADDITIVES',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'general.content.header_offer.redirection_title',
                'value'        => 'SHOP NOW',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'general.content.header_offer.redirection_link',
                'value'        => '/products',
                'channel_code' => null,
                'locale_code'  => null,
            ],

            // Footer Copyright (Locale-based: en)
            [
                'code'         => 'general.content.footer.copyright_content',
                'value'        => 'Copyright &copy; '.date('Y').' ELIOR Botanical Nutrition — All rights reserved.',
                'channel_code' => null,
                'locale_code'  => 'en',
            ],

            // Email & Customer Care Settings (Channel-based: default)
            [
                'code'         => 'emails.configure.email_settings.sender_name',
                'value'        => 'ELIOR Botanical Nutrition',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'emails.configure.email_settings.sender_email',
                'value'        => 'care@elior.in',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'emails.configure.email_settings.admin_name',
                'value'        => 'ELIOR Care Team',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'emails.configure.email_settings.admin_email',
                'value'        => 'care@elior.in',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'emails.configure.email_settings.contact_name',
                'value'        => 'ELIOR Customer Care',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'emails.configure.email_settings.contact_email',
                'value'        => 'care@elior.in',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],

            // Shipping Origin (Hyderabad, Telangana, India)
            [
                'code'         => 'sales.shipping.origin.address',
                'value'        => 'Plot 42, Road No. 36, Jubilee Hills',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],
            [
                'code'         => 'sales.shipping.origin.address1',
                'value'        => 'Plot 42, Road No. 36, Jubilee Hills',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.shipping.origin.city',
                'value'        => 'Hyderabad',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],
            [
                'code'         => 'sales.shipping.origin.city',
                'value'        => 'Hyderabad',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.shipping.origin.state',
                'value'        => 'Telangana',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],
            [
                'code'         => 'sales.shipping.origin.state',
                'value'        => 'Telangana',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.shipping.origin.zipcode',
                'value'        => '500033',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],
            [
                'code'         => 'sales.shipping.origin.zipcode',
                'value'        => '500033',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.shipping.origin.country',
                'value'        => 'IN',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],
            [
                'code'         => 'sales.shipping.origin.country',
                'value'        => 'IN',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.shipping.origin.store_name',
                'value'        => 'ELIOR Botanical Research & Fulfillment Hub',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],

            // Taxes Default Destination (Telangana, India)
            [
                'code'         => 'sales.taxes.default_destination_calculation.country',
                'value'        => 'IN',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.taxes.default_destination_calculation.state',
                'value'        => 'TG',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.taxes.default_destination_calculation.post_code',
                'value'        => '500033',
                'channel_code' => null,
                'locale_code'  => null,
            ],

            // Minimum Order Settings
            [
                'code'         => 'sales.order_settings.minimum_order.enable',
                'value'        => '1',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.order_settings.minimum_order.minimum_order_amount',
                'value'        => '499',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.order_settings.minimum_order.description',
                'value'        => 'Complimentary express shipping applies on all orders above ₹499.',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],

            // Shipping Carriers: Flat Rate (channel: default, locale: en)
            [
                'code'         => 'sales.carriers.flatrate.active',
                'value'        => '1',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.carriers.flatrate.title',
                'value'        => 'Standard Botanical Transit',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],
            [
                'code'         => 'sales.carriers.flatrate.description',
                'value'        => 'Reliable carbon-neutral ground shipping across India.',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],
            [
                'code'         => 'sales.carriers.flatrate.default_rate',
                'value'        => '50',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.carriers.flatrate.type',
                'value'        => 'per_order',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],

            // Shipping Carriers: Free Shipping (channel: default, locale: en)
            [
                'code'         => 'sales.carriers.free.active',
                'value'        => '1',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'sales.carriers.free.title',
                'value'        => 'Complimentary Express Delivery (Orders > ₹499)',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],
            [
                'code'         => 'sales.carriers.free.description',
                'value'        => 'Free priority dispatch for all orders of ₹499 and above.',
                'channel_code' => 'default',
                'locale_code'  => 'en',
            ],

            // Units & Catalog Options (Weight Unit: grams)
            [
                'code'         => 'general.general.locale_options.weight_unit',
                'value'        => 'grams',
                'channel_code' => 'default',
                'locale_code'  => null,
            ],
            [
                'code'         => 'catalog.products.settings.compare_option',
                'value'        => '1',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'customer.settings.wishlist.wishlist_option',
                'value'        => '1',
                'channel_code' => null,
                'locale_code'  => null,
            ],
            [
                'code'         => 'general.general.breadcrumbs.shop',
                'value'        => '1',
                'channel_code' => null,
                'locale_code'  => null,
            ],
        ];

        foreach ($configs as $config) {
            DB::table('core_config')->updateOrInsert(
                [
                    'code'         => $config['code'],
                    'channel_code' => $config['channel_code'],
                    'locale_code'  => $config['locale_code'],
                ],
                [
                    'value'      => $config['value'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        // 5. Update Channel Details and Home SEO
        DB::table('channel_translations')->where('channel_id', 1)->where('locale', 'en')->update([
            'name'     => 'ELIOR',
            'home_seo' => json_encode([
                'meta_title'       => 'ELIOR — Pure Plant-Based Botanical Nutrition & Functional Blends',
                'meta_keywords'    => 'botanical powders, cold-dehydrated nutrition, moringa powder, beetroot powder, turmeric powder, green superblend, plant nutrition, organic herbs',
                'meta_description' => 'Discover ELIOR: Concentrated whole plant food powders and adaptogenic superblends cold-dehydrated below 42°C for effortless daily nutrition rituals.',
            ]),
        ]);

        $this->command->info('ELIOR Core Configuration & Channel SEO seeded successfully.');
    }
}
