@extends('admin::layouts.content')
@section('page_title')
    {{ __('admin::app.settings.pickuplocations.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.pickuplocations.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.pickup-location.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.pickuplocations.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @inject('pickuplocations','Webkul\Admin\DataGrids\PickupLocationDataGrid')
            {!! $pickuplocations->render() !!}
        </div>
    </div>
@stop