@php
    use Webkul\CMS\Models\Page;

    $content = $page->html_content ?? '';
    $readingTime = ceil(max(1, str_word_count(strip_tags($content)) / 200));

    // Fetch related recipes
    $relatedRecipes = Page::whereHas('channels', function ($query) {
            $query->where('channels.id', core()->getCurrentChannel()->id);
        })
        ->where('id', '!=', $page->id)
        ->whereHas('translations', function ($query) {
            $query->where('url_key', 'LIKE', 'recipe-%')
                  ->orWhere('url_key', 'LIKE', 'recipes/%');
        })
        ->take(4)
        ->get();
@endphp

<div class="bg-[#f4f0e6] min-h-screen">
    @if (core()->getConfigData('general.general.breadcrumbs.shop'))
        <!-- Breadcrumbs -->
        <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
            <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-[#677a6d]">
                <a href="{{ route('shop.home.index') }}" class="hover:text-[#205132] transition-colors">Home</a>
                <span class="text-[#e5decb]">/</span>
                <a href="{{ route('shop.cms.page', 'recipes') }}" class="hover:text-[#205132] transition-colors">Recipes</a>
                <span class="text-[#e5decb]">/</span>
                <span class="text-[#163923] font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $page->page_title }}</span>
            </nav>
        </div>
    @endif

    <!-- Article Header & Reading Column -->
    <article class="site-container pt-8 pb-20 space-y-10">
        <!-- Article Header -->
        <header class="space-y-4 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#e8f2ec] text-[#205132] text-[10px] sm:text-xs font-bold tracking-widest uppercase">
                <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span></span>
                <span>Botanical Recipe</span>
            </div>

            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923] leading-[1.15]">
                {{ $page->page_title }}
            </h1>

            <div class="flex items-center justify-center gap-3 text-xs text-[#677a6d] font-medium pt-1">
                <span>{{ $readingTime }} min read</span>
                <span class="text-[#c9a25a]">•</span>
                <span>Whole Food Preparation</span>
            </div>

            @if ($page->meta_description)
                <p class="text-base sm:text-lg text-[#163923]/80 leading-relaxed font-serif italic pt-2 max-w-2xl mx-auto">
                    {{ $page->meta_description }}
                </p>
            @endif
        </header>

        <!-- Article Body Content Container -->
        <div class="rounded-3xl border border-[#e5decb] bg-white p-6 sm:p-10 lg:p-12 shadow-sm space-y-8 max-w-5xl mx-auto">
            <div class="prose prose-stone max-w-none text-[#163923] leading-relaxed font-sans text-sm sm:text-base [&_h2]:font-serif [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:text-[#163923] [&_h2]:mt-8 [&_h2]:mb-4 [&_h2]:pb-2 [&_h2]:border-b [&_h2]:border-[#e5decb] [&_h3]:font-serif [&_h3]:text-lg [&_h3]:font-semibold [&_h3]:text-[#163923] [&_h3]:mt-6 [&_h3]:mb-3 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-2 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:space-y-2 [&_li]:text-sm [&_p]:text-sm [&_p]:leading-relaxed [&_blockquote]:border-l-4 [&_blockquote]:border-[#205132] [&_blockquote]:bg-[#f4f0e6] [&_blockquote]:p-4 [&_blockquote]:rounded-r-xl [&_blockquote]:italic">
                {!! $page->html_content !!}
            </div>

            <!-- Back to Recipes Link -->
            <div class="pt-8 border-t border-elior-border/70 flex items-center justify-between">
                <a
                    href="{{ route('shop.cms.page', 'recipes') }}"
                    class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-elior-botanical hover:text-elior-botanicalDark transition-colors"
                >
                    <span class="icon-arrow-left text-xs"></span>
                    <span>All Recipes</span>
                </a>

                <a
                    href="{{ route('shop.search.index') }}"
                    class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-elior-charcoal hover:text-elior-botanical transition-colors"
                >
                    <span>Explore Products</span>
                    <span class="icon-arrow-right text-xs"></span>
                </a>
            </div>
        </div>

        <!-- Related Recipes Section -->
        @if ($relatedRecipes->isNotEmpty())
            <section class="pt-8 space-y-6">
                <div class="flex items-center justify-between border-b border-elior-border/70 pb-4">
                    <h3 class="font-serif text-2xl font-bold text-elior-charcoal">
                        More Botanical Recipes
                    </h3>
                    <a
                        href="{{ route('shop.cms.page', 'recipes') }}"
                        class="text-xs font-semibold uppercase tracking-wider text-elior-botanical hover:underline"
                    >
                        View All
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($relatedRecipes as $rel)
                        <x-shop::recipes.card :recipe="$rel" />
                    @endforeach
                </div>
            </section>
        @endif
    </article>
</div>
