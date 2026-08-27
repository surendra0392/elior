<x-admin::layouts>
    <x-slot:title>
        @lang('recipe::app.admin.recipes.title')
    </x-slot>

    <div class="flex items-center justify-between">
        <p class="text-xl font-bold text-gray-800">
            @lang('recipe::app.admin.recipes.title')
        </p>

        <div class="flex items-center gap-x-2.5">
            <!-- Create New Recipe Button -->
            @if (bouncer()->hasPermission('recipes.create'))
                <a
                    href="{{ route('admin.recipes.create') }}"
                    class="primary-button"
                >
                    @lang('recipe::app.admin.recipes.create')
                </a>
            @endif
        </div>
    </div>

    {!! view_render_event('bagisto.admin.recipes.list.before') !!}

    <x-admin::datagrid :src="route('admin.recipes.index')" />
    
    {!! view_render_event('bagisto.admin.recipes.list.after') !!}

</x-admin::layouts>
