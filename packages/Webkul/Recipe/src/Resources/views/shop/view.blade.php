@inject('recipeRepository', 'Webkul\Recipe\Repositories\RecipeRepository')

@php
    $readingTime = ceil(max(1, (count($recipe->ingredients ?? []) * 0.5) + (count($recipe->instructions ?? []) * 1)));
    
    // Fetch related recipes
    $relatedRecipes = $recipeRepository->getModel()
        ->where('id', '!=', $recipe->id)
        ->where('status', 1)
        ->take(3)
        ->get();

    $linkedProducts = $recipe->products;

    // Structured Data for Google Rich Snippets
    $schemaData = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Recipe',
        'name'        => $recipe->name,
        'image'       => $recipe->featured_image ? [Storage::url($recipe->featured_image)] : [],
        'description' => $recipe->description,
        'prepTime'    => 'PT' . ($recipe->prep_time ?? 5) . 'M',
        'cookTime'    => 'PT' . ($recipe->cook_time ?? 0) . 'M',
        'totalTime'   => 'PT' . (($recipe->prep_time ?? 5) + ($recipe->cook_time ?? 0)) . 'M',
        'recipeYield' => ($recipe->servings ?? 1) . ' serving',
        'recipeCategory' => 'Beverage & Tonic',
        'recipeCuisine'  => 'Botanical Whole Food',
        'recipeIngredient' => $recipe->ingredients ?? [],
        'recipeInstructions' => array_map(function ($step, $i) {
            return [
                '@type' => 'HowToStep',
                'position' => $i + 1,
                'text'  => $step,
            ];
        }, $recipe->instructions ?? [], array_keys($recipe->instructions ?? [])),
    ];
@endphp

