@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('productViewHelper', 'Webkul\Product\Helpers\View')

@php
    $avgRatings = $reviewHelper->getAverageRating($product);

    $percentageRatings = $reviewHelper->getPercentageRating($product);

    $customAttributeValues = $productViewHelper->getAdditionalData($product);

    $attributeData = collect($customAttributeValues)->filter(fn ($item) => ! empty($item['value']));

    $weightUnit = core()->getConfigData('general.general.locale_options.weight_unit') ?: 'kgs';
    $wVal = (float) ($product->weight ?? 0);
    if ($weightUnit === 'lbs') {
        $formattedProductWeight = $wVal . ' lbs';
    } elseif ($weightUnit === 'grams') {
        $formattedProductWeight = ($wVal < 1 ? ((int) round($wVal * 1000)) : $wVal) . ' g';
    } else {
        $formattedProductWeight = $wVal >= 1 ? ($wVal . ' kg') : (($wVal * 1000) . ' g');
    }

    $isReviewEnabled = filter_var(core()->getConfigData('catalog.products.review.customer_review'), FILTER_VALIDATE_BOOLEAN)
        || filter_var(core()->getConfigData('catalog.products.review.guest_review'), FILTER_VALIDATE_BOOLEAN);
@endphp

@php
    $productFlat = $product->product_flats->where('channel', core()->getCurrentChannel()->code)->where('locale', app()->getLocale())->first() ?: $product->product_flats->first();
    $seoTitle = trim($productFlat?->meta_title ?: ($product->meta_title ?: '')) ?: $product->name . ' | ELIOR Botanicals';
    $seoDesc  = trim($productFlat?->meta_description ?: ($product->meta_description ?: '')) ?: \Illuminate\Support\Str::limit(strip_tags($product->description), 160, '');
    $seoKeys  = trim($productFlat?->meta_keywords ?: ($product->meta_keywords ?: '')) ?: 'botanical powders, superfoods, plant nutrition, ELIOR';
    $productBaseImage = product_image()->getProductBaseImage($product);
@endphp

<!-- SEO Meta Content -->
@push('meta')
    <meta name="title" content="{{ $seoTitle }}" />

    <meta name="description" content="{{ $seoDesc }}"/>

    <meta name="keywords" content="{{ $seoKeys }}"/>

    @if (core()->getConfigData('catalog.rich_snippets.products.enable'))
        <script type="application/ld+json">
            {!! app('Webkul\Product\Helpers\SEO')->getProductJsonLd($product) !!}
        </script>
    @endif

    <meta name="twitter:card" content="summary_large_image" />

    <meta name="twitter:title" content="{{ $seoTitle }}" />

    <meta name="twitter:description" content="{{ $seoDesc }}" />

    <meta name="twitter:image:alt" content="{{ $product->name }}" />

    <meta name="twitter:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:type" content="og:product" />

    <meta property="og:title" content="{{ $seoTitle }}" />

    <meta property="og:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:description" content="{{ $seoDesc }}" />

    <meta property="og:url" content="{{ route('shop.product_or_category.index', $product->url_key) }}" />
@endPush

