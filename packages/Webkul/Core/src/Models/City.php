<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Models\Courtry;
use Webkul\Core\Models\CountryState;
use Webkul\Core\Models\CourierZone;
use Webkul\Core\Contracts\City as CityContract;

class City extends Model implements CityContract
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'name',
        'state_code',
        'state_name',
        'country_code',
        'country_name',
        'latitude',
        'longitude',
        'courier_zone_id',
        'country_id',
        'state_id'
    ];

    public $timestamps = true;

    public function country()
    {
       return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
       return $this->belongsTo(CountryState::class, 'state_id');
    }

    public function courier_zone()
    {
       return $this->belongsTo(CourierZone::class, 'courier_zone_id');
    }
}
