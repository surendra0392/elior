@php
    use Webkul\CMS\Models\Page;

    $currentPage = (int) request()->query('page', 1);

    $recipes = Page::whereHas('translations', function ($query) {
            $query->where('url_key', 'LIKE', 'recipe-%')
                  ->orWhere('url_key', 'LIKE', 'recipes/%');
        })
        ->orderBy('id', 'asc')
        ->paginate(6, ['*'], 'page', $currentPage);
@endphp

<div class="bg-[#f4f0e6] min-h-screen">
    <!-- Breadcrumbs -->
    <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
        <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-[#677a6d]">
            <a href="{{ route('shop.home.index') }}" class="hover:text-[#205132] transition-colors">Home</a>
            <span class="text-[#e5decb]">/</span>
            <span class="text-[#163923] font-semibold">Recipes</span>
        </nav>
    </div>

    <!-- Editorial Hero Section -->
    <section class="site-container pt-8 pb-12 sm:pt-12 sm:pb-16 text-center max-w-4xl mx-auto space-y-4">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#e8f2ec] text-[#205132] text-[10px] sm:text-xs font-bold tracking-widest uppercase border border-[#205132]/20">
            <span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">spa</span>
            <span>ELIOR Botanical Kitchen</span>
        </div>

        <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923] leading-[1.12]">
            Recipes & Daily Rituals
        </h1>

        <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed max-w-2xl mx-auto font-sans">
            Practical whole food culinary ideas, cold-stirred morning tonics, and restorative drink preparations crafted to incorporate ELIOR pure botanicals seamlessly into your everyday wellness routine.
        </p>
    </section>

    <!-- Main Content Area -->
    <main class="site-container pb-20 space-y-12">
        @if ($recipes->isNotEmpty())
            <!-- Recipe Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach ($recipes as $recipe)
                    <x-shop::recipes.card :recipe="$recipe" />
                @endforeach
            </div>

            <!-- Dynamic Botanical Pagination -->
            @if ($recipes->hasPages())
                <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-elior-border/80">
                    <p class="text-xs text-elior-muted tracking-wide">
                        Showing <span class="font-semibold text-elior-charcoal">{{ $recipes->firstItem() }}</span> to <span class="font-semibold text-elior-charcoal">{{ $recipes->lastItem() }}</span> of <span class="font-semibold text-elior-charcoal">{{ $recipes->total() }}</span> botanical recipes
                    </p>

                    <div class="flex items-center gap-2">
                        {{-- Previous Page Link --}}
                        @if ($recipes->onFirstPage())
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl border border-elior-border/60 bg-white/50 text-elior-muted/40 cursor-not-allowed select-none">
                                <span class="material-symbols-outlined text-sm">arrow_back</span>
                            </span>
                        @else
                            <a
                                href="{{ $recipes->previousPageUrl() }}"
                                class="flex h-10 w-10 items-center justify-center rounded-xl border border-elior-border bg-white text-elior-charcoal hover:bg-elior-botanical hover:text-white hover:border-elior-botanical transition-all duration-200 shadow-sm"
                                aria-label="Previous Page"
                            >
                                <span class="material-symbols-outlined text-sm">arrow_back</span>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($recipes->getUrlRange(1, $recipes->lastPage()) as $pageNumber => $url)
                            @if ($pageNumber == $recipes->currentPage())
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-elior-botanical text-white font-serif font-bold text-sm shadow-sm select-none">
                                    {{ $pageNumber }}
                                </span>
                            @else
                                <a
                                    href="{{ $url }}"
                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-elior-border bg-white text-elior-charcoal hover:bg-elior-botanical hover:text-white hover:border-elior-botanical transition-all duration-200 font-serif font-semibold text-sm shadow-sm"
                                >
                                    {{ $pageNumber }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($recipes->hasMorePages())
                            <a
                                href="{{ $recipes->nextPageUrl() }}"
                                class="flex h-10 w-10 items-center justify-center rounded-xl border border-elior-border bg-white text-elior-charcoal hover:bg-elior-botanical hover:text-white hover:border-elior-botanical transition-all duration-200 shadow-sm"
                                aria-label="Next Page"
                            >
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        @else
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl border border-elior-border/60 bg-white/50 text-elior-muted/40 cursor-not-allowed select-none">
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <!-- Editorial Restrained Empty State -->
            <section class="rounded-3xl border border-elior-border/80 bg-white p-8 sm:p-14 lg:p-20 text-center max-w-3xl mx-auto shadow-elior-subtle space-y-6">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#FAF8F5] border border-elior-border text-2xl">
                    <span class="material-symbols-outlined text-2xl text-elior-botanical">emoji_food_beverage</span>
                </div>

                <div class="space-y-2.5">
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-elior-charcoal">
                        Recipes Coming Soon
                    </h2>
                    <p class="text-sm text-elior-muted leading-relaxed max-w-lg mx-auto">
                        We are currently documenting authentic culinary preparations, cold-stirred morning tonics, and superblend smoothie rituals. Check back soon for step-by-step guides.
                    </p>
                </div>

                <div class="pt-2">
                    <a
                        href="{{ route('shop.product_or_category.index', 'products') }}"
                        class="elior-btn-primary inline-flex items-center gap-2 text-xs uppercase tracking-widest font-semibold px-7 py-3.5 shadow-elior-card"
                    >
                        <span>Explore Botanicals</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </section>
        @endif
    </main>
</div>
