<x-admin::layouts>
    <x-slot:title>
        Inventory Stock Ledger
    </x-slot>

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
            Inventory Stock Ledger (Movements)
        </h2>
        
        <!-- We can add buttons here later (e.g. Add Adjustment) -->
    </div>

    <x-admin::datagrid :src="route('admin.settings.inventory_ledger.index')">
    </x-admin::datagrid>

</x-admin::layouts>
