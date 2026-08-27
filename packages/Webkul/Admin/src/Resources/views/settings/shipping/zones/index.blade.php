<x-admin::layouts>
    <x-slot:title>
        Shipping Zones
    </x-slot>

    <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
        <p class="text-[20px] text-gray-800 font-bold">
            Shipping Zones
        </p>

        <div class="flex gap-x-[10px] items-center">
            <a href="{{ route('admin.settings.shipping.zones.create') }}" class="primary-button">
                Create Shipping Zone
            </a>
        </div>
    </div>

    <x-admin::datagrid :src="route('admin.settings.shipping.zones.index')"></x-admin::datagrid>
</x-admin::layouts>
