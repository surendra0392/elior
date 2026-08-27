<?php

namespace Webkul\Shipping\Repositories;

use Webkul\Core\Eloquent\Repository;

class ShippingZoneLocationRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'Webkul\Shipping\Contracts\ShippingZoneLocation';
    }
}
