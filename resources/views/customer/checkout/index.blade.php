@extends('layouts.customer')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-1 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Choose address</h3>
            </div>
        </div>
        <div class="content-body">
            @if ($errors->any())
            <div class="w-100 alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="checkout">
                <form class="needs-validation w-100" novalidate=""
                    action="{{ route('customer.post_checkout', ['product_id' => Request()->id, 'influencer_id' => Request()->ref]) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="delivery_unit_id" id="delivery-unit-id" value="{{ $delivery_unit->first()->id }}">
                    <input type="hidden" class="price-total" name="total" id="total" value="">
                    <input type="hidden" name="date_est" id="date_est" value="{{ date('Y-m-d', strtotime(now() .' + '. $delivery_unit->first()->time_estimate .' days')) }}">
                    <div class="row mt-2">
                        <div class="col-md-4 order-md-2 mb-1">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Your cart</span>
                            </h4>
                            <ul class="list-group mb-3 card">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Product</h6>
                                        <div class="d-flex align-items-center">
                                            <p>{{ $product->name }} </p>
                                        </div>
                                        <small class="text-muted">
                                            <img src="{{ $product->getMainImg()->first()->url }}" width="80" height="80" class="obj-contain"
                                                alt="product">
                                        </small>
                                    </div>
                                    <div class="text-right">
                                        <h6 class="my-0 invisible">Product</h6>
                                        <span class="text-muted"><span id="price">{{ $product->price }}
                                            </span>VND</span>
                                        <div class="d-flex align-items-center justify-content-end"
                                            style="margin-bottom:2px">
                                            <span>x </span>
                                            <input type="number" name="quantity" min="1" id="qty-product"
                                                value="{{ $quantity ?? 1 }}" class="form-control px-1">
                                        </div>
                                        <div class="">= <span
                                                class="price-total-demo">{{ number_format($product->price * $quantity) }}
                                            </span></div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div id="delivery-unit-info">
                                        @php $first_delivery = $delivery_unit->first(); @endphp
                                        <h6 class="my-0">Delivery unit</h6>
                                        <p>{{ optional($first_delivery)->name }}</p>
                                        <p class="mb-1">Receiving on
                                            {{ date('Y-m-d', strtotime(now(). ' + '. $first_delivery->time_estimate .' days')) }}
                                        </p>
                                    </div>
                                    <div>
                                        <span class="text-muted">20,000 VND</span>
                                        <div class="link-change" data-target="#modalChangeDelivery" data-toggle="modal">
                                            Change</div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total (VND)</span>
                                    <strong class="price-total"></strong>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8 order-md-1">
                            <h4 class="mb-3">Billing address</h4>
                            <div class="card p-2">
                                <div class="mb-3">
                                    <label for="person-name">Person in charge</label>
                                    <input type="text" class="form-control" id="person-name" placeholder=""
                                        name="person_incharge"
                                        value="{{ old('person_incharge') ?? optional($address)->name }}" required="">
                                    <div class="invalid-feedback">
                                        Person in charge is required
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Phone number</label>
                                    <input type="text" class="form-control" id="phone" placeholder=""
                                        name="phone_incharge"
                                        value="{{ old('phone_incharge') ?? optional($address)->phone }}" required="">
                                    <div class="invalid-feedback">
                                        Phone number is required.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="1234 Main St"
                                        name="delivery_addr"
                                        value="{{ old('delivery_addr') ?? optional($address)->address }}" required="">
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="save-info" name="save_addr_info">
                                    <label class="custom-control-label" for="save-info">Save this information for next
                                        time</label>
                                </div>

                                <h4 class="mt-4 mb-1">Payment</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-block my-2">
                                            <div class="custom-control custom-radio">
                                                <input id="banking" name="payment_method" type="radio"
                                                    class="custom-control-input" checked value="0" required="">
                                                <label class="custom-control-label" for="banking">Banking</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input id="momo" name="payment_method" type="radio"
                                                    class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="momo">Momo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="payment_banking">
                                    <div class="col-md-6 mb-3">
                                        <label for="inthelink-bank">Inthelink's bank name</label>
                                        <input type="text" class="form-control" id="inthelink-bank" placeholder=""
                                            readonly required="" value="{{ $inthelink->bank_name }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="inthelink-account">Inthelink's bank account number</label>
                                        <input type="text" class="form-control" readonly id="inthelink-account"
                                            placeholder="" required="" value="{{ $inthelink->bank_acc_num }}">
                                    </div>
                                </div>
                                <div class="row d-none" id="payment_momo">
                                    <div class="col-md-12 mb-3">
                                        <label for="inthelink-bank">Inthelink's momo infomation</label>
                                        <input type="text" class="form-control" id="inthelink-bank" placeholder=""
                                            readonly required="" value="{{ $inthelink->momo_info }}">
                                    </div>
                                </div>
                                <button class="btn btn-info btn-lg btn-block btn-checkout"
                                    onclick="event.preventDefault()" type="submit">Checkout</button>
                            </div>
                        </div>
                    </div>

                    {{-- modal --}}
                    <div class="modal fade text-left" id="modalConfirmCheckout" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel9" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success white">
                                    <h4 class="modal-title text-white" id="myModalLabel9"><i
                                            class="la la-check mr-1"></i>Confirm Checkout</h4>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="mb-2">Please confirm your order before checkout</h5>
                                    <p class="mb-1">Product: {{ $product->name }}</p>
                                    <p class="mb-1">Quantity: <span class="qty-confirm">{{ $quantity }}</span></p>
                                    <p class="mb-1">Price: <span>{{ number_format($product->price) }} VND</span></p>
                                    <p class="mb-1">Delivery fee: <span>{{ number_format(20000) }} VND</span></p>
                                    <p class="mb-1">Total: <span class="total-confirm"></span></p>
                                    <div class="col-12 p-2 text-center">
                                        <img src="{{ $product->getMainImg()->first()->url }}" class="img-fluid obj-contain" alt="product" width="200" height="200">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn grey btn-secondary"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success  btn-accept-checkout">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalChangeDelivery">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content sign__content pb-4 text-center">
                                <!-- Modal body -->
                                <p class="title">
                                    Change your delivery unit
                                </p>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Time estimate</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($delivery_unit as $key => $item)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->time_estimate }} days</td>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input check-delivery" name="delivery-unit"
                                                        id="customRadio{{$item->id}}" data-id="{{$item->id}}" data-name="{{ $item->name }}"
                                                        data-est="{{$item->time_estimate}}" {{ $loop->first ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="customRadio{{$item->id}}">{{ $item->delivery_price }}</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button class="submit" data-dismiss="modal">Done</button>
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
<script src="{{ asset('js/customer/checkout.js') }}"></script>
@endsection