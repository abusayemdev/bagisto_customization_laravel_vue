<?php

namespace Webkul\Checkout\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Models\CourierZone;
use Webkul\Checkout\Contracts\PickupLocation as PickupLocationContract;

class PickupLocation extends Model implements PickupLocationContract
{
    protected $fillable = [
        'name',
        'address',
        'opening_hours',
        'price',
        'courier_zone_id',
    ];

    public function courier_zone()
    {
       return $this->belongsTo(CourierZone::class, 'courier_zone_id');
    }
    
}