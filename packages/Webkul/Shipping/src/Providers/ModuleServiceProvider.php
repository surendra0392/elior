<?php

namespace Webkul\Shipping\Providers;

use Webkul\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    /**
     * Models.
     *
     * @var array
     */
    protected $models = [
        \Webkul\Shipping\Models\ShippingZone::class,
        \Webkul\Shipping\Models\ShippingZoneLocation::class,
        \Webkul\Shipping\Models\ShippingZoneMethod::class,
    ];
}
