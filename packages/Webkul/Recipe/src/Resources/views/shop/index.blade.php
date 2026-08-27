@inject('recipeRepository', 'Webkul\Recipe\Repositories\RecipeRepository')

@php
    $recipes = $recipeRepository->getModel()
        ->where('status', 1)
        ->orderBy('id', 'asc')
        ->paginate(9);
@endphp

@push('meta')
    <meta name="title" content="Botanical Recipes & Daily Rituals | ELIOR Pure Plant Nutrition" />
    <meta name="description" content="Discover whole food recipes, cold-stirred tonics, morning smoothies, and adaptogenic breakfast bowls crafted with ELIOR cold-dehydrated botanical powders." />
    <meta name="keywords" content="botanical recipes, superfood smoothie recipes, turmeric golden milk, moringa smoothies, amla cooler, elior daily rituals" />
    <meta property="og:title" content="Botanical Recipes & Daily Rituals | ELIOR Pure Plant Nutrition" />
    <meta property="og:description" content="Discover whole food recipes, cold-stirred tonics, morning smoothies, and adaptogenic breakfast bowls crafted with ELIOR cold-dehydrated botanical powders." />
@endpush

<x-shop::layouts>
    <x-slot:title>
        Botanical Recipes & Daily Rituals | ELIOR
    </x-slot>

    <div class="bg-[#f4f0e6] min-h-screen pb-24">
        <!-- Breadcrumbs -->
        <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
            <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-[#677a6d]">
                <a href="{{ route('shop.home.index') }}" class="hover:text-[#205132] transition-colors">Home</a>
                <span class="text-[#e5decb]">/</span>
                <span class="text-[#163923] font-semibold">Recipes & Daily Rituals</span>
            </nav>
        </div>

        <!-- Editorial Hero Section -->
        <section class="site-container pt-8 pb-12 sm:pt-14 sm:pb-16 text-center max-w-4xl mx-auto space-y-4">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8f2ec] text-[#205132] text-xs font-bold tracking-widest uppercase border border-[#205132]/20">
                <span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">spa</span>
                <span>ELIOR Botanical Kitchen</span>
            </div>

            <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#163923] leading-[1.12]">
                Recipes & Daily Rituals
            </h1>

            <p class="text-sm sm:text-base md:text-lg text-[#677a6d] leading-relaxed max-w-2xl mx-auto font-sans">
                Practical whole food culinary ideas, cold-stirred morning tonics, and restorative drink preparations crafted to incorporate ELIOR pure botanicals seamlessly into your everyday wellness routine.
            </p>
        </section>

        <!-- Main Recipe Catalog Grid -->
        <main class="site-container max-w-7xl mx-auto pb-12 space-y-12">
            @if ($recipes->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($recipes as $recipe)
                        <x-shop::recipes.card :recipe="$recipe" />
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($recipes->hasPages())
                    <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-[#e5decb]">
                        <p class="text-xs text-[#677a6d] tracking-wide">
                            Showing <span class="font-semibold text-[#163923]">{{ $recipes->firstItem() }}</span> to <span class="font-semibold text-[#163923]">{{ $recipes->lastItem() }}</span> of <span class="font-semibold text-[#163923]">{{ $recipes->total() }}</span> botanical recipes
                        </p>

                        <div class="flex items-center gap-2">
                            {{-- Previous Page Link --}}
                            @if ($recipes->onFirstPage())
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#e5decb] bg-white/50 text-[#677a6d]/40 cursor-not-allowed select-none">
                                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                                </span>
                            @else
                                <a
                                    href="{{ $recipes->previousPageUrl() }}"
                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#e5decb] bg-white text-[#163923] hover:bg-[#205132] hover:text-white hover:border-[#205132] transition-all duration-200 shadow-sm"
                                    aria-label="Previous Page"
                                >
                                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($recipes->getUrlRange(1, $recipes->lastPage()) as $pageNumber => $url)
                                @if ($pageNumber == $recipes->currentPage())
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#205132] text-white font-serif font-bold text-sm shadow-sm select-none">
                                        {{ $pageNumber }}
                                    </span>
                                @else
                                    <a
                                        href="{{ $url }}"
                                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#e5decb] bg-white text-[#163923] hover:bg-[#205132] hover:text-white hover:border-[#205132] transition-all duration-200 font-serif font-semibold text-sm shadow-sm"
                                    >
                                        {{ $pageNumber }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($recipes->hasMorePages())
                                <a
                                    href="{{ $recipes->nextPageUrl() }}"
                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#e5decb] bg-white text-[#163923] hover:bg-[#205132] hover:text-white hover:border-[#205132] transition-all duration-200 shadow-sm"
                                    aria-label="Next Page"
                                >
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            @else
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#e5decb] bg-white/50 text-[#677a6d]/40 cursor-not-allowed select-none">
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-20 bg-white rounded-3xl border border-[#e5decb] max-w-xl mx-auto p-8 space-y-4">
                    <span class="material-symbols-outlined text-4xl text-[#205132]/60">spa</span>
                    <h3 class="font-serif text-2xl font-bold text-[#163923]">No Recipes Found</h3>
                    <p class="text-sm text-[#677a6d]">We are curating fresh seasonal botanical recipes. Please check back shortly.</p>
                </div>
            @endif
        </main>
    </div>
</x-shop::layouts>
