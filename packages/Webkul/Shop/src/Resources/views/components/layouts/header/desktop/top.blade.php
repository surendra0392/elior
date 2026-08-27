{!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.before') !!}

@php
    $offerTitle = core()->getConfigData('general.content.header_offer.title');
    $redirectionTitle = core()->getConfigData('general.content.header_offer.redirection_title');
    $redirectionLink = core()->getConfigData('general.content.header_offer.redirection_link');
@endphp

<v-topbar>
    <!-- Shimmer / SSR Fallback -->
    <div style="background-color: #205132 !important; border-bottom: 1px solid rgba(201, 162, 90, 0.2) !important;">
        <div class="site-container flex items-center justify-between py-2 text-xs" style="color: #f4f0e6 !important;">
            <div class="w-20"></div>
            <div class="text-[11px] font-medium tracking-widest uppercase flex items-center gap-2">
                @if ($offerTitle)
                    <span>{!! $offerTitle !!}</span>
                    @if ($redirectionTitle && $redirectionLink)
                        <a
                            href="{{ $redirectionLink }}"
                            class="ml-1.5 inline-flex items-center gap-1 font-bold text-[#c9a25a] hover:text-white underline transition-colors"
                        >
                            <span>{{ $redirectionTitle }}</span>
                            <span class="text-xs">&rarr;</span>
                        </a>
                    @endif
                @else
                    <span>Free shipping on orders over ₹499 • 100% Pure Botanical Nutrition • Zero Synthetic Additives</span>
                @endif
            </div>
            <div class="w-20"></div>
        </div>
    </div>
</v-topbar>

{!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.after') !!}

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-topbar-template"
    >
        <div style="background-color: #205132 !important; border-bottom: 1px solid rgba(201, 162, 90, 0.2) !important;">
            <div class="site-container flex items-center justify-between py-2 text-[11px] font-medium tracking-widest uppercase" style="color: #f4f0e6 !important;">
            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.currency_switcher.before') !!}

            <!-- Currency Switcher -->
            <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'left' : 'right' }}">
                <!-- Dropdown Toggler -->
                <x-slot:toggle>
                    <div
                        class="flex cursor-pointer items-center gap-1.5 hover:text-white transition-colors"
                        role="button"
                        tabindex="0"
                        @click="currencyToggler = ! currencyToggler"
                    >
                        <span v-pre>
                            {{ core()->getCurrentCurrency()->symbol . ' ' . core()->getCurrentCurrencyCode() }}
                        </span>

                        <span
                            class="text-sm"
                            :class="{'icon-arrow-up': currencyToggler, 'icon-arrow-down': ! currencyToggler}"
                            role="presentation"
                        >
                        </span>
                    </div>
                </x-slot>

                <!-- Dropdown Content -->
                <x-slot:content class="journal-scroll max-h-[500px] !p-0 bg-white text-[#163923] shadow-lg border border-[#e5decb] rounded-md">
                    <v-currency-switcher></v-currency-switcher>
                </x-slot>
            </x-shop::dropdown>

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.currency_switcher.after') !!}

            <!-- Benefit Ticker / Announcement (Connected to Admin: General > Content > Header Offer Title) -->
            <div class="flex items-center gap-2.5 text-[11px] font-medium tracking-widest uppercase" style="color: #f4f0e6 !important;">
                @if ($offerTitle)
                    <span>{!! $offerTitle !!}</span>
                    @if ($redirectionTitle && $redirectionLink)
                        <a
                            href="{{ $redirectionLink }}"
                            class="ml-1.5 inline-flex items-center gap-1 font-bold text-[#c9a25a] hover:text-white underline transition-colors"
                        >
                            <span>{{ $redirectionTitle }}</span>
                            <span class="text-xs">&rarr;</span>
                        </a>
                    @endif
                @else
                    <span>Free shipping on orders over ₹499</span>
                    <span style="color: #c9a25a !important;">•</span>
                    <span>100% Pure Botanical Powders</span>
                    <span style="color: #c9a25a !important;">•</span>
                    <span>Zero Synthetic Additives</span>
                @endif
            </div>

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.locale_switcher.before') !!}

            <!-- Locales Switcher -->
            <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
                <x-slot:toggle>
                    <div
                        class="flex cursor-pointer items-center gap-1.5 hover:text-white transition-colors"
                        role="button"
                        tabindex="0"
                        @click="localeToggler = ! localeToggler"
                    >
                        <span v-pre>
                            {{ core()->getCurrentChannel()->locales()->orderBy('name')->where('code', app()->getLocale())->value('name') ?? 'EN' }}
                        </span>

                        <span
                            class="text-sm"
                            :class="{'icon-arrow-up': localeToggler, 'icon-arrow-down': ! localeToggler}"
                            role="presentation"
                        ></span>
                    </div>
                </x-slot>
            
                <x-slot:content class="journal-scroll max-h-[500px] !p-0 bg-white text-elior-charcoal shadow-elior-card border border-elior-border rounded-elior">
                    <v-locale-switcher></v-locale-switcher>
                </x-slot>
            </x-shop::dropdown>

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.locale_switcher.after') !!}
            </div>
        </div>
    </script>

    <script
        type="text/x-template"
        id="v-currency-switcher-template"
    >
        <div class="my-2.5 grid gap-1 overflow-auto max-md:my-0 sm:max-h-[500px]">
            <span
                class="cursor-pointer px-5 py-2 text-base hover:bg-gray-100"
                v-for="currency in currencies"
                :class="{'bg-gray-100': currency.code == '{{ core()->getCurrentCurrencyCode() }}'}"
                @click="change(currency)"
            >
                @{{ currency.symbol + ' ' + currency.code }}
            </span>
        </div>
    </script>

    <script
        type="text/x-template"
        id="v-locale-switcher-template"
    >
        <div class="my-2.5 grid gap-1 overflow-auto max-md:my-0 sm:max-h-[500px]">
            <span
                class="flex cursor-pointer items-center gap-2.5 px-5 py-2 text-base hover:bg-gray-100"
                :class="{'bg-gray-100': locale.code == '{{ app()->getLocale() }}'}"
                v-for="locale in locales"
                @click="change(locale)"                  
            >
                <img
                    :src="locale.logo_url || '{{ bagisto_asset('images/default-language.svg') }}'"
                    width="24"
                    height="16"
                />

                @{{ locale.name }}
            </span>
        </div>
    </script>

    <script type="module">
        app.component('v-topbar', {
            template: '#v-topbar-template',

            data() {
                return {
                    localeToggler: '',

                    currencyToggler: '',
                };
            },
        });

        app.component('v-currency-switcher', {
            template: '#v-currency-switcher-template',

            data() {
                return {
                    currencies: @json(core()->getCurrentChannel()->currencies),
                };
            },

            methods: {
                change(currency) {
                    let url = new URL(window.location.href);

                    url.searchParams.set('currency', currency.code);

                    window.location.href = url.href;
                }
            }
        });

        app.component('v-locale-switcher', {
            template: '#v-locale-switcher-template',

            data() {
                return {
                    locales: @json(core()->getCurrentChannel()->locales()->orderBy('name')->get()),
                };
            },

            methods: {
                change(locale) {
                    let url = new URL(window.location.href);

                    url.searchParams.set('locale', locale.code);

                    window.location.href = url.href;
                }
            }
        });
    </script>
@endPushOnce