<?php

namespace Webkul\Core\Models;

use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\Core\Models\Country;
use Webkul\Core\Models\CourierZone;
use Webkul\Core\Contracts\CountryState as CountryStateContract;

class CountryState extends TranslatableModel implements CountryStateContract
{
    public $timestamps = false;

    public $translatedAttributes = [];

    protected $with = ['translations'];

    protected $fillable = [
        'country_code',
        'code',
        'default_name',
        'courier_zone_id',
        'country_id'
    ];

    public function country()
    {
       return $this->belongsTo(Country::class, 'country_id');
    }

    public function courier_zone()
    {
       return $this->belongsTo(CourierZone::class, 'courier_zone_id');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $array['default_name'] = $this->default_name;

        return $array;
    }
}