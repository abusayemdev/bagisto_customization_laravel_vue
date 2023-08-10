@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.courierzones.add-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.courierzones.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.courierzones.index') }}'"></i>

                        {{ __('admin::app.settings.courierzones.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.settings.courierzones.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

    

                    <accordian :title="'{{ __('admin::app.settings.courierzones.general') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('zone_name') ? 'has-error' : '']">
                                <label for="zone_name" class="required">{{ __('admin::app.settings.courierzones.zone-name') }}</label>
                                <input v-validate="'required'" class="control" id="zone_name" name="zone_name" data-vv-as="&quot;{{ __('admin::app.settings.courierzones.zone-name') }}&quot;" v-zone_name/>
                                <span class="control-error" v-if="errors.has('zone_name')">@{{ errors.first('zone_name') }}</span>
                            </div>

                            

                            <div class="control-group" :class="[errors.has('weight_increase_rate') ? 'has-error' : '']">
                                <label for="weight_increase_rate" class="required">{{ __('admin::app.settings.courierzones.weight-increase-rate') }}</label>
                                <input v-validate="'required'" class="control" id="weight_increase_rate" name="weight_increase_rate" data-vv-as="&quot;{{ __('admin::app.settings.courierzones.weight-increase-rate') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('weight_increase_rate')">@{{ errors.first('weight_increase_rate') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('initial_shipping_charge') ? 'has-error' : '']">
                                <label for="initial_shipping_charge" class="required">{{ __('admin::app.settings.courierzones.initial-shipping-charge') }}</label>
                                <input v-validate="'required'" class="control" id="initial_shipping_charge" name="initial_shipping_charge" data-vv-as="&quot;{{ __('admin::app.settings.courierzones.initial-shipping-charge') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('initial_shipping_charge')">@{{ errors.first('initial_shipping_charge') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('shipping_charge_increase_rate') ? 'has-error' : '']">
                                <label for="shipping_charge_increase_rate" class="required">{{ __('admin::app.settings.courierzones.shipping-charge-increase-rate') }}</label>
                                <input v-validate="'required'" class="control" id="shipping_charge_increase_rate" name="shipping_charge_increase_rate" data-vv-as="&quot;{{ __('admin::app.settings.courierzones.shipping-charge-increase-rate') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('shipping_charge_increase_rate')">@{{ errors.first('shipping_charge_increase_rate') }}</span>
                            </div>


                            <div class="control-group" :class="[errors.has('shipping_charge_type') ? 'has-error' : '']">
                                <label for="shipping_charge_type" >{{ __('admin::app.settings.courierzones.shipping-charge-type') }}</label>
                                <select class="control" id="shipping_charge_type" name="shipping_charge_type" data-vv-as="&quot;{{ __('admin::app.settings.courierzones.shipping-charge-type') }}&quot;">
                                    <option value="" disabled selected title="{{ __('admin::app.settings.courierzones.select-type') }}"> {{ __('admin::app.settings.courierzones.select-type') }}</option>
                                    <option value="per_total_weight"  title="Per Total Weight">Per Total Weight</option>
                                    <option value="per_product_weight"  title="Per Product Weight">Per Product Weight</option>
                                </select>
                                <span class="control-error" v-if="errors.has('shipping_charge_type')">@{{ errors.first('shipping_charge_type') }}</span>
                            </div>
                  
                           
                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop