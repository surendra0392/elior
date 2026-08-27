<?php
    $searchTitle = $suggestion ?? $query;
    $title = $searchTitle ? trans('shop::app.search.title', ['query' => $searchTitle]) : trans('shop::app.search.results');
    $searchInstead = $suggestion ? $query : null;
?>

<!-- SEO Meta Content -->
@push('meta')
    <meta name="title" content="{{ $title }} | ELIOR" />
    <meta name="description" content="Search ELIOR's collection of single-origin botanical powders, functional superblends, and culinary ingredients." />
@endPush

<x-shop::layouts :has-feature="false">
    <!-- Page Title -->
    <x-slot:title>
        {{ $title }} | ELIOR
    </x-slot>

    <div class="bg-[#f4f0e6] min-h-screen">
        @if (core()->getConfigData('general.general.breadcrumbs.shop'))
            <!-- Breadcrumbs -->
            <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
                <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-[#677a6d]">
                    <a href="{{ route('shop.home.index') }}" class="hover:text-[#205132] transition-colors">Home</a>
                    <span class="text-[#e5decb]">/</span>
                    <span class="text-[#163923] font-semibold">Search</span>
                </nav>
            </div>
        @endif

        <!-- Editorial Search Hero -->
        <section class="site-container pt-6 pb-8 sm:pt-10 sm:pb-12 text-center max-w-3xl mx-auto space-y-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#e8f2ec] text-[#205132] text-[10px] sm:text-xs font-semibold tracking-widest uppercase">
                <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">search</span></span>
                <span>Search Catalog</span>
            </div>

            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923] leading-tight">
                @if ($query)
                    Search results for <span class="text-[#205132]">"{{ $query }}"</span>
                @else
                    Search ELIOR Botanicals
                @endif
            </h1>

            <!-- Interactive Search Box -->
            <form
                action="{{ route('shop.search.index') }}"
                method="GET"
                class="relative max-w-2xl mx-auto flex items-center pt-2"
                role="search"
            >
                <label for="search-page-input" class="sr-only">Search ELIOR products</label>

                <div class="pointer-events-none absolute left-5 top-1/2 -translate-y-1/2 flex items-center justify-center text-[#677a6d]">
                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">search</span>
                </div>

                <input
                    id="search-page-input"
                    type="text"
                    name="query"
                    value="{{ $query }}"
                    class="w-full h-12 sm:h-14 pl-14 pr-32 text-sm sm:text-base text-[#163923] placeholder:text-[#677a6d] bg-white border border-[#e5decb] rounded-full shadow-sm focus:border-[#205132] focus:ring-1 focus:ring-[#205132] outline-none transition-all"
                    placeholder="Search botanical powders, blends..."
                    aria-label="Search ELIOR products"
                    autocomplete="off"
                    required
                >

                <div class="absolute right-2 top-1/2 -translate-y-1/2">
                    <button
                        type="submit"
                        class="elior-btn-primary !h-8 sm:!h-10 px-5 sm:px-7 text-[11px] sm:text-xs uppercase tracking-wider font-bold !rounded-full shadow-none"
                    >
                        Search
                    </button>
                </div>
            </form>

            <!-- Popular Search Suggestions -->
            <div class="pt-2 flex items-center justify-center gap-1.5 flex-wrap text-xs text-[#677a6d]">
                <span class="font-medium text-[#163923]/80 mr-1">Popular:</span>
                <a href="{{ route('shop.search.index', ['query' => 'Moringa']) }}" class="px-2.5 py-1 rounded-full bg-white border border-[#e5decb] hover:bg-[#f4f0e6] hover:text-[#205132] transition-colors">Moringa</a>
                <a href="{{ route('shop.search.index', ['query' => 'Beetroot']) }}" class="px-2.5 py-1 rounded-full bg-white border border-[#e5decb] hover:bg-[#f4f0e6] hover:text-[#205132] transition-colors">Beetroot</a>
                <a href="{{ route('shop.search.index', ['query' => 'Turmeric']) }}" class="px-2.5 py-1 rounded-full bg-white border border-[#e5decb] hover:bg-[#f4f0e6] hover:text-[#205132] transition-colors">Turmeric</a>
                <a href="{{ route('shop.search.index', ['query' => 'Amla']) }}" class="px-2.5 py-1 rounded-full bg-white border border-[#e5decb] hover:bg-[#f4f0e6] hover:text-[#205132] transition-colors">Amla</a>
                <a href="{{ route('shop.search.index', ['query' => 'Ashwagandha']) }}" class="px-2.5 py-1 rounded-full bg-white border border-[#e5decb] hover:bg-[#f4f0e6] hover:text-[#205132] transition-colors">Ashwagandha</a>
                <a href="{{ route('shop.search.index', ['query' => 'Spirulina']) }}" class="px-2.5 py-1 rounded-full bg-white border border-[#e5decb] hover:bg-[#f4f0e6] hover:text-[#205132] transition-colors">Spirulina</a>
            </div>

            @if ($searchInstead)
                <form
                    action="{{ route('shop.search.index', ['suggest' => false]) }}"
                    class="flex max-w-[445px] items-center justify-center mx-auto pt-2"
                    role="search"
                >
                    <input
                        type="text"
                        name="query"
                        class="hidden"
                        value="{{ $searchInstead }}"
                    >

                    <input
                        type="text"
                        name="suggest"
                        class="hidden"
                        value="0"
                    >

                    <p class="text-xs text-elior-muted" v-pre>
                        {{ trans('shop::app.search.suggest') }}
                        <button
                            type="submit"
                            class="text-elior-botanical font-semibold underline underline-offset-2 hover:text-elior-botanicalDark"
                        >
                            {{ $searchInstead }}
                        </button>
                    </p>
                </form>
            @endif
        </section>

        <!-- Product Search Results Vue Component -->
        <main class="site-container pb-20">
            <v-search>
                <x-shop::shimmer.categories.view />
            </v-search>
        </main>
    </div>

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-search-template"
        >
            <div>
                <div class="flex items-start gap-8 lg:gap-10">
                    <!-- Product Listing Filters (Sidebar) -->
                    @include('shop::categories.filters')

                    <!-- Product Listing Container -->
                    <div class="flex-1">
                        <!-- Desktop Product Listing Toolbar (Sorting, Layout Mode) -->
                        <div class="max-md:hidden">
                            @include('shop::categories.toolbar')
                        </div>

                        <!-- Product List Mode Card Container -->
                        <div
                            class="mt-8 grid grid-cols-1 gap-6"
                            v-if="(filters.toolbar.applied.mode ?? filters.toolbar.default.mode) === 'list'"
                        >
                            <!-- Shimmer Effect -->
                            <template v-if="isLoading">
                                <x-shop::shimmer.products.cards.list count="12" />
                            </template>

                            <!-- Product List Cards -->
                            <template v-else>
                                <template v-if="products.length">
                                    <x-shop::products.card
                                        ::mode="'list'"
                                        v-for="product in products"
                                    />
                                </template>

                                <!-- Empty State -->
                                <template v-else>
                                    <div class="rounded-3xl border border-elior-border/80 bg-white p-8 sm:p-14 text-center max-w-xl mx-auto shadow-elior-subtle space-y-5 my-12">
                                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#FAF8F5] border border-elior-border text-2xl">
                                            <span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span>
                                        </div>

                                        <div class="space-y-2">
                                            <h3 class="font-serif text-2xl font-bold text-elior-charcoal">
                                                No Products Found
                                            </h3>
                                            <p class="text-xs sm:text-sm text-elior-muted leading-relaxed max-w-md mx-auto">
                                                We couldn't find any products matching your search term. Try checking for typos or searching for a general botanical like <em>Moringa</em> or <em>Beetroot</em>.
                                            </p>
                                        </div>

                                        <div class="pt-2">
                                            <a
                                                href="{{ route('shop.search.index') }}"
                                                class="elior-btn-primary inline-flex items-center gap-2 text-xs uppercase tracking-widest font-semibold px-6 py-3"
                                            >
                                                <span>Explore All Products</span>
                                                <span class="icon-arrow-right text-xs"></span>
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </template>
                        </div>

                        <!-- Product Grid Mode Card Container -->
                        <div v-else>
                            <!-- Shimmer Effect -->
                            <template v-if="isLoading">
                                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                                    <x-shop::shimmer.products.cards.grid count="12" />
                                </div>
                            </template>

                            <!-- Product Grid Cards -->
                            <template v-else>
                                <template v-if="products.length">
                                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                                        <x-shop::products.card
                                            ::mode="'grid'"
                                            v-for="product in products"
                                            :navigation-link="route('shop.search.index')"
                                        />
                                    </div>
                                </template>

                                <!-- Empty State -->
                                <template v-else>
                                    <div class="rounded-3xl border border-elior-border/80 bg-white p-8 sm:p-14 text-center max-w-xl mx-auto shadow-elior-subtle space-y-5 my-12">
                                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#FAF8F5] border border-elior-border text-2xl">
                                            <span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span>
                                        </div>

                                        <div class="space-y-2">
                                            <h3 class="font-serif text-2xl font-bold text-elior-charcoal">
                                                No Products Found
                                            </h3>
                                            <p class="text-xs sm:text-sm text-elior-muted leading-relaxed max-w-md mx-auto">
                                                We couldn't find any products matching your search term. Try checking for typos or searching for a general botanical like <em>Moringa</em> or <em>Beetroot</em>.
                                            </p>
                                        </div>

                                        <div class="pt-2">
                                            <a
                                                href="{{ route('shop.search.index') }}"
                                                class="elior-btn-primary inline-flex items-center gap-2 text-xs uppercase tracking-widest font-semibold px-6 py-3"
                                            >
                                                <span>Explore All Products</span>
                                                <span class="icon-arrow-right text-xs"></span>
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </template>
                        </div>

                        <!-- Load More / Pagination Button -->
                        <div class="mt-12 text-center" v-if="links.next">
                            <button
                                class="elior-btn-outline inline-flex items-center gap-2 text-xs uppercase tracking-widest font-semibold px-8 py-3.5"
                                @click="loadMoreProducts"
                            >
                                <span>@lang('shop::app.categories.view.load-more')</span>
                                <span class="icon-arrow-down text-xs"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-search', {
                template: '#v-search-template',

                data() {
                    return {
                        isMobile: window.innerWidth <= 767,

                        isLoading: true,

                        isDrawerActive: {
                            toolbar: false,

                            filter: false,
                        },

                        filters: {
                            toolbar: {
                                default: {},

                                applied: {},
                            },

                            filter: {},
                        },

                        products: [],

                        links: {},
                    }
                },

                computed: {
                    queryParams() {
                        let queryParams = Object.assign({}, this.filters.filter, this.filters.toolbar.applied);

                        return this.removeJsonEmptyValues(queryParams);
                    },

                    queryString() {
                        return this.jsonToQueryString(this.queryParams);
                    },
                },

                watch: {
                    queryParams() {
                        this.getProducts();
                    },

                    queryString() {
                        window.history.pushState({}, '', '?' + this.queryString);
                    },
                },

                methods: {
                    setFilters(type, filters) {
                        this.filters[type] = filters;
                    },

                    clearFilters(type, filters) {
                        this.filters[type] = {};
                    },

                    getProducts() {
                        this.isDrawerActive = {
                            toolbar: false,

                            filter: false,
                        };

                        this.$axios.get(("{{ route('shop.api.products.index') }}"), {
                            params: this.queryParams
                        })
                            .then(response => {
                                this.isLoading = false;

                                this.products = response.data.data;

                                this.links = response.data.links;
                            }).catch(error => {
                                console.log(error);
                            });
                    },

                    loadMoreProducts() {
                        if (this.links.next) {
                            this.$axios.get(this.links.next).then(response => {
                                this.products = [...this.products, ...response.data.data];

                                this.links = response.data.links;
                            }).catch(error => {
                                console.log(error);
                            });
                        }
                    },

                    removeJsonEmptyValues(params) {
                        Object.keys(params).forEach(function (key) {
                            if ((! params[key] && params[key] !== undefined)) {
                                delete params[key];
                            }

                            if (Array.isArray(params[key])) {
                                params[key] = params[key].join(',');
                            }
                        });

                        return params;
                    },

                    jsonToQueryString(params) {
                        let parameters = new URLSearchParams();

                        for (const key in params) {
                            parameters.append(key, params[key]);
                        }

                        return parameters.toString();
                    }
                },
            });
        </script>
    @endPushOnce
</x-shop::layouts>
