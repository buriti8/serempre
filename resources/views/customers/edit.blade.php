@extends('layouts.menu')

@section('title', __('base_lang.customers') . ' - ' . __('base_lang.edit'))

@section('title_page')
<i class="fas fa-user-tie"></i>&nbsp;@lang('base_lang.customers')&nbsp;
<i class="fa fa-caret-right"></i>&nbsp;@lang('base_lang.edit')
@endsection

@section('content_page')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12">

            @permission(['view_customers', 'all_customers'])
            <div class="mb-2">
                <a href="{{ url('/customers') }}" class="btn btn-sm btn-primary">
                    <i class="far fa-eye"></i>
                    @lang('customers.view_customers')
                </a>
            </div>
            @endpermission

            <div class="panel panel-default">
                <div class="panel-body body_form">
                    <div class="card card-secondary mb-2">
                        @include('customers._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection