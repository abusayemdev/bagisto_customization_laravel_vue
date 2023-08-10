<?php

namespace App\Exports;

use Webkul\Core\Models\City;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitiesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return City::select(
            'name',
            'state_code',
            'state_name',
            'country_code',
            'country_name',
            'latitude',
            'longitude',
           

            
            )->limit(3)->latest()->get();
    }

    public function headings(): array
    {
        return [
            'name',
            'state_code',
            'state_name',
            'country_code',
            'country_name',
            'latitude',
            'longitude',
        ];
    }
}
