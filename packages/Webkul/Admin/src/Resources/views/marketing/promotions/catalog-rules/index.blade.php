<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.marketing.promotions.catalog-rules.index.title')
    </x-slot>

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                @lang('admin::app.marketing.promotions.catalog-rules.index.title')
            </h1>
            <p class="mt-0.5 text-xs text-slate-500">
                Set category-wide markdown pricing, percentage sales, and scheduled catalog promotions.
            </p>
        </div>

        <div class="flex items-center gap-2.5">
            @if (bouncer()->hasPermission('marketing.promotions.catalog_rules.create'))
                <a 
                    href="{{ route('admin.marketing.promotions.catalog_rules.create') }}"
                    class="primary-button"
                >
                    <svg class="h-4 w-4 mr-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    @lang('admin::app.marketing.promotions.catalog-rules.index.create-btn')
                </a>
            @endif
        </div>
    </div>
    
    {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.list.before') !!}

    <x-admin::datagrid :src="route('admin.marketing.promotions.catalog_rules.index')" />

    {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.list.after') !!}
</x-admin::layouts>