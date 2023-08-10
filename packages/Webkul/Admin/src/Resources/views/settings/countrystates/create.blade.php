@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.countrystates.add-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.countrystates.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.countrystates.index') }}'"></i>

                        {{ __('admin::app.settings.countrystates.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.settings.countrystates.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

    

                    <accordian :title="'{{ __('admin::app.settings.countrystates.general') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('country_code') ? 'has-error' : '']">
                                <label for="country_code" class="required">{{ __('admin::app.settings.countrystates.country-code') }}</label>
                                <input v-validate="'required'" class="control" id="country_code" name="country_code" data-vv-as="&quot;{{ __('admin::app.settings.countrystates.country-code') }}&quot;" v-country_code/>
                                <span class="control-error" v-if="errors.has('country_code')">@{{ errors.first('country_code') }}</span>
                            </div>

                            

                            <div class="control-group" :class="[errors.has('code') ? 'has-error' : '']">
                                <label for="code" class="required">{{ __('admin::app.settings.countrystates.code') }}</label>
                                <input v-validate="'required'" class="control" id="code" name="code" data-vv-as="&quot;{{ __('admin::app.settings.countrystates.code') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('code')">@{{ errors.first('code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('default_name') ? 'has-error' : '']">
                                <label for="default_name" class="required">{{ __('admin::app.settings.countrystates.default-name') }}</label>
                                <input v-validate="'required'" class="control" id="default_name" name="default_name" data-vv-as="&quot;{{ __('admin::app.settings.countrystates.default-name') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('default_name')">@{{ errors.first('default_name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('country_id') ? 'has-error' : '']">
                                <label for="country_id" class="required">{{ __('admin::app.settings.countrystates.country-name') }}</label>
                                <select v-validate="'required'" class="control" id="country_id" name="country_id" data-vv-as="&quot;{{ __('admin::app.settings.countrystates.country-name') }}&quot;">
                                <option value="" disabled selected title="{{ __('admin::app.settings.countrystates.select-country') }}"> {{ __('admin::app.settings.countrystates.select-country') }}</option>
                                @foreach($countries as $country)    
                                <option value="{{$country->id}}"  title="{{$country->name}}">{{$country->name}}</option>
                                @endforeach
                                    
                                </select>
                                <span class="control-error" v-if="errors.has('country_id')">@{{ errors.first('country_id') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('courier_zone_id') ? 'has-error' : '']">
                                <label for="courier_zone_id" >{{ __('admin::app.settings.countrystates.zone-name') }}</label>
                                <select class="control" id="courier_zone_id" name="courier_zone_id" data-vv-as="&quot;{{ __('admin::app.settings.countrystates.zone-name') }}&quot;">
                                <option value="" disabled selected title="{{ __('admin::app.settings.countrystates.select-zone') }}"> {{ __('admin::app.settings.countrystates.select-zone') }}</option>
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