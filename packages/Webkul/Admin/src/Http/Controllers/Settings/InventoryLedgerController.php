<?php

namespace Webkul\Admin\Http\Controllers\Settings;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\DataGrids\Settings\InventoryLedgerDataGrid;

class InventoryLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(InventoryLedgerDataGrid::class)->toJson();
        }

        return view('admin::settings.inventory_ledger.index');
    }
}
