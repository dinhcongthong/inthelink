@extends('layouts.admin')
@section('content')
{{-- users/influencer/Harry Parkison --}}
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Order's Detail - {{ $order->id }}</h3>
            </div>
        </div>
        <div class="">
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <div class="page-content p-0 payment__influencer-detail">
                            <div class="detail__info">
                                <div class="row no-gutters">
                                    <div class="col-lg-6 col-xl-3 detail__info-logo">
                                        <h1>{{  $inthelink->name }}</h1>
                                    </div>
                                    <div class="col-lg-6 col-xl-3 detail__info-col detail__info-col-center">
                                        <div class="mb-3">
                                            <i class="la la-globe" data-toggle="tooltip" title="Website"></i>
                                            <div>
                                                <a href="{{ $inthelink->website }}">{{ $inthelink->website }}</a>
                                            </div>Payment method:
                                        </div>
                                        
                                        <div class="" style="mb-3">
                                            <i class="la la-phone" data-toggle="tooltip" title="Phone"></i>
                                            <div>{{ $inthelink->phone }}</div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-12 col-xl-6 detail__info-col">
                                        <div class='mb-3'>
                                            <i class="la la-map-marker" data-toggle="tooltip" title="Location"></i>
                                            <div>{{ $inthelink->address }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <i class="la la-envelope" data-toggle="tooltip" title="email"></i>
                                            <div>{{ $inthelink->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page-table--wrap detail__table">
                                <div class="row no-gutters" style="padding: 0 34px">
                                    <div class="col-md-6">
                                        <p><span>Product:</span> {{ $order->product_name }} <img src="{{ $order->getProduct->getMainImg()->first()->url }}" height="30"></p>
                                        <p><span>Price:</span> {{ number_format($order->price) }}</p>
                                        <p><span>Quantity:</span> {{ $order->quantity }}</p>
                                        <p><span>Delivery fee:</span> 20,000 VND</p>
                                        <p><span>Delivery unit:</span> {{ $order->delivery_unit }}</p>
                                        <p><span>Total:</span> {{ number_format($order->total_amount) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><span>Order date:</span> {{ $order->created_at }}</p>
                                        @if (ORDER_STATUS[$order->status] == 'Cancelled')
                                        <p><span>Order status:</span> <span class="text-danger font-weight-bold">{{ ORDER_STATUS[$order->status] }}</span></p>
                                        @else 
                                        <p><span>Order status:</span> {{ ORDER_STATUS[$order->status] }}</p>
                                        @endif
                                        <p><span>Delivery address:</span> {{ $order->delivery_addr }}</p>
                                        <p><span>Payment method:</span> {{ PAYMENT_METHOD[$order->payment_method] }}</p>
                                        <p><span>Inthelink payment account number:</span> {{ $inthelink->bank_acc_num }} ({{ $inthelink->bank_name }})</p>
                                    </div>
                                </div>
                                
                                <div class="detail__total align-items-end d-flex flex-column">
                                    <div class="d-flex flex-wrap"><span>Influencer commission: </span>{{ number_format($order->getInfluencerHistory->commission_money) }} VND ({{ $order->getInfluencer->commission }}%)</div>
                                    <div class="d-flex flex-wrap"><span>Inthelink profit: </span>{{ number_format($order->profit) }} VND</div>
                                </div>
                                <div class="detail__terms row no-gutters">
                                    <div class="col-lg-10">
                                        <ul class="">
                                            <div class="detail__terms-title">Terms and Conditions</div>
                                            <li>
                                                If account is not paid within 7 days the system details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.
                                            </li>
                                            <li>
                                                If account is not paid within 7 days the system details supplied as confirmation.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center justify-content-center">
                                        <i class="la la-print pointer main-gray mt-auto ml-auto fa-2x" data-toggle="tooltip" title="Print"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('datatables')
<script type="text/javascript" src="{{asset('js/admin/order_detail.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.detail__bill-image').mouseenter(function(){
            $(this).find('img:nth-child(1)').css('display','none');
            $(this).find('img:nth-child(2)').css('display','block');
        });
        $('.detail__bill-image').mouseleave(function(){
            $(this).find('img:nth-child(2)').css('display','none');
            $(this).find('img:nth-child(1)').css('display','block');
        });
        $('.la-print').on('click',function(){
            window.print();
        })
    })
</script>
@endsection
