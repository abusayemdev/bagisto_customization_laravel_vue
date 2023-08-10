@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.pickuplocations.add-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.pickup-location.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.pickup-location.index') }}'"></i>

                        {{ __('admin::app.settings.pickuplocations.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.settings.pickuplocations.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

    

                    <accordian :title="'{{ __('admin::app.settings.pickuplocations.general') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('admin::app.settings.pickuplocations.name') }}</label>
                                <input v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;{{ __('admin::app.settings.pickuplocations.name') }}&quot;" v-name/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                            </div>

                            

                            <div class="control-group" :class="[errors.has('address') ? 'has-error' : '']">
                                <label for="address" class="required">{{ __('admin::app.settings.pickuplocations.address') }}</label>
                                <input v-validate="'required'" class="control" id="address" name="address" data-vv-as="&quot;{{ __('admin::app.settings.pickuplocations.address') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('address')">@{{ errors.first('address') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('opening_hours') ? 'has-error' : '']">
                                <label for="opening_hours" class="required">{{ __('admin::app.settings.pickuplocations.opening-hours') }}</label>
                                <input v-validate="'required'" class="control" id="opening_hours" name="opening_hours" data-vv-as="&quot;{{ __('admin::app.settings.pickuplocations.opening-hours') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('opening_hours')">@{{ errors.first('opening_hours') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('price') ? 'has-error' : '']">
                                <label for="price" class="required">{{ __('admin::app.settings.pickuplocations.price') }}</label>
                                <input v-validate="'required'" class="control" id="price" name="price" data-vv-as="&quot;{{ __('admin::app.settings.pickuplocations.price') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('price')">@{{ errors.first('price') }}</span>
                            </div>


                            <div class="control-group" :class="[errors.has('courier_zone_id') ? 'has-error' : '']">
                                <label for="courier_zone_id" >{{ __('admin::app.settings.pickuplocations.zone-name') }}</label>
                                <select class="control" id="courier_zone_id" name="courier_zone_id" data-vv-as="&quot;{{ __('admin::app.settings.pickuplocations.zone-name') }}&quot;">
                                <option value="" disabled selected title="{{ __('admin::app.settings.pickuplocations.select-zone') }}"> {{ __('admin::app.settings.pickuplocations.select-zone') }}</option>
                                <option value="null"  title="None">None</option>
                                @foreach($courierzones as $zone)    
                                <option value="{{$zone->id}}"  title="{{$zone->zone_name}}">{{$zone->zone_name}}</option>
                                @endforeach
                                    
                                </select>
                                <span class="control-error" v-if="errors.has('courier_zone_id')">@{{ errors.first('courier_zone_id') }}</span>
                            </div>

                           
                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop