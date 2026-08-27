@props([
    'hasHeader'  => true,
    'hasFeature' => true,
    'hasFooter'  => true,
])

<!DOCTYPE html>

<html
    lang="{{ app()->getLocale() }}"
    dir="{{ core()->getCurrentLocale()->direction }}"
>
    <head>

        {!! view_render_event('bagisto.shop.layout.head.before') !!}

        <title>{{ $title ?? '' }}</title>

        <meta charset="UTF-8">

        <meta
            http-equiv="X-UA-Compatible"
            content="IE=edge"
        >
        <meta
            http-equiv="content-language"
            content="{{ app()->getLocale() }}"
        >

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        >
        <meta
            name="base-url"
            content="{{ url()->to('/') }}"
        >
        <meta
            name="currency"
            content="{{ core()->getCurrentCurrency()->toJson() }}"
        >
        <meta 
            name="generator" 
            content="ELIOR Botanical Nutrition"
        >

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}" />

        <!-- Open Graph Meta Tags -->
        <meta property="og:site_name" content="ELIOR Botanical Nutrition" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@elior_botanicals" />

        @stack('meta')

        <!-- JSON-LD Global Organization & WebSite Schema -->
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@graph'   => [
                [
                    '@type'       => 'Organization',
                    '@id'         => url('/') . '/#organization',
                    'name'        => 'ELIOR Botanical Nutrition',
                    'url'         => url('/'),
                    'logo'        => [
                        '@type'   => 'ImageObject',
                        '@id'     => url('/') . '/#logo',
                        'url'     => url('/') . '/logo.svg',
                        'caption' => 'ELIOR Botanical Nutrition',
                    ],
                    'sameAs'      => [
                        'https://instagram.com/elior.botanicals',
                        'https://youtube.com/@eliorbotanicals',
                        'https://linkedin.com/company/elior-nutrition',
                        'https://twitter.com/elior_botanicals',
                    ],
                    'contactPoint' => [
                        '@type'             => 'ContactPoint',
                        'telephone'         => '+91-98765-43210',
                        'contactType'       => 'customer service',
                        'email'             => 'care@elior.in',
                        'areaServed'        => 'IN',
                        'availableLanguage' => ['English', 'Hindi'],
                    ],
                ],
                [
                    '@type'           => 'WebSite',
                    '@id'             => url('/') . '/#website',
                    'url'             => url('/'),
                    'name'            => 'ELIOR',
                    'description'     => 'Pure Plant-Based Botanical Nutrition & Functional Powders',
                    'publisher'       => [
                        '@id' => url('/') . '/#organization',
                    ],
                    'potentialAction' => [
                        '@type'       => 'SearchAction',
                        'target'      => [
                            '@type'       => 'EntryPoint',
                            'urlTemplate' => url('/search') . '?query={search_term_string}',
                        ],
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>

        @php
            $faviconConfig = core()->getConfigData('general.design.admin_logo.favicon');
            $faviconUrl = core()->getCurrentChannel()->favicon_url
                ?: ($faviconConfig ? \Illuminate\Support\Facades\Storage::url($faviconConfig) : bagisto_asset('images/favicon.ico'));
        @endphp

        <link
            rel="icon"
            sizes="16x16"
            href="{{ $faviconUrl }}"
        />
        <link
            rel="apple-touch-icon"
            href="{{ $faviconUrl }}"
        />

        @bagistoVite(['src/Resources/assets/css/app.css', 'src/Resources/assets/js/app.js'])

        <link
            rel="preconnect"
            href="https://fonts.googleapis.com"
            crossorigin
        />

        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin
        />

        <!-- Google Font: Poppins (Exclusive Store-Wide Font) -->
        <link
            rel="preload" as="style"
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        />

        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        />

        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

        <style>
            :root {
                --elior-green: #205132;
                --elior-green-dark: #163923;
                --elior-green-light: #e8f2ec;
                --elior-gold: #c9a25a;
                --elior-gold-dark: #b08a43;
                --elior-gold-light: #f5eedd;
                --elior-bg: #f4f0e6;
                --elior-surface: #ece6d8;
                --elior-card: #ffffff;
                --elior-border: #e5decb;
                --elior-text: #163923;
                --elior-muted: #677a6d;
            }

            /* Strict Store-Wide Typography: Google Poppins Font Only */
            html,
            body,
            h1, h2, h3, h4, h5, h6,
            p,
            span:not([class*="material-symbols"]):not([class*="icon-"]),
            a:not([class*="material-symbols"]):not([class*="icon-"]),
            button:not([class*="material-symbols"]):not([class*="icon-"]),
            input, textarea, select, label,
            .font-serif,
            .font-sans,
            .elior-heading-display,
            .elior-heading-serif,
            .elior-eyebrow,
            .prose,
            [class*="font-"]:not([class*="material-symbols"]):not([class*="icon-"]) {
                font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
            }

            /* Preserve Bagisto Shop Icon Font on Elements and Pseudo-elements */
            [class^="icon-"],
            [class*=" icon-"],
            [class*="icon-"],
            [class^="icon-"]::before,
            [class*=" icon-"]::before,
            [class*="icon-"]::before,
            [class^="icon-"]::after,
            [class*=" icon-"]::after,
            [class*="icon-"]::after {
                font-family: "bagisto-shop" !important;
                font-style: normal !important;
                font-weight: normal !important;
                font-variant: normal !important;
                text-transform: none !important;
                line-height: 1 !important;
                speak: never;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            /* Preserve Google Material Symbols on Elements and Pseudo-elements */
            .material-symbols-outlined,
            .material-symbols-outlined::before,
            .material-symbols-outlined::after,
            [class*="material-symbols"],
            [class*="material-symbols"]::before,
            [class*="material-symbols"]::after {
                font-family: 'Material Symbols Outlined' !important;
                font-weight: normal !important;
                font-style: normal !important;
                font-size: 24px;
                line-height: 1;
                letter-spacing: normal;
                text-transform: none;
                display: inline-block;
                white-space: nowrap;
                word-wrap: normal;
                direction: ltr;
                -webkit-font-feature-settings: 'liga';
                -webkit-font-smoothing: antialiased;
            }

            body {
                background-color: #f4f0e6 !important;
                color: #163923 !important;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            /* Exact Tailwind Arbitrary Color Utilities */
            .bg-\[\#163923\] { background-color: #163923 !important; }
            .hover\:bg-\[\#163923\]:hover { background-color: #163923 !important; }
            .bg-\[\#205132\] { background-color: #205132 !important; }
            .hover\:bg-\[\#205132\]:hover { background-color: #205132 !important; }
            .bg-\[\#e8f2ec\] { background-color: #e8f2ec !important; }
            .bg-\[\#f4f0e6\] { background-color: #f4f0e6 !important; }
            .bg-\[\#ece6d8\] { background-color: #ece6d8 !important; }
            .bg-\[\#c9a25a\] { background-color: #c9a25a !important; }
            .hover\:bg-\[\#c9a25a\]:hover { background-color: #c9a25a !important; }
            .bg-\[\#b08a43\] { background-color: #b08a43 !important; }
            .hover\:bg-\[\#b08a43\]:hover { background-color: #b08a43 !important; }
            .bg-\[\#f5eedd\] { background-color: #f5eedd !important; }

            .border-\[\#e5decb\] { border-color: #e5decb !important; }
            .border-\[\#205132\] { border-color: #205132 !important; }
            .border-\[\#c9a25a\] { border-color: #c9a25a !important; }

            .text-\[\#163923\] { color: #163923 !important; }
            .hover\:text-\[\#163923\]:hover { color: #163923 !important; }
            .text-\[\#205132\] { color: #205132 !important; }
            .hover\:text-\[\#205132\]:hover { color: #205132 !important; }
            .text-\[\#677a6d\] { color: #677a6d !important; }
            .text-\[\#c9a25a\] { color: #c9a25a !important; }
            .text-\[\#f4f0e6\] { color: #f4f0e6 !important; }
            .hover\:text-white:hover { color: #ffffff !important; }

            header,
            .site-header,
            header.sticky,
            [role="banner"] {
                background-color: #f4f0e6 !important;
                background: #f4f0e6 !important;
                opacity: 1 !important;
            }

            /* Global Component Styling Overrides for #205132, #c9a25a, #f4f0e6, #ffffff */
            ::selection {
                background-color: #205132 !important;
                color: #ffffff !important;
            }

            .elior-eyebrow {
                font-size: 0.6875rem !important;
                font-weight: 700 !important;
                letter-spacing: 0.22em !important;
                text-transform: uppercase !important;
                color: #205132 !important;
            }

            .elior-btn-primary,
            .primary-button, 
            .btn-primary, 
            button.btn-primary {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                background-color: #205132 !important;
                border: 1.5px solid #205132 !important;
                color: #ffffff !important;
                font-size: 0.75rem !important;
                font-weight: 700 !important;
                letter-spacing: 0.12em !important;
                text-transform: uppercase !important;
                border-radius: 9999px !important;
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
                cursor: pointer !important;
                box-shadow: 0 4px 14px rgba(32, 81, 50, 0.18) !important;
            }

            .elior-btn-primary:hover,
            .primary-button:hover, 
            .btn-primary:hover, 
            button.btn-primary:hover {
                background-color: #163923 !important;
                border-color: #163923 !important;
                box-shadow: 0 8px 24px rgba(32, 81, 50, 0.3) !important;
                transform: translateY(-2px) !important;
            }

            .elior-btn-secondary,
            .gold-cta-btn {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                background: linear-gradient(135deg, #c9a25a 0%, #b08a43 100%) !important;
                color: #ffffff !important;
                font-size: 0.75rem !important;
                font-weight: 700 !important;
                letter-spacing: 0.12em !important;
                text-transform: uppercase !important;
                border: none !important;
                border-radius: 9999px !important;
                box-shadow: 0 6px 20px rgba(201, 162, 90, 0.38) !important;
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
                cursor: pointer !important;
            }

            .elior-btn-secondary:hover,
            .gold-cta-btn:hover {
                background: linear-gradient(135deg, #d6b677 0%, #c9a25a 100%) !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 10px 28px rgba(201, 162, 90, 0.5) !important;
            }

            .elior-btn-outline,
            .secondary-button,
            .btn-secondary {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                background-color: transparent !important;
                border: 1.5px solid #205132 !important;
                color: #205132 !important;
                font-size: 0.75rem !important;
                font-weight: 700 !important;
                letter-spacing: 0.12em !important;
                text-transform: uppercase !important;
                border-radius: 9999px !important;
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
                cursor: pointer !important;
            }

            .elior-btn-outline:hover,
            .secondary-button:hover,
            .btn-secondary:hover {
                background-color: #205132 !important;
                color: #ffffff !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 8px 24px rgba(32, 81, 50, 0.22) !important;
            }

            .elior-badge-botanical {
                display: inline-flex !important;
                align-items: center !important;
                padding: 0.3rem 0.85rem !important;
                border-radius: 9999px !important;
                font-size: 0.6875rem !important;
                font-weight: 700 !important;
                letter-spacing: 0.08em !important;
                text-transform: uppercase !important;
                background-color: #e8f2ec !important;
                color: #205132 !important;
                border: 1px solid rgba(32, 81, 50, 0.15) !important;
            }

            .elior-badge-terracotta {
                display: inline-flex !important;
                align-items: center !important;
                padding: 0.3rem 0.85rem !important;
                border-radius: 9999px !important;
                font-size: 0.6875rem !important;
                font-weight: 700 !important;
                letter-spacing: 0.08em !important;
                text-transform: uppercase !important;
                background-color: #f5eedd !important;
                color: #c9a25a !important;
                border: 1px solid rgba(201, 162, 90, 0.25) !important;
            }

            .elior-nav-link-active {
                color: #205132 !important;
                font-weight: 700 !important;
            }

            .elior-nav-link-active::after {
                content: '' !important;
                position: absolute !important;
                bottom: -2px !important;
                left: 0 !important;
                right: 0 !important;
                height: 2px !important;
                background-color: #205132 !important;
                border-radius: 9999px !important;
            }

            /* Stars and Rating Accents in Warm Gold #c9a25a */
            .icon-star-fill, 
            .icon-star,
            [class*="icon-star"],
            .rating-star {
                color: #c9a25a !important;
            }

            /* Award-Winning Micro-Animations */
            @keyframes eliorFadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(16px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .elior-card-hover {
                transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
            }

            .elior-card-hover:hover {
                transform: translateY(-5px) !important;
                box-shadow: 0 20px 40px -10px rgba(32, 81, 50, 0.12) !important;
                border-color: rgba(32, 81, 50, 0.35) !important;
            }

            {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}
        </style>

        @stack('styles')

        @if(core()->getConfigData('general.content.speculation_rules.enabled'))
            <script type="speculationrules">
                @json(core()->getSpeculationRules(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            </script>
        @endif

        {!! view_render_event('bagisto.shop.layout.head.after') !!}

    </head>

    <body class="bg-[#f4f0e6] text-[#163923] font-sans antialiased selection:bg-[#205132] selection:text-white">
        {!! view_render_event('bagisto.shop.layout.body.before') !!}

        <a
            href="#main"
            class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-6 focus:py-3 focus:bg-elior-botanical focus:text-white focus:shadow-xl focus:rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-elior-botanical font-semibold text-sm transition-all"
        >
            Skip to main content
        </a>

        <!-- Built With Bagisto -->
        <div id="app" class="min-h-screen flex flex-col justify-between">
            <!-- Flash Message Blade Component -->
            <x-shop::flash-group />

            <!-- Confirm Modal Blade Component -->
            <x-shop::modal.confirm />

            <!-- Page Header Blade Component -->
            @if ($hasHeader)
                <x-shop::layouts.header />
            @endif

            {!! view_render_event('bagisto.shop.layout.content.before') !!}

            <!-- Page Content Blade Component -->
            <main id="main" class="flex-grow bg-[#f4f0e6]">
                {{ $slot }}
            </main>

            {!! view_render_event('bagisto.shop.layout.content.after') !!}

            <!-- Page Services Blade Component -->
            @if ($hasFeature)
                <x-shop::layouts.services />
            @endif

            <!-- Global Quick View Modal -->
            <x-shop::products.quick-view />

            <!-- Global Back to Top Button -->
            <x-shop::layouts.back-to-top />

            <!-- Page Footer Blade Component -->
            @if ($hasFooter)
                <x-shop::layouts.footer />
            @endif
        </div>

        {!! view_render_event('bagisto.shop.layout.body.after') !!}

        <!-- WebMCP Tool Registration For AI Agents -->
        <x-shop::layouts.webmcp />

        @stack('scripts')

        {!! view_render_event('bagisto.shop.layout.vue-app-mount.before') !!}
        <script>
            /**
             * Mount the application as soon as the DOM is ready instead of waiting
             * for the `load` event. All `Vue` components are registered through
             * deferred `type="module"` scripts, which always finish executing
             * before `DOMContentLoaded` fires, so every component is available
             * by the time `app.mount()` runs. Mounting on `DOMContentLoaded`
             * avoids blocking the storefront behind every image/font download.
             */
            function mountApp() {
                app.mount("#app");
            }

            if (document.readyState === "loading") {
                document.addEventListener("DOMContentLoaded", mountApp);
            } else {
                mountApp();
            }
        </script>

        {!! view_render_event('bagisto.shop.layout.vue-app-mount.after') !!}

        <script type="text/javascript">
            {!! core()->getConfigData('general.content.custom_scripts.custom_javascript') !!}
        </script>
    </body>
</html>
