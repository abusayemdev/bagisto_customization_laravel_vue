<?php

namespace App\Imports;

use Webkul\Core\Models\City;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CitiesImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new City([

            'name' => $row['name'],
            'state_code' => $row['state_code'],
            'state_name' => $row['state_name'],
            'country_code' => $row['country_code'],
            'country_name' => $row['country_name'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude']
        ]);
    }
}
