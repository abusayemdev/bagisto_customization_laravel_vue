<?php

namespace Webkul\Checkout\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Checkout\Contracts\ServiceCharge as ServiceChargeContract;

class ServiceCharge extends Model implements ServiceChargeContract
{
    protected $fillable = [
        'primary_charge',
        'payment_service_name',
        'charge_limit',
        'additional_charge',
        'percent_of_total'
    ];

    
}