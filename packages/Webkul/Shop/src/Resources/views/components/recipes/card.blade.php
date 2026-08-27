@props(['recipe'])

@php
    $urlKey = $recipe->url_key ?? $recipe->slug ?? '';
    // Ensure URL matches route
    $url = route('shop.recipes.view', $urlKey);
    $title = $recipe->name ?? $recipe->page_title ?? $recipe->title ?? '';
    $description = $recipe->description ?? $recipe->meta_description ?? '';
    $prepTime = $recipe->prep_time ?? 5;
    $difficulty = $recipe->difficulty ?? 1;
    $difficultyText = $difficulty == 1 ? 'Easy' : ($difficulty == 2 ? 'Medium' : 'Advanced');
    
    $image = $recipe->featured_image ?? $recipe->image ?? null;
    if (! $image && ! empty($recipe->html_content) && preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $recipe->html_content, $matches)) {
        $image = $matches[1];
        $image = str_replace(['/storage/', 'storage/'], '', $image);
    }
@endphp

<article class="group flex flex-col h-full rounded-2xl border border-[#e5decb] bg-white overflow-hidden shadow-sm hover:shadow-lg hover:border-[#205132]/40 transition-all duration-300">
    <!-- Card Image Stage -->
    <a
        href="{{ $url }}"
        class="relative block aspect-[16/10] w-full overflow-hidden bg-[#f4f0e6]"
        aria-label="{{ $title }}"
    >
        @if ($image)
            <img
                src="{{ Storage::url($image) }}"
                alt="{{ $title }}"
                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                loading="lazy"
            />
        @else
            <div class="flex h-full w-full flex-col items-center justify-center p-6 text-center bg-[#f4f0e6]">
                <span class="material-symbols-outlined text-3xl mb-2 text-[#205132]/60" style="font-variation-settings: 'FILL' 1;">eco</span>
                <span class="font-serif text-sm font-semibold text-[#163923] tracking-wide">
                    ELIOR Botanical Recipe
                </span>
            </div>
        @endif

        <!-- Card Header Badges (Clean Non-Overlapping Header Strip) -->
        <div class="absolute top-3 left-3 right-3 flex items-center justify-between pointer-events-none gap-2" style="top: 0.75rem; left: 0.75rem; right: 0.75rem;">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#205132] text-white shadow-sm shrink-0">
                Botanical Ritual
            </span>

            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/95 text-[#163923] shadow-sm backdrop-blur-sm border border-[#e5decb]/60 shrink-0" style="background-color: rgba(255, 255, 255, 0.95); color: #163923;">
                {{ $difficultyText }}
            </span>
        </div>
    </a>

    <!-- Content Details -->
    <div class="flex flex-1 flex-col justify-between p-5 sm:p-6 space-y-4">
        <div class="space-y-2.5">
            <!-- Preparation Timing Strip -->
            <div class="flex items-center gap-2 text-[11px] font-semibold uppercase tracking-wider text-[#677a6d]">
                <span class="material-symbols-outlined text-[14px] text-[#205132]">schedule</span>
                <span>{{ $prepTime }} min prep</span>
                <span class="text-[#c9a25a]">•</span>
                <span>Whole Food</span>
            </div>

            <!-- Title -->
            <h3 class="font-serif text-xl sm:text-2xl font-bold tracking-tight text-[#163923] group-hover:text-[#205132] transition-colors line-clamp-2 leading-snug">
                <a href="{{ $url }}">
                    {{ $title }}
                </a>
            </h3>

            <!-- Excerpt -->
            @if ($description)
                <p class="text-xs sm:text-sm text-[#677a6d] leading-relaxed line-clamp-2">
                    {{ $description }}
                </p>
            @endif
        </div>

        <!-- Card Footer / Link -->
        <div class="pt-3 border-t border-[#e5decb] flex items-center justify-between">
            <a
                href="{{ $url }}"
                class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest text-[#205132] group-hover:text-[#163923] transition-colors"
            >
                <span>Read Recipe</span>
                <span class="icon-arrow-right text-xs transition-transform duration-200 group-hover:translate-x-1"></span>
            </a>
        </div>
    </div>
</article>
