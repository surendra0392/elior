<v-quick-view></v-quick-view>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-quick-view-template"
    >
        <div v-if="isOpen">
            <!-- Modal Overlay Backdrop -->
            <transition
                enter-active-class="transition-opacity duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-opacity duration-200 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    class="fixed inset-0 z-[999] bg-black/60 backdrop-blur-sm transition-opacity"
                    @click="close"
                ></div>
            </transition>

            <!-- Modal Content Dialog Wrapper -->
            <transition
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0 scale-95 translate-y-4"
                enter-to-class="opacity-100 scale-100 translate-y-0"
                leave-active-class="transition-all duration-200 ease-in"
                leave-from-class="opacity-100 scale-100 translate-y-0"
                leave-to-class="opacity-0 scale-95 translate-y-4"
            >
                <div
                    class="fixed inset-0 z-[1000] flex items-center justify-center p-4 sm:p-6 overflow-y-auto"
                    @click.self="close"
                >
                    <!-- Modal Frame (Relative container with visible overflow so close button sits completely on top) -->
                    <div
                        class="relative w-full max-w-4xl my-auto"
                        role="dialog"
                        aria-modal="true"
                    >
                        <!-- Modal Dialog Card Body -->
                        <div class="relative z-10 w-full max-h-[88vh] overflow-y-auto rounded-3xl bg-white border border-[#e5decb] shadow-2xl p-6 sm:p-8">
                            <div class="flex flex-col md:flex-row gap-8" v-if="product">
                                <!-- Left: Gallery Showcase -->
                                <div class="w-full md:w-1/2 flex flex-col gap-4">
                                    <div class="relative aspect-square w-full overflow-hidden rounded-2xl bg-[#f4f0e6] border border-[#e5decb]">
                                        <img
                                            :src="activeImage || product.base_image?.large_image_url || product.base_image?.medium_image_url"
                                            :alt="product.name"
                                            class="h-full w-full object-cover transition-all duration-300"
                                        />

                                        <!-- Badges -->
                                        <div class="absolute top-3 left-3 flex flex-col gap-1.5 z-10">
                                            <span
                                                v-if="product.discount_percent > 0"
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-[#163923] text-[#f4f0e6] text-[10px] font-bold tracking-wider uppercase shadow-sm"
                                            >
                                                @{{ product.discount_percent }}% OFF
                                            </span>
                                            <span
                                                v-if="product.is_new"
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-[#205132] text-white text-[10px] font-bold tracking-wider uppercase shadow-sm"
                                            >
                                                New Botanical
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Thumbnail strip if multiple gallery images -->
                                    <div
                                        class="flex items-center gap-3 overflow-x-auto pb-1"
                                        v-if="product.gallery_images && product.gallery_images.length > 1"
                                    >
                                        <button
                                            v-for="(img, idx) in product.gallery_images"
                                            :key="idx"
                                            type="button"
                                            class="relative h-16 w-16 shrink-0 overflow-hidden rounded-xl border-2 transition-all"
                                            :class="activeImage === (img.large_image_url || img.medium_image_url) ? 'border-[#205132] ring-2 ring-[#205132]/20' : 'border-[#e5decb] opacity-70 hover:opacity-100'"
                                            @click="activeImage = img.large_image_url || img.medium_image_url"
                                        >
                                            <img
                                                :src="img.small_image_url || img.medium_image_url"
                                                :alt="product.name"
                                                class="h-full w-full object-cover"
                                            />
                                        </button>
                                    </div>
                                </div>

                                <!-- Right: Product Information & Commerce Actions -->
                                <div class="w-full md:w-1/2 flex flex-col justify-between space-y-6">
                                    <div class="space-y-4">
                                        <!-- Eyebrow Category & Weight -->
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="elior-eyebrow">@{{ product.category_name || 'Pure Botanical' }}</span>
                                            <span
                                                v-if="product.formatted_weight"
                                                class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-[#f4f0e6] border border-[#e5decb] text-[11px] font-semibold text-[#677a6d]"
                                            >
                                                @{{ product.formatted_weight }}
                                            </span>
                                        </div>

                                        <!-- Product Title -->
                                        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-[#163923] leading-snug">
                                            @{{ product.name }}
                                        </h3>

                                        <!-- Side-by-Side Pricing -->
                                        <div class="flex items-baseline gap-3 pt-1">
                                            <template v-if="product.special_price">
                                                <span class="font-serif text-2xl sm:text-3xl font-bold text-[#205132]">
                                                    @{{ product.special_price }}
                                                </span>
                                                <span class="text-base text-[#677a6d] line-through font-normal">
                                                    @{{ product.regular_price }}
                                                </span>
                                                <span
                                                    v-if="product.discount_percent > 0"
                                                    class="px-2 py-0.5 rounded-full bg-[#f5eedd] text-[#c9a25a] text-xs font-bold"
                                                >
                                                    Save @{{ product.discount_percent }}%
                                                </span>
                                            </template>
                                            <template v-else>
                                                <span class="font-serif text-2xl sm:text-3xl font-bold text-[#205132]">
                                                    @{{ product.regular_price || product.min_price }}
                                                </span>
                                            </template>
                                        </div>

                                        <!-- Short Description -->
                                        <p
                                            class="text-xs sm:text-sm text-[#677a6d] leading-relaxed pt-2 border-t border-[#e5decb]"
                                            v-if="product.short_description"
                                        >
                                            @{{ product.short_description }}
                                        </p>

                                        <!-- Botanical Trust Badges -->
                                        <div class="grid grid-cols-2 gap-2 pt-2 text-[11px] text-[#163923]">
                                            <div class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-[#205132]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                <span>Cold-Dehydrated &lt; 42°C</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-[#205132]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                <span>Zero Synthetic Additives</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-[#205132]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                <span>100% Plant-Based Purity</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-[#205132]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                <span>Free Shipping Over ₹499</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Commerce Action Controls -->
                                    <div class="space-y-4 pt-4 border-t border-[#e5decb]">
                                        <div class="flex items-center gap-4">
                                            <!-- Quantity Selector -->
                                            <div class="flex items-center rounded-xl border border-[#e5decb] bg-[#f4f0e6] p-1">
                                                <button
                                                    type="button"
                                                    class="flex h-8 w-8 items-center justify-center rounded-lg text-base font-bold text-[#163923] hover:bg-white transition-colors disabled:opacity-30"
                                                    :disabled="quantity <= 1"
                                                    @click="quantity > 1 ? quantity-- : null"
                                                >
                                                    -
                                                </button>

                                                <span class="w-10 text-center text-sm font-bold text-[#163923]">
                                                    @{{ quantity }}
                                                </span>

                                                <button
                                                    type="button"
                                                    class="flex h-8 w-8 items-center justify-center rounded-lg text-base font-bold text-[#163923] hover:bg-white transition-colors"
                                                    @click="quantity++"
                                                >
                                                    +
                                                </button>
                                            </div>

                                            <!-- Add to Cart Button -->
                                            <button
                                                type="button"
                                                class="elior-btn-primary flex-1 py-3.5 px-6 rounded-xl font-bold uppercase tracking-wider text-xs shadow-md transition-all disabled:opacity-50"
                                                :disabled="! product.is_saleable || isAddingToCart"
                                                @click="addToCart()"
                                            >
                                                <span v-if="! product.is_saleable">Out of Stock</span>
                                                <span v-else-if="! isAddingToCart">Add To Cart</span>
                                                <span v-else>Adding...</span>
                                            </button>
                                        </div>

                                        <!-- View Full Details Link -->
                                        <div class="text-center pt-2">
                                            <a
                                                :href="'{{ route('shop.product_or_category.index', ':slug') }}'.replace(':slug', product.url_key)"
                                                class="inline-flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-[#205132] hover:text-[#163923] underline underline-offset-4 transition-colors"
                                            >
                                                View Full Botanical Profile &amp; Recipes &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Close Button: Placed on TOP (after the card body in DOM order with z-index: 9999) -->
                        <button
                            type="button"
                            class="absolute flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-full shadow-2xl transition-all duration-200 hover:scale-110 hover:brightness-125 focus:outline-none cursor-pointer"
                            style="top: -14px; right: -14px; background-color: #163923; color: #ffffff; border: 2.5px solid #ffffff; z-index: 9999; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3);"
                            aria-label="Close Quick View"
                            @click="close"
                        >
                            <svg class="w-5 h-5 text-white stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            </transition>
        </div>
    </script>

    <script type="module">
        app.component('v-quick-view', {
            template: '#v-quick-view-template',

            data() {
                return {
                    isOpen: false,
                    product: null,
                    activeImage: null,
                    quantity: 1,
                    isAddingToCart: false,
                };
            },

            mounted() {
                this.$emitter.on('open-quick-view', (product) => {
                    this.product = product;
                    this.activeImage = product.base_image?.large_image_url || product.base_image?.medium_image_url || null;
                    this.quantity = 1;
                    this.isOpen = true;
                    document.body.style.overflow = 'hidden';
                });
            },

            methods: {
                close() {
                    this.isOpen = false;
                    this.product = null;
                    this.activeImage = null;
                    document.body.style.overflow = '';
                },

                calculateSubtotal() {
                    if (! this.product) return '';
                    let priceStr = this.product.special_price || this.product.regular_price || this.product.min_price || '';
                    return priceStr;
                },

                addToCart() {
                    if (! this.product) return;

                    this.isAddingToCart = true;

                    this.$axios.post('{{ route("shop.api.checkout.cart.store") }}', {
                            'quantity': this.quantity,
                            'product_id': this.product.id,
                        })
                        .then(response => {
                            if (response.data.message) {
                                this.$emitter.emit('update-mini-cart', response.data.data);
                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });
                                this.close();
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
            }
        });
    </script>
@endpushOnce
