@extends('layouts_cart.menu')

@section('title', __('Compra exitosa'))

@section('content_page')

<div class="register-login-section">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 text-center">
                <div class="card">
                    <span class="fa fa-check fa-5x"></span>
                    <h4 class="display-4 text-black">¡Gracias!</h4>
                    <p class="lead">@lang('orders.success_order')</p>
                    @if ($payment->is_qr_bancolombia)
                    <p class="lead mb-5">@lang('orders.qr_select')
                        <span>
                            <a href="#" data-toggle="modal" data-target=".qr-modal" class="text-info pointer">aquí</a>
                        </span>.
                    </p>
                    @elseif($payment->is_bank_transfer)
                    <p class="lead mb-5">@lang('orders.bank_transfer')
                        <span>
                            <a href="#" data-toggle="modal" data-target=".transfer-modal"
                                class="text-info pointer">aquí</a>
                        </span>.
                    </p>
                    @endif
                    <p>
                        <a href="{{route('cart.home')}}"
                            class="btn btn-cart-primary mb-1">@lang('cart.back_to_shop')</a>
                        <a href="{{url('/my_orders')}}" class="btn btn-cart-secondary mb-1">@lang('cart.show_my_orders')
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@include('messages._modals')
@endsection