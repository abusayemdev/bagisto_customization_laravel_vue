@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.cities.import-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.cities-import-store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.cities.index') }}'"></i>

                        {{ __('admin::app.settings.cities.import-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <a href="{{ route('admin.cities-export') }}" class="btn btn-lg btn-primary">
                        {{ __('admin::app.settings.cities.export-cities') }}
                    </a>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.settings.cities.import-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

    

                    <accordian :title="'{{ __('admin::app.settings.cities.general') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('import_file') ? 'has-error' : '']">
                                <label for="import_file" class="required">{{ __('admin::app.settings.cities.import-file') }}</label>
                                <input v-validate="'required'" type="file" class="control" id="import_file" name="import_file" data-vv-as="&quot;{{ __('admin::app.settings.cities.import-file') }}&quot;" v-import_file/>
                                <span class="control-error" v-if="errors.has('import_file')">@{{ errors.first('import_file') }}</span>
                            </div>

                           
                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop