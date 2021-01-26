@extends('layouts_cart.menu')

@section('title', __('Carrito vacío'))

@section('content_page')

<div class="container-fluid px-md-5 py-3 py-md-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card p-md-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <span class="icon_cart_alt fa-5x strike-through"></span>
                            <h3 class="display-5 text-black mb-3">Su carrito de compras está vacío</h3>
                            <p class="lead mb-3">Comience a comprar
                                @if (!Auth::user())
                                o <span>
                                    <a href="{{route('cart.login')}}" class="login">inicie sesión</a>
                                </span>
                                @endif
                                para ver los productos agregados.
                            </p>
                            <p>
                                <a href="{{ url('/home') }}" class="btn btn-cart-primary">
                                    @lang('cart.back_to_shop')
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection