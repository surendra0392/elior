<div class="rounded-3xl border border-[#e5decb] bg-white p-6 sm:p-8 shadow-sm space-y-6">
    <!-- Header -->
    <div class="border-b border-[#e5decb]/60 pb-4">
        <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#163923]" role="heading" aria-level="2">
            @lang('shop::app.checkout.onepage.summary.cart-summary')
            <span class="text-xs font-sans font-normal text-[#677a6d]" v-if="cart?.items?.length">
                (@{{ cart.items.length }} @{{ cart.items.length === 1 ? 'item' : 'items' }})
            </span>
        </h2>
    </div>

    <!-- Cart Items (Compact) -->
    <div class="divide-y divide-elior-border/60 max-h-64 overflow-y-auto pr-1">
        <div
            class="py-3.5 first:pt-0 last:pb-0 flex gap-3 items-center justify-between"
            v-for="item in cart.items"
        >
            <div class="flex items-center gap-3 min-w-0">
                {!! view_render_event('bagisto.shop.checkout.onepage.summary.item_image.before') !!}

                <div class="shrink-0 w-12 h-12 rounded-xl bg-[#FAF8F5] border border-elior-border/70 overflow-hidden flex items-center justify-center">
                    <img
                        class="w-full h-full object-cover"
                        :src="item.base_image.small_image_url"
                        :alt="item.name"
                    />
                </div>

                {!! view_render_event('bagisto.shop.checkout.onepage.summary.item_image.after') !!}

                <div class="min-w-0">
                    {!! view_render_event('bagisto.shop.checkout.onepage.summary.item_name.before') !!}

                    <p class="font-serif text-xs sm:text-sm font-semibold text-elior-charcoal truncate">
                        @{{ item.name }}
                    </p>

                    {!! view_render_event('bagisto.shop.checkout.onepage.summary.item_name.after') !!}

                    <p class="text-[11px] text-elior-muted">
                        Qty: @{{ item.quantity }}
                    </p>
                </div>
            </div>

            <div class="text-right shrink-0">
                <span class="font-serif text-xs sm:text-sm font-bold text-elior-charcoal">
                    <template v-if="displayTax.prices == 'including_tax'">
                        @{{ item.formatted_total_incl_tax }}
                    </template>
                    <template v-else>
                        @{{ item.formatted_total }}
                    </template>
                </span>
            </div>
        </div>
    </div>

    <!-- Cart Totals Breakdown -->
    <div class="border-t border-elior-border/60 pt-4 space-y-3 text-xs sm:text-sm">
        <!-- Original Price (MRP) when discount exists -->
        <div class="flex justify-between items-center text-xs text-[#677a6d]" v-if="cart.has_discount">
            <span>Original Price (MRP)</span>
            <span class="line-through font-medium">@{{ cart.formatted_regular_sub_total }}</span>
        </div>

        <!-- Discount Savings Row -->
        <div class="flex justify-between items-center text-xs font-semibold text-[#205132]" v-if="cart.has_discount">
            <span class="inline-flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[14px]">local_offer</span>
                Discount & Savings
            </span>
            <span>- @{{ cart.formatted_total_discount }}</span>
        </div>

        <!-- Sub Total -->
        {!! view_render_event('bagisto.shop.checkout.onepage.summary.sub_total.before') !!}

        <div class="flex justify-between items-center text-elior-slate" :class="{'pt-1 border-t border-[#e5decb]/60': cart.has_discount}">
            <span>@lang('shop::app.checkout.onepage.summary.sub-total')</span>

            <span class="font-semibold text-elior-charcoal">
                <template v-if="displayTax.subtotal == 'including_tax'">
                    @{{ cart.formatted_sub_total_incl_tax }}
                </template>
                <template v-else-if="displayTax.subtotal == 'both'">
                    @{{ cart.formatted_sub_total_incl_tax }}
                    <span class="text-xs text-elior-muted block text-right font-normal">(@lang('shop::app.checkout.onepage.summary.excl-tax') @{{ cart.formatted_sub_total }})</span>
                </template>
                <template v-else>
                    @{{ cart.formatted_sub_total }}
                </template>
            </span>
        </div>

        {!! view_render_event('bagisto.shop.checkout.onepage.summary.sub_total.after') !!}

        <!-- Discount Amount (Coupon) -->
        {!! view_render_event('bagisto.shop.checkout.onepage.summary.discount_amount.before') !!}

        <template v-if="cart.discount_amount && parseFloat(cart.discount_amount) > 0">
            <div class="flex justify-between items-center text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-200 text-xs font-semibold">
                <span>@lang('shop::app.checkout.onepage.summary.discount-amount')</span>
                <span>- @{{ cart.formatted_discount_amount }}</span>
            </div>
        </template>

        {!! view_render_event('bagisto.shop.checkout.onepage.summary.discount_amount.after') !!}

        <!-- Coupon Application -->
        {!! view_render_event('bagisto.shop.checkout.onepage.summary.coupon.before') !!}

        <div class="pt-1 pb-1 border-t border-elior-border/60">
            @include('shop::checkout.coupon')
        </div>

        {!! view_render_event('bagisto.shop.checkout.onepage.summary.coupon.after') !!}

        <!-- Delivery / Shipping Charges -->
        {!! view_render_event('bagisto.shop.checkout.onepage.summary.delivery_charges.before') !!}

        <div class="flex justify-between items-center text-elior-slate" v-if="cart.selected_shipping_rate || cart.shipping_method">
            <span>@lang('shop::app.checkout.onepage.summary.delivery-charges')</span>
            <span class="font-semibold text-elior-charcoal">
                <template v-if="parseFloat(cart.shipping_amount || 0) <= 0">
                    <span class="text-[#205132] font-bold">FREE</span>
                </template>
                <template v-else-if="displayTax.shipping == 'including_tax'">
                    + @{{ cart.formatted_shipping_amount_incl_tax }}
                </template>
                <template v-else>
                    + @{{ cart.formatted_shipping_amount }}
                </template>
            </span>
        </div>
        <div class="flex justify-between items-center text-xs text-elior-muted" v-else-if="cart.have_stockable_items">
            <span>Shipping</span>
            <span>Calculated automatically</span>
        </div>

        {!! view_render_event('bagisto.shop.checkout.onepage.summary.delivery_charges.after') !!}

        <!-- Taxes -->
        {!! view_render_event('bagisto.shop.checkout.onepage.summary.tax.before') !!}

        <div class="flex justify-between items-center text-elior-slate" v-if="cart.tax_total && parseFloat(cart.tax_total) > 0">
            <span>@lang('shop::app.checkout.onepage.summary.tax')</span>
            <span class="font-semibold text-elior-charcoal">+ @{{ cart.formatted_tax_total }}</span>
        </div>

        {!! view_render_event('bagisto.shop.checkout.onepage.summary.tax.after') !!}

        <!-- Grand Total -->
        {!! view_render_event('bagisto.shop.checkout.onepage.summary.grand_total.before') !!}

        <div class="pt-3 border-t border-elior-border/80 flex justify-between items-baseline">
            <span class="font-serif text-base font-bold text-elior-charcoal">
                @lang('shop::app.checkout.onepage.summary.grand-total')
            </span>

            <span class="font-serif text-2xl sm:text-3xl font-bold text-elior-charcoal">
                @{{ cart.formatted_grand_total }}
            </span>
        </div>

        {!! view_render_event('bagisto.shop.checkout.onepage.summary.grand_total.after') !!}

        <!-- Mobile Place Order CTA -->
        <div class="block lg:hidden pt-3" v-if="canPlaceOrder">
            <x-shop::button
                type="button"
                class="elior-btn-primary h-12 w-full text-xs uppercase tracking-widest font-semibold flex items-center justify-center gap-2 shadow-elior-card"
                :title="trans('shop::app.checkout.onepage.summary.place-order')"
                ::disabled="isPlacingOrder"
                ::loading="isPlacingOrder"
                @click="placeOrder"
            />
        </div>

        <!-- Trust Badges -->
        <div class="pt-3 border-t border-elior-border/60 space-y-1.5 text-[11px] text-elior-muted">
            <div class="flex items-center gap-2">
                <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">lock</span></span>
                <span>256-Bit Encrypted Secure Checkout</span>
            </div>
            <div class="flex items-center gap-2">
                <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">inventory_2</span></span>
                <span>Fresh Sealed Dispatch from Certified Facility</span>
            </div>
        </div>
    </div>
</div>
