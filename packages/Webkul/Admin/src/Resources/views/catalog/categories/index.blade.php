<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.catalog.categories.index.title')
    </x-slot>

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                @lang('admin::app.catalog.categories.index.title')
            </h1>
            <p class="mt-0.5 text-xs text-slate-500">
                Organize your botanical products into nested taxonomy groups, hero banners, and SEO slugs.
            </p>
        </div>

        <div class="flex items-center gap-2.5">
            {!! view_render_event('bagisto.admin.catalog.categories.index.create-button.before') !!}

            @if (bouncer()->hasPermission('catalog.categories.create'))
                <a href="{{ route('admin.catalog.categories.create') }}">
                    <div class="primary-button">
                        <svg class="h-4 w-4 mr-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        @lang('admin::app.catalog.categories.index.add-btn')
                    </div>
                </a>
            @endif

            {!! view_render_event('bagisto.admin.catalog.categories.index.create-button.after') !!}
        </div>        
    </div>

    {!! view_render_event('bagisto.admin.catalog.categories.list.before') !!}

    <x-admin::datagrid :src="route('admin.catalog.categories.index')" />

    {!! view_render_event('bagisto.admin.catalog.categories.list.after') !!}
</x-admin::layouts>
