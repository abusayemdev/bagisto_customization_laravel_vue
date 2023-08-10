@extends('admin::layouts.content')
@section('page_title')
    {{ __('admin::app.settings.cities.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.cities.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.cities-import') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.cities.import-cities') }}
                </a>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.cities.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.cities.add-title') }}
                </a>
            </div>
            
        </div>

        <div class="page-content">

            @inject('cities','Webkul\Admin\DataGrids\CitiesDataGrid')
            {!! $cities->render() !!}
        </div>
    </div>
@stop