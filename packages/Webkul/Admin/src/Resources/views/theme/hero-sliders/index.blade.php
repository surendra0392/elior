<x-admin::layouts>
    <x-slot:title>
        Hero Sliders
    </x-slot>

    <div class="flex items-center justify-between">
        <p class="text-xl font-bold text-gray-800">
            Hero Sliders
        </p>

        <div class="flex items-center gap-x-2.5">
            <a href="{{ route('admin.cms.hero_sliders.create') }}" class="primary-button">
                Create Hero Slider
            </a>
        </div>
    </div>

    {!! view_render_event('bagisto.admin.theme.hero_sliders.list.before') !!}

    <x-admin::datagrid :src="route('admin.cms.hero_sliders.index')" />
    
    {!! view_render_event('bagisto.admin.theme.hero_sliders.list.after') !!}

</x-admin::layouts>
