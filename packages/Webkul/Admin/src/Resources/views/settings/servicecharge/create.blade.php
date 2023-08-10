@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.servicecharge.add-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.service-charge.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.service-charge.index') }}'"></i>

                        {{ __('admin::app.settings.servicecharge.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.settings.servicecharge.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

    

                    <accordian :title="'{{ __('admin::app.settings.servicecharge.general') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('primary_charge') ? 'has-error' : '']">
                                <label for="primary_charge" class="required">{{ __('admin::app.settings.servicecharge.primary-charge') }}</label>
                                <input v-validate="'required'" class="control" id="primary_charge" name="primary_charge" data-vv-as="&quot;{{ __('admin::app.settings.servicecharge.primary-charge') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('primary_charge')">@{{ errors.first('primary_charge') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('payment_service_name') ? 'has-error' : '']">
                                <label for="payment_service_name" class="required">{{ __('admin::app.settings.servicecharge.payment-service-name') }}</label>
                                <input v-validate="'required'" class="control" id="payment_service_name" name="payment_service_name" data-vv-as="&quot;{{ __('admin::app.settings.servicecharge.payment-service-name') }}&quot;">
                                <span class="control-error" v-if="errors.has('payment_service_name')">@{{ errors.first('payment_service_name') }}</span>
                            </div>

                            

                           

                            <div class="control-group" :class="[errors.has('charge_limit') ? 'has-error' : '']">
                                <label for="charge_limit" class="required">{{ __('admin::app.settings.servicecharge.charge-limit') }}</label>
                                <input v-validate="'required'" class="control" id="charge_limit" name="charge_limit" data-vv-as="&quot;{{ __('admin::app.settings.servicecharge.charge-limit') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('charge_limit')">@{{ errors.first('charge_limit') }}</span>
                            </div>

                            

                            <div class="control-group" :class="[errors.has('additional_charge') ? 'has-error' : '']">
                                <label for="additional_charge" class="required">{{ __('admin::app.settings.servicecharge.additional-charge') }}</label>
                                <input v-validate="'required'" class="control" id="additional_charge" name="additional_charge" data-vv-as="&quot;{{ __('admin::app.settings.servicecharge.additional-charge') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('additional_charge')">@{{ errors.first('additional_charge') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('percent_of_total') ? 'has-error' : '']">
                                <label for="percent_of_total" class="required">{{ __('admin::app.settings.servicecharge.percent-of-total') }}</label>
                                <input v-validate="'required'" class="control" id="percent_of_total" name="percent_of_total" data-vv-as="&quot;{{ __('admin::app.settings.servicecharge.percent-of-total') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('percent_of_total')">@{{ errors.first('percent_of_total') }}</span>
                            </div>




                           
                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop