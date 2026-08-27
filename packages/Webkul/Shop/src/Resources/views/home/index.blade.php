@inject('productRepository', 'Webkul\Product\Repositories\ProductRepository')

@php
    use Webkul\CMS\Models\Page;

    $channel = core()->getCurrentChannel();

    // Query 8 Featured Products
    $featuredProducts = app('Webkul\Product\Repositories\ProductRepository')->getModel()
        ->whereHas('attribute_values', function($q) {
            $q->whereHas('attribute', fn($q2) => $q2->where('code', 'status'))
              ->where('boolean_value', 1);
        })
        ->whereHas('attribute_values', function($q) {
            $q->whereHas('attribute', fn($q2) => $q2->where('code', 'visible_individually'))
              ->where('boolean_value', 1);
        })
        ->orderBy('updated_at', 'desc')
        ->take(8)->get();

    // Query 4 Best Sellers
    $bestSellers = app('Webkul\Product\Repositories\ProductRepository')->getModel()
        ->whereHas('attribute_values', function($q) {
            $q->whereHas('attribute', fn($q2) => $q2->where('code', 'status'))
              ->where('boolean_value', 1);
        })
        ->whereHas('attribute_values', function($q) {
            $q->whereHas('attribute', fn($q2) => $q2->where('code', 'visible_individually'))
              ->where('boolean_value', 1);
        })
        ->orderBy('id', 'asc')
        ->take(4)->get();

    // Query 3 featured recipes for Journal section
    $featuredRecipes = app('Webkul\Recipe\Repositories\RecipeRepository')->getModel()
        ->where('status', 1)
        ->orderBy('updated_at', 'desc')
        ->take(3)
        ->get();
@endphp

<!-- SEO Meta Content -->
@push ('meta')
    @php
        $homeTitle = $channel->home_seo['meta_title'] ?? 'ELIOR — Pure Plant-Based Botanical Nutrition & Functional Powders';
        $homeDesc  = $channel->home_seo['meta_description'] ?? 'ELIOR crafts cold-dehydrated, clean-label plant food powders, functional blends, and botanical ingredients with zero synthetic fillers.';
        $homeKeys  = $channel->home_seo['meta_keywords'] ?? 'botanical powders, cold dehydrated superfoods, plant nutrition, organic moringa, lakadong turmeric, beetroot powder, amla vitamin c, functional superblends, clean label nutrition, ELIOR';
    @endphp

    <meta
        name="title"
        content="{{ $homeTitle }}"
    />

    <meta
        name="description"
        content="{{ $homeDesc }}"
    />

    <meta
        name="keywords"
        content="{{ $homeKeys }}"
    />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $homeTitle }}" />
    <meta name="twitter:description" content="{{ $homeDesc }}" />

    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $homeTitle }}" />
    <meta property="og:description" content="{{ $homeDesc }}" />
    <meta property="og:url" content="{{ url('/') }}" />
@endpush

@push('scripts')
    @if(! empty($categories))
        <script>
            localStorage.setItem('categories', JSON.stringify(@json($categories)));
        </script>
    @endif
@endpush

