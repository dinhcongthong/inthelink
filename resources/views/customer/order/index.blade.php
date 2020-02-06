@extends('layouts.customer')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">My Orders</h3>
            </div>
        </div>
        <div class="content-body orders__customer">
            <div class="shopping-cart">
                <div class="card">
                    <div class="card-header d-flex align-items-center flex-wrap justify-content-between">
                        <div class="btn-group float-md-right" role="group"
                            aria-label="Button group with nested dropdown" data-toggle="tooltip"
                            title="Filter by order status">
                            <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2"
                                id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="la la-list"></i> {{ ucwords(Request()->status ?? 'all') }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="{{ route('customer.ordered') }}">All</a>
                                <a class="dropdown-item" href="{{ route('customer.ordered', ['status' => 'pending']) }}">Pending</a>
                                <a class="dropdown-item" href="{{ route('customer.ordered', ['status' => 'confirmed']) }}">Confirmed</a>
                                <a class="dropdown-item" href="{{ route('customer.ordered', ['status' => 'on-going']) }}">On going</a>
                                <a class="dropdown-item" href="{{ route('customer.ordered', ['status' => 'delivered']) }}">Delivered</a>
                                <a class="dropdown-item" href="{{ route('customer.ordered', ['status' => 'cancelled']) }}">Cancelled</a>
                            </div>
                        </div>
                        @if (session()->has('status'))
                        <div class="mt-2 w-100 alert alert-success"><p>{{ session()->get('status') }}</p></div>
                        @endif
                    </div>
                    @if (count($ordered) ==  0)
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h3>There are no orders.</h3>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @if (count($ordered) != 0)
                @foreach ($ordered as $order)
                <a href="{{ route('customer.order_detail', $order->id) }}" class="d-contents">
                    <div class="card pull-up">
                        <div class="card-header">
                            <div class="float-left btn btn-info" title="Order ID">
                                #{{ $order->id }}
                            </div>
                            <div class="float-right">
                                @if($order->status == 2 && empty($order->getEvaluation))
                                <a href="javascript:void(0)" class="btn btn-outline-info btn-{{$order->id}}"
                                    onclick="evaluation({{$order->id}}, {{$order->product_id}} , '{{ $order->getProduct->getMainImg()->first()->url }}' , '{{ $order->product_name }}' , event )">
                                    <i class="la la-comment" style="margin-right: 5px"></i>Received and Evaluation
                                </a>
                                @elseif (ORDER_STATUS[$order->status] == 'Pending')
                                <a href="javascript:void(0)" class="btn btn-outline-info"
                                    onclick="cancelOrder({{ $order->id }} , this , event)">
                                    <i class="la la-close"></i> Cancel
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body py-0">
                                <div class="d-flex flex-wrap justify-content-between lh-condensed">
                                    <div class="order-details text-center">
                                        <div class="product-img d-flex align-items-center">
                                            <img class="img-fluid"
                                                src="{{ $order->getProduct->getMainImg()->first()->url }}"
                                                alt="Card image cap">
                                        </div>
                                    </div>
                                    <div class="order-details">
                                        <h6 class="my-0">{{ $order->product_name }}</h6>
                                        <h3 class="mt-1">{{ number_format($order->price) }} VND</h3>
                                        <small class="text-muted d-block">Quantity: {{ $order->quantity }}</small>
                                        <small class="text-muted">Type of product: {{ $order->category_name }}</small>
                                    </div>
                                    <div class="order-details">
                                        <div class="order-info">
                                            <h6 class="my-0">Payment method:
                                                {{ PAYMENT_METHOD[$order->payment_method] }}
                                            </h6>
                                            <small class="text-muted">Delivery fee: 20,000 VND</small>
                                            <div><small class="text-muted">Inthelink account number:
                                                    {{ $inthelink->bank_acc_num }} ({{ $inthelink->bank_name }})</small>
                                            </div>
                                            @if(!empty($order->note))
                                            <b>Note: </b>{{ $order->note }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="order-details">
                                        @php
                                        $color_status = [4 => 'red', 3 => 'text-success' , 2 => 'text-info' , 0 => '' , 1 => ''];
                                        @endphp
                                        <div class="text-center order-status {{ $color_status[$order->status] }}">
                                            {{ ORDER_STATUS[$order->status] }}
                                        </div>
                                        @if (PAYMENT_METHOD[$order->payment_method] == 'Momo' && $order->payment_status == App\Models\Order::NOT_PAID_YET && ORDER_STATUS[$order->status] == 'Pending')
                                        <form action="{{ route('customer.post_payment_momo', ['orderId' => $order->id]) }}" method="post" id="payment{{$order->id}}">
                                            @csrf
                                            <input type="hidden" name="total_amount" value="{{ $order->total_amount }}">
                                            <button type="submit" class="btn btn-outline-danger">Pay now</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between flex-wrap border-top-blue-grey border-top-lighten-5 text-muted">
                            <span class="pb-1 pr-1">
                                <span class="text-muted">Order date</span>
                                <strong>{{ $order->created_at->format('Y-m-d H:i:s') }}</strong>
                            </span>
                            <span class="pb-1">
                                <span class="text-muted">Total Amount</span>
                                <strong>{{ number_format($order->total_amount) }} VND</strong>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
                @endif
            </div>
            <div class="w-100">
                {{ $ordered->links() }}
            </div>
        </div>
    </div>
</div>

{{-- modals --}}
<div class="modal fade" id="modalEvaluation">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <p class="title ">
                Evaluation
            </p>
            <div class="evaluation-notice">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <p>
                    Share your impressions about the service to encourage our travelers.
                </p>
            </div>
            <div class="evaluation-product d-flex">
                <img src="" alt="product">
                <div class="p-1 w-100">
                    <div class="product-name"></div>
                    <p>
                        Share your impressions about the service to encourage our travelers.
                    </p>
                </div>
            </div>
            <div class="evaluation-note">
                <div class="rates d-flex justify-content-center"></div>
                <div class="reasons reasons-bad ">
                    <div class="btn-reason active btn-reason-first" data-reason="Deliver overtime">Deliver overtime
                    </div>
                    <div class="btn-reason" data-reason="Bad communication">Bad communication</div>
                    <div class="btn-reason" data-reason="Accommodating">Accommodating</div>
                    <div class="btn-reason" data-reason="Damage item">Damage item</div>
                </div>
                <div class="reasons reasons-good">
                    <div class="btn-reason active btn-reason-first" data-reason="Delivery on time">Delivery on time
                    </div>
                    <div class="btn-reason" data-reason="Good communication">Good communication</div>
                    <div class="btn-reason" data-reason="Accommodating">Accommodating</div>
                    <div class="btn-reason" data-reason="Perferct item">Perferct item</div>
                </div>
                <textarea id="" placeholder="Please share what you like..."></textarea>
            </div>
            <div class="evaluation-buttons">
                <button class="btn" data-dismiss="modal">Back</button>
                <button class="btn submit" id="" data-dismiss="modal">Post</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCancelOrder">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body p-5">
                <h2 class="text-center header">
                    Do you really want to cancel this order ?
                </h2>
                <form>
                    <div class="button-group d-flex flex-wrap justify-content-center mt-2">
                        <button type="button" class="btn btn-danger btn-accept-cancel">Yes</button>
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="{{ asset('js/customer/order.js') }}"></script>
@stop