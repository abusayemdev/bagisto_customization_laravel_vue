<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Webkul\Core\Models\City;



class CoreController extends Controller
{
    
    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConfig()
    {
        $configValues = [];

        foreach (explode(',', request()->input('_config')) as $config) {
            $configValues[$config] = core()->getConfigData($config);
        }
        
        return response()->json([
            'data' => $configValues,
        ]);
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountryStateGroup()
    {
        return response()->json([
            'data' => core()->groupedStatesByCountries(),
        ]);
    }


    public function getCountryStateCityGroup()
    {
        return response()->json([
            'data' => core()->groupedCitiesByStates(),
        ]);
    }

    public function getAllCities()
    {
        $all_cities = City::get();
        return response()->json($all_cities);

    }

    public function getCityName($city_id)
    {
        $city = City::find($city_id);

        if (isset($city)) {
           $city_name =  $city->name;
        } else {
            $city_name = '';
        }

        response()->json(['city_name' => $city_name]);

    }



    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function switchCurrency()
    {
        return response()->json([]);
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function switchLocale()
    {
        return response()->json([]);
    }
}
