@props([
    'product' => null,
])

@php
    $productJson = null;
    if ($product instanceof \Webkul\Product\Contracts\Product) {
        $productJson = json_encode(new \Webkul\Shop\Http\Resources\ProductCardResource($product));
    } elseif (is_array($product)) {
        $productJson = json_encode($product);
    }
@endphp

<v-product-card
    {{ $attributes }}
    @if ($productJson)
        :product="{{ $productJson }}"
    @else
        :product="product"
    @endif
>
</v-product-card>

@pushOnce('scripts')
    <style>
        .elior-action-btn {
            background-color: #ffffff !important;
            border: 1px solid #e5decb !important;
            color: #163923 !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .elior-action-btn:hover {
            background-color: #163923 !important;
            border-color: #163923 !important;
            color: #ffffff !important;
            transform: scale(1.1) !important;
            box-shadow: 0 6px 16px rgba(22, 57, 35, 0.25) !important;
        }
        .elior-action-btn:hover svg {
            stroke: #ffffff !important;
        }
        .elior-action-btn:hover span {
            color: #ffffff !important;
        }
    </style>

    <script
        type="text/x-template"
        id="v-product-card-template"
    >
        <!-- Grid Card -->
        <div
            class="group relative flex flex-col justify-between w-full rounded-2xl bg-white border border-[#e5decb] p-3.5 sm:p-4 transition-all duration-300 hover:border-[#205132]/60 hover:shadow-[0_12px_32px_rgba(22,57,35,0.09)] hover:-translate-y-1"
            v-if="mode != 'list'"
        >
            <div>
                <!-- Image Stage -->
                <div class="relative w-full aspect-square overflow-hidden rounded-xl bg-[#f4f0e6]">
                    {!! view_render_event('bagisto.shop.components.products.card.image.before') !!}

                    <!-- Product Image -->
                    <a
                        :href="'{{ route('shop.product_or_category.index', ':slug') }}'.replace(':slug', product.url_key)"
                        :aria-label="product.name"
                        class="block w-full h-full"
                    >
                        <x-shop::media.images.lazy
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                            ::src="product.base_image?.medium_image_url"
                            ::srcset="product.base_image ? `
                                ${product.base_image.small_image_url} 150w,
                                ${product.base_image.medium_image_url} 300w,
                            ` : ''"
                            sizes="(max-width: 768px) 150px, (max-width: 1200px) 300px, 600px"
                            ::key="product.id"
                            ::index="product.id"
                            width="291"
                            height="300"
                            ::alt="product.name"
                        />
                    </a>

                    {!! view_render_event('bagisto.shop.components.products.card.image.after') !!}

                    <!-- Brand Badges (Explicitly Locked to Top-Left) -->
                    <div
                        class="absolute flex flex-col gap-1 z-[2] pointer-events-none"
                        style="top: 0.75rem; left: 0.75rem; right: auto;"
                    >
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[9px] font-bold uppercase tracking-[0.16em] shadow-md"
                            style="background-color: #163923; color: #f4f0e6; border: 1px solid rgba(32, 81, 50, 0.3);"
                            v-if="product.on_sale"
                        >
                            Special Harvest
                        </span>

                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[9px] font-bold uppercase tracking-[0.16em] shadow-md"
                            style="background-color: #205132; color: #ffffff;"
                            v-else-if="product.is_new"
                        >
                            New Botanical
                        </span>
                    </div>

                    <!-- Quick Floating Actions (Explicitly Locked to Top-Right - Interactive Invert on Hover) -->
                    <div
                        class="absolute flex flex-col gap-1.5 opacity-0 group-hover:opacity-100 transition-all duration-200 z-[2] max-lg:opacity-100"
                        style="top: 0.75rem; right: 0.75rem; left: auto;"
                    >
                        @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                            <button
                                type="button"
                                class="elior-action-btn flex h-8 w-8 items-center justify-center rounded-full shadow-md"
                                aria-label="@lang('shop::app.components.products.card.add-to-wishlist')"
                                :class="product.is_wishlist ? '!text-red-500' : ''"
                                @click="addToWishlist()"
                            >
                                <span :class="product.is_wishlist ? 'icon-heart-fill' : 'icon-heart'" class="text-sm"></span>
                            </button>
                        @endif

                        @if (core()->getConfigData('catalog.products.settings.compare_option'))
                            <button
                                type="button"
                                class="elior-action-btn flex h-8 w-8 items-center justify-center rounded-full shadow-md"
                                aria-label="@lang('shop::app.components.products.card.add-to-compare')"
                                title="@lang('shop::app.components.products.card.add-to-compare')"
                                @click="addToCompare(product.id)"
                            >
                                <span class="icon-compare text-sm"></span>
                            </button>
                        @endif

                        <button
                            type="button"
                            class="elior-action-btn flex h-8 w-8 items-center justify-center rounded-full shadow-md"
                            aria-label="Quick View"
                            title="Quick View"
                            @click="openQuickView()"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Product Information Section (Clean, Comfortable Gap Under Image) -->
                <div class="mt-4 sm:mt-4.5 flex flex-col gap-1">
                    {!! view_render_event('bagisto.shop.components.products.card.name.before') !!}

                    <!-- Eyebrow: Category on LEFT & Net Weight on RIGHT (Side-by-Side) -->
                    <div class="flex items-center justify-between gap-2 text-[10px] pt-0.5">
                        <span v-if="product.category_name" class="font-bold uppercase tracking-[0.16em] text-[#c9a25a] line-clamp-1">
                            @{{ product.category_name }}
                        </span>
                        <span v-else class="font-bold uppercase tracking-[0.16em] text-[#c9a25a]">
                            Botanical Formulation
                        </span>

                        <span v-if="product.formatted_weight" class="font-semibold text-[11px] text-[#677a6d] shrink-0">
                            @{{ product.formatted_weight }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 class="font-serif text-[15px] sm:text-base font-bold text-[#163923] group-hover:text-[#205132] transition-colors line-clamp-2 leading-snug tracking-tight mt-1">
                        <a :href="'{{ route('shop.product_or_category.index', ':slug') }}'.replace(':slug', product.url_key)">
                            @{{ product.name }}
                        </a>
                    </h3>

                    {!! view_render_event('bagisto.shop.components.products.card.name.after') !!}

                    <!-- Pricing Strip -->
                    {!! view_render_event('bagisto.shop.components.products.card.price.before') !!}

                    <div class="flex items-center gap-2 pt-1.5">
                        <template v-if="product.special_price">
                            <span class="text-base font-bold text-[#163923] tracking-tight">
                                @{{ product.special_price }}
                            </span>
                            <span class="text-xs text-[#677a6d] line-through font-normal">
                                @{{ product.regular_price }}
                            </span>
                            <span
                                v-if="product.discount_percent > 0"
                                class="text-[9px] font-bold tracking-wider text-[#205132] px-2 py-0.5 rounded-full ml-auto"
                                style="background-color: rgba(32, 81, 50, 0.1); border: 1px solid rgba(32, 81, 50, 0.2); color: #205132;"
                            >
                                @{{ product.discount_percent }}% OFF
                            </span>
                        </template>
                        <template v-else>
                            <span class="text-base font-bold text-[#163923] tracking-tight">
                                @{{ product.regular_price || product.min_price }}
                            </span>
                        </template>
                    </div>

                    {!! view_render_event('bagisto.shop.components.products.card.price.after') !!}
                </div>
            </div>

            <!-- Action Button -->
            <div class="mt-4 pt-3 border-t border-[#e5decb]/60">
                @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                    {!! view_render_event('bagisto.shop.components.products.card.add_to_cart.before') !!}

                    <button
                        class="elior-btn-primary w-full py-2.5 px-4 text-xs font-bold uppercase tracking-[0.14em] rounded-xl flex items-center justify-center gap-2 transition-all duration-200 active:scale-[0.98] disabled:opacity-50"
                        :disabled="! product.is_saleable || isAddingToCart"
                        @click="addToCart()"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span v-if="! product.is_saleable">Out of Stock</span>
                        <span v-else-if="! isAddingToCart">Add To Cart</span>
                        <span v-else>Adding...</span>
                    </button>

                    {!! view_render_event('bagisto.shop.components.products.card.add_to_cart.after') !!}
                @endif
            </div>
        </div>

        <!-- List Card -->
        <div
            class="group relative flex gap-6 p-4 sm:p-5 rounded-2xl bg-white border border-[#e5decb] transition-all duration-300 hover:border-[#205132]/60 hover:shadow-[0_12px_32px_rgba(22,57,35,0.09)] max-sm:flex-wrap items-center"
            v-else
        >
            <!-- Image Stage -->
            <div class="relative w-full max-w-[200px] aspect-square overflow-hidden rounded-xl bg-[#f4f0e6] shrink-0">
                {!! view_render_event('bagisto.shop.components.products.card.image.before') !!}

                <a
                    :href="'{{ route('shop.product_or_category.index', ':slug') }}'.replace(':slug', product.url_key)"
                    class="block w-full h-full"
                >
                    <x-shop::media.images.lazy
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                        ::src="product.base_image?.medium_image_url"
                        ::key="product.id"
                        ::index="product.id"
                        width="291"
                        height="300"
                        ::alt="product.name"
                    />
                </a>

                {!! view_render_event('bagisto.shop.components.products.card.image.after') !!}

                <div
                    class="absolute flex flex-col gap-1 z-[2]"
                    style="top: 0.75rem; left: 0.75rem; right: auto;"
                >
                    <span
                        class="inline-flex items-center px-2.5 py-1 rounded-full text-[9px] font-bold uppercase tracking-[0.16em] shadow-md"
                        style="background-color: #163923; color: #f4f0e6; border: 1px solid rgba(32, 81, 50, 0.3);"
                        v-if="product.on_sale"
                    >
                        Special Harvest
                    </span>

                    <span
                        class="inline-flex items-center px-2.5 py-1 rounded-full text-[9px] font-bold uppercase tracking-[0.16em] shadow-md"
                        style="background-color: #205132; color: #ffffff;"
                        v-else-if="product.is_new"
                    >
                        New Botanical
                    </span>
                </div>
            </div>

            <!-- List Details -->
            <div class="flex flex-1 flex-col justify-between h-full space-y-3">
                <div class="space-y-1.5">
                    <!-- Eyebrow: Category on LEFT & Net Weight on RIGHT (Side-by-Side) -->
                    <div class="flex items-center justify-between gap-2 text-[10px]">
                        <span v-if="product.category_name" class="font-bold uppercase tracking-[0.16em] text-[#c9a25a]">
                            @{{ product.category_name }}
                        </span>
                        <span v-else class="font-bold uppercase tracking-[0.16em] text-[#c9a25a]">
                            Botanical Formulation
                        </span>

                        <span v-if="product.formatted_weight" class="font-semibold text-[11px] text-[#677a6d]">
                            @{{ product.formatted_weight }}
                        </span>
                    </div>

                    <h3 class="font-serif text-lg sm:text-xl font-bold text-[#163923] group-hover:text-[#205132] transition-colors leading-snug">
                        <a :href="'{{ route('shop.product_or_category.index', ':slug') }}'.replace(':slug', product.url_key)">
                            @{{ product.name }}
                        </a>
                    </h3>

                    <p v-if="product.short_description" class="text-xs text-[#677a6d] line-clamp-2 leading-relaxed">
                        @{{ product.short_description }}
                    </p>
                </div>

                <!-- Price and Cart Button Row -->
                <div class="pt-3 border-t border-[#e5decb]/60 flex items-center justify-between gap-4">
                    <div class="flex items-baseline gap-2">
                        <template v-if="product.special_price">
                            <span class="text-lg font-bold text-[#163923]">
                                @{{ product.special_price }}
                            </span>
                            <span class="text-xs text-[#677a6d] line-through font-normal">
                                @{{ product.regular_price }}
                            </span>
                        </template>
                        <template v-else>
                            <span class="text-lg font-bold text-[#163923]">
                                @{{ product.regular_price || product.min_price }}
                            </span>
                        </template>
                    </div>

                    <div class="flex items-center gap-2">
                        @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                            <button
                                class="elior-btn-primary py-2.5 px-6 text-xs font-bold uppercase tracking-[0.14em] rounded-xl flex items-center gap-2"
                                :disabled="! product.is_saleable || isAddingToCart"
                                @click="addToCart()"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                <span v-if="! product.is_saleable">Out of Stock</span>
                                <span v-else-if="! isAddingToCart">Add To Cart</span>
                                <span v-else>Adding...</span>
                            </button>
                        @endif

                        @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                            <button
                                type="button"
                                class="elior-action-btn flex h-9 w-9 items-center justify-center rounded-full shadow-sm"
                                aria-label="@lang('shop::app.components.products.card.add-to-wishlist')"
                                :class="product.is_wishlist ? '!text-red-500' : ''"
                                @click="addToWishlist()"
                            >
                                <span :class="product.is_wishlist ? 'icon-heart-fill' : 'icon-heart'" class="text-sm"></span>
                            </button>
                        @endif

                        @if (core()->getConfigData('catalog.products.settings.compare_option'))
                            <button
                                type="button"
                                class="elior-action-btn flex h-9 w-9 items-center justify-center rounded-full shadow-sm"
                                aria-label="@lang('shop::app.components.products.card.add-to-compare')"
                                title="@lang('shop::app.components.products.card.add-to-compare')"
                                @click="addToCompare(product.id)"
                            >
                                <span class="icon-compare text-sm"></span>
                            </button>
                        @endif

                        <button
                            type="button"
                            class="elior-action-btn flex h-9 w-9 items-center justify-center rounded-full shadow-sm"
                            aria-label="Quick View"
                            title="Quick View"
                            @click="openQuickView()"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-product-card', {
            template: '#v-product-card-template',

            props: ['mode', 'product'],

            data() {
                return {
                    isCustomer: '{{ auth()->guard('customer')->check() }}',

                    isAddingToCart: false,
                }
            },

            methods: {
                openQuickView() {
                    this.$emitter.emit('open-quick-view', this.product);
                },

                addToWishlist() {
                    if (this.isCustomer) {
                        this.$axios.post(`{{ route('shop.api.customers.account.wishlist.store') }}`, {
                                product_id: this.product.id
                            })
                            .then(response => {
                                this.product.is_wishlist = ! this.product.is_wishlist;

                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.data.message });
                            })
                            .catch(error => {});
                        } else {
                            window.location.href = "{{ route('shop.customer.session.index')}}";
                        }
                },

                addToCompare(productId) {
                    if (this.isCustomer) {
                        this.$axios.post('{{ route("shop.api.compare.store") }}', {
                                'product_id': productId
                            })
                            .then(response => {
                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.data.message });
                            })
                            .catch(error => {
                                if ([400, 422].includes(error.response.status)) {
                                    this.$emitter.emit('add-flash', { type: 'warning', message: error.response.data.data.message });

                                    return;
                                }

                                this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message});
                            });

                        return;
                    }

                    let items = this.getStorageValue() ?? [];

                    if (items.length) {
                        if (! items.includes(productId)) {
                            items.push(productId);

                            localStorage.setItem('compare_items', JSON.stringify(items));

                            this.$emitter.emit('add-flash', { type: 'success', message: "@lang('shop::app.components.products.card.add-to-compare-success')" });
                        } else {
                            this.$emitter.emit('add-flash', { type: 'warning', message: "@lang('shop::app.components.products.card.already-in-compare')" });
                        }
                    } else {
                        localStorage.setItem('compare_items', JSON.stringify([productId]));

                        this.$emitter.emit('add-flash', { type: 'success', message: "@lang('shop::app.components.products.card.add-to-compare-success')" });
                    }
                },

                getStorageValue(key) {
                    let value = localStorage.getItem('compare_items');

                    if (! value) {
                        return [];
                    }

                    return JSON.parse(value);
                },

                addToCart() {
                    this.isAddingToCart = true;

                    this.$axios.post('{{ route("shop.api.checkout.cart.store") }}', {
                            'quantity': 1,
                            'product_id': this.product.id,
                        })
                        .then(response => {
                            if (response.data.message) {
                                this.$emitter.emit('update-mini-cart', response.data.data );

                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                                this.$emitter.emit('open-mini-cart');
                            } else {
                                this.$emitter.emit('add-flash', { type: 'warning', message: response.data.data.message });
                            }

                            this.isAddingToCart = false;
                        })
                        .catch(error => {
                            this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });

                            if (error.response.data.redirect_uri) {
                                window.location.href = error.response.data.redirect_uri;
                            }

                            this.isAddingToCart = false;
                        });
                },
            },
        });
    </script>
@endpushOnce
