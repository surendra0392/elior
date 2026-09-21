<x-admin::layouts>
    <x-slot:title>
        Delivery Setup
    </x-slot>

    <div class="flex gap-[16px] justify-between items-center max-sm:flex-wrap">
        <div>
            <p class="text-[20px] text-gray-800 font-bold">
                Delivery Setup (Shipping Zones)
            </p>
            <p class="text-xs text-gray-500 mt-1">
                Configure delivery zones, state/PIN code regions, flat rates, and free delivery thresholds.
            </p>
        </div>

        <div class="flex gap-x-[10px] items-center">
            <a href="{{ route('admin.settings.shipping.zones.create') }}" class="primary-button">
                Create Shipping Zone
            </a>
        </div>
    </div>

    <x-admin::datagrid :src="route('admin.settings.shipping.zones.index')"></x-admin::datagrid>
</x-admin::layouts>
