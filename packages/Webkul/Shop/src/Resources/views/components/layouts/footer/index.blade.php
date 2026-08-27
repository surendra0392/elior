{!! view_render_event('bagisto.shop.layout.footer.before') !!}

@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

@php
    $channel = core()->getCurrentChannel();
    $logoConfig = core()->getConfigData('general.design.admin_logo.logo_image');
    $logoUrl = $channel->logo_url ?: ($logoConfig ? \Illuminate\Support\Facades\Storage::url($logoConfig) : null);

    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'footer_links',
        'status'     => 1,
        'theme_code' => $channel->theme,
        'channel_id' => $channel->id,
    ]);

    $socialLinks = $customization->options['social_links'] ?? [
        'instagram' => 'https://instagram.com/elior.botanicals',
        'youtube'   => 'https://youtube.com/@eliorbotanicals',
        'linkedin'  => 'https://linkedin.com/company/elior-nutrition',
        'twitter'   => 'https://twitter.com/elior_botanicals',
        'facebook'  => 'https://facebook.com/eliorbotanicals',
    ];

    $copyrightContent = core()->getConfigData('general.content.footer.copyright_content') ?: '&copy; ' . date('Y') . ' ELIOR. Pure Botanical Nutrition. All rights reserved.';
@endphp

<footer 
    class="w-full overflow-hidden" 
    style="background-color: #163923 !important; color: #f4f0e6 !important; border-top: 1px solid rgba(201, 162, 90, 0.2) !important; font-family: 'Poppins', sans-serif !important;"