<!-- Page Layout -->
<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        {{ trim($product->meta_title) != "" ? $product->meta_title : $product->name }}
    </x-slot>

    {!! view_render_event('bagisto.shop.products.view.before', ['product' => $product]) !!}

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        <x-shop::breadcrumbs
            name="product"
            :entity="$product"
        />
    @endif

    <!-- Product Information Vue Component -->
    <v-product>
        <x-shop::shimmer.products.view />
    </v-product>

    <!-- Information Section (Desktop Tabs) -->
    <div class="site-container mt-16 lg:mt-24 border-t border-elior-border/70 pt-10 max-1180:hidden">
        <x-shop::tabs
            position="center"
            ref="productTabs"
        >
            <!-- Description Tab -->
            {!! view_render_event('bagisto.shop.products.view.description.before', ['product' => $product]) !!}

            <x-shop::tabs.item
                id="descritpion-tab"
                class="!p-0"
                :title="trans('shop::app.products.view.description')"
                :is-selected="true"
            >
                <div class="max-w-4xl mx-auto mt-10 space-y-6">
                    <div class="prose prose-stone max-w-none text-elior-slate leading-relaxed font-sans text-sm sm:text-base [&_h2]:font-serif [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:text-elior-charcoal [&_h2]:mt-8 [&_h2]:mb-4 [&_h3]:font-serif [&_h3]:text-lg [&_h3]:font-semibold [&_h3]:text-elior-charcoal [&_h3]:mt-6 [&_h3]:mb-3 [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-2 [&_li]:text-sm [&_p]:text-sm [&_p]:leading-relaxed">
                        {!! $product->description !!}
                    </div>
                </div>
            </x-shop::tabs.item>

            {!! view_render_event('bagisto.shop.products.view.description.after', ['product' => $product]) !!}

            <!-- Additional Information / Specifications Tab -->
            @if(count($attributeData) || $product->weight || $product->sku)
                <x-shop::tabs.item
                    id="information-tab"
                    class="!p-0"
                    :title="trans('shop::app.products.view.additional-information')"
                    :is-selected="false"
                >
                    <div class="max-w-3xl mx-auto mt-10">
                        <div class="rounded-2xl border border-elior-border/80 bg-white overflow-hidden shadow-elior-subtle">
                            <table class="w-full text-left text-sm">
                                <tbody class="divide-y divide-elior-border/60">
                                    <tr class="hover:bg-[#FAF8F5]/50 transition-colors">
                                        <th class="py-3.5 px-6 font-medium text-elior-charcoal w-1/3 bg-[#FAF8F5]/30">SKU</th>
                                        <td class="py-3.5 px-6 text-elior-muted font-mono text-xs">{{ $product->sku }}</td>
                                    </tr>

                                    @if ($product->weight)
                                        <tr class="hover:bg-[#FAF8F5]/50 transition-colors">
                                            <th class="py-3.5 px-6 font-medium text-elior-charcoal w-1/3 bg-[#FAF8F5]/30">Net Weight</th>
                                            <td class="py-3.5 px-6 text-elior-muted">{{ $formattedProductWeight }}</td>
                                        </tr>
                                    @endif

                                    @foreach ($customAttributeValues as $customAttributeValue)
                                        @if (! empty($customAttributeValue['value']))
                                            <tr class="hover:bg-[#FAF8F5]/50 transition-colors">
                                                <th class="py-3.5 px-6 font-medium text-elior-charcoal w-1/3 bg-[#FAF8F5]/30">
                                                    {{ $customAttributeValue['label'] }}
                                                </th>
                                                <td class="py-3.5 px-6 text-elior-muted">
                                                    @if ($customAttributeValue['type'] == 'file')
                                                        <a
                                                            href="{{ Storage::url($product[$customAttributeValue['code']]) }}"
                                                            download="{{ $customAttributeValue['label'] }}"
                                                            class="inline-flex items-center gap-1.5 text-elior-botanical hover:underline font-medium"
                                                        >
                                                            <span class="icon-download text-lg"></span>
                                                            <span>Download</span>
                                                        </a>
                                                    @elseif ($customAttributeValue['type'] == 'image')
                                                        <a
                                                            href="{{ Storage::url($product[$customAttributeValue['code']]) }}"
                                                            download="{{ $customAttributeValue['label'] }}"
                                                        >
                                                            <img
                                                                class="h-8 w-8 rounded object-cover border border-elior-border"
                                                                src="{{ Storage::url($customAttributeValue['value']) }}"
                                                                alt="Attribute image"
                                                            />
                                                        </a>
                                                    @else
                                                        {{ $customAttributeValue['value'] }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </x-shop::tabs.item>
            @endif

            <!-- Shipping & Handling Policy Tab -->
            <x-shop::tabs.item
                id="shipping-tab"
                class="!p-0"
                title="Shipping & Dispatch"
                :is-selected="false"
            >
                <div class="max-w-3xl mx-auto mt-10 space-y-5 text-sm text-elior-slate leading-relaxed">
                    <div class="p-6 rounded-2xl bg-[#FAF8F5] border border-elior-border/70 space-y-3">
                        <h4 class="font-serif text-lg font-bold text-elior-charcoal">Botanical Freshness & Dispatch</h4>
                        <p class="text-elior-muted text-xs sm:text-sm">
                            Each botanical powder batch is milled and packed in airtight, protective pouches or jars to preserve living enzymes and delicate phytocompounds. Orders are dispatched within 24–48 hours directly from our certified packaging facility.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-5 rounded-xl bg-white border border-elior-border/70 shadow-elior-subtle space-y-1.5">
                            <p class="font-semibold text-xs uppercase tracking-wider text-elior-charcoal">Standard Delivery</p>
                            <p class="text-xs text-elior-muted">Delivered via priority air courier in 3–5 business days across domestic pin codes.</p>
                        </div>
                        <div class="p-5 rounded-xl bg-white border border-elior-border/70 shadow-elior-subtle space-y-1.5">
                            <p class="font-semibold text-xs uppercase tracking-wider text-elior-charcoal">Airtight Packaging</p>
                            <p class="text-xs text-elior-muted">UV-resistant, food-grade resealable barrier pouches for maximum shelf stability.</p>
                        </div>
                    </div>
                </div>
            </x-shop::tabs.item>

            <!-- Reviews Tab -->
            @if ($isReviewEnabled)
                <x-shop::tabs.item
                    id="review-tab"
                    class="!p-0"
                    :title="trans('shop::app.products.view.review')"
                    :is-selected="false"
                >
                    <div class="max-w-4xl mx-auto mt-10">
                        @include('shop::products.view.reviews')
                    </div>
                </x-shop::tabs.item>
            @endif
        </x-shop::tabs>
    </div>

    <!-- Information Section (Mobile Accordions) -->
    <div class="site-container mt-10 grid gap-3 1180:hidden">
        <!-- Description Accordion -->
        <x-shop::accordion
            class="rounded-xl border border-elior-border bg-white overflow-hidden"
            :is-active="true"
        >
            <x-slot:header class="bg-[#FAF8F5] !py-3.5 !px-5">
                <p class="text-sm font-semibold uppercase tracking-wider text-elior-charcoal font-serif">
                    @lang('shop::app.products.view.description')
                </p>
            </x-slot>

            <x-slot:content class="p-5">
                <div class="prose prose-stone text-xs sm:text-sm text-elior-muted leading-relaxed">
                    {!! $product->description !!}
                </div>
            </x-slot>
        </x-shop::accordion>

        <!-- Additional Information Accordion -->
        @if (count($attributeData) || $product->weight || $product->sku)
            <x-shop::accordion
                class="rounded-xl border border-elior-border bg-white overflow-hidden"
                :is-active="false"
            >
                <x-slot:header class="bg-[#FAF8F5] !py-3.5 !px-5">
                    <p class="text-sm font-semibold uppercase tracking-wider text-elior-charcoal font-serif">
                        @lang('shop::app.products.view.additional-information')
                    </p>
                </x-slot>

                <x-slot:content class="p-5">
                    <div class="space-y-2.5 text-xs text-elior-muted">
                        <div class="flex justify-between py-1.5 border-b border-elior-border/40">
                            <span class="font-medium text-elior-charcoal">SKU</span>
                            <span class="font-mono">{{ $product->sku }}</span>
                        </div>

                        @if ($product->weight)
                            <div class="flex justify-between py-1.5 border-b border-elior-border/40">
                                <span class="font-medium text-elior-charcoal">Net Weight</span>
                                <span>{{ $formattedProductWeight }}</span>
                            </div>
                        @endif

                        @foreach ($customAttributeValues as $customAttributeValue)
                            @if (! empty($customAttributeValue['value']))
                                <div class="flex justify-between py-1.5 border-b border-elior-border/40">
                                    <span class="font-medium text-elior-charcoal">{{ $customAttributeValue['label'] }}</span>
                                    <span>{{ $customAttributeValue['value'] ?? '-' }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </x-slot>
            </x-shop::accordion>
        @endif

        <!-- Shipping Accordion -->
        <x-shop::accordion
            class="rounded-xl border border-elior-border bg-white overflow-hidden"
            :is-active="false"
        >
            <x-slot:header class="bg-[#FAF8F5] !py-3.5 !px-5">
                <p class="text-sm font-semibold uppercase tracking-wider text-elior-charcoal font-serif">
                    Shipping & Dispatch
                </p>
            </x-slot>

            <x-slot:content class="p-5 text-xs text-elior-muted space-y-2">
                <p>Orders are milled, fresh-sealed, and dispatched within 24–48 hours.</p>
                <p>Standard delivery takes 3–5 business days with live courier tracking.</p>
            </x-slot>
        </x-shop::accordion>

        <!-- Reviews Accordion -->
        @if ($isReviewEnabled)
            <x-shop::accordion
                class="rounded-xl border border-elior-border bg-white overflow-hidden"
                :is-active="false"
            >
                <x-slot:header
                    class="bg-[#FAF8F5] !py-3.5 !px-5"
                    id="review-accordian-button"
                >
                    <p class="text-sm font-semibold uppercase tracking-wider text-elior-charcoal font-serif">
                        @lang('shop::app.products.view.review')
                    </p>
                </x-slot>

                <x-slot:content class="p-4 sm:p-5">
                    @include('shop::products.view.reviews')
                </x-slot:content>
            </x-shop::accordion>
        @endif
    </div>

    <!-- Related Products Associations -->
    <div class="site-container mt-16 lg:mt-24 border-t border-elior-border/70 pt-12 pb-16">
        <v-product-associations></v-product-associations>
    </div>

    {!! view_render_event('bagisto.shop.products.view.after', ['product' => $product]) !!}

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-product-template"
        >
            <x-shop::form
                v-slot="{ meta, errors, handleSubmit }"
                as="div"
            >
                <form
                    ref="formData"
                    @submit="handleSubmit($event, addToCart)"
                >
                    <input
                        type="hidden"
                        name="product_id"
                        value="{{ $product->id }}"
                    >

                    <input
                        type="hidden"
                        name="is_buy_now"
                        v-model="is_buy_now"
                    >

                    <div class="site-container py-6 lg:py-10">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
                            <!-- Left Column: Gallery Blade Inclusion -->
                            <div class="lg:col-span-6 xl:col-span-7 flex justify-center lg:justify-start w-full">
                                @include('shop::products.view.gallery')
                            </div>

                            <!-- Right Column: Product Purchasing Details -->
                            <div class="lg:col-span-6 xl:col-span-5 space-y-6 w-full">
                                {!! view_render_event('bagisto.shop.products.name.before', ['product' => $product]) !!}

                                <!-- Top Meta / Category Pill & Wishlist -->
                                <div class="flex items-center justify-between gap-3">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="elior-badge-botanical text-[10px] tracking-wider uppercase">
                                            @if ($product->categories->where('id', '!=', 1)->first())
                                                {{ $product->categories->where('id', '!=', 1)->first()->name }}
                                            @else
                                                Botanical Harvest
                                            @endif
                                        </span>

                                        @if ($product->new)
                                            <span class="elior-badge-terracotta text-[10px] tracking-wider uppercase">
                                                New Batch
                                            </span>
                                        @endif
                                    </div>

                                    @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                                        <button
                                            type="button"
                                            class="flex h-10 w-10 items-center justify-center rounded-full border border-[#e5decb] bg-white text-[#163923] hover:text-red-500 hover:border-red-200 transition-all duration-200 shadow-sm"
                                            aria-label="@lang('shop::app.products.view.add-to-wishlist')"
                                            :class="isWishlist ? 'text-red-600 border-red-200 bg-red-50/50' : ''"
                                            @click="addToWishlist"
                                        >
                                            <span :class="isWishlist ? 'icon-heart-fill text-xl' : 'icon-heart text-xl'"></span>
                                        </button>
                                    @endif
                                </div>

                                <!-- Product Title -->
                                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923] leading-[1.12]" v-pre>
                                    {{ $product->name }}
                                </h1>

                                {!! view_render_event('bagisto.shop.products.name.after', ['product' => $product]) !!}

                                <!-- Rating Summary (If Available) -->
                                {!! view_render_event('bagisto.shop.products.rating.before', ['product' => $product]) !!}

                                @if ($isReviewEnabled && ($totalRatings = $reviewHelper->getTotalFeedback($product)))
                                    <div
                                        class="inline-flex items-center gap-2 cursor-pointer pt-1"
                                        role="button"
                                        tabindex="0"
                                        @click="scrollToReview"
                                    >
                                        <x-shop::products.ratings
                                            class="transition-all hover:border-gray-400"
                                            :average="$avgRatings"
                                            :total="$totalRatings"
                                            ::rating="true"
                                        />
                                        <span class="text-xs text-[#677a6d] underline underline-offset-2">
                                            ({{ $totalRatings }} {{ $totalRatings == 1 ? 'Review' : 'Reviews' }})
                                        </span>
                                    </div>
                                @endif

                                {!! view_render_event('bagisto.shop.products.rating.after', ['product' => $product]) !!}

                                <!-- Pricing & Stock Status -->
                                {!! view_render_event('bagisto.shop.products.price.before', ['product' => $product]) !!}

                                <div class="flex flex-wrap items-baseline gap-4 pt-1 border-b border-[#e5decb] pb-5">
                                    <div class="text-3xl font-bold text-[#163923] flex items-center gap-3">
                                        {!! $product->getTypeInstance()->getPriceHtml() !!}
                                    </div>

                                    <!-- Stock Availability Badge -->
                                    @if ($product->isSaleable(1))
                                        <span class="elior-badge-botanical text-[11px] font-bold tracking-wider uppercase">
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#205132] animate-pulse mr-1.5"></span>
                                            In Stock
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-700 text-[11px] font-semibold tracking-wider uppercase border border-red-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                            Out of Stock
                                        </span>
                                    @endif

                                    @if (\Webkul\Tax\Facades\Tax::isInclusiveTaxProductPrices())
                                        <span class="text-xs text-elior-muted">
                                            (@lang('shop::app.products.view.tax-inclusive'))
                                        </span>
                                    @endif
                                </div>

                                @if (count($product->getTypeInstance()->getCustomerGroupPricingOffers()))
                                    <div class="grid gap-1.5 text-xs text-elior-muted">
                                        @foreach ($product->getTypeInstance()->getCustomerGroupPricingOffers() as $offer)
                                            <p class="[&>*]:text-elior-charcoal">
                                                {!! $offer !!}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif

                                {!! view_render_event('bagisto.shop.products.price.after', ['product' => $product]) !!}

                                <!-- Short Description -->
                                {!! view_render_event('bagisto.shop.products.short_description.before', ['product' => $product]) !!}

                                @if ($product->short_description)
                                    <div class="text-sm leading-relaxed text-elior-muted">
                                        {!! $product->short_description !!}
                                    </div>
                                @endif

                                {!! view_render_event('bagisto.shop.products.short_description.after', ['product' => $product]) !!}

                                <!-- Product Types Includes -->
                                @include('shop::products.view.types.simple')

                                @include('shop::products.view.types.configurable')

                                @include('shop::products.view.types.grouped')

                                @include('shop::products.view.types.bundle')

                                @include('shop::products.view.types.downloadable')

                                @include('shop::products.view.types.booking')

                                <!-- Purchase Actions & Quantity Controls -->
                                <div class="space-y-3 pt-4">
                                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                        {!! view_render_event('bagisto.shop.products.view.quantity.before', ['product' => $product]) !!}

                                        @if ($product->getTypeInstance()->showQuantityBox())
                                            <x-shop::quantity-changer
                                                name="quantity"
                                                value="1"
                                                class="h-12 w-full sm:w-[130px] px-3 justify-between"
                                            />
                                        @endif

                                        {!! view_render_event('bagisto.shop.products.view.quantity.after', ['product' => $product]) !!}

                                        @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                                            <!-- Add To Cart Button -->
                                            {!! view_render_event('bagisto.shop.products.view.add_to_cart.before', ['product' => $product]) !!}

                                            <button
                                                type="submit"
                                                class="elior-btn-primary h-12 flex-1 text-xs uppercase tracking-widest font-semibold flex items-center justify-center gap-2 shadow-elior-card disabled:opacity-50 disabled:cursor-not-allowed"
                                                :disabled="! {{ $product->isSaleable(1) ? 'true' : 'false' }} || isStoring.addToCart"
                                                @click="is_buy_now=0;"
                                            >
                                                <span v-if="isStoring.addToCart" class="inline-block h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></span>
                                                <span>@lang('shop::app.products.view.add-to-cart')</span>
                                            </button>

                                            {!! view_render_event('bagisto.shop.products.view.add_to_cart.after', ['product' => $product]) !!}
                                        @else
                                            <button
                                                type="button"
                                                class="elior-btn-primary h-12 flex-1 text-xs uppercase tracking-widest font-semibold flex items-center justify-center gap-2"
                                                @click="$refs.contactUsModal.open()"
                                            >
                                                @lang('shop::app.components.layouts.footer.contact-us')
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Buy Now Button -->
                                    @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                                        {!! view_render_event('bagisto.shop.products.view.buy_now.before', ['product' => $product]) !!}

                                        @if (core()->getConfigData('catalog.products.storefront.buy_now_button_display'))
                                            <button
                                                type="submit"
                                                class="elior-btn-outline h-12 w-full text-xs uppercase tracking-widest font-semibold flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                                :disabled="! {{ $product->isSaleable(1) ? 'true' : 'false' }} || isStoring.buyNow"
                                                @click="is_buy_now=1;"
                                            >
                                                <span v-if="isStoring.buyNow" class="inline-block h-4 w-4 animate-spin rounded-full border-2 border-elior-charcoal border-t-transparent"></span>
                                                <span>@lang('shop::app.products.view.buy-now')</span>
                                            </button>
                                        @endif

                                        {!! view_render_event('bagisto.shop.products.view.buy_now.after', ['product' => $product]) !!}
                                    @endif
                                </div>

                                {!! view_render_event('bagisto.shop.products.view.additional_actions.before', ['product' => $product]) !!}

                                <!-- Compare Action -->
                                {!! view_render_event('bagisto.shop.products.view.compare.before', ['product' => $product]) !!}

                                @if (core()->getConfigData('catalog.products.settings.compare_option'))
                                    <div class="pt-1 flex items-center justify-start">
                                        <button
                                            type="button"
                                            class="inline-flex items-center gap-2 text-xs font-medium text-elior-muted hover:text-elior-botanical transition-colors cursor-pointer"
                                            @click="is_buy_now=0; addToCompare({{ $product->id }})"
                                        >
                                            <span class="icon-compare text-lg"></span>
                                            <span>@lang('shop::app.products.view.compare')</span>
                                        </button>
                                    </div>
                                @endif

                                {!! view_render_event('bagisto.shop.products.view.compare.after', ['product' => $product]) !!}

                                {!! view_render_event('bagisto.shop.products.view.additional_actions.after', ['product' => $product]) !!}

                                <!-- Editorial Botanical Trust Indicators -->
                                <div class="grid grid-cols-2 gap-3 pt-6 border-t border-[#e5decb] text-xs text-[#163923] font-medium">
                                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-white border border-[#e5decb] shadow-sm">
                                        <span class="text-[#205132] text-sm"><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span></span>
                                        <span>Single-Origin Botanicals</span>
                                    </div>
                                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-white border border-[#e5decb] shadow-sm">
                                        <span class="text-[#205132] text-sm"><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">ac_unit</span></span>
                                        <span>Cold-Dehydrated &lt; 42°C</span>
                                    </div>
                                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-white border border-[#e5decb] shadow-sm">
                                        <span class="text-[#205132] text-sm"><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">bolt</span></span>
                                        <span>100% Whole Plants</span>
                                    </div>
                                    <div class="flex items-center gap-2.5 p-3 rounded-xl bg-white border border-[#e5decb] shadow-sm">
                                        <span class="text-[#205132] text-sm"><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">shield</span></span>
                                        <span>Zero Synthetic Fillers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </x-shop::form>

            <!-- Contact Us Modal -->
            <x-shop::modal ref="contactUsModal">
                <x-slot:header>
                <h2 class="text-lg font-semibold max-md:text-base">
                        @lang('shop::app.products.view.contact-us.title')
                    </h2>
                </x-slot>

                <x-slot:content>
                    <x-shop::form :action="route('shop.home.contact_us.send_mail')">
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.products.view.contact-us.name')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="text"
                                name="name"
                                rules="required"
                                :value="old('name')"
                                :label="trans('shop::app.products.view.contact-us.name')"
                                :placeholder="trans('shop::app.products.view.contact-us.name')"
                                :aria-label="trans('shop::app.products.view.contact-us.name')"
                                aria-required="true"
                            />

                            <x-shop::form.control-group.error control-name="name" />
                        </x-shop::form.control-group>

                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.products.view.contact-us.email')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="email"
                                name="email"
                                rules="required|email"
                                :value="old('email')"
                                :label="trans('shop::app.products.view.contact-us.email')"
                                :placeholder="trans('shop::app.products.view.contact-us.email')"
                                :aria-label="trans('shop::app.products.view.contact-us.email')"
                                aria-required="true"
                            />

                            <x-shop::form.control-group.error control-name="email" />
                        </x-shop::form.control-group>

                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label>
                                @lang('shop::app.products.view.contact-us.phone-number')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="text"
                                name="contact"
                                rules="phone"
                                :value="old('contact')"
                                :label="trans('shop::app.products.view.contact-us.phone-number')"
                                :placeholder="trans('shop::app.products.view.contact-us.phone-number')"
                                :aria-label="trans('shop::app.products.view.contact-us.phone-number')"
                            />

                            <x-shop::form.control-group.error control-name="contact" />
                        </x-shop::form.control-group>

                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.products.view.contact-us.desc')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="textarea"
                                name="message"
                                rules="required"
                                :label="trans('shop::app.products.view.contact-us.message')"
                                :placeholder="trans('shop::app.products.view.contact-us.describe-here')"
                                :aria-label="trans('shop::app.products.view.contact-us.message')"
                                aria-required="true"
                                rows="6"
                            />

                            <x-shop::form.control-group.error control-name="message" />
                        </x-shop::form.control-group>

                        @if (core()->getConfigData('customer.captcha.credentials.status'))
                            <x-shop::form.control-group class="mt-5">
                                {!! \Webkul\Customer\Facades\Captcha::render() !!}

                                <x-shop::form.control-group.error control-name="recaptcha_token" />
                            </x-shop::form.control-group>
                        @endif

                        <div class="mt-6 flex justify-end">
                            <button
                                type="submit"
                                class="primary-button rounded-2xl px-8 py-3 max-sm:rounded-lg max-sm:px-6 max-sm:py-2"
                            >
                                @lang('shop::app.products.view.contact-us.submit')
                            </button>
                        </div>
                    </x-shop::form>
                </x-slot>
            </x-shop::modal>
        </script>

        <script type="module">
            app.component('v-product', {
                template: '#v-product-template',

                data() {
                    return {
                        isWishlist: false,

                        isCustomer: '{{ auth()->guard('customer')->check() }}',

                        is_buy_now: 0,

                        isStoring: {
                            addToCart: false,

                            buyNow: false,
                        },
                    }
                },

                mounted() {
                    this.checkWishlistStatus();
                },

                methods: {
                    addToCart(params) {
                        const operation = this.is_buy_now ? 'buyNow' : 'addToCart';

                        this.isStoring[operation] = true;

                        let formData = new FormData(this.$refs.formData);

                        this.ensureQuantity(formData);

                        this.$axios.post('{{ route("shop.api.checkout.cart.store") }}', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then(response => {
                                if (response.data.message) {
                                    this.$emitter.emit('update-mini-cart', response.data.data);

                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                                    if (operation === 'addToCart') {
                                        this.$emitter.emit('open-mini-cart');
                                    }

                                    if (response.data.redirect) {
                                        window.location.href= response.data.redirect;
                                    }
                                } else {
                                    this.$emitter.emit('add-flash', { type: 'warning', message: response.data.data.message });
                                }

                                this.isStoring[operation] = false;
                            })
                            .catch(error => {
                                this.isStoring[operation] = false;

                                this.$emitter.emit('add-flash', { type: 'warning', message: error.response.data.message });
                            });
                    },

                    checkWishlistStatus() {
                        if (this.isCustomer) {
                            /**
                             * Fetches the wishlist items for the customer and checks whether the current
                             * product exists in the wishlist. If found, `isWishlist` is set to true;
                             * otherwise, it is set to false.
                             *
                             * This approach is used due to Full Page Cache (FPC) limitations. We cannot
                             * use a replacer here because `product_id` is dynamic, and the replacer
                             * cannot reliably detect it.
                             */
                            this.$axios.get('{{ route('shop.api.customers.account.wishlist.index') }}')
                                .then(response => {
                                    const wishlistItems = response.data.data || [];

                                    this.isWishlist = Boolean(wishlistItems.find(item => item.product.id == "{{ $product->id }}")?.product?.is_wishlist);
                                })
                                .catch(error => {});
                        }
                    },

                    addToWishlist() {
                        if (this.isCustomer) {
                            this.$axios.post('{{ route('shop.api.customers.account.wishlist.store') }}', {
                                    product_id: "{{ $product->id }}"
                                })
                                .then(response => {
                                    this.isWishlist = ! this.isWishlist;

                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.data.message });
                                })
                                .catch(error => {});
                        } else {
                            window.location.href = "{{ route('shop.customer.session.index')}}";
                        }
                    },

                    addToCompare(productId) {
                        /**
                         * This will handle for customers.
                         */
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

                        /**
                         * This will handle for guests.
                         */
                        let existingItems = this.getStorageValue(this.getCompareItemsStorageKey()) ?? [];

                        if (existingItems.length) {
                            if (! existingItems.includes(productId)) {
                                existingItems.push(productId);

                                this.setStorageValue(this.getCompareItemsStorageKey(), existingItems);

                                this.$emitter.emit('add-flash', { type: 'success', message: "@lang('shop::app.products.view.add-to-compare')" });
                            } else {
                                this.$emitter.emit('add-flash', { type: 'warning', message: "@lang('shop::app.products.view.already-in-compare')" });
                            }
                        } else {
                            this.setStorageValue(this.getCompareItemsStorageKey(), [productId]);

                            this.$emitter.emit('add-flash', { type: 'success', message: "@lang('shop::app.products.view.add-to-compare')" });
                        }
                    },

                    updateQty(quantity, id) {
                        this.isLoading = true;

                        let qty = {};

                        qty[id] = quantity;

                        this.$axios.put('{{ route('shop.api.checkout.cart.update') }}', { qty })
                            .then(response => {
                                if (response.data.message) {
                                    this.cart = response.data.data;
                                } else {
                                    this.$emitter.emit('add-flash', { type: 'warning', message: response.data.data.message });
                                }

                                this.isLoading = false;
                            }).catch(error => this.isLoading = false);
                    },

                    getCompareItemsStorageKey() {
                        return 'compare_items';
                    },

                    setStorageValue(key, value) {
                        localStorage.setItem(key, JSON.stringify(value));
                    },

                    getStorageValue(key) {
                        let value = localStorage.getItem(key);

                        if (value) {
                            value = JSON.parse(value);
                        }

                        return value;
                    },

                    scrollToReview() {
                        let accordianElement = document.querySelector('#review-accordian-button');

                        if (accordianElement) {
                            accordianElement.click();

                            accordianElement.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }

                        let tabElement = document.querySelector('#review-tab-button');

                        if (tabElement) {
                            tabElement.click();

                            tabElement.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    },

                    ensureQuantity(formData) {
                        if (! formData.has('quantity')) {
                            formData.append('quantity', 1);
                        }
                    },
                },
            });
        </script>

        <script
            type="text/x-template"
            id="v-product-associations-template"
        >
            <div ref="carouselWrapper">
                <template v-if="isVisible">
                    <!-- Featured Products -->
                    <x-shop::products.carousel
                        :title="trans('shop::app.products.view.related-product-title')"
                        :src="route('shop.api.products.related.index', ['id' => $product->id])"
                    />

                    <!-- Up-sell Products -->
                    <x-shop::products.carousel
                        :title="trans('shop::app.products.view.up-sell-title')"
                        :src="route('shop.api.products.up-sell.index', ['id' => $product->id])"
                    />
                </template>
            </div>
        </script>

        <script type="module">
            app.component('v-product-associations', {
                template: '#v-product-associations-template',

                data() {
                    return {
                        isVisible: false,
                    };
                },

                mounted() {
                    const observer = new IntersectionObserver(
                        (entries) => {
                            entries.forEach((entry) => {
                                if (entry.isIntersecting) {
                                    this.isVisible = true;
                                    observer.unobserve(entry.target); // Stop observing
                                }
                            });
                        },
                        { threshold: 0.1 }
                    );

                    observer.observe(this.$refs.carouselWrapper);
                }
            });
        </script>

        @if (core()->getConfigData('customer.captcha.credentials.status'))
            {!! \Webkul\Customer\Facades\Captcha::renderJS() !!}
        @endif
    @endPushOnce
</x-shop::layouts>
