<?php

namespace Webkul\Core\Http\Controllers;

use Webkul\Core\Repositories\CountryRepository;
use Webkul\Core\Repositories\CountryStateRepository;
use Webkul\Core\Repositories\CourierZoneRepository;

class CountryStateController extends Controller
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
     * @param  \Webkul\Core\Repositories\CourierZoneRepository  $courierZoneRepository
     * @return void
     */
    public function __construct(
        CountryRepository $countryRepository,
        CountryStateRepository $countryStateRepository,
        CourierZoneRepository $courierZoneRepository
    )
    {
        $this->countryRepository = $countryRepository;

        $this->countryStateRepository = $countryStateRepository;

        $this->courierZoneRepository = $courierZoneRepository;

        $this->_config = request('_config');
    }

    /**
     * Function to retrieve states with respect to countries with codes and names for both of the countries and states.
     *
     * @return \Illuminate\View\View
     */
    public function getCountries()
    {
        $countries = $this->countryRepository->all();

        $states = $this->countryStateRepository->all();

        $nestedArray = [];

        foreach ($countries as $keyCountry => $country) {
            foreach ($states as $keyState => $state) {
                if ($country->code == $state->country_code) {
                    $nestedArray[$country->name][$state->code] = $state->default_name;
                }
            }
        }

        return view($this->_config['view'])->with('statesCountries', $nestedArray);
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function getStates($country)
    {
        $countries = $this->countryRepository->all();
        
        $states = $this->countryStateRepository->all();

        $nestedArray = [];

        foreach ($countries as $keyCountry => $country) {
            foreach ($states as $keyState => $state) {
                if ($country->code == $state->country_code) {
                    $nestedArray[$country->name][$state->code] = $state->default_name;
                }
            }
        }

        return view($this->_config['view'])->with('statesCountries', $nestedArray);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $countrystates = $this->countryStateRepository->all();
        return view($this->_config['view'], compact('countrystates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = $this->countryRepository->all();

        $zones = $this->courierZoneRepository->all();

        return view($this->_config['view'], compact('countries', 'zones'));
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
            'code' => 'required',
            'default_name' => 'required',
            'country_id' => 'required',
        ]);

        

     

        $countrystate = $this->countryStateRepository->create(request()->all());

      

        session()->flash('success', trans('admin::app.settings.countrystates.create-success'));

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

        $countrystate = $this->countryStateRepository->findOrFail($id);

        return view($this->_config['view'], compact('countries','zones','countrystate'));
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
            'code' => 'required',
            'default_name' => 'required',
            'country_id' => 'required',
        ]);

     

        $countrystate = $this->countryStateRepository->update(request()->all(), $id);

      

        session()->flash('success', trans('admin::app.settings.countrystates.update-success'));

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
        $countrystate = $this->countryStateRepository->findOrFail($id);

        
        try {

            $this->countryStateRepository->delete($id);


            session()->flash('success', trans('admin::app.settings.countrystates.delete-success'));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'countrystates']));
        }
        

        return response()->json(['message' => false], 400);
    }
}