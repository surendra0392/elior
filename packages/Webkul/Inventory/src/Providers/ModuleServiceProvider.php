<?php

namespace Webkul\Inventory\Providers;

use Webkul\Core\Providers\CoreModuleServiceProvider;
use Webkul\Inventory\Models\InventorySource;
use Webkul\Inventory\Models\InventoryMovement;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    /**
     * Models.
     *
     * @var array
     */
    protected $models = [
        InventorySource::class,
        InventoryMovement::class,
    ];
}
