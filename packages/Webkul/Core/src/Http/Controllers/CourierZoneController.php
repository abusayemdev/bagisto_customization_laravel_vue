<?php

namespace Webkul\Core\Http\Controllers;

use Webkul\Core\Repositories\CourierZoneRepository;

class CourierZoneController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CourierZoneRepository object
     *
     * @var \Webkul\Core\Repositories\CourierZoneRepository
     */
    protected $courierZoneRepository;


    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\CourierZoneRepository  $courierZoneRepository
     * @return void
     */
    public function __construct(
        CourierZoneRepository $courierZoneRepository
    )
    
    {

        $this->courierZoneRepository = $courierZoneRepository;

        $this->_config = request('_config');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $courierzones = $this->courierZoneRepository->all();
        return view($this->_config['view'], compact('courierzones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
       
        $this->validate(request(), [
            'zone_name'  => 'required',
            'weight_increase_rate'  => 'required',
            'initial_shipping_charge'  => 'required',
            'shipping_charge_increase_rate'  => 'required',
        ]);


        $courierzone = $this->courierZoneRepository->create(request()->all());

      

        session()->flash('success', trans('admin::app.settings.courierzones.create-success'));

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

        $courierzone = $this->courierZoneRepository->findOrFail($id);

        return view($this->_config['view'], compact('courierzone'));
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
            'zone_name'  => 'required',
            'weight_increase_rate'  => 'required',
            'initial_shipping_charge'  => 'required',
            'shipping_charge_increase_rate'  => 'required',
        ]);

     

        $courierzone = $this->courierZoneRepository->update(request()->all(), $id);

      

        session()->flash('success', trans('admin::app.settings.courierzones.update-success'));

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
        $courierzone = $this->courierZoneRepository->findOrFail($id);

        try {

            $this->courierZoneRepository->delete($id);


            session()->flash('success', trans('admin::app.settings.courierzones.delete-success'));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'countrystates']));
        }
        

        return response()->json(['message' => false], 400);
    }
}