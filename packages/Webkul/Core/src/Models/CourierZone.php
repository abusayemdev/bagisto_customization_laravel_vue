<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\CourierZone as CourierZoneContract;

class CourierZone extends Model implements CourierZoneContract
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zone_name',
        'weight_increase_rate',
        'initial_shipping_charge',
        'shipping_charge_increase_rate',
        'shipping_charge_type'
    ];

    public $timestamps = true;
}
