@extends('layouts.menu')

@section('title', __('base_lang.cities') . ' - ' . __('base_lang.new'))

@section('title_page')
<i class="fas fa-user-tie"></i>&nbsp;@lang('base_lang.cities')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.new')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">

            @permission(['view_cities', 'all_customers'])
            <div class="mb-2">
                <a href="{{ url('/cities') }}" class="btn btn-sm btn-primary">
                    <i class="far fa-eye"></i>
                    @lang('cities.view_cities')
                </a>
            </div>
            @endpermission

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('cities._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection