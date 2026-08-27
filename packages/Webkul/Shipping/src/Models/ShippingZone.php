<?php

namespace Webkul\Shipping\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Shipping\Contracts\ShippingZone as ShippingZoneContract;

class ShippingZone extends Model implements ShippingZoneContract
{
    protected $table = 'shipping_zones';

    protected $fillable = [
        'name',
        'is_active',
    ];

    public function locations()
    {
        return $this->hasMany(ShippingZoneLocationProxy::modelClass());
    }

    public function methods()
    {
        return $this->hasMany(ShippingZoneMethodProxy::modelClass());
    }
}
