<x-shop::layouts
    :has-header="true"
    :has-feature="false"
    :has-footer="true"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang("shop::app.errors.{$errorCode}.title") | ELIOR
    </x-slot>

    <div class="bg-elior-cream min-h-[calc(100vh-160px)] flex items-center justify-center">
        <main class="site-container py-16 sm:py-24 text-center space-y-6">
            <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#EBF3EE] text-elior-botanical text-xs font-semibold tracking-widest uppercase">
                <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span></span>
                <span>Error {{ $errorCode }}</span>
            </div>

            <div class="space-y-3 max-w-lg mx-auto">
                <h1 class="font-serif text-3xl sm:text-5xl font-bold tracking-tight text-elior-charcoal">
                    @lang("shop::app.errors.{$errorCode}.title")
                </h1>

                <p class="text-sm sm:text-base text-elior-muted leading-relaxed">
                    {{ 
                        $errorCode === 503 && core()->getCurrentChannel()->maintenance_mode_text != ""
                        ? core()->getCurrentChannel()->maintenance_mode_text : trans("shop::app.errors.{$errorCode}.description")
                    }}
                </p>
            </div>

            <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                <a 
                    href="{{ route('shop.home.index') }}"
                    class="elior-btn-primary h-12 px-8 text-xs uppercase tracking-widest font-semibold inline-flex items-center gap-2 shadow-elior-card"
                >
                    <span>@lang('shop::app.errors.go-to-home')</span>
                    <span class="icon-arrow-right text-xs"></span>
                </a>

                <a 
                    href="{{ route('shop.search.index') }}"
                    class="elior-btn-outline h-12 px-8 text-xs uppercase tracking-widest font-semibold inline-flex items-center gap-2"
                >
                    <span>Explore Products</span>
                </a>
            </div>
        </main>
    </div>
</x-shop::layouts>