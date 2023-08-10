<?php

namespace Webkul\Admin\Http\Controllers\Sales;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Checkout\Repositories\PickupLocationRepository;
use Webkul\Core\Repositories\CourierZoneRepository;

class PickupLocationController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * PickupLocationRepository object
     *
     * @var \Webkul\Checkuot\Repositories\PickupLocationRepository
     */
    protected $pickupLocationRepository;

    /**
     * CourierZoneRepository object
     *
     * @var \Webkul\Core\Repositories\CourierZoneRepository
     */
    protected $courierZoneRepository;


    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Checkout\Repositories\PickupLocationRepository  $pickupLocationRepository
     * @param  \Webkul\Core\Repositories\CourierZoneRepository  $courierZoneRepository
     * @return void
     */
    public function __construct(
        PickupLocationRepository $pickupLocationRepository,
        CourierZoneRepository $courierZoneRepository
    )
    
    {

        $this->pickupLocationRepository = $pickupLocationRepository;
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
        $pickuplocations = $this->pickupLocationRepository->all();
        return view($this->_config['view'], compact('pickuplocations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $courierzones = $this->courierZoneRepository->all();
        return view($this->_config['view'], compact('courierzones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
       
        $this->validate(request(), [
            'name' => 'required',
            'address' => 'required',
            'opening_hours' => 'required',
            'price' => 'required',
        ]);


        $pickuplocation = $this->pickupLocationRepository->create(request()->all());
        

        session()->flash('success', trans('admin::app.settings.pickuplocation.create-success'));

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

        $courierzones = $this->courierZoneRepository->all();
        $pickuplocation = $this->pickupLocationRepository->findOrFail($id);

        return view($this->_config['view'], compact('courierzones','pickuplocation'));
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
            'name' => 'required',
            'address' => 'required',
            'opening_hours' => 'required',
            'price' => 'required',
        ]);

     

        $pickuplocation = $this->pickupLocationRepository->update(request()->all(), $id);

      

        session()->flash('success', trans('admin::app.settings.pickuplocation.update-success'));

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
        $pickuplocation = $this->pickupLocationRepository->findOrFail($id);

        try {

            $this->pickupLocationRepository->delete($id);


            session()->flash('success', trans('admin::app.settings.pickuplocation.delete-success'));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'pickuplocatin']));
        }
        

        return response()->json(['message' => false], 400);
    }
}