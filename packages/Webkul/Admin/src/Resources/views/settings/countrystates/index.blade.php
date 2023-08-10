@extends('admin::layouts.content')
@section('page_title')
    {{ __('admin::app.settings.countrystates.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.countrystates.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.countrystates.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.countrystates.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @inject('countrystates','Webkul\Admin\DataGrids\CountryStatesDataGrid')
            {!! $countrystates->render() !!}
        </div>
    </div>
@stop