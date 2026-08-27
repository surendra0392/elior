<?php

namespace Webkul\Admin\Http\Controllers\Settings;

use Illuminate\Http\JsonResponse;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Shipping\Repositories\ShippingZoneRepository;
use Webkul\Shipping\Repositories\ShippingZoneLocationRepository;
use Webkul\Shipping\Repositories\ShippingZoneMethodRepository;
use Webkul\Admin\DataGrids\Settings\ShippingZoneDataGrid;
use Illuminate\Support\Facades\Event;

class ShippingZoneController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected ShippingZoneRepository $shippingZoneRepository,
        protected ShippingZoneLocationRepository $shippingZoneLocationRepository,
        protected ShippingZoneMethodRepository $shippingZoneMethodRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(ShippingZoneDataGrid::class)->toJson();
        }

        return view('admin::settings.shipping.zones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::settings.shipping.zones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'name'      => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $data = request()->only(['name', 'is_active']);
        $locations = request()->input('locations', []);
        $methods = request()->input('methods', []);

        $zone = $this->shippingZoneRepository->create($data);

        foreach ($locations as $location) {
            $this->shippingZoneLocationRepository->create([
                'shipping_zone_id' => $zone->id,
                'location_type'    => $location['type'],
                'location_code'    => $location['code'],
            ]);
        }

        foreach ($methods as $method) {
            $this->shippingZoneMethodRepository->create(array_merge($method, [
                'shipping_zone_id' => $zone->id,
                'is_active'        => $method['is_active'] ?? 1,
                'price'            => $method['price'] ?? 0,
                'priority'         => $method['priority'] ?? 0,
            ]));
        }

        session()->flash('success', 'Shipping Zone created successfully.');

        return redirect()->route('admin.settings.shipping.zones.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $zone = $this->shippingZoneRepository->with(['locations', 'methods'])->findOrFail($id);

        return view('admin::settings.shipping.zones.edit', compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $this->validate(request(), [
            'name'      => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $data = request()->only(['name', 'is_active']);
        $locations = request()->input('locations', []);
        $methods = request()->input('methods', []);

        $zone = $this->shippingZoneRepository->update($data, $id);

        // Sync Locations (delete old, create new)
        $this->shippingZoneLocationRepository->deleteWhere(['shipping_zone_id' => $id]);
        foreach ($locations as $location) {
            $this->shippingZoneLocationRepository->create([
                'shipping_zone_id' => $id,
                'location_type'    => $location['type'],
                'location_code'    => $location['code'],
            ]);
        }

        // Sync Methods
        $this->shippingZoneMethodRepository->deleteWhere(['shipping_zone_id' => $id]);
        foreach ($methods as $method) {
            $this->shippingZoneMethodRepository->create(array_merge($method, [
                'shipping_zone_id' => $id,
                'is_active'        => $method['is_active'] ?? 1,
                'price'            => $method['price'] ?? 0,
                'priority'         => $method['priority'] ?? 0,
            ]));
        }

        session()->flash('success', 'Shipping Zone updated successfully.');

        return redirect()->route('admin.settings.shipping.zones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->shippingZoneRepository->delete($id);

            return response()->json(['message' => 'Shipping Zone deleted successfully.']);
        } catch (\Exception $e) {
        }

        return response()->json(['message' => 'Shipping Zone could not be deleted.'], 400);
    }
}
