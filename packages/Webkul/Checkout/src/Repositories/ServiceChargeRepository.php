<?php

namespace Webkul\Checkout\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Cart Address Repository
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ServiceChargeRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Webkul\Checkout\Contracts\ServiceCharge';
    }
}