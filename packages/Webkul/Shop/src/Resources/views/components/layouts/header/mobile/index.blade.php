@php
    $channel = core()->getCurrentChannel();
    $logoConfig = core()->getConfigData('general.design.admin_logo.logo_image');
    $logoUrl = $channel->logo_url ?: ($logoConfig ? \Illuminate\Support\Facades\Storage::url($logoConfig) : null);
    $showCompare = (bool) core()->getConfigData('catalog.products.settings.compare_option');
    $showWishlist = (bool) core()->getConfigData('customer.settings.wishlist.wishlist_option');
@endphp

<div class="flex flex-wrap gap-4 px-4 pt-4 pb-4 shadow-sm lg:hidden bg-[#f4f0e6] border-b border-[#e5decb]">
    <div class="flex items-center justify-between w-full">
        <!-- Left Navigation -->
        <div class="flex items-center gap-x-2">
            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.drawer.before') !!}

            <!-- Drawer -->
            <v-mobile-drawer></v-mobile-drawer>

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.drawer.after') !!}

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.logo.before') !!}

            <a
                href="{{ route('shop.home.index') }}"
                class="flex items-center py-1 group"
                aria-label="ELIOR - Botanical Nutrition"
            >
                @if ($logoUrl)
                    <img
                        src="{{ $logoUrl }}"
                        alt="{{ config('app.name', 'ELIOR') }}"
                        class="h-8 w-auto object-contain max-w-[130px]"
                    />
                @else
                    <div class="flex flex-col">
                        <span class="font-serif text-2xl font-bold tracking-tight text-elior-charcoal">
                            ELIOR
                        </span>
                        <span class="text-[8px] tracking-[0.25em] uppercase text-elior-muted -mt-1 font-sans font-semibold">
                            Botanicals
                        </span>
                    </div>
                @endif
            </a>

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.logo.after') !!}
        </div>

        <!-- Right Navigation -->
        <div>
            <div class="flex items-center gap-x-1 sm:gap-x-2">
                {!! view_render_event('bagisto.shop.components.layouts.header.mobile.compare.before') !!}

                @if($showCompare)
                    <a
                        href="{{ route('shop.compare.index') }}"
                        aria-label="@lang('shop::app.components.layouts.header.mobile.compare')"
                        class="flex h-10 w-10 items-center justify-center rounded-full text-[#163923] hover:bg-black/5 hover:text-[#205132] transition-colors focus:outline-none"
                    >
                        <span class="icon-compare text-2xl" role="presentation"></span>
                    </a>
                @endif

                {!! view_render_event('bagisto.shop.components.layouts.header.mobile.compare.after') !!}

                {!! view_render_event('bagisto.shop.components.layouts.header.mobile.mini_cart.before') !!}

                @if(core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                    @include('shop::checkout.cart.mini-cart')
                @endif

                {!! view_render_event('bagisto.shop.components.layouts.header.mobile.mini_cart.after') !!}

                <!-- For Large screens -->
                <div class="max-md:hidden">
                    <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
                        <x-slot:toggle>
                            <button
                                type="button"
                                class="flex h-10 w-10 items-center justify-center rounded-full text-[#163923] hover:bg-black/5 hover:text-[#205132] transition-colors focus:outline-none"
                                aria-label="@lang('shop::app.components.layouts.header.desktop.bottom.profile')"
                            >
                                <span class="icon-users text-2xl" role="presentation"></span>
                            </button>
                        </x-slot>

                            <!-- Guest Dropdown -->
                            @guest('customer')
                                <x-slot:content>
                                    <div class="grid gap-2.5">
                                        <p class="text-xl font-dmserif">
                                            @lang('shop::app.components.layouts.header.mobile.welcome-guest')
                                        </p>

                                        <p class="text-sm">
                                            @lang('shop::app.components.layouts.header.mobile.dropdown-text')
                                        </p>
                                    </div>

                                    <p class="w-full mt-3 border border-zinc-200"></p>

                                    {!! view_render_event('bagisto.shop.components.layouts.header.mobile.index.customers_action.before') !!}

                                    <div class="flex gap-4 mt-6">
                                        {!! view_render_event('bagisto.shop.components.layouts.header.mobile.index.sign_in_button.before') !!}

                                    <a
                                        href="{{ route('shop.customer.session.create') }}"
                                        class="block py-4 m-0 mx-auto text-base font-medium text-center text-white cursor-pointer w-max rounded-2xl bg-navyBlue px-7 ltr:ml-0 rtl:mr-0"
                                    >
                                            @lang('shop::app.components.layouts.header.mobile.sign-in')
                                        </a>

                                    <a
                                        href="{{ route('shop.customers.register.index') }}"
                                        class="m-0 mx-auto block w-max cursor-pointer rounded-2xl border-2 border-navyBlue bg-white px-7 py-3.5 text-center text-base font-medium text-navyBlue ltr:ml-0 rtl:mr-0"
                                    >
                                            @lang('shop::app.components.layouts.header.mobile.sign-up')
                                        </a>

                                        {!! view_render_event('bagisto.shop.components.layouts.header.mobile.index.sign_in_button.after') !!}
                                    </div>

                                    {!! view_render_event('bagisto.shop.components.layouts.header.mobile.index.customers_action.after') !!}
                                    </x-slot>
                            @endguest

                                <!-- Customers Dropdown -->
                                @auth('customer')
                                    <x-slot:content class="!p-0">
                                        <div class="grid gap-2.5 p-5 pb-0">
                                            <p class="text-xl font-dmserif" v-pre>
                                        @lang('shop::app.components.layouts.header.mobile.welcome')’
                                                {{ auth()->guard('customer')->user()->first_name }}
                                            </p>

                                            <p class="text-sm">
                                                @lang('shop::app.components.layouts.header.mobile.dropdown-text')
                                            </p>
                                        </div>

                                        <p class="w-full mt-3 border border-zinc-200"></p>

                                        <div class="mt-2.5 grid gap-1 pb-2.5">
                                            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.index.profile_dropdown.links.before') !!}

                                    <a
                                        class="px-5 py-2 text-base cursor-pointer"
                                        href="{{ route('shop.customers.account.profile.index') }}"
                                    >
                                                @lang('shop::app.components.layouts.header.mobile.profile')
                                            </a>

                                    <a
                                        class="px-5 py-2 text-base cursor-pointer"
                                        href="{{ route('shop.customers.account.orders.index') }}"
                                    >
                                                @lang('shop::app.components.layouts.header.mobile.orders')
                                            </a>

                                            @if ($showWishlist)
                                        <a
                                            class="px-5 py-2 text-base cursor-pointer"
                                            href="{{ route('shop.customers.account.wishlist.index') }}"
                                        >
                                                    @lang('shop::app.components.layouts.header.mobile.wishlist')
                                                </a>
                                            @endif

                                            <!--Customers logout-->
                                            @auth('customer')
                                        <x-shop::form
                                            method="DELETE"
                                            action="{{ route('shop.customer.session.destroy') }}"
                                            id="customerLogout"
                                        />

                                        <a
                                            class="px-5 py-2 text-base cursor-pointer"
                                                    href="{{ route('shop.customer.session.destroy') }}"
                                            onclick="event.preventDefault(); document.getElementById('customerLogout').submit();"
                                        >
                                                    @lang('shop::app.components.layouts.header.mobile.logout')
                                                </a>
                                            @endauth

                                            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.index.profile_dropdown.links.after') !!}
                                        </div>
                                        </x-slot>
                                @endauth
                    </x-shop::dropdown>
                </div>

                <!-- For Medium and small screen -->
                <div class="md:hidden">
                    @guest('customer')
                        <a
                            href="{{ route('shop.customer.session.create') }}"
                            aria-label="@lang('shop::app.components.layouts.header.mobile.account')"
                        >
                            <span class="text-2xl cursor-pointer icon-users"></span>
                        </a>
                    @endguest

                    <!-- Customers Dropdown -->
                    @auth('customer')
                        <a
                            href="{{ route('shop.customers.account.index') }}"
                            aria-label="@lang('shop::app.components.layouts.header.mobile.account')"
                        >
                            <span class="text-2xl cursor-pointer icon-users"></span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {!! view_render_event('bagisto.shop.components.layouts.header.mobile.search.before') !!}

    <!-- Serach Catalog Form -->
    <form action="{{ route('shop.search.index') }}" class="flex items-center w-full">
        <label
            for="organic-search"
            class="sr-only"
        >
            @lang('shop::app.components.layouts.header.mobile.search')
        </label>

        <div class="relative w-full">
            <div class="icon-search pointer-events-none absolute top-3 flex items-center text-2xl max-md:text-xl max-sm:top-2.5 ltr:left-3 rtl:right-3"></div>

            <input
                type="text"
                class="block w-full rounded-xl border border-['#E3E3E3'] px-11 py-3.5 text-sm font-medium text-gray-900 max-md:rounded-lg max-md:px-10 max-md:py-3 max-md:font-normal max-sm:text-xs"
                name="query"
                value="{{ request('query') }}"
                placeholder="@lang('shop::app.components.layouts.header.mobile.search-text')"
                required
            >

            @if (core()->getConfigData('catalog.products.settings.image_search'))
                @include('shop::search.images.index')
            @endif
        </div>
    </form>

    {!! view_render_event('bagisto.shop.components.layouts.header.mobile.search.after') !!}
</div>

@pushOnce('scripts')
    <script type="text/x-template" id="v-mobile-drawer-template">
        <x-shop::drawer
            position="left"
            width="340px"
        >
            <x-slot:toggle>
                <button
                    type="button"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-elior-charcoal hover:bg-black/5 hover:text-elior-botanical transition-colors focus:outline-none focus:ring-2 focus:ring-elior-botanical"
                    aria-label="Open Navigation"
                >
                    <span class="text-2xl cursor-pointer icon-hamburger"></span>
                </button>
            </x-slot>

            <x-slot:header>
                <div class="flex items-center justify-between py-1">
                    <a href="{{ route('shop.home.index') }}" class="flex items-center">
                        @if ($logoUrl)
                            <img
                                src="{{ $logoUrl }}"
                                alt="{{ config('app.name', 'ELIOR') }}"
                                class="h-8 w-auto object-contain max-w-[120px]"
                            />
                        @else
                            <div class="flex flex-col">
                                <span class="font-serif text-2xl font-bold tracking-tight text-elior-charcoal">
                                    ELIOR
                                </span>
                                <span class="text-[8px] tracking-[0.25em] uppercase text-elior-muted -mt-1 font-sans font-semibold">
                                    Botanical Nutrition
                                </span>
                            </div>
                        @endif
                    </a>
                </div>
            </x-slot>

            <x-slot:content class="!p-0">
                <!-- Primary ELIOR Navigation -->
                <nav class="px-6 py-6 border-b border-elior-border/70 space-y-1" aria-label="Mobile Primary Navigation">
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
                                    <a href="{{ route('shop.cms.page', $pageTranslation->url_key) }}" class="flex items-center justify-between py-3 text-sm font-semibold uppercase tracking-wider {{ request()->is('page/'.$pageTranslation->url_key.'*') || request()->is($pageTranslation->url_key.'*') ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} border-b border-elior-border/30 transition-colors">
                                        <span>{{ $item['title'] ?? $pageTranslation->page_title }}</span>
                                        <span class="icon-arrow-right text-xs text-elior-muted"></span>
                                    </a>
                                @endif
                            @elseif ($item['type'] === 'category' && isset($categories[$item['id']]))
                                @php $categoryTranslation = $categories[$item['id']]->translate(core()->getRequestedLocaleCode()); @endphp
                                @if ($categoryTranslation)
                                    @php $categoryUrl = $categoryTranslation->url_path ?: $categoryTranslation->slug; @endphp
                                    <a href="{{ $categoryUrl ? route('shop.product_or_category.index', $categoryUrl) : '#' }}" class="flex items-center justify-between py-3 text-sm font-semibold uppercase tracking-wider {{ request()->is($categoryUrl.'*') ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} border-b border-elior-border/30 transition-colors">
                                        <span>{!! $item['title'] ?? $categoryTranslation->name !!}</span>
                                        <span class="icon-arrow-right text-xs text-elior-muted"></span>
                                    </a>
                                @endif
                            @elseif ($item['type'] === 'custom')
                                <a href="{{ $item['url'] }}" class="flex items-center justify-between py-3 text-sm font-semibold uppercase tracking-wider {{ request()->fullUrlIs($item['url'].'*') ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} border-b border-elior-border/30 transition-colors">
                                    <span>{{ $item['title'] }}</span>
                                    <span class="icon-arrow-right text-xs text-elior-muted"></span>
                                </a>
                            @endif
                        @endforeach
                    @else
                        <a
                            href="{{ route('shop.home.index') }}"
                            class="flex items-center justify-between py-3 text-sm font-semibold uppercase tracking-wider {{ (request()->routeIs('shop.home.index') && request()->is('/')) ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} border-b border-elior-border/30 transition-colors"
                        >
                            <span>Home</span>
                            <span class="icon-arrow-right text-xs text-elior-muted"></span>
                        </a>

                        <a
                            href="{{ route('shop.cms.page', 'about-us') }}"
                            class="flex items-center justify-between py-3 text-sm font-semibold uppercase tracking-wider {{ request()->is('page/about-us*') ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} border-b border-elior-border/30 transition-colors"
                        >
                            <span>About</span>
                            <span class="icon-arrow-right text-xs text-elior-muted"></span>
                        </a>

                        <a
                            href="{{ route('shop.cms.page', 'quality') }}"
                            class="flex items-center justify-between py-3 text-sm font-semibold uppercase tracking-wider {{ request()->is('page/quality*') ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} border-b border-elior-border/30 transition-colors"
                        >
                            <span>Quality</span>
                            <span class="icon-arrow-right text-xs text-elior-muted"></span>
                        </a>

                        <a
                            href="/products"
                            class="flex items-center justify-between py-3 text-sm font-semibold uppercase tracking-wider {{ (request()->is('products*') || request()->routeIs('shop.product_or_category.index')) ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} border-b border-elior-border/30 transition-colors"
                        >
                            <span>Products</span>
                            <span class="icon-arrow-right text-xs text-elior-muted"></span>
                        </a>

                        <a
                            href="{{ route('shop.recipes.index') }}"
                            class="flex items-center justify-between py-3 text-sm font-semibold uppercase tracking-wider {{ request()->is('recipes*') ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} border-b border-elior-border/30 transition-colors"
                        >
                            <span>Recipes</span>
                            <span class="icon-arrow-right text-xs text-elior-muted"></span>
                        </a>

                        <a
                            href="{{ route('shop.home.contact_us') }}"
                            class="flex items-center justify-between py-3 text-sm font-semibold uppercase tracking-wider {{ (request()->routeIs('shop.home.contact_us*') || request()->is('contact-us*')) ? 'text-elior-botanical font-bold' : 'text-elior-charcoal hover:text-elior-botanical' }} border-b border-elior-border/30 transition-colors"
                        >
                            <span>Contact</span>
                            <span class="icon-arrow-right text-xs text-elior-muted"></span>
                        </a>
                    @endif
                </nav>

                <!-- Account Profile Section -->
                <div class="p-6">
                    <div class="grid grid-cols-[auto_1fr] items-center gap-4 rounded-xl border border-elior-border bg-white p-3.5 shadow-sm">
                        <div>
                            <img
                                src="{{ auth()->user()?->image_url ??  bagisto_asset('images/user-placeholder.png') }}"
                                class="h-[46px] w-[46px] rounded-full object-cover"
                                alt="User Profile"
                            >
                        </div>

                        @guest('customer')
                            <a
                                href="{{ route('shop.customer.session.create') }}"
                                class="flex items-center text-sm font-semibold text-elior-charcoal hover:text-elior-botanical"
                            >
                                @lang('shop::app.components.layouts.header.mobile.login')

                                <i class="icon-double-arrow text-base ltr:ml-2 rtl:mr-2 text-elior-botanical"></i>
                            </a>
                        @endguest

                        @auth('customer')
                            <div
                                class="flex flex-col justify-between gap-0.5"
                                v-pre
                            >
                                <p class="text-sm font-bold text-elior-charcoal">Hello, {{ auth()->user()?->first_name }}</p>

                                <a href="{{ route('shop.customers.account.profile.index') }}" class="text-xs text-elior-botanical font-medium hover:underline">
                                    View Account &rarr;
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </x-slot>

            <x-slot:footer>
                <!-- Quick Search & Cart Actions -->
                <div class="flex items-center justify-between gap-4 text-xs font-semibold uppercase tracking-wider text-elior-charcoal">
                    <a href="{{ route('shop.search.index') }}" class="flex items-center gap-1.5 hover:text-elior-botanical transition-colors">
                        <span class="icon-search text-base text-elior-muted"></span>
                        <span>Search</span>
                    </a>

                    <a href="{{ route('shop.checkout.cart.index') }}" class="flex items-center gap-1.5 hover:text-elior-botanical transition-colors">
                        <span class="icon-cart text-base text-elior-muted"></span>
                        <span>Cart</span>
                    </a>
                </div>
            </x-slot>
        </x-shop::drawer>
    </script>

    <script type="module">
        app.component('v-mobile-drawer', {
            template: '#v-mobile-drawer-template',
        });
    </script>
@endPushOnce
