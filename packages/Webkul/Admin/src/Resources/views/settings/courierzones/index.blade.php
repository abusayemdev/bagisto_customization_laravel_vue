@extends('admin::layouts.content')
@section('page_title')
    {{ __('admin::app.settings.courierzones.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.courierzones.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.courierzones.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.courierzones.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @inject('courierzones','Webkul\Admin\DataGrids\CourierZonesDataGrid')
            {!! $courierzones->render() !!}
        </div>
    </div>
@stop