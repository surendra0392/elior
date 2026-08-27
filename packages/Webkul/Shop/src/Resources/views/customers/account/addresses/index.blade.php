<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.addresses.index.add-address')
    </x-slot>
    
    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="addresses" />
        @endSection
    @endif

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <!-- Main Content Card -->
    <div class="flex-1 w-full rounded-3xl border border-elior-border/80 bg-white p-6 sm:p-8 shadow-elior-subtle space-y-6">
        <div class="flex items-center justify-between border-b border-elior-border/60 pb-4">
            <div class="flex items-center gap-3">
                <!-- Back Button For Mobile View -->
                <a
                    class="md:hidden flex h-8 w-8 items-center justify-center rounded-lg border border-elior-border text-elior-charcoal"
                    href="{{ route('shop.customers.account.index') }}"
                >
                    <span class="icon-arrow-left text-sm"></span>
                </a>
    
                <div>
                    <div class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-[#EBF3EE] text-elior-botanical text-[9px] font-semibold tracking-wider uppercase">
                        <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span></span>
                        <span>Address Book</span>
                    </div>
                    <h1 class="font-serif text-xl sm:text-2xl font-bold text-elior-charcoal">
                        @lang('shop::app.customers.account.addresses.index.title')
                    </h1>
                </div>
            </div>

            <a
                href="{{ route('shop.customers.account.addresses.create') }}"
                class="elior-btn-primary h-10 px-5 text-xs uppercase tracking-widest font-semibold inline-flex items-center gap-1.5 shadow-elior-card"
            >
                <span class="icon-plus text-xs"></span>
                <span>@lang('shop::app.customers.account.addresses.index.add-address')</span> 
            </a>
        </div>

        @if (! $addresses->isEmpty())
            <!-- Address Cards Grid -->
            {!! view_render_event('bagisto.shop.customers.account.addresses.list.before', ['addresses' => $addresses]) !!}

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($addresses as $address)
                    <div class="p-5 border border-elior-border/80 rounded-2xl bg-[#FAF8F5] space-y-3">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-serif text-sm font-bold text-elior-charcoal" v-pre>
                                    {{ $address->first_name }} {{ $address->last_name }}

                                    @if ($address->company_name)
                                        <span class="text-xs text-elior-muted font-normal">({{ $address->company_name }})</span>
                                    @endif
                                </p>
                            </div>

                            <div class="flex items-center gap-2">
                                @if ($address->default_address)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-[#EBF3EE] text-elior-botanical text-[10px] font-semibold tracking-wider uppercase">
                                        @lang('shop::app.customers.account.addresses.index.default-address') 
                                    </span>
                                @endif

                                <!-- Dropdown Actions -->
                                <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
                                    <x-slot:toggle>
                                        <button 
                                            class="icon-more cursor-pointer rounded-lg p-1 text-xl text-elior-muted hover:text-elior-charcoal transition-colors" 
                                            aria-label="More Options"
                                        >
                                        </button>
                                    </x-slot>

                                    <x-slot:menu class="!py-1">
                                        <x-shop::dropdown.menu.item>
                                            <a href="{{ route('shop.customers.account.addresses.edit', $address->id) }}">
                                                <p class="w-full text-xs">
                                                    @lang('shop::app.customers.account.addresses.index.edit')
                                                </p>
                                            </a>    
                                        </x-shop::dropdown.menu.item>

                                        <x-shop::dropdown.menu.item>
                                            <form
                                                method="POST"
                                                ref="addressDelete_{{ $address->id }}"
                                                action="{{ route('shop.customers.account.addresses.delete', $address->id) }}"
                                            >
                                                @method('DELETE')
                                                @csrf
                                            </form>

                                            <a 
                                                href="javascript:void(0);"                                                
                                                @click="$emitter.emit('open-confirm-modal', {
                                                    agree: () => {
                                                        $refs['addressDelete_{{ $address->id }}'].submit()
                                                    }
                                                })"
                                            >
                                                <p class="w-full text-xs text-red-600">
                                                    @lang('shop::app.customers.account.addresses.index.delete')
                                                </p>
                                            </a>
                                        </x-shop::dropdown.menu.item>

                                        @if (! $address->default_address)
                                            <x-shop::dropdown.menu.item>
                                                <form
                                                    method="POST"
                                                    ref="setAsDefault_{{ $address->id }}"
                                                    action="{{ route('shop.customers.account.addresses.update.default', $address->id) }}"
                                                >
                                                    @method('PATCH')
                                                    @csrf
                                                </form>

                                                <a 
                                                    href="javascript:void(0);"                                                
                                                    @click="$emitter.emit('open-confirm-modal', {
                                                        agree: () => {
                                                            $refs['setAsDefault_{{ $address->id }}'].submit()
                                                        }
                                                    })"
                                                >
                                                    <p class="w-full text-xs">
                                                        @lang('shop::app.customers.account.addresses.index.set-as-default')
                                                    </p>
                                                </a>
                                            </x-shop::dropdown.menu.item>
                                        @endif
                                    </x-slot>
                                </x-shop::dropdown>
                            </div>
                        </div>

                        <p class="text-xs text-elior-muted leading-relaxed" v-pre>
                            {{ $address->address }},
                            {{ $address->city }}, 
                            {{ $address->state }}, {{ $address->country }}, 
                            {{ $address->postcode }}
                        </p>

                        @if ($address->phone)
                            <p class="text-[11px] text-elior-slate pt-1" v-pre>
                                <span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">phone</span> {{ $address->phone }}
                            </p>
                        @endif
                    </div>    
                @endforeach
            </div>

            {!! view_render_event('bagisto.shop.customers.account.addresses.list.after', ['addresses' => $addresses]) !!}

        @else
            <!-- Address Empty State -->
            <div class="py-16 text-center space-y-4">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#FAF8F5] border border-elior-border text-2xl">
                    <span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span>
                </div>

                <div class="space-y-1">
                    <h3 class="font-serif text-lg font-bold text-elior-charcoal">
                        @lang('shop::app.customers.account.addresses.index.empty-address')
                    </h3>
                    <p class="text-xs text-elior-muted leading-relaxed max-w-xs mx-auto">
                        Save your shipping addresses for seamless and rapid checkout on future orders.
                    </p>
                </div>

                <div class="pt-2">
                    <a
                        href="{{ route('shop.customers.account.addresses.create') }}"
                        class="elior-btn-primary inline-flex items-center gap-2 text-xs uppercase tracking-widest font-semibold px-6 py-3 shadow-elior-card"
                    >
                        <span>@lang('shop::app.customers.account.addresses.index.add-address')</span>
                        <span class="icon-plus text-xs"></span>
                    </a>
                </div>
            </div>    
        @endif
    </div>
</x-shop::layouts.account>