@push('meta')
    <meta name="title" content="{{ $recipe->meta_title ?? $recipe->name }}" />
    <meta name="description" content="{{ $recipe->meta_description ?? $recipe->description }}" />
    @if ($recipe->meta_keywords)
        <meta name="keywords" content="{{ $recipe->meta_keywords }}" />
    @endif
    <meta property="og:title" content="{{ $recipe->meta_title ?? $recipe->name }}" />
    <meta property="og:description" content="{{ $recipe->meta_description ?? $recipe->description }}" />
    @if ($recipe->featured_image)
        <meta property="og:image" content="{{ Storage::url($recipe->featured_image) }}" />
    @endif
    
    <script type="application/ld+json">
        {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

<x-shop::layouts>
    <x-slot:title>
        {{ $recipe->meta_title ?? $recipe->name }}
    </x-slot>

    <div class="bg-[#f4f0e6] min-h-screen pb-24">
        <!-- Breadcrumbs -->
        <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
            <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-[#677a6d]">
                <a href="{{ route('shop.home.index') }}" class="hover:text-[#205132] transition-colors">Home</a>
                <span class="text-[#e5decb]">/</span>
                <a href="{{ route('shop.recipes.index') }}" class="hover:text-[#205132] transition-colors">Recipes & Rituals</a>
                <span class="text-[#e5decb]">/</span>
                <span class="text-[#163923] font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $recipe->name }}</span>
            </nav>
        </div>

        <main class="site-container max-w-6xl mx-auto pt-6 space-y-12">
            <!-- Article Header -->
            <header class="text-center max-w-3xl mx-auto space-y-5">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#e8f2ec] text-[#205132] text-[10px] sm:text-xs font-bold tracking-widest uppercase border border-[#205132]/20">
                    <span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">spa</span>
                    <span>ELIOR Botanical Kitchen</span>
                </div>

                <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#163923] leading-[1.12]">
                    {{ $recipe->name }}
                </h1>

                @if ($recipe->description)
                    <p class="text-sm sm:text-base md:text-lg text-[#677a6d] leading-relaxed max-w-2xl mx-auto font-sans">
                        {{ $recipe->description }}
                    </p>
                @endif

                <!-- Metadata Metrics Strip -->
                <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 pt-2">
                    <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full border border-[#e5decb] shadow-sm text-xs font-semibold text-[#163923]">
                        <span class="material-symbols-outlined text-[#205132] text-[18px]">schedule</span>
                        <span>Prep: {{ $recipe->prep_time ?? 5 }} mins</span>
                    </div>

                    @if ($recipe->cook_time)
                        <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full border border-[#e5decb] shadow-sm text-xs font-semibold text-[#163923]">
                            <span class="material-symbols-outlined text-[#c2613f] text-[18px]">local_fire_department</span>
                            <span>Cook: {{ $recipe->cook_time }} mins</span>
                        </div>
                    @endif

                    <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full border border-[#e5decb] shadow-sm text-xs font-semibold text-[#163923]">
                        <span class="material-symbols-outlined text-[#205132] text-[18px]">restaurant</span>
                        <span>Serves: {{ $recipe->servings ?? 1 }}</span>
                    </div>

                    <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full border border-[#e5decb] shadow-sm text-xs font-semibold text-[#163923]">
                        <span class="material-symbols-outlined text-[#205132] text-[18px]">signal_cellular_alt</span>
                        <span>{{ $recipe->difficulty == 1 ? 'Easy' : ($recipe->difficulty == 2 ? 'Medium' : 'Advanced') }}</span>
                    </div>
                </div>
            </header>

            <!-- Hero Image Stage -->
            @if ($recipe->featured_image)
                <div class="w-full aspect-[16/9] sm:aspect-[21/9] rounded-3xl overflow-hidden shadow-sm border border-[#e5decb] bg-white">
                    <img
                        src="{{ Storage::url($recipe->featured_image) }}"
                        alt="{{ $recipe->name }}"
                        class="w-full h-full object-cover"
                    />
                </div>
            @endif

            <!-- Main 2-Column Content Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                <!-- Left Column: Ingredients & Featured Products (Sticky Sidebar) -->
                <aside class="lg:col-span-5 space-y-6 lg:sticky lg:top-24">
                    <!-- Ingredients Card -->
                    <div class="rounded-2xl border border-[#e5decb] bg-white p-6 sm:p-8 shadow-sm space-y-6">
                        <div class="flex items-center justify-between pb-4 border-b border-[#e5decb]">
                            <div class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-[#205132] text-2xl">grocery</span>
                                <h2 class="font-serif text-2xl font-bold text-[#163923]">
                                    Ingredients
                                </h2>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-[#677a6d] bg-[#f4f0e6] px-2.5 py-1 rounded-full">
                                {{ count($recipe->ingredients ?? []) }} Items
                            </span>
                        </div>

                        <ul class="space-y-3.5">
                            @if (! empty($recipe->ingredients) && is_array($recipe->ingredients))
                                @foreach ($recipe->ingredients as $ingredient)
                                    <li class="flex items-start gap-3 text-sm text-[#163923]/90 leading-snug group">
                                        <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#e8f2ec] text-[#205132] mt-0.5 group-hover:bg-[#205132] group-hover:text-white transition-colors">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        <span class="pt-0.5">{{ $ingredient }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-xs text-[#677a6d] italic">No ingredients listed.</li>
                            @endif
                        </ul>
                    </div>

                    <!-- Linked ELIOR Formulations / Products Card -->
                    @if ($linkedProducts->isNotEmpty())
                        <div class="rounded-2xl border border-[#205132]/25 bg-[#e8f2ec] p-6 sm:p-7 space-y-4">
                            <div class="space-y-1">
                                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#205132]">Featured Botanical</span>
                                <h3 class="font-serif text-xl font-bold text-[#163923]">Elevate this Ritual</h3>
                                <p class="text-xs text-[#677a6d] leading-relaxed">
                                    Crafted with our cold-dehydrated whole plant powders.
                                </p>
                            </div>

                            <div class="space-y-3 pt-2">
                                @foreach ($linkedProducts as $product)
                                    @php
                                        $productFlat = $product->product_flats->firstWhere('locale', app()->getLocale()) ?? $product->product_flats->first();
                                        $productUrl = route('shop.product_or_category.index', $productFlat->url_key ?? $product->url_key ?? '');
                                        $productImg = $product->base_image_url ?? null;
                                        if (! $productImg && $product->images->isNotEmpty()) {
                                            $productImg = Storage::url($product->images->first()->path);
                                        }
                                    @endphp

                                    <div class="flex items-center gap-4 bg-white p-3.5 rounded-xl border border-[#e5decb] shadow-sm hover:border-[#205132]/50 transition-all">
                                        <a href="{{ $productUrl }}" class="shrink-0 w-14 h-14 rounded-lg overflow-hidden bg-[#f4f0e6]">
                                            @if ($productImg)
                                                <img src="{{ $productImg }}" alt="{{ $productFlat->name ?? $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[#205132]/40">
                                                    <span class="material-symbols-outlined text-lg">eco</span>
                                                </div>
                                            @endif
                                        </a>

                                        <div class="flex-1 min-w-0">
                                            <a href="{{ $productUrl }}" class="block font-serif text-sm font-bold text-[#163923] hover:text-[#205132] truncate transition-colors">
                                                {{ $productFlat->name ?? $product->name }}
                                            </a>
                                            <p class="text-[11px] text-[#677a6d] truncate mt-0.5">
                                                100% Pure Whole Plant Matter
                                            </p>
                                            <a href="{{ $productUrl }}" class="inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-[#205132] hover:text-[#163923] mt-1.5 transition-colors">
                                                <span>Shop Formulation</span>
                                                <span class="icon-arrow-right text-[9px]"></span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>

                <!-- Right Column: Preparation Steps & Culinary Wisdom -->
                <div class="lg:col-span-7 space-y-8">
                    <!-- Steps Card -->
                    <div class="rounded-2xl border border-[#e5decb] bg-white p-6 sm:p-10 shadow-sm space-y-8">
                        <div class="flex items-center gap-3 pb-4 border-b border-[#e5decb]">
                            <span class="material-symbols-outlined text-[#205132] text-2xl">blender</span>
                            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#163923]">
                                Preparation Method
                            </h2>
                        </div>

                        <ol class="space-y-6 sm:space-y-8">
                            @if (! empty($recipe->instructions) && is_array($recipe->instructions))
                                @foreach ($recipe->instructions as $index => $step)
                                    <li class="flex gap-4 sm:gap-6 items-start">
                                        <div class="shrink-0 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-2xl bg-[#f4f0e6] border border-[#e5decb] text-[#205132] font-serif font-bold text-base sm:text-lg shadow-sm">
                                            {{ sprintf('%02d', $index + 1) }}
                                        </div>
                                        <div class="pt-1.5 sm:pt-2">
                                            <p class="text-sm sm:text-base leading-relaxed text-[#163923] font-sans">
                                                {{ $step }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-xs text-[#677a6d] italic">No instructions listed.</li>
                            @endif
                        </ol>
                    </div>

                    <!-- Botanical Wisdom Callout -->
                    <div class="rounded-2xl border border-[#e5decb] bg-[#FAF8F5] p-6 sm:p-8 space-y-3 shadow-sm">
                        <div class="flex items-center gap-2 text-[#205132] text-xs font-bold uppercase tracking-wider">
                            <span class="material-symbols-outlined text-base">info</span>
                            <span>The Cold-Processed Difference</span>
                        </div>
                        <p class="text-xs sm:text-sm text-[#677a6d] leading-relaxed">
                            ELIOR powders are micro-milled and cold-dehydrated below 42°C. When preparing warm lattes or elixirs, add powders after heating liquids to preserve heat-sensitive enzymes, natural pigments, and vital polyphenols.
                        </p>
                    </div>

                    <!-- Navigation Footer Strip -->
                    <div class="pt-6 flex items-center justify-between border-t border-[#e5decb]">
                        <a
                            href="{{ route('shop.recipes.index') }}"
                            class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#205132] hover:text-[#163923] transition-colors"
                        >
                            <span class="icon-arrow-left text-xs"></span>
                            <span>All Recipes</span>
                        </a>

                        <a
                            href="{{ route('shop.search.index') }}"
                            class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#163923] hover:text-[#205132] transition-colors"
                        >
                            <span>Browse Botanicals</span>
                            <span class="icon-arrow-right text-xs"></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Recipes Section -->
            @if ($relatedRecipes->isNotEmpty())
                <section class="pt-12 space-y-8 border-t border-[#e5decb]">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#205132]">More Inspirations</span>
                            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#163923]">
                                Explore More Daily Rituals
                            </h2>
                        </div>
                        <a
                            href="{{ route('shop.recipes.index') }}"
                            class="elior-btn-outline !px-5 !py-2.5 text-xs font-bold"
                        >
                            View All Recipes &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                        @foreach ($relatedRecipes as $relRecipe)
                            <x-shop::recipes.card :recipe="$relRecipe" />
                        @endforeach
                    </div>
                </section>
            @endif
        </main>
    </div>
</x-shop::layouts>
