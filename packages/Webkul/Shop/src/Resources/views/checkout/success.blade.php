<x-shop::layouts
    :has-header="true"
    :has-feature="false"
    :has-footer="true"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.checkout.success.thanks') | ELIOR
    </x-slot>

    <div class="bg-elior-cream min-h-[calc(100vh-80px)]">
        <!-- Page content -->
        <main class="site-container py-12 lg:py-20">
            <div class="rounded-3xl border border-elior-border/80 bg-white p-8 sm:p-14 lg:p-16 text-center max-w-2xl mx-auto shadow-elior-subtle space-y-6">
                {{ view_render_event('bagisto.shop.checkout.success.image.before', ['order' => $order]) }}

                <!-- Success Badge -->
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#EBF3EE] border border-elior-botanical/40 text-2xl text-elior-botanical font-bold select-none">
                    <span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">check</span>
                </div>

                {{ view_render_event('bagisto.shop.checkout.success.image.after', ['order' => $order]) }}

                <div class="space-y-2">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EBF3EE] text-elior-botanical text-[10px] sm:text-xs font-semibold tracking-widest uppercase">
                        <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span></span>
                        <span>Order Confirmed</span>
                    </div>

                    <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight text-elior-charcoal">
                        @lang('shop::app.checkout.success.thanks')
                    </h1>

                    <p class="text-sm sm:text-base font-semibold text-elior-botanical pt-1">
                        @if (auth()->guard('customer')->user())
                            @lang('shop::app.checkout.success.order-id-info', [
                                'order_id' => '<a class="underline hover:text-elior-botanicalDark" href="'.route('shop.customers.account.orders.view', $order->id).'">#'.$order->increment_id.'</a>'
                            ])
                        @else
                            Order #{{ $order->increment_id }}
                        @endif
                    </p>

                    <p class="text-xs sm:text-sm text-elior-muted leading-relaxed max-w-md mx-auto pt-2">
                        @if (! empty($order->checkout_message))
                            {!! nl2br($order->checkout_message) !!}
                        @else
                            A confirmation receipt has been dispatched to <strong>{{ $order->customer_email }}</strong>. Your pure botanical batch is being prepared for fresh dispatch.
                        @endif
                    </p>
                </div>

                {{ view_render_event('bagisto.shop.checkout.success.continue-shopping.before', ['order' => $order]) }}

                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a
                        href="{{ route('shop.home.index') }}"
                        class="elior-btn-primary w-full sm:w-auto inline-flex items-center justify-center gap-2 text-xs uppercase tracking-widest font-semibold px-8 py-3.5 shadow-elior-card"
                    >
                        <span>@lang('shop::app.checkout.cart.index.continue-shopping')</span>
                        <span class="icon-arrow-right text-xs"></span>
                    </a>

                    @if (auth()->guard('customer')->user())
                        <a
                            href="{{ route('shop.customers.account.orders.view', $order->id) }}"
                            class="elior-btn-outline w-full sm:w-auto inline-flex items-center justify-center gap-2 text-xs uppercase tracking-widest font-semibold px-7 py-3.5"
                        >
                            <span>View Order Status</span>
                        </a>
                    @endif
                </div>

                {{ view_render_event('bagisto.shop.checkout.success.continue-shopping.after', ['order' => $order]) }}
            </div>
        </main>
    </div>
</x-shop::layouts>
