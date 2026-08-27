<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.orders.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="orders" />
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
                        <span>History</span>
                    </div>
                    <h1 class="font-serif text-xl sm:text-2xl font-bold text-elior-charcoal">
                        @lang('shop::app.customers.account.orders.title')
                    </h1>
                </div>
            </div>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.orders.list.before') !!}

        <!-- For Desktop View -->
        <div class="max-md:hidden">
            <x-shop::datagrid :src="route('shop.customers.account.orders.index')" />
        </div>

        <!-- For Mobile View -->
        <div class="md:hidden">
            <x-shop::datagrid :src="route('shop.customers.account.orders.index')">
                <!-- Datagrid Header -->
                <template #header="{
                    isLoading,
                    available,
                    applied,
                    selectAll,
                    sort,
                    performAction
                }">
                    <div class="hidden"></div>
                </template>

                <template #body="{
                    isLoading,
                    available,
                    applied,
                    selectAll,
                    sort,
                    performAction
                }">
                    <template v-if="isLoading">
                        <x-shop::shimmer.datagrid.table.body />
                    </template>
    
                    <template v-else>
                        <template v-for="record in available.records">
                            <div class="w-full p-4 border border-elior-border/70 rounded-2xl bg-[#FAF8F5] mb-3 last:mb-0 space-y-3">
                                <a :href="record.actions[0].url" class="block space-y-2">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-serif text-sm font-bold text-elior-charcoal">
                                                Order #@{{ record.id }}
                                            </p>
                                            <p class="text-xs text-elior-muted">
                                                @{{ record.created_at }}
                                            </p>
                                        </div>

                                        <p v-html="record.status"></p>
                                    </div>
        
                                    <div class="pt-2 border-t border-elior-border/60 flex justify-between items-center text-xs">
                                        <span class="text-elior-muted">Total</span>
                                        <span class="font-serif text-sm font-bold text-elior-charcoal">
                                            @{{ record.grand_total }}
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </template>
                    </template>
                </template>
            </x-shop::datagrid>
        </div>
    
        {!! view_render_event('bagisto.shop.customers.account.orders.list.after') !!}
    </div>
</x-shop::layouts.account>