<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        {{  $channel->home_seo['meta_title'] ?? 'ELIOR — Pure Plant-Based Botanical Nutrition' }}
    </x-slot>

    <!-- SECTION 1: COMMANDING EDITORIAL HERO -->
    <x-shop::hero-slider code="elior-homepage-hero" />

    <!-- SECTION 2: BRAND PHILOSOPHY & MANIFESTO -->
    <section id="philosophy" class="py-20 lg:py-28 bg-[#f4f0e6] border-b border-[#e5decb]">
        <div class="site-container">
            <!-- Section Header -->
            <div class="mx-auto max-w-3xl text-center space-y-4 mb-16">
                <span class="elior-eyebrow">The ELIOR Philosophy</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923] leading-tight">
                    Nutrition In Its Most Concentrated, Unadulterated Form.
                </h2>
                <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed max-w-2xl mx-auto">
                    Most conventional supplements dilute active ingredients with synthetic carriers and high-heat spray drying. ELIOR takes a radically pure approach: whole functional botanical foods, dried at low temperatures and finely milled.
                </p>
            </div>

            <!-- 3 Core Formulation Pillars (Editorial Structure) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 lg:p-10 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4 hover:border-[#205132]/50 transition-colors duration-300">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#205132]">Pillar 01</span>
                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#163923]">Cold-Dehydration Science</h3>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#677a6d]">
                        We avoid destructive high-heat processing. Our low-temperature vacuum dehydration dries botanicals below 42°C, preserving living enzymes, natural aroma, and active phytonutrients.
                    </p>
                </div>

                <div class="p-8 lg:p-10 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4 hover:border-[#205132]/50 transition-colors duration-300">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#205132]">Pillar 02</span>
                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#163923]">Zero Additive Standard</h3>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#677a6d]">
                        Every blend contains 100% of the named whole foods and botanicals. We never use artificial sweeteners, synthetics, natural flavor chemicals, or maltodextrin carriers.
                    </p>
                </div>

                <div class="p-8 lg:p-10 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4 hover:border-[#205132]/50 transition-colors duration-300">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#205132]">Pillar 03</span>
                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#163923]">Daily Ritual Synergy</h3>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#677a6d]">
                        Micro-milled powders engineered for effortless dissolvability. Easily whisk into morning water, blend into tonics, or stir into warm oat milk for restorative daily nourishment.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: FEATURED PRODUCTS CATALOG -->
    <section id="collections" class="py-20 lg:py-28 bg-[#f4f0e6] border-b border-[#e5decb]">
        <div class="site-container">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
                <div class="space-y-3">
                    <span class="elior-eyebrow">Signature Collection</span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-elior-charcoal">
                        Featured Formulations
                    </h2>
                    <p class="text-xs sm:text-sm text-elior-muted max-w-lg leading-relaxed">
                        Explore our premier selection of cold-dehydrated botanical powders. Carefully sourced and milled to preserve peak nutritional potency.
                    </p>
                </div>

                <a
                    href="{{ route('shop.product_or_category.index', 'products') }}"
                    class="elior-btn-outline self-start md:self-auto !px-6 !py-3 text-xs"
                >
                    View Entire Collection &rarr;
                </a>
            </div>

            <!-- Botanical Product Showcase -->
            @if ($featuredProducts->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($featuredProducts as $product)
                        <x-shop::products.card :product="$product" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION 4: BESTSELLERS / MOST LOVED STRIP -->
    <section class="py-20 lg:py-28 bg-[#f4f0e6] border-b border-[#e5decb]">
        <div class="site-container">
            <div class="mx-auto max-w-3xl text-center space-y-4 mb-14">
                <span class="elior-eyebrow">Most Loved</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Community Bestsellers
                </h2>
                <p class="text-sm text-[#677a6d] max-w-lg mx-auto leading-relaxed">
                    The botanical formulations our community reaches for every single day.
                </p>
            </div>

            @if ($bestSellers->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($bestSellers as $bsProduct)
                        <x-shop::products.card :product="$bsProduct" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION 5: INGREDIENT & BOTANICAL SPOTLIGHT -->
    <section id="ingredients" class="py-20 lg:py-28 bg-[#ece6d8] border-b border-[#e5decb]">
        <div class="site-container">
            <div class="mx-auto max-w-3xl text-center space-y-4 mb-16">
                <span class="elior-eyebrow">Raw Botanical Harvests</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    The Flora Behind The Formulations
                </h2>
                <p class="text-xs sm:text-sm text-[#677a6d] leading-relaxed">
                    We select single-origin herbs, wild adaptogens, and deep nutrient supergreens harvested at peak biological potency.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Botanical 1: Moringa -->
                <div class="p-6 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-3 hover:border-[#205132]/50 transition-colors">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-[#e8f2ec] text-[#205132]">Living Chlorophyll</span>
                    <h4 class="font-serif text-lg font-semibold text-[#163923]">Organic Moringa Leaf</h4>
                    <p class="text-xs leading-relaxed text-[#677a6d]">
                        Cold-dehydrated below 38°C to retain vibrant cellular chlorophyll, 46 antioxidants, and essential plant amino acids.
                    </p>
                </div>

                <!-- Botanical 2: Turmeric -->
                <div class="p-6 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-3 hover:border-[#205132]/50 transition-colors">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-[#e8f2ec] text-[#205132]">7.5% High Curcumin</span>
                    <h4 class="font-serif text-lg font-semibold text-[#163923]">Lakadong Turmeric</h4>
                    <p class="text-xs leading-relaxed text-[#677a6d]">
                        Sourced exclusively from Meghalaya hillsides, delivering world-renowned active curcuminoid density for daily recovery.
                    </p>
                </div>

                <!-- Botanical 3: Spirulina -->
                <div class="p-6 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-3 hover:border-[#205132]/50 transition-colors">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-[#e8f2ec] text-[#205132]">Deep Phytonutrient</span>
                    <h4 class="font-serif text-lg font-semibold text-[#163923]">Artisanal Spirulina</h4>
                    <p class="text-xs leading-relaxed text-[#677a6d]">
                        Sun-cultivated in pure alkaline waters, cold-filtered and milled into bioavailable phycocyanin and plant proteins.
                    </p>
                </div>

                <!-- Botanical 4: Ashwagandha -->
                <div class="p-6 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-3 hover:border-[#205132]/50 transition-colors">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-[#e8f2ec] text-[#205132]">Adaptogenic Harmony</span>
                    <h4 class="font-serif text-lg font-semibold text-[#163923]">KSM-66 Ashwagandha</h4>
                    <p class="text-xs leading-relaxed text-[#677a6d]">
                        Standardized full-spectrum root extract revered for cognitive equilibrium, physical resilience, and restorative sleep.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: WHY ELIOR — COMPARISON TABLE -->
    <section class="py-20 lg:py-28 bg-[#f4f0e6] border-b border-[#e5decb]">
        <div class="site-container">
            <div class="mx-auto max-w-3xl text-center space-y-4 mb-14">
                <span class="elior-eyebrow">The Difference</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Why Choose ELIOR?
                </h2>
                <p class="text-sm text-[#677a6d] max-w-lg mx-auto leading-relaxed">
                    See how our cold-dehydrated botanical formulations compare to conventional supplement brands.
                </p>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="overflow-hidden rounded-2xl border border-[#e5decb] shadow-sm">
                    {{-- Table Header --}}
                    <div class="grid grid-cols-3 bg-[#163923] text-white">
                        <div class="p-5 lg:p-6 text-xs font-bold uppercase tracking-widest border-r border-white/10">
                            Criteria
                        </div>
                        <div class="p-5 lg:p-6 text-center text-xs font-bold uppercase tracking-widest border-r border-white/10">
                            <span class="text-[#c9a25a]">ELIOR</span>
                        </div>
                        <div class="p-5 lg:p-6 text-center text-xs font-bold uppercase tracking-widest text-white/60">
                            Others
                        </div>
                    </div>

                    {{-- Row 1 --}}
                    <div class="grid grid-cols-3 bg-white border-b border-[#e5decb]">
                        <div class="p-5 lg:p-6 text-sm font-medium text-[#163923] border-r border-[#e5decb]">
                            Processing Method
                        </div>
                        <div class="p-5 lg:p-6 text-center border-r border-[#e5decb]">
                            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#205132]">
                                <svg class="w-4 h-4 text-[#205132] shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                Cold Dehydrated &lt;42°C
                            </span>
                        </div>
                        <div class="p-5 lg:p-6 text-center text-[#677a6d]">
                            High-Heat Spray Dried
                        </div>
                    </div>

                    {{-- Row 2 --}}
                    <div class="grid grid-cols-3 bg-[#f4f0e6]/50 border-b border-[#e5decb]">
                        <div class="p-5 lg:p-6 text-sm font-medium text-[#163923] border-r border-[#e5decb]">
                            Synthetic Fillers
                        </div>
                        <div class="p-5 lg:p-6 text-center border-r border-[#e5decb]">
                            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#205132]">
                                <svg class="w-4 h-4 text-[#205132] shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                Zero Fillers
                            </span>
                        </div>
                        <div class="p-5 lg:p-6 text-center text-[#677a6d]">
                            Maltodextrin / Silica
                        </div>
                    </div>

                    {{-- Row 3 --}}
                    <div class="grid grid-cols-3 bg-white border-b border-[#e5decb]">
                        <div class="p-5 lg:p-6 text-sm font-medium text-[#163923] border-r border-[#e5decb]">
                            Artificial Sweeteners
                        </div>
                        <div class="p-5 lg:p-6 text-center border-r border-[#e5decb]">
                            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#205132]">
                                <svg class="w-4 h-4 text-[#205132] shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                None Added
                            </span>
                        </div>
                        <div class="p-5 lg:p-6 text-center text-[#677a6d]">
                            Stevia / Sucralose
                        </div>
                    </div>

                    {{-- Row 4 --}}
                    <div class="grid grid-cols-3 bg-[#f4f0e6]/50 border-b border-[#e5decb]">
                        <div class="p-5 lg:p-6 text-sm font-medium text-[#163923] border-r border-[#e5decb]">
                            Ingredient Purity
                        </div>
                        <div class="p-5 lg:p-6 text-center border-r border-[#e5decb]">
                            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#205132]">
                                <svg class="w-4 h-4 text-[#205132] shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                100% Whole Food
                            </span>
                        </div>
                        <div class="p-5 lg:p-6 text-center text-[#677a6d]">
                            Extracts & Isolates
                        </div>
                    </div>

                    {{-- Row 5 --}}
                    <div class="grid grid-cols-3 bg-white border-b border-[#e5decb]">
                        <div class="p-5 lg:p-6 text-sm font-medium text-[#163923] border-r border-[#e5decb]">
                            Batch Testing
                        </div>
                        <div class="p-5 lg:p-6 text-center border-r border-[#e5decb]">
                            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#205132]">
                                <svg class="w-4 h-4 text-[#205132] shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                Third-Party Verified
                            </span>
                        </div>
                        <div class="p-5 lg:p-6 text-center text-[#677a6d]">
                            Self-Certified
                        </div>
                    </div>

                    {{-- Row 6 --}}
                    <div class="grid grid-cols-3 bg-[#f4f0e6]/50">
                        <div class="p-5 lg:p-6 text-sm font-medium text-[#163923] border-r border-[#e5decb]">
                            Enzyme Retention
                        </div>
                        <div class="p-5 lg:p-6 text-center border-r border-[#e5decb]">
                            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#205132]">
                                <svg class="w-4 h-4 text-[#205132] shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                Living Enzymes Intact
                            </span>
                        </div>
                        <div class="p-5 lg:p-6 text-center text-[#677a6d]">
                            Destroyed by Heat
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 7: THE DAILY RITUAL SEQUENCE -->
    <section class="py-20 lg:py-28 border-b border-white/10" style="background-color: #163923 !important; color: #f4f0e6 !important;">
        <div class="site-container">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 space-y-6">
                    <span class="inline-block text-xs font-bold uppercase tracking-widest text-[#c9a25a]">
                        Daily Ritual Sequence
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-white leading-tight">
                        Seamless Integration Into Daily Life
                    </h2>
                    <p class="text-xs sm:text-sm text-[#f4f0e6]/75 leading-relaxed">
                        Because our formulations contain zero synthetic anti-caking gums or maltodextrin carriers, they dissolve naturally in water, teas, tonics, or warm plant milks without clumping.
                    </p>
                    <a
                        href="{{ route('shop.product_or_category.index', 'products') }}"
                        class="gold-cta-btn inline-flex px-8 py-3.5 rounded-full text-xs uppercase tracking-widest font-bold text-white shadow-lg hover:brightness-110 transition-all"
                        style="background: linear-gradient(135deg, #c9a25a 0%, #b08a43 100%) !important;"
                    >
                        Begin Your Ritual
                    </a>
                </div>

                <div class="lg:col-span-7 space-y-4">
                    <div class="p-6 rounded-2xl space-y-2" style="background-color: #205132 !important; border: 1px solid rgba(255, 255, 255, 0.12) !important;">
                        <div class="flex items-center justify-between">
                            <h4 class="font-serif text-base font-semibold text-white">01. Morning Awakening &amp; Cleansing</h4>
                            <span class="text-[11px] uppercase tracking-wider text-[#c9a25a] font-semibold">07:00 AM</span>
                        </div>
                        <p class="text-xs text-[#f4f0e6]/75 leading-relaxed">
                            Whisk 1 scoop of Moringa Green Vitality into 250ml of cold spring water with fresh lime juice for cellular alkalization.
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl space-y-2" style="background-color: #205132 !important; border: 1px solid rgba(255, 255, 255, 0.12) !important;">
                        <div class="flex items-center justify-between">
                            <h4 class="font-serif text-base font-semibold text-white">02. Midday Clarity &amp; Metabolic Energy</h4>
                            <span class="text-[11px] uppercase tracking-wider text-[#c9a25a] font-semibold">01:30 PM</span>
                        </div>
                        <p class="text-xs text-[#f4f0e6]/75 leading-relaxed">
                            Blend 1 scoop of Golden Immunity or Spirulina into your post-movement smoothie or matcha for sustained non-caffeine energy.
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl space-y-2" style="background-color: #205132 !important; border: 1px solid rgba(255, 255, 255, 0.12) !important;">
                        <div class="flex items-center justify-between">
                            <h4 class="font-serif text-base font-semibold text-white">03. Evening Restorative Recovery</h4>
                            <span class="text-[11px] uppercase tracking-wider text-[#c9a25a] font-semibold">08:30 PM</span>
                        </div>
                        <p class="text-xs text-[#f4f0e6]/75 leading-relaxed">
                            Stir 1 scoop of KSM-66 Ashwagandha into warm oat milk with a dash of raw honey to calm the nervous system for deep sleep.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 8: BOTANICAL PROCESS & SOURCING TRANSPARENCY -->
    <section class="py-20 lg:py-28 bg-[#f4f0e6] border-b border-[#e5decb]">
        <div class="site-container">
            <div class="grid grid-cols-1 items-center gap-16 lg:grid-cols-12">
                <div class="lg:col-span-7 space-y-6">
                    <span class="elior-eyebrow">Radical Transparency</span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923] leading-tight">
                        Uncompromised integrity from soil to formulation.
                    </h2>
                    <p class="text-sm sm:text-base leading-relaxed text-[#677a6d] max-w-xl">
                        We partner with ethical growers who practice regenerative agriculture. Every ingredient undergoes low-temperature vacuum dehydration and rigorous third-party laboratory verification for heavy metals and microbial purity.
                    </p>

                    <div class="pt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-[#e5decb] shadow-sm">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#e8f2ec] text-[#205132] font-serif font-bold text-xs">01</span>
                            <div>
                                <h4 class="font-serif text-sm font-semibold text-[#163923]">Ethically Harvested</h4>
                                <p class="text-xs text-[#677a6d] mt-0.5">Fair grower compensation & regenerative farming.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-[#e5decb] shadow-sm">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#e8f2ec] text-[#205132] font-serif font-bold text-xs">02</span>
                            <div>
                                <h4 class="font-serif text-sm font-semibold text-[#163923]">Cold Dehydration</h4>
                                <p class="text-xs text-[#677a6d] mt-0.5">Vacuum dried &lt;42°C to preserve living nutrients.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-[#e5decb] shadow-sm">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#e8f2ec] text-[#205132] font-serif font-bold text-xs">03</span>
                            <div>
                                <h4 class="font-serif text-sm font-semibold text-[#163923]">Ultra-Fine Milled</h4>
                                <p class="text-xs text-[#677a6d] mt-0.5">Engineered for instantaneous liquid suspension.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 p-4 rounded-xl bg-white border border-[#e5decb] shadow-sm">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#e8f2ec] text-[#205132] font-serif font-bold text-xs">04</span>
                            <div>
                                <h4 class="font-serif text-sm font-semibold text-[#163923]">Nitrogen Sealed</h4>
                                <p class="text-xs text-[#677a6d] mt-0.5">Triple-barrier protection against oxidation.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Showcase Card -->
                <div class="lg:col-span-5">
                    <div class="rounded-2xl bg-white p-8 sm:p-10 border border-[#e5decb] shadow-lg space-y-6 text-center">
                        <div class="aspect-square overflow-hidden rounded-xl bg-[#f4f0e6] flex flex-col items-center justify-center p-8 border border-[#e5decb] space-y-3">
                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#205132] text-white text-3xl font-serif font-bold shadow-md">
                                E
                            </div>
                            <h3 class="font-serif text-2xl font-bold text-[#163923] pt-2">
                                The Clean-Label Standard
                            </h3>
                            <p class="text-xs sm:text-sm text-[#677a6d] max-w-xs leading-relaxed">
                                No synthetic additives, zero maltodextrin bulking agents, and 100% plant-based purity in every single jar.
                            </p>
                        </div>

                        <a
                            href="{{ route('shop.cms.page', 'quality') }}"
                            class="inline-flex w-full items-center justify-center gap-2 text-xs uppercase tracking-widest font-semibold py-3.5 rounded-full bg-[#205132] text-white hover:bg-[#163923] transition-colors"
                        >
                            <span>Read Quality Standard</span>
                            <span class="icon-arrow-right text-xs"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 9: JOURNAL & FIELD NOTES -->
    <section class="py-20 lg:py-28 bg-white border-b border-[#e5decb]">
        <div class="site-container">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                <div class="space-y-3">
                    <span class="elior-eyebrow">Journal & Field Notes</span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                        Botanical Research & Recipes
                    </h2>
                    <p class="text-xs sm:text-sm text-[#677a6d] max-w-lg leading-relaxed">
                        Insights into cold-dehydration science, botanical synergies, and functional recipes for your daily rituals.
                    </p>
                </div>

                <a
                    href="{{ route('shop.recipes.index') }}"
                    class="elior-btn-outline self-start md:self-auto !px-6 !py-3 text-xs"
                >
                    View All Recipes &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                @foreach ($featuredRecipes as $recipe)
                    <x-shop::recipes.card :recipe="$recipe" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION 10: EDITORIAL SOCIAL PROOF / COMMUNITY NOTES -->
    <section class="py-20 lg:py-28 bg-[#f4f0e6] border-b border-[#e5decb]">
        <div class="site-container">
            <div class="mx-auto max-w-3xl text-center space-y-4 mb-16">
                <span class="elior-eyebrow">Community Notes</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Elevating Daily Rituals
                </h2>
                <p class="text-xs sm:text-sm text-[#677a6d] max-w-lg mx-auto">
                    Verified botanical reviews from holistic nutritionists, herbal practitioners, and conscious consumers.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="p-8 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4 hover:border-[#205132]/40 transition-colors">
                    <div class="flex text-[#c9a25a] text-sm tracking-wider">★★★★★</div>
                    <p class="font-serif text-base italic text-[#163923] leading-relaxed">
                        "The purity of these cold-dehydrated powders is immediately noticeable. No chalky fillers or stevia aftertaste—just vibrant, authentic plant power."
                    </p>
                    <div class="pt-2 border-t border-[#e5decb] text-xs font-semibold text-[#677a6d]">
                        — Sarah L., Clinical Nutritionist
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="p-8 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4 hover:border-[#205132]/40 transition-colors">
                    <div class="flex text-[#c9a25a] text-sm tracking-wider">★★★★★</div>
                    <p class="font-serif text-base italic text-[#163923] leading-relaxed">
                        "I use the Lakadong Turmeric and Moringa in my morning tonics. The dissolvability without gums or silica anti-caking agents is truly unprecedented."
                    </p>
                    <div class="pt-2 border-t border-[#e5decb] text-xs font-semibold text-[#677a6d]">
                        — David M., Integrative Health Coach
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="p-8 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4 hover:border-[#205132]/40 transition-colors">
                    <div class="flex text-[#c9a25a] text-sm tracking-wider">★★★★★</div>
                    <p class="font-serif text-base italic text-[#163923] leading-relaxed">
                        "The transparency and batch testing give me total peace of mind. Knowing my adaptogens are vacuum-dried under 42°C makes all the difference."
                    </p>
                    <div class="pt-2 border-t border-[#e5decb] text-xs font-semibold text-[#677a6d]">
                        — Elena R., Herbalist & Founder
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 11: AS SEEN IN / PRESS & CERTIFICATIONS MARQUEE -->
    <section class="py-16 lg:py-20 bg-[#ece6d8] border-b border-[#e5decb] overflow-hidden">
        <div class="site-container">
            <div class="text-center mb-10">
                <span class="text-[11px] font-bold uppercase tracking-[0.25em] text-[#677a6d]">Trusted &amp; Certified</span>
            </div>
        </div>

        {{-- Scrolling Marquee --}}
        <div class="relative">
            <div class="flex animate-marquee whitespace-nowrap">
                @for ($i = 0; $i < 2; $i++)
                    <div class="flex items-center gap-16 px-8">
                        <span class="flex items-center gap-2.5 text-[#205132]/60 hover:text-[#205132] transition-colors">
                            <svg class="w-6 h-6 text-[#205132]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            <span class="font-serif text-xl font-bold tracking-wide">FSSAI Certified</span>
                        </span>
                        <span class="flex items-center gap-2.5 text-[#205132]/60 hover:text-[#205132] transition-colors">
                            <svg class="w-6 h-6 text-[#205132]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                            <span class="font-serif text-xl font-bold tracking-wide">100% Plant-Based</span>
                        </span>
                        <span class="flex items-center gap-2.5 text-[#205132]/60 hover:text-[#205132] transition-colors">
                            <svg class="w-6 h-6 text-[#205132]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                            <span class="font-serif text-xl font-bold tracking-wide">Heavy-Metal Tested</span>
                        </span>
                        <span class="flex items-center gap-2.5 text-[#205132]/60 hover:text-[#205132] transition-colors">
                            <svg class="w-6 h-6 text-[#205132]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="font-serif text-xl font-bold tracking-wide">Non-GMO</span>
                        </span>
                        <span class="flex items-center gap-2.5 text-[#205132]/60 hover:text-[#205132] transition-colors">
                            <svg class="w-6 h-6 text-[#205132]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                            <span class="font-serif text-xl font-bold tracking-wide">No Preservatives</span>
                        </span>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- SECTION 12: FAQ ACCORDION -->
    <section class="py-20 lg:py-28 bg-[#f4f0e6]">
        <div class="site-container">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                {{-- Left: Header --}}
                <div class="lg:col-span-4 space-y-4">
                    <span class="elior-eyebrow">Common Questions</span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-[2.75rem] font-bold tracking-tight text-[#163923] leading-tight">
                        Frequently Asked Questions
                    </h2>
                    <p class="text-sm text-[#677a6d] leading-relaxed">
                        Everything you need to know about our cold-dehydrated botanical formulations, sourcing, and daily use.
                    </p>
                    <a
                        href="{{ route('shop.home.contact_us') }}"
                        class="elior-btn-outline inline-flex !px-6 !py-3 text-xs mt-4"
                    >
                        Still Have Questions? Contact Us
                    </a>
                </div>

                {{-- Right: Accordion Cards --}}
                <div class="lg:col-span-8 space-y-4">
                    {{-- FAQ 1 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-white p-6 transition-all duration-300 open:border-[#205132]/40 open:shadow-md">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="pr-4">What does "cold-dehydrated" mean?</span>
                            <svg class="w-5 h-5 text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        </summary>
                        <div class="pt-4 text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb] mt-4">
                            Cold dehydration is a low-temperature vacuum drying process that removes moisture from whole foods at below 42°C. Unlike conventional spray-drying (which uses temperatures exceeding 150°C), this method preserves the food's living enzymes, natural pigmentation, aromatic compounds, and active phytonutrients — delivering nutrition as close to the raw botanical as possible.
                        </div>
                    </details>

                    {{-- FAQ 2 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-white p-6 transition-all duration-300 open:border-[#205132]/40 open:shadow-md">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="pr-4">How should I use ELIOR powders?</span>
                            <svg class="w-5 h-5 text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        </summary>
                        <div class="pt-4 text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb] mt-4">
                            Our micro-milled powders are designed for effortless daily integration. Mix 1 scoop (approximately 3–5 grams) into water, smoothies, morning oats, botanical lattes, soups, or yogurt. They dissolve instantly without clumping because we use zero anti-caking chemicals. Check our Recipes section for culinary inspiration and serving suggestions.
                        </div>
                    </details>

                    {{-- FAQ 3 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-white p-6 transition-all duration-300 open:border-[#205132]/40 open:shadow-md">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="pr-4">Are ELIOR products safe during pregnancy or breastfeeding?</span>
                            <svg class="w-5 h-5 text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        </summary>
                        <div class="pt-4 text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb] mt-4">
                            While our formulations contain only pure whole plant foods with zero synthetic additives, we always recommend consulting your healthcare provider before introducing any new supplement during pregnancy or breastfeeding. Certain botanicals like Ashwagandha may not be recommended during pregnancy.
                        </div>
                    </details>

                    {{-- FAQ 4 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-white p-6 transition-all duration-300 open:border-[#205132]/40 open:shadow-md">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="pr-4">What certifications do ELIOR products hold?</span>
                            <svg class="w-5 h-5 text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        </summary>
                        <div class="pt-4 text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb] mt-4">
                            All ELIOR formulations are FSSAI certified, manufactured in licensed facilities, and undergo rigorous third-party laboratory testing for heavy metals, pesticide residues, and microbial purity. We are 100% plant-based, non-GMO, and free from all synthetic additives.
                        </div>
                    </details>

                    {{-- FAQ 5 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-white p-6 transition-all duration-300 open:border-[#205132]/40 open:shadow-md">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="pr-4">How long do the powders last after opening?</span>
                            <svg class="w-5 h-5 text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        </summary>
                        <div class="pt-4 text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb] mt-4">
                            Our nitrogen-sealed packaging protects against oxidation and moisture. Once opened, we recommend consuming the powder within 90 days. Store in a cool, dry place away from direct sunlight with the lid tightly sealed. The dehydration process itself gives the product a shelf life of 12–18 months from manufacturing.
                        </div>
                    </details>

                    {{-- FAQ 6 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-white p-6 transition-all duration-300 open:border-[#205132]/40 open:shadow-md">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="pr-4">Do you offer free shipping?</span>
                            <svg class="w-5 h-5 text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        </summary>
                        <div class="pt-4 text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb] mt-4">
                            Yes! We offer free standard shipping on all orders above ₹499 across India. Orders are typically dispatched within 24–48 hours and delivered within 5–7 business days. Express shipping options are also available at checkout.
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </section>
</x-shop::layouts>
