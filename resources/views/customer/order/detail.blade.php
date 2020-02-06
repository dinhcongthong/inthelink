@extends('layouts.customer')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-1 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Order's Detail - {{ $order->id }}</h3>
            </div>
        </div>
        <div class="content-body">
            <div class="checkout">
                <form class="needs-validation w-100" novalidate="">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-4 order-md-2 mb-4">
                            <ul class="list-group mb-3 card">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div class="d-flex">
                                        <img src="{{ $order->getProduct->getMainImg()->first()->url }}" width="80" height="80"
                                        class="obj-contain mr-1" alt="product">
                                        <div>
                                            <span class="text-muted">{{ $order->product_name }}</span>
                                            <div class="d-flex align-items-center">
                                                <p>
                                                    x {{ $order->quantity}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-muted"><span id="price">{{ number_format($order->price) }} VND
                                        </span></span>
                                        <div class="">= <span class="price-total-demo" data-qty="{{ $order->quantity}}"
                                            data-unit="{{ $order->price }}"></span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div class="d-flex">
                                        Delivery fee
                                    </div>
                                    <div class="text-right">
                                        <p>20,000 VND</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total</span>
                                    <strong>{{ number_format($order->total_amount) }} VND</strong>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8 order-md-1">
                            <div class="card p-2">
                                <h4 class="mb-2">Information</h4>
                                <div class="mb-3">
                                    <p class="text-muted">Person in charge:
                                        <span class="text-dark">{{ $order->person_incharge }}</span>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted">Phone number:
                                        <span class="text-dark">
                                            {{ $order->phone_incharge }}
                                        </span>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted">Address:
                                        <span class="text-dark">{{ $order->delivery_addr }}</span>
                                    </p>
                                </div>
                                
                                <h4 class="mt-1 mb-2">Payment</h4>
                                <div class="mb-3">
                                    <p class="text-muted">Payment method:
                                        <span class="text-dark">{{ PAYMENT_METHOD[$order->payment_method] }}</span>
                                    </p>
                                </div>
                                @if (PAYMENT_METHOD[$order->payment_method] == 'Momo')
                                <div class="mb-3">
                                    <p class="text-muted">Inthelink's momo information:
                                        <span class="text-dark">{{ $inthelink->momo_info }}</span>
                                    </p>
                                </div>
                                @else
                                <div class="mb-3">
                                    <p class="text-muted">Inthelink's account bank:
                                        <span class="text-dark">{{ $inthelink->bank_name }}</span>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted">Inthelink's account number:
                                        <span class="text-dark">{{ $inthelink->bank_acc_num }}</span>
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(document).ready(function(){
        $('.price-total-demo').html(formatNumber($('.price-total-demo').data('unit') * $('.price-total-demo').data('qty')) + ' VND');
    })
</script>
@stop