>
    <!-- Main Footer Content -->
    <div class="site-container w-full" style="padding-top: 3.75rem; padding-bottom: 3.75rem;">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-12 gap-8 lg:gap-6 xl:gap-8 items-start w-full">
            
            <!-- Brand Column (4 Cols on LG) -->
            <div class="sm:col-span-2 md:col-span-3 lg:col-span-4 lg:pr-4" style="display: flex; flex-direction: column; gap: 1.25rem;">
                <a href="{{ route('shop.home.index') }}" class="inline-block group" style="text-decoration: none;">
                    @if ($logoUrl)
                        <img
                            src="{{ $logoUrl }}"
                            alt="{{ config('app.name', 'ELIOR') }}"
                            class="h-9 w-auto object-contain max-w-[170px] brightness-0 invert opacity-95 transition-opacity group-hover:opacity-100"
                        />
                    @else
                        <span style="font-family: 'Poppins', sans-serif; font-size: 1.75rem; font-weight: 800; color: #ffffff; letter-spacing: -0.02em;">
                            ELIOR
                        </span>
                        <span style="display: block; font-size: 0.5625rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a25a; font-weight: 700; margin-top: 0.2rem;">
                            Botanical Nutrition
                        </span>
                    @endif
                </a>

                <p style="font-size: 0.8125rem; line-height: 1.6; color: rgba(244, 240, 230, 0.75); max-width: 340px; margin: 0;">
                    Pure botanical nutrition and clean-label functional food powders. Low-temperature processed from whole plant harvests with zero synthetic carriers, chemical fillers, or artificial preservatives.
                </p>

                <!-- Clean Label Standard Badges -->
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; padding-top: 0.25rem;">
                    <span style="background: #205132; color: #f4f0e6; border: 1px solid rgba(201, 162, 90, 0.25); padding: 0.3rem 0.75rem; border-radius: 9999px; font-size: 0.6875rem; font-weight: 600; letter-spacing: 0.02em;">
                        100% Whole Food
                    </span>
                    <span style="background: #205132; color: #f4f0e6; border: 1px solid rgba(201, 162, 90, 0.25); padding: 0.3rem 0.75rem; border-radius: 9999px; font-size: 0.6875rem; font-weight: 600; letter-spacing: 0.02em;">
                        Cold-Dehydrated &lt; 42°C
                    </span>
                    <span style="background: #205132; color: #f4f0e6; border: 1px solid rgba(201, 162, 90, 0.25); padding: 0.3rem 0.75rem; border-radius: 9999px; font-size: 0.6875rem; font-weight: 600; letter-spacing: 0.02em;">
                        Zero Synthetics
                    </span>
                </div>
            </div>

            <!-- Column 1: Collections (2 Cols on LG) -->
            <div class="lg:col-span-2" style="display: flex; flex-direction: column;">
                <h3 style="color: #c9a25a; font-family: 'Poppins', sans-serif; font-size: 0.875rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 1rem; padding-bottom: 0.35rem; border-bottom: 1px solid rgba(201, 162, 90, 0.2); display: inline-block;">
                    Collections
                </h3>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.65rem;">
                    @if ($customization && isset($customization->options['column_1']))
                        @foreach ($customization->options['column_1'] as $link)
                            <li>
                                <a href="{{ $link['url'] }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">
                                    {{ $link['title'] }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="{{ route('shop.search.index', ['category_id' => 50]) }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Botanical Powders</a></li>
                        <li><a href="{{ route('shop.search.index', ['category_id' => 51]) }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Functional Blends</a></li>
                        <li><a href="{{ route('shop.search.index', ['category_id' => 52]) }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Culinary Ingredients</a></li>
                        <li><a href="{{ route('shop.search.index', ['category_id' => 53]) }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Wellness Essentials</a></li>
                        <li><a href="{{ route('shop.product_or_category.index', 'products') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: #c9a25a; font-size: 0.8125rem; font-weight: 600; text-decoration: none;">All Formulations &rarr;</a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 2: Brand Story & Philosophy (2 Cols on LG) -->
            <div class="lg:col-span-2" style="display: flex; flex-direction: column;">
                <h3 style="color: #c9a25a; font-family: 'Poppins', sans-serif; font-size: 0.875rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 1rem; padding-bottom: 0.35rem; border-bottom: 1px solid rgba(201, 162, 90, 0.2); display: inline-block;">
                    Philosophy
                </h3>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.65rem;">
                    @if ($customization && isset($customization->options['column_2']))
                        @foreach ($customization->options['column_2'] as $link)
                            <li>
                                <a href="{{ $link['url'] }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">
                                    {{ $link['title'] }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="{{ route('shop.cms.page', 'about-us') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Our Story &amp; Philosophy</a></li>
                        <li><a href="{{ route('shop.cms.page', 'quality') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Quality Standards</a></li>
                        <li><a href="{{ route('shop.recipes.index') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Daily Rituals &amp; Recipes</a></li>
                        <li><a href="{{ route('shop.home.contact_us') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Contact Concierge</a></li>
                        <li><a href="{{ route('shop.cms.page', 'customer-service') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Customer Care &amp; SLAs</a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 3: Policies (2 Cols on LG) -->
            <div class="lg:col-span-2" style="display: flex; flex-direction: column;">
                <h3 style="color: #c9a25a; font-family: 'Poppins', sans-serif; font-size: 0.875rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 1rem; padding-bottom: 0.35rem; border-bottom: 1px solid rgba(201, 162, 90, 0.2); display: inline-block;">
                    Policies
                </h3>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.65rem;">
                    @if ($customization && isset($customization->options['column_3']))
                        @foreach ($customization->options['column_3'] as $link)
                            <li>
                                <a href="{{ $link['url'] }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">
                                    {{ $link['title'] }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="{{ route('shop.cms.page', 'privacy-policy') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Privacy Policy</a></li>
                        <li><a href="{{ route('shop.cms.page', 'terms-conditions') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Terms of Sale</a></li>
                        <li><a href="{{ route('shop.cms.page', 'shipping-policy') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">Shipping &amp; Delivery</a></li>
                        @if (core()->getConfigData('general.sitemap.settings.enabled') ?? true)
                            <li><a href="{{ route('shop.sitemap.index') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block" style="color: rgba(244, 240, 230, 0.8); font-size: 0.8125rem; text-decoration: none;">XML Sitemap</a></li>
                        @endif
                    @endif
                </ul>
            </div>

            <!-- Column 4: The Ritual / Social (2 Cols on LG) -->
            <div class="lg:col-span-2" style="display: flex; flex-direction: column; gap: 0.75rem;">
                @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                    {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.before') !!}

                    <h3 style="color: #c9a25a; font-family: 'Poppins', sans-serif; font-size: 0.875rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 0.25rem; padding-bottom: 0.35rem; border-bottom: 1px solid rgba(201, 162, 90, 0.2); display: inline-block;">
                        The Ritual
                    </h3>

                    <p style="font-size: 0.75rem; line-height: 1.5; color: rgba(244, 240, 230, 0.75); margin: 0;">
                        Subscribe for botanical recipes and seasonal harvest releases.
                    </p>

                    <form
                        action="{{ route('shop.subscription.store') }}"
                        method="POST"
                        style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.25rem;"
                    >
                        @csrf
                        <input
                            type="email"
                            name="email"
                            required
                            placeholder="Enter your email"
                            style="background: #205132; border: 1px solid rgba(201, 162, 90, 0.3); color: #ffffff; border-radius: 9999px; height: 38px; padding: 0 1rem; font-size: 0.75rem; width: 100%; box-sizing: border-box; outline: none;"
                        />
                        <button
                            type="submit"
                            style="background: linear-gradient(135deg, #c9a25a 0%, #b08a43 100%); color: #ffffff; border-radius: 9999px; height: 38px; width: 100%; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 14px rgba(201, 162, 90, 0.35); transition: all 0.2s ease;"
                        >
                            Subscribe
                        </button>
                    </form>

                    {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.after') !!}
                @endif

                <!-- Social Channels -->
                <div style="padding-top: 0.25rem;">
                    <h3 style="color: #c9a25a; font-family: 'Poppins', sans-serif; font-size: 0.875rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 0.5rem; padding-bottom: 0.35rem; border-bottom: 1px solid rgba(201, 162, 90, 0.2); display: inline-block;">
                        Connect
                    </h3>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        @if (!empty($socialLinks['instagram']))
                            <a
                                href="{{ $socialLinks['instagram'] }}"
                                target="_blank"
                                rel="noopener"
                                aria-label="Follow ELIOR on Instagram"
                                style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 9999px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(201, 162, 90, 0.25); color: #f4f0e6; text-decoration: none;"
                            >
                                <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        @endif

                        @if (!empty($socialLinks['youtube']))
                            <a
                                href="{{ $socialLinks['youtube'] }}"
                                target="_blank"
                                rel="noopener"
                                aria-label="Subscribe to ELIOR on YouTube"
                                style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 9999px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(201, 162, 90, 0.25); color: #f4f0e6; text-decoration: none;"
                            >
                                <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        @endif

                        @if (!empty($socialLinks['linkedin']))
                            <a
                                href="{{ $socialLinks['linkedin'] }}"
                                target="_blank"
                                rel="noopener"
                                aria-label="Connect with ELIOR on LinkedIn"
                                style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 9999px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(201, 162, 90, 0.25); color: #f4f0e6; text-decoration: none;"
                            >
                                <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        @endif

                        @if (!empty($socialLinks['twitter']))
                            <a
                                href="{{ $socialLinks['twitter'] }}"
                                target="_blank"
                                rel="noopener"
                                aria-label="Follow ELIOR on X (Twitter)"
                                style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 9999px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(201, 162, 90, 0.25); color: #f4f0e6; text-decoration: none;"
                            >
                                <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.after') !!}
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div style="background-color: #112b1b !important; border-top: 1px solid rgba(201, 162, 90, 0.15) !important; padding: 1.25rem 0 !important;">
        <div class="site-container flex flex-col md:flex-row items-center justify-between gap-4 text-xs" style="color: rgba(244, 240, 230, 0.65) !important;">
            {!! view_render_event('bagisto.shop.layout.footer.footer_text.before') !!}

            <p class="text-center md:text-left text-xs m-0">
                {!! $copyrightContent !!}
            </p>

            <div class="flex items-center gap-4 text-[11px]" style="color: rgba(244, 240, 230, 0.6) !important;">
                <a href="{{ route('shop.cms.page', 'privacy-policy') }}" class="hover:text-[#c9a25a] transition-colors" style="color: inherit; text-decoration: none;">Privacy</a>
                <span>&bull;</span>
                <a href="{{ route('shop.cms.page', 'terms-conditions') }}" class="hover:text-[#c9a25a] transition-colors" style="color: inherit; text-decoration: none;">Terms</a>
                <span>&bull;</span>
                <a href="{{ route('shop.cms.page', 'shipping-policy') }}" class="hover:text-[#c9a25a] transition-colors" style="color: inherit; text-decoration: none;">Shipping</a>
                @if (core()->getConfigData('general.sitemap.settings.enabled') ?? true)
                    <span>&bull;</span>
                    <a href="{{ route('shop.sitemap.index') }}" class="hover:text-[#c9a25a] transition-colors" style="color: inherit; text-decoration: none;">Sitemap</a>
                @endif
            </div>

            {!! view_render_event('bagisto.shop.layout.footer.footer_text.after') !!}
        </div>
    </div>
</footer>

{!! view_render_event('bagisto.shop.layout.footer.after') !!}
