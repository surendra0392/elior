<?php

namespace Webkul\Shipping\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Shipping\Contracts\ShippingZoneLocation as ShippingZoneLocationContract;

class ShippingZoneLocation extends Model implements ShippingZoneLocationContract
{
    protected $table = 'shipping_zone_locations';

    protected $fillable = [
        'shipping_zone_id',
        'location_type',
        'location_code',
    ];

    public function zone()
    {
        return $this->belongsTo(ShippingZoneProxy::modelClass(), 'shipping_zone_id');
    }
}
