@extends('layouts.influencer')


@section('content')
<nav class="nav-front">
    <div class="d-flex align-items-center flex-wrap justify-content-between">
        <div class="d-flex align-items-center justify-content-between">
            <i class="fas fa-bars d-block d-md-none opennav" onclick="openNav()"></i>
            <a class="mb-0 nav-brand align-items-center d-none d-md-flex" href="{{ route('customer.ordered') }}">
                IN THE&nbsp;<span> LINK</span>
            </a>
            <a href="{{ route('customer.ordered') }}" class="d-flex align-items-center title mb-0 w-100 text-center d-md-none">
                IN THE LINK
            </a>
        </div>
    </div>

    <div class="nav-right  align-items-center d-flex">
        <div class="dropdown">
            <div class="nav-right--user dropdown-toggle d-flex align-items-center" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->user_name }}
                <i class="fas fa-user"></i>
                <!-- <span class="notice">2</span> -->
            </div>
            <div class="dropdown-menu" aria-labelledby="">
                <div class="rectangle">
                </div>

                <a class="d-flex dropdown-item" href="{{ route('customer.ordered') }}">
                    <p class=" mb-0">Order</p>
                </a>
                <a class="d-flex dropdown-item" href="{{ route('customer.get_profile') }}">
                    <p class=" mb-0">Your profile</p>
                </a>
                <a class="d-flex dropdown-item" href="{{ route('customer.get_address') }}">
                    <p class=" mb-0">Your addresses</p>
                </a>
                <a class="d-flex dropdown-item" href="{{ url('/logout') }}">
                    <p class=" mb-0">Logout</p>
                </a>
            </div>
        </div>
</nav>
<div class="container-fluid checkoutsuccess">
    <div class="row mb-3">
        <div class="col-md-6">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">In the link</a></li>
                    <li class="breadcrumb-item"><a href="#">Checkout</a></li>
                    <li class="breadcrumb-item active" aria-current="#">{{ PAYMENT_METHOD[$order->payment_method] }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row checkout__app">
        @if ($order->payment_method == 0)
        <div class="col-12">
            <div class="checkout__zalo-banner">
                <img src="{{asset('images/customer/banking-method.jpg')}}" alt="banking">
                <p class="pl-2 pr-2">Checked out successfully</p>
            </div>
        </div>
        @elseif($order->payment_method == 1)
        <div class="col-12">
            <div class="checkout__momo-banner">
                <img src="{{asset('images/customer/logo-momo.png')}}" alt="momo">
                <p class="pl-2 pr-2">Thank you! The payment was checked out successfully.</p>
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="checkout__zalo-banner">
                <img src="{{asset('images/customer/zalopay.png')}}" alt="momo">
                <p class="pl-2 pr-2">Thank you! The payment was checked out successfully.</p>
            </div>
        </div>
        @endif
    </div>
    <div class="row checkout__desc">
        <h5 class="col-12">Thank you for ordering our products.</h5>
        <p class="col-12">
            <span class="checkout__title">Destination address: </span>
            {{ $order->delivery_addr }}
        </p>
        <p class="red col-12">
            <span class="checkout__title">Estimate receive time: </span>
            {{ $order->date_receive_est }}
        </p>
        <p class="col-12">
            Checked out successfully by
            <span class="checkout__title">
                {{ PAYMENT_METHOD[$order->payment_method] }}
            </span>
        </p>
        <p class="red col-12">
            <span class="checkout__title">Total: </span>
            {{ number_format($order->total_amount) }} VND
        </p>
        <p class="red col-12">
            <span class="checkout__title">Inthelink number account: {{ $inthelink_info->bank_acc_num }}
                ({{ $inthelink_info->bank_name }})</span>
        </p>
        <p class="col-12">
            When you need support quotes, contact the number
            @foreach (explode(',', $inthelink_info->phone) as $item)

            <span class="yellow">
                {{$item}}
            </span>
            @if (!$loop->last)
            or
            @endif
            @endforeach
        </p>
    </div>
    <div class="container-fluid checkout__products p-0">
        <div class="table-responsive col-12 checkout__bill p-0">
            <table class="w-100">
                <thead>
                    <tr>
                        <th class="text-center main-blue ">Products</th>
                        <th class="text-center main-blue ">Total Amount </th>
                    </tr>
                </thead>
                <tbody class="checkout__product">
                    <tr>
                        <td class="d-flex flex-wrap justify-content-center">
                            <img src="{{ $order->getProductThumb->url }}" alt="innisfree" style="object-fit:contain;">
                            <div class="d-flex flex-column flex-wrap justify-content-center p-1 p-md-4">
                                <p class="main-blue text-center">
                                    {{ $order->product_name }}
                                </p>
                                <p class="text-center">
                                    {{ number_format($order->price) }} VND
                                </p>
                            </div>
                        </td>
                        <td class="text-center red">
                            {{ number_format($order->total_amount) }} VND
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row pt-4 pt-md-5">
            <div class="col-12 text-center">
                <a href="{{ route('customer.ordered') }}" class="btn btn-outline-primary btn-lg">Go to my order</a>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(document).ready(function () {
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
})
</script>
@endsection