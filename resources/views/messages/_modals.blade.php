<div class="modal fade qr-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('cart.qr_bancolombia')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h5>
                    <a href="{{ route('download_qr_code', $qr_code->id) }}">
                        <i class="fas fa-download"></i>
                        @lang('orders.download_qr')
                    </a>
                </h5>
                <img src="{{ route('cart.qr_code', $qr_code->id) }}?{{rand(0, 1000)}}"
                    alt="@lang('cart.qr_bancolombia')" class="payment_modal_img mb-2">
                <h5>
                    <strong>
                        <span class="text-black">${{number_format($order->total_price, 0, ',', '.')}}</span>
                    </strong>
                </h5>
                <p class="mb-1">@lang('orders.scan_qr')</p>
                <p>@lang('orders.after_payment')</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{url('/my_orders/'. $order->id)}}"
                    class="btn btn-cart-primary">@lang('orders.send_payment_support')
                </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade transfer-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('cart.bank_transfer')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-4">
                        <b>@lang('payment_methods.bank_name')</b>
                        <p class="mb-0">{{$bank_transfer->bank_name}}</p>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <b>@lang('payment_methods.account_type')</b>
                        <p class="mb-0">{{$bank_transfer->account_types->option ?? ''}}</p>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <b>@lang('payment_methods.account_number')</b>
                        <p class="mb-0">{{$bank_transfer->account_number}}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-12 col-md-4">
                        <b>@lang('payment_methods.account_holder')</b>
                        <p class="mb-0">{{$bank_transfer->account_holder}}</p>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <b>@lang('payment_methods.document_type')</b>
                        <p class="mb-0">{{$bank_transfer->document_types->option ?? ''}}</p>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <b>@lang('payment_methods.document_number')</b>
                        <p class="mb-0">{{$bank_transfer->document_number}}</p>
                    </div>
                </div>
                <p class="mb-0">
                    @lang('orders.bank_transfer_payment')
                    <strong>
                        <span class="text-black">${{number_format($order->total_price, 0, ',', '.')}}</span>
                    </strong>
                </p>
                <p>@lang('orders.after_payment')</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{url('/my_orders/'. $order->id)}}"
                    class="btn btn-cart-primary">@lang('orders.send_payment_support')
                </a>
            </div>
        </div>
    </div>
</div>