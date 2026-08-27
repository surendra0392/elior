<!-- Estimate Tax and Shipping -->
{!! view_render_event('bagisto.shop.checkout.cart.summary.estimate_shipping.before') !!}

<x-shop::accordion
    class="overflow-hidden rounded-2xl border border-elior-border/80 bg-[#FAF8F5]/40"
    :is-active="false"
>
    <x-slot:header class="p-4 font-semibold text-xs sm:text-sm text-elior-charcoal hover:text-elior-botanical transition-colors cursor-pointer flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-elior-botanical text-[18px]">local_shipping</span>
            <span>@lang('shop::app.checkout.cart.summary.estimate-shipping.title')</span>
        </div>
    </x-slot>

    <x-slot:content class="p-4 pt-1 border-t border-elior-border/60">
        <v-estimate-tax-shipping
            :cart="cart"
            @processed="setCart"
        ></v-estimate-tax-shipping>
    </x-slot>
</x-shop::accordion>

{!! view_render_event('bagisto.shop.checkout.cart.summary.estimate_shipping.after') !!}

@pushOnce('scripts')
    <script type="text/x-template" id="v-estimate-tax-shipping-template">
        <div class="space-y-3.5">
            <p class="text-xs text-elior-muted leading-relaxed">
                @lang('shop::app.checkout.cart.summary.estimate-shipping.info')
            </p>

            <form @submit.prevent="calculateShipping" class="space-y-3">
                <!-- Country -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-elior-charcoal">
                        @lang('shop::app.checkout.cart.summary.estimate-shipping.country')
                    </label>

                    <select
                        name="country"
                        v-model="selectedCountry"
                        @change="onCountryChange"
                        class="w-full h-10 px-3 rounded-xl border border-elior-border bg-white text-xs text-elior-charcoal focus:border-elior-botanical focus:ring-1 focus:ring-elior-botanical outline-none"
                    >
                        <option value="">
                            @lang('shop::app.checkout.cart.summary.estimate-shipping.select-country')
                        </option>

                        <option
                            v-for="country in countries"
                            :key="country.code"
                            :value="country.code"
                            v-text="country.name"
                        ></option>
                    </select>
                </div>

                <!-- State -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-elior-charcoal">
                        @lang('shop::app.checkout.cart.summary.estimate-shipping.state')
                    </label>

                    <select
                        v-if="haveStates"
                        name="state"
                        v-model="selectedState"
                        :disabled="!selectedCountry"
                        @change="calculateShipping"
                        class="w-full h-10 px-3 rounded-xl border border-elior-border bg-white text-xs text-elior-charcoal focus:border-elior-botanical focus:ring-1 focus:ring-elior-botanical outline-none disabled:bg-gray-100 disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                        <option value="">
                            @lang('shop::app.checkout.cart.summary.estimate-shipping.select-state')
                        </option>

                        <option
                            v-for="state in states[selectedCountry]"
                            :key="state.code"
                            :value="state.code"
                            v-text="state.default_name"
                        ></option>
                    </select>

                    <input
                        v-else
                        type="text"
                        name="state"
                        v-model="selectedState"
                        :disabled="!selectedCountry"
                        @change="calculateShipping"
                        :placeholder="selectedCountry ? 'Enter state' : 'Select country first'"
                        class="w-full h-10 px-3 rounded-xl border border-elior-border bg-white text-xs text-elior-charcoal focus:border-elior-botanical focus:ring-1 focus:ring-elior-botanical outline-none disabled:bg-gray-100 disabled:opacity-60 disabled:cursor-not-allowed"
                    />
                </div>

                <!-- Postcode -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-elior-charcoal">
                        @lang('shop::app.checkout.cart.summary.estimate-shipping.postcode')
                    </label>

                    <input
                        type="text"
                        name="postcode"
                        v-model="postcode"
                        :disabled="!selectedCountry"
                        @change="calculateShipping"
                        :placeholder="selectedCountry ? 'e.g. 500072' : 'Select country first'"
                        class="w-full h-10 px-3 rounded-xl border border-elior-border bg-white text-xs text-elior-charcoal focus:border-elior-botanical focus:ring-1 focus:ring-elior-botanical outline-none disabled:bg-gray-100 disabled:opacity-60 disabled:cursor-not-allowed"
                    />
                </div>

                <!-- Action Buttons -->
                <div class="pt-1 flex items-center gap-2">
                    <button
                        type="button"
                        @click="calculateShipping"
                        :disabled="isCalculating || !selectedCountry || !selectedState"
                        class="elior-btn-primary h-10 flex-1 text-xs uppercase tracking-widest font-semibold flex items-center justify-center gap-2 disabled:opacity-50"
                    >
                        <span v-if="! isCalculating">Calculate Shipping</span>
                        <span v-else class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Calculating...</span>
                        </span>
                    </button>

                    <button
                        type="button"
                        v-if="selectedCountry || selectedState || postcode || rates.length"
                        @click="resetShipping"
                        :disabled="isCalculating"
                        class="h-10 px-3.5 rounded-xl border border-elior-border bg-white text-xs font-semibold text-elior-slate hover:text-red-600 hover:border-red-300 hover:bg-red-50/50 transition-all flex items-center justify-center gap-1.5 shrink-0"
                        title="Clear estimate"
                    >
                        <span class="material-symbols-outlined text-[16px]">restart_alt</span>
                        <span>Clear</span>
                    </button>
                </div>
            </form>

            <!-- Calculated Shipping Results -->
            <div class="space-y-2 pt-2 border-t border-elior-border/60" v-if="rates.length">
                <p class="text-[11px] font-semibold uppercase tracking-wider text-elior-muted">
                    Available Rates
                </p>

                <div class="space-y-2">
                    <div
                        v-for="rate in rates"
                        :key="rate.method"
                        class="p-3 rounded-xl border-2 bg-white flex items-center justify-between gap-3 cursor-pointer transition-all"
                        :class="selectedMethod === rate.method ? 'border-elior-botanical bg-[#FAF8F5]' : 'border-elior-border/70 hover:border-elior-botanical/50'"
                        @click="applyShippingRate(rate.method)"
                    >
                        <div class="flex items-center gap-2.5">
                            <div 
                                class="h-4 w-4 rounded-full border-2 flex items-center justify-center text-[10px]"
                                :class="selectedMethod === rate.method ? 'border-elior-botanical bg-elior-botanical text-white' : 'border-elior-border'"
                            >
                                <span v-if="selectedMethod === rate.method">✓</span>
                            </div>
                            <span class="text-xs font-semibold text-elior-charcoal">
                                @{{ rate.method_title }}
                            </span>
                        </div>

                        <span class="font-bold text-xs text-[#163923]" v-if="parseFloat(rate.price || rate.base_price || 0) > 0">
                            @{{ rate.base_formatted_price }}
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-[#EBF3EE] text-[#205132]" v-else>
                            FREE
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-estimate-tax-shipping', {
            template: '#v-estimate-tax-shipping-template',

            props: ['cart'],

            emits: ['processed'],

            data() {
                return {
                    selectedCountry: this.cart?.shipping_address?.country || '',
                    selectedState: this.cart?.shipping_address?.state || '',
                    postcode: this.cart?.shipping_address?.postcode || '',
                    countries: [],
                    states: {},
                    rates: [],
                    selectedMethod: null,
                    isCalculating: false,
                }
            },

            computed: {
                haveStates() {
                    return Boolean(this.states && this.states[this.selectedCountry]?.length);
                },
            },

            mounted() {
                this.getCountries();
                this.getStates();

                if (this.cart?.shipping_address) {
                    this.selectedCountry = this.cart.shipping_address.country || 'IN';
                    this.selectedState = this.cart.shipping_address.state || '';
                    this.postcode = this.cart.shipping_address.postcode || '';
                }
            },

            methods: {
                getCountries() {
                    this.$axios.get("{{ route('shop.api.core.countries') }}")
                        .then(response => {
                            this.countries = response.data.data;
                        })
                        .catch(() => {});
                },

                getStates() {
                    this.$axios.get("{{ route('shop.api.core.states') }}")
                        .then(response => {
                            this.states = response.data.data;
                        })
                        .catch(() => {});
                },

                onCountryChange() {
                    this.selectedState = '';
                    this.rates = [];
                },

                calculateShipping() {
                    if (! this.selectedCountry || ! this.selectedState) {
                        return;
                    }

                    this.isCalculating = true;

                    let payload = {
                        country: this.selectedCountry,
                        state: this.selectedState,
                        postcode: this.postcode || '',
                    };

                    this.$axios.post('{{ route('shop.api.checkout.cart.estimate_shipping') }}', payload)
                        .then((response) => {
                            this.isCalculating = false;

                            let shippingMethods = response.data.data.shipping_methods || [];
                            let allRates = [];

                            shippingMethods.forEach(method => {
                                if (method.rates) {
                                    allRates.push(...method.rates);
                                }
                            });

                            this.rates = allRates;

                            let cartData = response.data.data.cart;
                            if (cartData) {
                                this.selectedMethod = cartData.shipping_method || (allRates[0] ? allRates[0].method : null);
                                this.$emit('processed', cartData);
                            }
                        })
                        .catch(error => {
                            this.isCalculating = false;
                        });
                },

                applyShippingRate(methodCode) {
                    this.selectedMethod = methodCode;
                    this.isCalculating = true;

                    let payload = {
                        country: this.selectedCountry,
                        state: this.selectedState,
                        postcode: this.postcode || '',
                        shipping_method: methodCode,
                    };

                    this.$axios.post('{{ route('shop.api.checkout.cart.estimate_shipping') }}', payload)
                        .then((response) => {
                            this.isCalculating = false;
                            this.$emit('processed', response.data.data.cart);
                        })
                        .catch(() => {
                            this.isCalculating = false;
                        });
                },

                resetShipping() {
                    this.isCalculating = true;

                    this.$axios.delete('{{ route('shop.api.checkout.cart.estimate_shipping.reset') }}')
                        .then((response) => {
                            this.isCalculating = false;
                            this.selectedCountry = '';
                            this.selectedState = '';
                            this.postcode = '';
                            this.rates = [];
                            this.selectedMethod = null;

                            if (response.data.data?.cart) {
                                this.$emit('processed', response.data.data.cart);
                            }
                        })
                        .catch(() => {
                            this.isCalculating = false;
                            this.selectedCountry = '';
                            this.selectedState = '';
                            this.postcode = '';
                            this.rates = [];
                            this.selectedMethod = null;
                        });
                },
            },
        });
    </script>
@endPushOnce
