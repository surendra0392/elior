<v-products-carousel
    src="{{ $src }}"
    title="{{ $title }}"
    navigation-link="{{ $navigationLink ?? '' }}"
>
    <x-shop::shimmer.products.carousel :navigation-link="$navigationLink ?? false" />
</v-products-carousel>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-products-carousel-template"
    >
        <div
            class="site-container py-6"
            v-if="! isLoading && products.length"
        >
            <div class="flex items-center justify-between gap-4 mb-6">
                <h2 class="font-serif text-2xl sm:text-3xl font-bold tracking-tight text-elior-charcoal">
                    @{{ title }}
                </h2>

                <div class="flex items-center gap-3">
                    <a
                        :href="navigationLink"
                        class="hidden max-lg:inline-flex items-center gap-1 text-xs font-semibold uppercase tracking-wider text-elior-botanical hover:underline"
                        v-if="navigationLink"
                    >
                        <span>@lang('shop::app.components.products.carousel.view-all')</span>
                        <span class="icon-arrow-right text-xs"></span>
                    </a>

                    <template v-if="products.length > 3">
                        <button
                            type="button"
                            v-if="products.length > 4 || (products.length > 3 && isScreenMax2xl)"
                            class="flex h-9 w-9 items-center justify-center rounded-full border border-elior-border bg-white text-elior-charcoal hover:bg-black/5 hover:text-elior-botanical transition-colors max-lg:hidden focus:outline-none"
                            role="button"
                            aria-label="@lang('shop::app.components.products.carousel.previous')"
                            tabindex="0"
                            @click="swipeLeft"
                        >
                            <span class="icon-arrow-left-stylish text-lg"></span>
                        </button>

                        <button
                            type="button"
                            v-if="products.length > 4 || (products.length > 3 && isScreenMax2xl)"
                            class="flex h-9 w-9 items-center justify-center rounded-full border border-elior-border bg-white text-elior-charcoal hover:bg-black/5 hover:text-elior-botanical transition-colors max-lg:hidden focus:outline-none"
                            role="button"
                            aria-label="@lang('shop::app.components.products.carousel.next')"
                            tabindex="0"
                            @click="swipeRight"
                        >
                            <span class="icon-arrow-right-stylish text-lg"></span>
                        </button>
                    </template>
                </div>
            </div>

            <div
                ref="swiperContainer"
                class="flex gap-8 pb-2.5 [&>*]:flex-[0] mt-10 overflow-auto scroll-smooth scrollbar-hide max-md:gap-7 max-md:mt-5 max-sm:gap-4 max-md:pb-0 max-md:whitespace-nowrap"
            >
                <x-shop::products.card
                    class="min-w-[291px] max-md:h-fit max-md:min-w-56 max-sm:min-w-[192px]"
                    v-for="product in products"
                />
            </div>

            <a
                :href="navigationLink"
                class="secondary-button mx-auto mt-5 block w-max rounded-2xl px-11 py-3 text-center text-base max-lg:mt-0 max-lg:hidden max-lg:py-3.5 max-md:rounded-lg"
                :aria-label="title"
                v-if="navigationLink"
            >
                @lang('shop::app.components.products.carousel.view-all')
            </a>
        </div>

        <!-- Product Card Listing -->
        <template v-if="isLoading">
            <x-shop::shimmer.products.carousel :navigation-link="$navigationLink ?? false" />
        </template>
    </script>

    <script type="module">
        app.component('v-products-carousel', {
            template: '#v-products-carousel-template',

            props: [
                'src',
                'title',
                'navigationLink',
            ],

            data() {
                return {
                    isLoading: true,

                    products: [],

                    offset: 323,

                    isScreenMax2xl: window.innerWidth <= 1440,
                };
            },

            mounted() {
                this.getProducts();
            },

            created() {
                window.addEventListener('resize', this.updateScreenSize);
            },

            beforeDestroy() {
                window.removeEventListener('resize', this.updateScreenSize);
            },

            methods: {
                getProducts() {
                    this.$axios.get(this.src)
                        .then(response => {
                            this.isLoading = false;

                            this.products = response.data.data;
                        }).catch(error => {
                            console.log(error);
                        });
                },

                updateScreenSize() {
                    this.isScreenMax2xl = window.innerWidth <= 1440;
                },

                swipeLeft() {
                    const container = this.$refs.swiperContainer;

                    container.scrollLeft -= this.offset;
                },

                swipeRight() {
                    const container = this.$refs.swiperContainer;

                    // Check if scroll reaches the end
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth) {
                        // Reset scroll to the beginning
                        container.scrollLeft = 0;
                    } else {
                        // Scroll to the right
                        container.scrollLeft += this.offset;
                    }
                },
            },
        });
    </script>
@endPushOnce
