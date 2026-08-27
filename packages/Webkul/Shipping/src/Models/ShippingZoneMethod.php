<?php

namespace Webkul\Shipping\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Shipping\Contracts\ShippingZoneMethod as ShippingZoneMethodContract;

class ShippingZoneMethod extends Model implements ShippingZoneMethodContract
{
    protected $table = 'shipping_zone_methods';

    protected $fillable = [
        'shipping_zone_id',
        'type',
        'title',
        'is_active',
        'price',
        'min_weight',
        'max_weight',
        'min_subtotal',
        'max_subtotal',
        'priority',
    ];

    public function zone()
    {
        return $this->belongsTo(ShippingZoneProxy::modelClass(), 'shipping_zone_id');
    }
}
