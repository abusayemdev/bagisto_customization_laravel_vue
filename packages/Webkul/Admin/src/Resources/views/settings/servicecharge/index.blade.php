@extends('admin::layouts.content')
@section('page_title')
    {{ __('admin::app.settings.servicecharge.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.servicecharge.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.service-charge.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.servicecharge.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @inject('servicecharges','Webkul\Admin\DataGrids\ServiceChargeDataGrid')
            {!! $servicecharges->render() !!}
        </div>
    </div>
@stop