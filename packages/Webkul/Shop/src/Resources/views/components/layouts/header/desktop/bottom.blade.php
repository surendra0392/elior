{!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.before') !!}

@php
    $channel = core()->getCurrentChannel();
    $logoConfig = core()->getConfigData('general.design.admin_logo.logo_image');
    $logoUrl = $channel->logo_url ?: ($logoConfig ? \Illuminate\Support\Facades\Storage::url($logoConfig) : null);
@endphp

<div class="site-container flex min-h-[92px] items-center justify-between">
    <!-- Left: Brand Logo -->
    <div class="flex items-center">
        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.before') !!}

        <a
            href="{{ route('shop.home.index') }}"
            class="flex items-center py-2 group"
            aria-label="ELIOR - Botanical Nutrition"
        >
            @if ($logoUrl)
                <img
                    src="{{ $logoUrl }}"
                    alt="{{ config('app.name', 'ELIOR') }}"
                    class="h-10 md:h-12 w-auto object-contain max-w-[200px] transition-transform duration-300 group-hover:scale-[1.02]"
                />
            @else
                <div class="flex flex-col">
                    <span class="font-serif text-3xl lg:text-4xl font-bold tracking-tight text-elior-charcoal group-hover:text-elior-botanical transition-colors">
                        ELIOR
                    </span>
                    <span class="text-[9px] tracking-[0.32em] uppercase text-elior-muted -mt-0.5 font-sans font-semibold">
                        Botanical Nutrition
                    </span>
                </div>
            @endif
        </a>

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.after') !!}
    </div>

    <!-- Center: Primary Navigation (6 Core ELIOR Architecture Items) -->
    <div class="hidden lg:flex items-center gap-x-8">
        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.before') !!}

        <nav class="flex items-center gap-7 lg:gap-8" aria-label="Primary Navigation">
            @php
                $categoryView = core()->getConfigData('general.design.categories.category_view');
            @endphp

            @if ($categoryView === 'custom')
                @php
                    $customMenuItems = json_decode(core()->getConfigData('general.design.categories.custom_menu_items') ?: '[]', true);
                    
                    $catIds = collect($customMenuItems)->where('type', 'category')->pluck('id')->toArray();
                    $cmsIds = collect($customMenuItems)->where('type', 'cms')->pluck('id')->toArray();
                    
                    $categories = empty($catIds) ? collect() : app(\Webkul\Category\Repositories\CategoryRepository::class)->findWhereIn('id', $catIds)->keyBy('id');
                    $cmsPages = empty($cmsIds) ? collect() : app(\Webkul\CMS\Repositories\PageRepository::class)->query()
                        ->select('cms_pages.*', 'cms_page_translations.url_key')
                        ->join('cms_page_translations', 'cms_pages.id', '=', 'cms_page_translations.cms_page_id')
                        ->whereIn('cms_page_translations.url_key', $cmsIds)
                        ->where('cms_page_translations.locale', core()->getRequestedLocaleCode())
                        ->get()
                        ->keyBy('url_key');
                @endphp

                @foreach ($customMenuItems as $item)
                    @if ($item['type'] === 'cms' && isset($cmsPages[$item['id']]))
                        @php $pageTranslation = $cmsPages[$item['id']]->translate(core()->getRequestedLocaleCode()); @endphp
                        @if ($pageTranslation)
                            <a href="{{ route('shop.cms.page', $pageTranslation->url_key) }}" class="text-xs uppercase tracking-[0.14em] font-semibold {{ request()->is('page/'.$pageTranslation->url_key.'*') || request()->is($pageTranslation->url_key.'*') ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} transition-colors">
                                {{ $item['title'] ?? $pageTranslation->page_title }}
                            </a>
                        @endif
                    @elseif ($item['type'] === 'category' && isset($categories[$item['id']]))
                        @php $categoryTranslation = $categories[$item['id']]->translate(core()->getRequestedLocaleCode()); @endphp
                        @if ($categoryTranslation)
                            @php $categoryUrl = $categoryTranslation->url_path ?: $categoryTranslation->slug; @endphp
                            <a href="{{ $categoryUrl ? route('shop.product_or_category.index', $categoryUrl) : '#' }}" class="text-xs uppercase tracking-[0.14em] font-semibold {{ request()->is($categoryUrl.'*') ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} transition-colors">
                                {!! $item['title'] ?? $categoryTranslation->name !!}
                            </a>
                        @endif
                    @elseif ($item['type'] === 'custom')
                        <a href="{{ $item['url'] }}" class="text-xs uppercase tracking-[0.14em] font-semibold {{ request()->fullUrlIs($item['url'].'*') ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} transition-colors">
                            {{ $item['title'] }}
                        </a>
                    @endif
                @endforeach
            @else
                @php
                    $themeCustomizations = app(\Webkul\Theme\Repositories\ThemeCustomizationRepository::class)->get();
                    $headerNav = $themeCustomizations->where('name', 'ELIOR Header Navigation')->first();
                @endphp
                @if ($headerNav && isset($headerNav->options['html']))
                    <!-- Rendered Nav -->
                    {!! str_replace(
                        [
                            'href="/?_route=shop.home.index" class="elior-nav-link"',
                            'href="/page/about-us" class="elior-nav-link"',
                            'href="/page/quality" class="elior-nav-link"',
                            'href="/products" class="elior-nav-link"',
                            'href="/page/recipes" class="elior-nav-link"',
                            'href="/recipes" class="elior-nav-link"',
                            'href="/contact-us" class="elior-nav-link"'
                        ],
                        [
                            'href="/" class="elior-nav-link ' . ((request()->routeIs('shop.home.index') && request()->is('/')) ? 'elior-nav-link-active' : '') . '"',
                            'href="/page/about-us" class="elior-nav-link ' . (request()->is('page/about-us*') ? 'elior-nav-link-active' : '') . '"',
                            'href="/page/quality" class="elior-nav-link ' . (request()->is('page/quality*') ? 'elior-nav-link-active' : '') . '"',
                            'href="/products" class="elior-nav-link ' . ((request()->is('products*') || request()->routeIs('shop.product_or_category.index')) ? 'elior-nav-link-active' : '') . '"',
                            'href="/recipes" class="elior-nav-link ' . (request()->is('recipes*') ? 'elior-nav-link-active' : '') . '"',
                            'href="/recipes" class="elior-nav-link ' . (request()->is('recipes*') ? 'elior-nav-link-active' : '') . '"',
                            'href="/contact-us" class="elior-nav-link ' . ((request()->routeIs('shop.home.contact_us*') || request()->is('contact-us*')) ? 'elior-nav-link-active' : '') . '"'
                        ],
                        $headerNav->options['html']
                    ) !!}
                @endif
            @endif
        </nav>

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.after') !!}
    </div>

    <!-- Right Utility Icons & Search Popover -->
    <div class="flex items-center gap-x-3 lg:gap-x-4 text-elior-charcoal">
        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.search_bar.before') !!}

        <!-- Search Icon Dropdown Popover -->
        <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}" :close-on-click="false">
            <x-slot:toggle>
                <button
                    type="button"
                    class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-full text-[#163923] hover:bg-black/5 hover:text-[#205132] transition-colors focus:outline-none"
                    aria-label="@lang('shop::app.components.layouts.header.desktop.bottom.search')"
                >
                    <span class="icon-search text-2xl" role="presentation"></span>
                </button>
            </x-slot>

            <x-slot:content class="w-[340px] sm:w-[420px] p-5 bg-white rounded-2xl border border-elior-border shadow-2xl">
                <form
                    action="{{ route('shop.search.index') }}"
                    class="relative flex items-center"
                    role="search"
                    toolname="search_products"
                    tooldescription="{{ trans('shop::app.components.layouts.webmcp.search-products') }}"
                    toolautosubmit
                >
                    <label for="header-search-input" class="sr-only">
                        @lang('shop::app.components.layouts.header.desktop.bottom.search')
                    </label>

                    <div class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 flex items-center text-elior-muted">
                        <span class="icon-search text-base"></span>
                    </div>

                    <input
                        id="header-search-input"
                        type="text"
                        name="query"
                        value="{{ request('query') }}"
                        toolparamdescription="{{ trans('shop::app.components.layouts.webmcp.search-products-query') }}"
                        class="w-full h-11 pl-10 pr-11 text-xs text-elior-charcoal placeholder:text-elior-muted/70 bg-[#FAF8F5] border border-elior-border rounded-xl focus:bg-white focus:border-elior-botanical focus:ring-1 focus:ring-elior-botanical transition-all outline-none"
                        minlength="{{ core()->getConfigData('catalog.products.search.min_query_length') }}"
                        maxlength="{{ core()->getConfigData('catalog.products.search.max_query_length') }}"
                        placeholder="Search botanical powders, ingredients..."
                        aria-label="@lang('shop::app.components.layouts.header.desktop.bottom.search-text')"
                        aria-required="true"
                        pattern="[^\\]+"
                        autocomplete="off"
                        required
                    >

                    <button
                        type="submit"
                        class="hidden"
                        aria-label="@lang('shop::app.components.layouts.header.desktop.bottom.submit')"
                    >
                    </button>

                    @if (core()->getConfigData('catalog.products.settings.image_search'))
                        @include('shop::search.images.index')
                    @endif
                </form>

                <!-- Quick / Popular Tags -->
                @php
                    $themeCustomizations = app(\Webkul\Theme\Repositories\ThemeCustomizationRepository::class)->get();
                    $popularTags = $themeCustomizations->where('name', 'ELIOR Popular Search Tags')->first();
                @endphp
                @if ($popularTags && isset($popularTags->options['html']))
                    {!! $popularTags->options['html'] !!}
                @endif
            </x-slot>
        </x-shop::dropdown>

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.search_bar.after') !!}

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.before') !!}

        @if(core()->getConfigData('catalog.products.settings.compare_option'))
            <a
                href="{{ route('shop.compare.index') }}"
                aria-label="@lang('shop::app.components.layouts.header.desktop.bottom.compare')"
                class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-full text-[#163923] hover:bg-black/5 hover:text-[#205132] transition-colors focus:outline-none"
            >
                <span class="icon-compare text-2xl" role="presentation"></span>
            </a>
        @endif

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.after') !!}

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.before') !!}

        @if(core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
            @include('shop::checkout.cart.mini-cart')
        @endif

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.after') !!}

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile.before') !!}

        <!-- User profile dropdown -->
        <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
            <x-slot:toggle>
                <button
                    type="button"
                    class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-full text-[#163923] hover:bg-black/5 hover:text-[#205132] transition-colors focus:outline-none"
                    aria-label="@lang('shop::app.components.layouts.header.desktop.bottom.profile')"
                >
                    <span class="icon-users text-2xl" role="presentation"></span>
                </button>
            </x-slot>

            <x-slot:content class="p-4 rounded-elior bg-white border border-elior-border shadow-elior-card">
                <!-- Guest Dropdown -->
                @guest('customer')
                    <div class="grid gap-2">
                        <p class="text-base font-serif font-semibold text-elior-charcoal">
                            @lang('shop::app.components.layouts.header.desktop.bottom.welcome-guest')
                        </p>

                        <p class="text-xs text-elior-muted">
                            @lang('shop::app.components.layouts.header.desktop.bottom.dropdown-text')
                        </p>
                    </div>

                    <div class="my-3 border-t border-elior-border"></div>

                    {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.customers_action.before') !!}

                    <div class="flex gap-2">
                        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.sign_in_button.before') !!}

                        <a
                            href="{{ route('shop.customer.session.create') }}"
                            class="elior-btn-primary !px-4 !py-2 text-[11px]"
                        >
                            @lang('shop::app.components.layouts.header.desktop.bottom.sign-in')
                        </a>

                        <a
                            href="{{ route('shop.customers.register.index') }}"
                            class="elior-btn-outline !px-4 !py-2 text-[11px]"
                        >
                            @lang('shop::app.components.layouts.header.desktop.bottom.sign-up')
                        </a>

                        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.sign_up_button.after') !!}
                    </div>

                    @if (core()->getConfigData('sales.eu_withdrawal.general.enabled', core()->getCurrentChannelCode()))
                        <a
                            href="{{ route('shop.eu-withdrawal.guest.lookup') }}"
                            class="mt-4 inline-flex items-center gap-1.5 text-xs font-medium text-navyBlue hover:underline"
                        >
                            @lang('shop::app.eu_withdrawal.guest_dropdown.link')
                        </a>
                    @endif

                    {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.customers_action.after') !!}
                @endguest

                <!-- Customers Dropdown -->
                @auth('customer')
                    <div class="grid gap-2.5 p-1 pb-0">
                        <p class="text-lg font-serif font-bold text-elior-charcoal" v-pre>
                            @lang('shop::app.components.layouts.header.desktop.bottom.welcome')’
                            {{ auth()->guard('customer')->user()->first_name }}
                        </p>

                        <p class="text-xs text-elior-muted">
                            @lang('shop::app.components.layouts.header.desktop.bottom.dropdown-text')
                        </p>
                    </div>

                    <div class="my-3 border-t border-elior-border"></div>

                    <div class="grid gap-1 pb-1">
                        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile_dropdown.links.before') !!}

                        <a
                            class="px-3 py-1.5 text-xs font-medium text-elior-charcoal hover:text-elior-botanical hover:bg-black/5 rounded-md transition-colors"
                            href="{{ route('shop.customers.account.profile.index') }}"
                        >
                            @lang('shop::app.components.layouts.header.desktop.bottom.profile')
                        </a>

                        <a
                            class="px-3 py-1.5 text-xs font-medium text-elior-charcoal hover:text-elior-botanical hover:bg-black/5 rounded-md transition-colors"
                            href="{{ route('shop.customers.account.orders.index') }}"
                        >
                            @lang('shop::app.components.layouts.header.desktop.bottom.orders')
                        </a>

                        @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                            <a
                                class="px-3 py-1.5 text-xs font-medium text-elior-charcoal hover:text-elior-botanical hover:bg-black/5 rounded-md transition-colors"
                                href="{{ route('shop.customers.account.wishlist.index') }}"
                            >
                                @lang('shop::app.components.layouts.header.desktop.bottom.wishlist')
                            </a>
                        @endif

                        <x-shop::form
                            method="DELETE"
                            action="{{ route('shop.customer.session.destroy') }}"
                            id="customerLogout"
                        />

                        <a
                            class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded-md transition-colors"
                            href="{{ route('shop.customer.session.destroy') }}"
                            onclick="event.preventDefault(); document.getElementById('customerLogout').submit();"
                        >
                            @lang('shop::app.components.layouts.header.desktop.bottom.logout')
                        </a>

                        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile_dropdown.links.after') !!}
                    </div>
                @endauth
            </x-slot>
        </x-shop::dropdown>

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile.after') !!}
    </div>
</div>

{!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.after') !!}
