<?php

namespace Webkul\Core\Http\Controllers;

use Webkul\Core\Repositories\CountryRepository;
use Webkul\Core\Repositories\CountryStateRepository;
use Webkul\Core\Repositories\CourierZoneRepository;
use Webkul\Core\Repositories\CityRepository;
use Webkul\Core\Models\City;
use App\Imports\CitiesImport;
use App\Exports\CitiesExport;
use Excel;

class CityController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CountryRepository object
     *
     * @var \Webkul\Core\Repositories\CountryRepository
     */
    protected $countryRepository;

    /**
     * CountryStateRepository object
     *
     * @var Webkul\Core\Repositories\CountryStateRepository
     */
    protected $countryStateRepository;


        /**
     * CityRepository object
     *
     * @var Webkul\Core\Repositories\CityRepository
     */
    protected $cityRepository;

          /**
     * CourierZoneRepository object
     *
     * @var Webkul\Core\Repositories\CourierZoneRepository
     */
    protected $courierZoneRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\CountryRepository       $countryRepository
     * @param  \Webkul\Core\Repositories\CountryStateRepository  $countryStateRepository
     * @param  \Webkul\Core\Repositories\courierZoneRepository  $CourierZoneRepository
     * @return void
     */
    public function __construct(
        CountryRepository $countryRepository,
        CountryStateRepository $countryStateRepository,
        CourierZoneRepository $courierZoneRepository,
        CityRepository $cityRepository
    )
    {
        $this->countryRepository = $countryRepository;

        $this->countryStateRepository = $countryStateRepository;

        $this->courierZoneRepository = $courierZoneRepository;

        $this->cityRepository = $cityRepository;

        $this->_config = request('_config');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cities = $this->cityRepository->all();
        return view($this->_config['view'], compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = $this->countryRepository->all();
        $countrystates = $this->countryStateRepository->all();
        $zones = $this->courierZoneRepository->all();

        return view($this->_config['view'], compact('countries','countrystates','zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
       
        $this->validate(request(), [
            'country_code' => 'required',
            'state_code' => 'required',
            'name' => 'required',
            'country_name' => 'required',
        ]);

    

     

        $city = $this->cityRepository->create(request()->all());

      

        session()->flash('success', trans('admin::app.settings.cities.create-success'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $countries = $this->countryRepository->all();

        $zones = $this->courierZoneRepository->all();

        $city = $this->cityRepository->findOrFail($id);

        if ($city->country_code) {
            $countrystates = $this->countryStateRepository->where('country_code', $city->country_code)->get();
        }else {
            $countrystates = $this->countryStateRepository->all();
        }

        return view($this->_config['view'], compact('countries','countrystates','zones','city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'country_code' => 'required',
            'state_code' => 'required',
            'name' => 'required',
            'country_name' => 'required',
        ]);

     

        $city = $this->cityRepository->update(request()->all(), $id);

      

        session()->flash('success', trans('admin::app.settings.cities.update-success'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->findOrFail($id);

        
        try {

            $this->cityRepository->delete($id);


            session()->flash('success', trans('admin::app.settings.cities.delete-success'));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'cities']));
        }
        

        return response()->json(['message' => false], 400);
    }

    public function country_states($country_name)
    {
        $country_id = $this->countryRepository->where('name', $country_name)->first()->id;
        $states = $this->countryStateRepository->where('country_id', $country_id)->get();
       
        return  $states;
    }

    public function cities_import()
    {
        return view($this->_config['view']);
    }

    public function cities_import_store() 
    {
    

        $import = Excel::import(new CitiesImport, request()->file('import_file'));

            
        if ($import) {
            session()->flash('success', trans('admin::app.settings.cities.import-success'));

            return redirect()->route($this->_config['redirect']);
        } else {
            session()->flash('error', trans('admin::app.settings.cities.error'));
            return back();
        }
         

      
        
    }

    public function cities_export() 
    {
        return Excel::download(new CitiesExport, 'cities.xlsx');
    }
}