<?php

namespace Webkul\Core\Repositories;

use Webkul\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

class CourierZoneRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Core\Contracts\CourierZone';
    }
}