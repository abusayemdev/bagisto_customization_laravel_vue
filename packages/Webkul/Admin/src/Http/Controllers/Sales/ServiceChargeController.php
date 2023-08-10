<?php

namespace Webkul\Admin\Http\Controllers\Sales;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Checkout\Repositories\ServiceChargeRepository;

class ServiceChargeController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * ServiceChargeRepository object
     *
     * @var \Webkul\Checkuot\Repositories\ServiceChargeRepository
     */
    protected $serviceChargeRepository;



    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Checkout\Repositories\ServiceChargeRepository  $serviceChargeRepository
     * @return void
     */
    public function __construct(
        ServiceChargeRepository $serviceChargeRepository
    )
    
    {

        $this->serviceChargeRepository = $serviceChargeRepository;

        $this->_config = request('_config');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $servicecharges = $this->serviceChargeRepository->all();
        return view($this->_config['view'], compact('servicecharges'));
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
            'primary_charge' => 'required',
            'payment_service_name' => 'required',
            'charge_limit' => 'required',
            'additional_charge' => 'required',
        ]);


        $servicecharge = $this->serviceChargeRepository->create(request()->all());
        

        session()->flash('success', trans('admin::app.settings.servicecharge.create-success'));

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

        $servicecharge = $this->serviceChargeRepository->findOrFail($id);

        return view($this->_config['view'], compact('servicecharge'));
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
            'primary_charge' => 'required',
            'payment_service_name' => 'required',
            'charge_limit' => 'required',
            'additional_charge' => 'required',
        ]);

     

        $servicecharge = $this->serviceChargeRepository->update(request()->all(), $id);

      

        session()->flash('success', trans('admin::app.settings.servicecharge.update-success'));

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
        $servicecharge = $this->serviceChargeRepository->findOrFail($id);

        try {

            $this->serviceChargeRepository->delete($id);


            session()->flash('success', trans('admin::app.settings.servicecharge.delete-success'));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'servicecharge']));
        }
        

        return response()->json(['message' => false], 400);
    }
}