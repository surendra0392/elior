<a
    href="{{ $card['url'] }}"
    target="_blank"
    rel="noopener noreferrer"
    class="group relative flex flex-col rounded-xl border border-gray-200 bg-white p-6 transition-all duration-200 hover:-translate-y-0.5 hover:border-[#205132]/20 hover:shadow-lg"
>
    <!-- External Link Indicator -->
    <span class="absolute right-5 top-5 text-gray-300 transition-colors group-hover:text-[#205132]">
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M7 17 17 7M9 7h8v8"></path>
        </svg>
    </span>

    <!-- Icon -->
    <span class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-[#205132]/10 text-[#205132] transition-colors group-hover:bg-[#205132] group-hover:text-white">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="{{ $card['icon'] }}"></path>
        </svg>
    </span>

    <!-- Title -->
    <p class="mb-2 text-lg font-bold !leading-snug text-gray-800">
        {{ $card['title'] }}
    </p>

    <!-- Description -->
    <p class="!leading-relaxed text-gray-600">
        {{ $card['info'] }}
    </p>

    <!-- Footer host -->
    <span class="mt-5 border-t border-gray-100 pt-4 text-sm font-medium text-gray-400 transition-colors group-hover:text-[#205132]">
        {{ $card['host'] }}
    </span>
</a>
