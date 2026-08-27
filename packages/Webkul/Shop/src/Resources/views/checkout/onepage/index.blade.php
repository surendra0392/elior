<!-- SEO Meta Content -->
@push('meta')
    <meta name="title" content="@lang('shop::app.checkout.onepage.index.checkout') | ELIOR" />
    <meta name="description" content="Complete your ELIOR botanical nutrition order with secure 256-bit encrypted checkout." />
@endPush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="true"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.checkout.onepage.index.checkout') | ELIOR
    </x-slot>

    @php
        $channel = core()->getCurrentChannel();
        $logoConfig = core()->getConfigData('general.design.admin_logo.logo_image');
        $logoUrl = $channel->logo_url ?: ($logoConfig ? \Illuminate\Support\Facades\Storage::url($logoConfig) : null);
    @endphp

    <!-- Focused Secure Checkout Top Bar -->
    <header class="border-b border-[#e5decb] sticky top-0 z-30 shadow-sm" style="background-color: #f4f0e6 !important;">
        <div class="site-container h-16 sm:h-20 flex items-center justify-between">
            <!-- Logo -->
            <a
                href="{{ route('shop.home.index') }}"
                class="flex items-center py-2 group"
                aria-label="ELIOR - Botanical Nutrition"
            >
                @if ($logoUrl)
                    <img
                        src="{{ $logoUrl }}"
                        alt="{{ config('app.name', 'ELIOR') }}"
                        class="h-9 sm:h-11 w-auto object-contain max-w-[180px] transition-transform duration-300 group-hover:scale-[1.02]"
                    />
                @else
                    <div class="flex flex-col">
                        <span class="font-serif text-2xl sm:text-3xl font-bold tracking-tight text-[#163923] group-hover:text-[#205132] transition-colors">
                            ELIOR
                        </span>
                        <span class="text-[8px] sm:text-[9px] tracking-[0.32em] uppercase text-[#677a6d] -mt-0.5 font-sans font-semibold">
                            Botanical Nutrition
                        </span>
                    </div>
                @endif
            </a>

            <!-- Center Trust Badge (Desktop) -->
            <div class="hidden md:flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#205132] bg-[#EBF3EE] border border-[#d2e4d8] px-4 py-1.5 rounded-full shadow-xs">
                <span class="material-symbols-outlined text-[16px] text-[#205132]">lock</span>
                <span>Secure 256-Bit SSL Checkout</span>
            </div>

            <!-- Right: Return to Cart & Auth -->
            <div class="flex items-center gap-3 sm:gap-4">
                <a
                    href="{{ route('shop.checkout.cart.index') }}"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wider text-[#163923] hover:text-[#205132] transition-colors"
                >
                    <span class="icon-arrow-left text-xs"></span>
                    <span>Back to Cart</span>
                </a>

                @guest('customer')
                    <span class="text-[#e5decb] hidden sm:inline">|</span>
                    <div class="block">
                        @include('shop::checkout.login')
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <div class="bg-elior-cream min-h-[calc(100vh-80px)]">
        <!-- Breadcrumbs -->
        <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
            <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-elior-muted">
                <a href="{{ route('shop.home.index') }}" class="hover:text-elior-botanical transition-colors">Home</a>
                <span class="text-elior-border">/</span>
                <a href="{{ route('shop.checkout.cart.index') }}" class="hover:text-elior-botanical transition-colors">Cart</a>
                <span class="text-elior-border">/</span>
                <span class="text-elior-charcoal font-semibold">Checkout</span>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="site-container pt-4 pb-6 sm:pt-6 sm:pb-8">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EBF3EE] text-elior-botanical text-[10px] sm:text-xs font-semibold tracking-widest uppercase">
                    <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">shield</span></span>
                    <span>Order Placement</span>
                </div>
                <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-elior-charcoal">
                    Checkout
                </h1>
            </div>
        </div>

        <!-- Checkout Vue Component -->
        <main class="site-container pb-20">
            <v-checkout>
                <!-- Shimmer Effect -->
                <x-shop::shimmer.checkout.onepage />
            </v-checkout>
        </main>
    </div>

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-checkout-template"
        >
            <template v-if="! cart">
                <!-- Shimmer Effect -->
                <x-shop::shimmer.checkout.onepage />
            </template>

            <template v-else>
                <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-start">
                    <!-- Steps Container (Left Column) -->
                    <div
                        class="flex-1 w-full space-y-6"
                        id="steps-container"
                    >
                        <!-- Mobile Order Summary (Collapsible/Preview on Small Screens) -->
                        <div class="block lg:hidden">
                            @include('shop::checkout.onepage.summary')
                        </div>

                        <!-- Step 1: Address -->
                        <template v-if="['address', 'shipping', 'payment', 'review'].includes(currentStep)">
                            @include('shop::checkout.onepage.address')
                        </template>

                        <!-- Step 2: Shipping Methods -->
                        <template v-if="cart.have_stockable_items && ['shipping', 'payment', 'review'].includes(currentStep)">
                            @include('shop::checkout.onepage.shipping')
                        </template>

                        <!-- Step 3: Payment Methods -->
                        <template v-if="['payment', 'review'].includes(currentStep)">
                            @include('shop::checkout.onepage.payment')
                        </template>
                    </div>

                    <!-- Desktop Order Summary (Right Sticky Column) -->
                    <div class="hidden lg:block w-[380px] xl:w-[420px] shrink-0 sticky top-28 space-y-4">
                        @include('shop::checkout.onepage.summary')

                        <!-- Place Order Button -->
                        <div v-if="canPlaceOrder" class="pt-2">
                            <template v-if="(selectedPaymentMethod || cart.payment_method) == 'paypal_smart_button'">
                                {!! view_render_event('bagisto.shop.checkout.onepage.summary.paypal_smart_button.before') !!}

                                <v-paypal-smart-button></v-paypal-smart-button>

                                {!! view_render_event('bagisto.shop.checkout.onepage.summary.paypal_smart_button.after') !!}
                            </template>

                            <template v-else>
                                <x-shop::button
                                    type="button"
                                    class="elior-btn-primary h-12 w-full text-xs uppercase tracking-widest font-semibold flex items-center justify-center gap-2 shadow-elior-card"
                                    :title="trans('shop::app.checkout.onepage.summary.place-order')"
                                    ::disabled="isPlacingOrder"
                                    ::loading="isPlacingOrder"
                                    @click="placeOrder"
                                />
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </script>

        <script type="module">
            app.component('v-checkout', {
                template: '#v-checkout-template',

                data() {
                    return {
                        cart: null,

                        displayTax: {
                            prices: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_prices') }}",
                            subtotal: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_subtotal') }}",
                            shipping: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_shipping_amount') }}",
                        },

                        isPlacingOrder: false,
                        currentStep: 'address',
                        shippingMethods: null,
                        paymentMethods: null,
                        selectedPaymentMethod: null,
                        canPlaceOrder: false,
                    }
                },

                mounted() {
                    this.getCart();
                },

                methods: {
                    getCart() {
                        this.$axios.get("{{ route('shop.checkout.onepage.summary') }}")
                            .then(response => {
                                this.cart = response.data.data;
                                this.scrollToCurrentStep();
                            })
                            .catch(error => {});
                    },

                    stepForward(step) {
                        this.currentStep = step;

                        if (step == 'review') {
                            this.canPlaceOrder = true;
                            return;
                        }

                        this.canPlaceOrder = false;

                        if (this.currentStep == 'shipping') {
                            this.shippingMethods = null;
                        } else if (this.currentStep == 'payment') {
                            this.paymentMethods = null;
                        }
                    },

                    stepProcessed(data) {
                        if (this.currentStep == 'shipping') {
                            this.shippingMethods = data;
                        } else if (this.currentStep == 'payment') {
                            this.paymentMethods = data;
                        }

                        this.getCart();
                    },

                    scrollToCurrentStep() {
                        let container = document.getElementById('steps-container');

                        if (! container) {
                            return;
                        }

                        container.scrollIntoView({
                            behavior: 'smooth',
                            block: 'end'
                        });
                    },

                    setSelectedPaymentMethod(method) {
                        this.selectedPaymentMethod = method;
                    },

                    placeOrder() {
                        if ((this.selectedPaymentMethod || this.cart.payment_method) == 'paypal_smart_button') {
                            return;
                        }

                        this.isPlacingOrder = true;

                        this.$axios.post('{{ route('shop.checkout.onepage.orders.store') }}')
                            .then(response => {
                                if (response.data.data.redirect) {
                                    window.location.href = response.data.data.redirect_url;
                                } else {
                                    window.location.href = '{{ route('shop.checkout.onepage.success') }}';
                                }

                                this.isPlacingOrder = false;
                            })
                            .catch(error => {
                                this.isPlacingOrder = false;
                                this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                            });
                    }
                },
            });
        </script>
    @endPushOnce
</x-shop::layouts>
