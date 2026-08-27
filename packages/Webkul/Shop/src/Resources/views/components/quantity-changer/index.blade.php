@props([
    'name'      => '',
    'value'     => 1,
    'minValue'  => 1,
    'removable' => false,
])

<v-quantity-changer
    {{ $attributes->merge(['class' => 'inline-flex items-center justify-between border border-elior-border bg-white rounded-xl text-elior-charcoal hover:border-elior-botanical/50 transition-colors']) }}
    name="{{ $name }}"
    value="{{ $value }}"
    min-value="{{ $minValue }}"
    is-removable="{{ $removable ? '1' : '0' }}"
>
</v-quantity-changer>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-quantity-changer-template"
    >
        <div class="flex items-center justify-between w-full select-none">
            <button
                type="button"
                class="flex h-8 w-8 items-center justify-center rounded-lg text-elior-slate hover:text-elior-botanical hover:bg-elior-botanicalLight/50 transition-colors focus:outline-none cursor-pointer"
                :class="(!isRemovable && atMinValue) ? 'opacity-30 cursor-not-allowed pointer-events-none' : ''"
                :disabled="!isRemovable && atMinValue"
                aria-label="@lang('shop::app.components.quantity-changer.decrease-quantity')"
                @click="decrease"
            >
                <span class="icon-minus text-base"></span>
            </button>

            <span class="min-w-[28px] text-center text-sm font-semibold text-elior-charcoal font-sans px-1">
                @{{ quantity }}
            </span>

            <button
                type="button"
                class="flex h-8 w-8 items-center justify-center rounded-lg text-elior-slate hover:text-elior-botanical hover:bg-elior-botanicalLight/50 transition-colors focus:outline-none cursor-pointer"
                aria-label="@lang('shop::app.components.quantity-changer.increase-quantity')"
                @click="increase"
            >
                <span class="icon-plus text-base"></span>
            </button>

            <v-field
                type="hidden"
                :name="name"
                v-model="quantity"
            ></v-field>
        </div>
    </script>

    <script type="module">
        app.component("v-quantity-changer", {
            template: '#v-quantity-changer-template',

            props:['name', 'value', 'minValue', 'isRemovable'],

            data() {
                return  {
                    quantity: this.value,
                }
            },

            computed: {
                /**
                 * Whether the quantity is at (or below) the minimum and cannot be
                 * decreased further.
                 */
                atMinValue() {
                    return Number(this.quantity) <= Number(this.minValue);
                },
            },

            watch: {
                value() {
                    this.quantity = this.value;
                },
            },

            methods: {
                increase() {
                    this.$emit('change', ++this.quantity);
                },

                decrease() {
                    if (this.quantity > this.minValue) {
                        this.quantity -= 1;
                        this.$emit('change', this.quantity);
                    } else if (this.isRemovable == '1') {
                        this.$emit('remove');
                    }
                },

                remove() {
                    this.$emit('remove');
                },
            }
        });
    </script>
@endpushOnce
