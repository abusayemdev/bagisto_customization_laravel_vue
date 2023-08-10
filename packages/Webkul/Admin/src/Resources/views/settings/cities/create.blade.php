@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.cities.add-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.cities.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.cities.index') }}'"></i>

                        {{ __('admin::app.settings.cities.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.settings.cities.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

    

                    <accordian :title="'{{ __('admin::app.settings.cities.general') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('country_code') ? 'has-error' : '']">
                                <label for="country_code" class="required">{{ __('admin::app.settings.cities.country-code') }}</label>
                                <input v-validate="'required'" class="control" id="country_code" name="country_code" data-vv-as="&quot;{{ __('admin::app.settings.cities.country-code') }}&quot;" v-country_code/>
                                <span class="control-error" v-if="errors.has('country_code')">@{{ errors.first('country_code') }}</span>
                            </div>

                            

                            <div class="control-group" :class="[errors.has('state_code') ? 'has-error' : '']">
                                <label for="state_code" class="required">{{ __('admin::app.settings.cities.state-code') }}</label>
                                <input v-validate="'required'" class="control" id="state_code" name="state_code" data-vv-as="&quot;{{ __('admin::app.settings.cities.state-code') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('state_code')">@{{ errors.first('state_code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('admin::app.settings.cities.name') }}</label>
                                <input v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;{{ __('admin::app.settings.cities.name') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('country_name') ? 'has-error' : '']">
                                <label for="country_name" class="required">{{ __('admin::app.settings.cities.country-name') }}</label>
                                <select v-validate="'required'" class="control" id="country_name" name="country_name" data-vv-as="&quot;{{ __('admin::app.settings.cities.country-name') }}&quot;">
                                <option value="" disabled selected title="{{ __('admin::app.settings.cities.select-country') }}"> {{ __('admin::app.settings.cities.select-country') }}</option>
                                @foreach($countries as $country)    
                                <option value="{{$country->name}}"  title="{{$country->name}}">{{$country->name}}</option>
                                @endforeach
                                    
                                </select>
                                <span class="control-error" v-if="errors.has('country_name')">@{{ errors.first('country_name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('state_name') ? 'has-error' : '']">
                                <label for="state_name" >{{ __('admin::app.settings.cities.state-name') }}</label>
                                <select  class="control" id="state_name" name="state_name" data-vv-as="&quot;{{ __('admin::app.settings.cities.state-name') }}&quot;">
                                <option value="" disabled selected title="{{ __('admin::app.settings.cities.select-state') }}"> {{ __('admin::app.settings.cities.select-state') }}</option>
                                @foreach($countrystates as $state)    
                                <option value="{{$state->default_name}}"  title="{{$state->default_name}}">{{$state->default_name}}</option>
                                @endforeach
                                    
                                </select>
                                <span class="control-error" v-if="errors.has('state_name')">@{{ errors.first('state_name') }}</span>
                            </div>


                            <div class="control-group" :class="[errors.has('courier_zone_id') ? 'has-error' : '']">
                                <label for="courier_zone_id" >{{ __('admin::app.settings.cities.zone-name') }}</label>
                                <select class="control" id="courier_zone_id" name="courier_zone_id" data-vv-as="&quot;{{ __('admin::app.settings.cities.zone-name') }}&quot;">
                                <option value="" disabled selected title="{{ __('admin::app.settings.cities.select-zone') }}"> {{ __('admin::app.settings.cities.select-zone') }}</option>
                                <option value="null"  title="None">None</option>
                                @foreach($zones as $zone)    
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