<x-admin::layouts>
    <!-- Page Title -->
    <x-slot:title>
        @lang('admin::app.sales.transactions.index.title')
    </x-slot>

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                @lang('admin::app.sales.transactions.index.title')
            </h1>
            <p class="mt-0.5 text-xs text-slate-500">
                Audit gateway transactions, transaction IDs, payment statuses, and captured amounts.
            </p>
        </div>

        <div class="flex items-center gap-2.5">
            <!-- Export Modal -->
            <x-admin::datagrid.export :src="route('admin.sales.transactions.index')" />
        </div>
    </div>

    <x-admin::datagrid :src="route('admin.sales.transactions.index')" />
</x-admin::layouts>
