@extends('layouts.admin')
@section('content')
{{-- users/influencer/Harry Parkison --}}
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Payment Influencer</h3>
            </div>
        </div>
        <div class="">
            <div class="content-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="common-wrap users__influencer-detail">
                            <form action="{{ route('admin.users.influencer_approved') }}" method="POST">
                                @csrf
                                <div class="influencer-banner {{ $influencer->status == 1 ? 'active' : ''}}">
                                    <input type="hidden" name="influencer_id" value="{{ $influencer->id }}">
                                    <input type="hidden" name="reason" value="">
                                    <input type="hidden" name="status" value="">
                                    <input type="hidden" name="commission" value="">

                                    <div class="d-flex influencer-avatar">
                                        <div class="avatar">
                                            <img src="{{ optional($influencer->getUser->getAvatar)->url ?? asset('images/overview/user-no-avatar.png') }}">
                                        </div>
                                        <div class="influencer-name" data-toggle="tooltip" title="Username">{{ $influencer->getUser->user_name }}</div>
                                    </div>
                                    <div class="influencer-info">
                                        <p class="m-1">
                                            <i class="fas fa-phone-alt" data-toggle="tooltip" title="Phone"></i>
                                            <span>Phone number : {{ $influencer->getUser->mobile }}</span>
                                        </p>
                                        <p class="m-1">
                                            <i class="fas fa-envelope" data-toggle="tooltip" title="Email"></i>
                                            <span>Email: {{ $influencer->getUser->email }}</span>
                                        </p>
                                        <p class="m-1">
                                            <i class="fas fa-venus-mars" data-toggle="tooltip" title="Gender"></i>
                                            <span>Gender: {{ GENDER[$influencer->getUser->gender] }}</span>
                                        </p>
                                        <p class="m-1">
                                            <i class="fas fa-birthday-cake" data-toggle="tooltip" title="Birthday"></i>
                                            <span>Birthday: {{ $influencer->getUser->birthday }}</span>
                                        </p>
                                        <p class="m-1">
                                            <i class="far fa-calendar-alt" data-toggle="tooltip" title="Joined date"></i>
                                            <span>Joined date: {{ $influencer->created_at->format('Y-m-d H:i:s') }}</span>
                                        </p>
                                    </div>
                                    @if ($influencer->status == 1)
                                    <label class="switch mt-auto ml-auto" id="switch-user" data-userid="{{ $influencer->id }}">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    @elseif($influencer->status == 2)
                                    <label class="switch mt-auto ml-auto" id="switch-user" data-userid=" {{$influencer->id  }}">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    @endif
                                </div>
                                <ul class="page-tabs d-flex justify-content-left nav nav-pills influencer-menu p-1">
                                    <li class="nav-item">
                                        <button class="btn active" data-toggle="pill" href="#all">
                                            General
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="btn " data-toggle="pill" href="#sale">
                                            Sale history
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="btn" data-toggle="pill" href="#payment">
                                            Payment
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content ">
                                    <div class="page-table--wrap tab-pane container-fluid active influencer-general {{ $influencer->status == 2 ? 'blocked' : '' }}" id="all">

                                        {{-- only show with block influencer --}}
                                        @if ($influencer->status == 2)
                                        <div class="row influencer-warning">
                                            <div class=" w-100">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                <div class="">
                                                    <p>
                                                        You blocked this influencer at {{ $influencer->updated_at->format('Y-m-d') }}.
                                                    </p>
                                                    <p class="mb-0">
                                                        The reason: {{ $influencer->getUser->reason_block }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row row-info">
                                            <div class="col-sm-12 col-lg-6 col-left">
                                                <div class="title">
                                                    Summary Info
                                                </div>
                                                <div class="info-child">
                                                    <div class="sub">Social link</div>
                                                    <ul>
                                                        @foreach ($influencer->getSocialLinks as $item)
                                                        <li>
                                                            <a class="text-truncate" href="{{ $item->link }}">{{ $item->link }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="info-child">
                                                    <div class="sub">Bank account</div>
                                                    <ul>
                                                        <li><b> Bank name: </b>&nbsp; {{ $influencer->bank_name }}</li>
                                                        <li><b> Bank account number: </b>&nbsp; {{ $influencer->bank_acc_num }}</li>
                                                    </ul>
                                                </div>
                                                <div class="info-child">
                                                    <div class="sub">ID</div>
                                                    <div class="d-flex flex-wrap justify-content-center">
                                                        <img src="{{ optional($influencer->getIdentityFontThumb()->first())->url ?? asset('images/overview/no-image-6x4.png') }}" class="m-2">
                                                        <img src="{{ optional($influencer->getIdentityBackThumb()->first())->url ?? asset('images/overview/no-image-6x4.png') }}" class="m-2">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 col-right">
                                                <div class="title d-flex justify-content-between">
                                                    <div>Commission set up</div>
                                                    <div class="icon-edit" title="Click here to edit commission" data-toggle="tooltip">
                                                        <i class="la la-pencil"></i>
                                                    </div>
                                                </div>
                                                <div class="sub">Commission <span class="red">*</span></div>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="ft-package"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control select-commission" disabled value="{{ $influencer->commission == null ? 5 : $influencer->commission }}" data-userid="{{ $influencer->id }}">
                                                        <option value="3">3%</option>
                                                        <option value="5">5%</option>
                                                        <option value="7">7%</option>
                                                    </select>
                                                </div>
                                                <div class="term">
                                                    <div class="term-title">Terms and Conditions</div>
                                                    <ul>
                                                        <li>
                                                            If account has 10,000 followers on their social network, they could get 3% on each
                                                            order was paid by customer that use in the link system.
                                                        </li>
                                                        <li>
                                                            If account has 50,000 followers on their soical network, they could get 5% on each
                                                            order was paid by customer that use in the link system.
                                                        </li>
                                                        <li>
                                                            If account over 50,000 followers on their soical network, they could get 7% on each
                                                            order was paid by customer that use in the link system.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($influencer->status == 0)
                                        <div class="row mt-2">
                                            <input type="hidden" name="reason" value="">
                                            <div class="col-sm-12 bg-white rounded">
                                                <div class="button-group d-flex">
                                                    <button class="btn-gray m-1" data-toggle="modal" data-target="#modalDecline" onclick="event.preventDefault()">Decline</button>
                                                    <button class="btn-yellow m-1 btn-approve" type="submit" data-userid="{{ $influencer->id }}">Accept</button>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="page-table--wrap tab-pane fade page-content" id="sale">
                                        @if ($influencer->getHistorySale->count() < 1) <img class="image-empty" src="{{asset('images/admin/empty.png')}}" alt="">
                                            <p class="text-center sub-blue text-empty">OOPs! No recent activities.</p>
                                            @else

                                            {{-- sale history --}}
                                            <div class="sale-wrap  py-0 px-2 ">
                                                <div class="sale-head">
                                                    <div class="">Sale report summary by month</div>
                                                </div>
                                                <div class="sale-products ">
                                                    <div class="accordion" id="accordionExample">
                                                        @foreach ($product as $product)
                                                        @if ($product->getOrders->count() > 0)
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne">
                                                                <h2 class="mb-0">
                                                                    <div class="d-flex justify-content-between" data-toggle="collapse" data-target="#product{{ $product->id }}" aria-expanded="true" aria-controls="product{{ $product->id }}">
                                                                        <div class="d-flex align-items-center">
                                                                            <img class="product-img" src="{{ optional($product->getMainImg()->first())->url }}">
                                                                            <div class="product-name main-blue">{{ $product->name }}</div>
                                                                        </div>
                                                                        <div class="product-shop main-blue d-flex align-items-center">
                                                                            {{ $product->getCategory->name }}
                                                                        </div>
                                                                    </div>
                                                                </h2>
                                                            </div>

                                                            <div id="product{{ $product->id }}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body page-table table-responsive">
                                                                    <div class="row">
                                                                        <div class="col-lg-8 table-responsive">
                                                                            <table id="table_product_{{ $product->id }}" data-id="{{ $product->id }}" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                                                                <thead>
                                                                                    <th>OrderId</th>
                                                                                    <th>Customer</th>
                                                                                    <th>Quantity</th>
                                                                                    <th>Total Amount(VND)</th>
                                                                                    <th>Commission(VND)</th>
                                                                                    <th>Payment Date</th>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                                {{-- <tfoot>
                                                        <tr>
                                                            <th colspan="5" class="text-right red">Profit(VND):</th>
                                                            <th class="red"></th>
                                                        </tr>
                                                    </tfoot> --}}
                                                                            </table>
                                                                        </div>
                                                                        <div class="col-lg-4 pt-3 pt-lg-5">
                                                                            <div class="product-info p-1">
                                                                                <p class="product-head">{{ $product->name }}</p>
                                                                                <div class="product-cate">
                                                                                    <label>Category: </label>
                                                                                    <div>{{ $product->getCategory->name }}</div>
                                                                                </div>
                                                                                <div class="product-price">
                                                                                    <label>
                                                                                        Price(VND):
                                                                                    </label>
                                                                                    <div>
                                                                                        {{ number_format($product->price) }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="product-shop">
                                                                                    <label>From: </label>
                                                                                    <a href="#" class="sub-blue">
                                                                                        INTHELINK Shop <i class="fas fa-store-alt"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <img class="product-img" src="{{ optional($product->getMainImg()->first())->url }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                    </div>

                                    <div class="page-table--wrap tab-pane fade" id="payment">
                                        @if ($influencer->getHistorySale->count() < 0)
                                        <img class="image-empty" src="{{asset('images/admin/empty.png')}}" alt="">
                                        <p class="text-center sub-blue text-empty">OOPs! No recent activities.</p>
                                        @else
                                        <div class="sale-wrap  py-0 px-2 ">
                                            <div class="sale-head pb-3">
                                                <div class="">Payment report summary by month</div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="table_payment" class="w-100 table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Order ID</th>
                                                            <th>Order Status</th>
                                                            <th>Total Amount(VND)</th>
                                                            <th>Commission(VND)</th>
                                                            <th>Payment Status</th>
                                                            <th>Payment Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modals --}}
<div class="modal fade" id="modalCommission">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <h5 class="text-center header">
                    By assuring with current set up for this influencer with 5% . This influencer will get whenever the
                    order was paid successfully.
                </h5>
                <div class="button-group d-flex flex-wrap justify-content-center">
                    <button type="button" class="btn btn-gray" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-yellow">Accpet</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDecline">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <h5 class="text-center header">
                    Please tell them a reason.
                </h5>
                <form>
                    <div class="alert alert-danger" style="display:none">
                        Please choose some reasons
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="damage" name="damage">
                        <label class="custom-control-label" for="damage">Damage product.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bad" name="bad">
                        <label class="custom-control-label" for="bad">The product is bad.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="others" name="others">
                        <label class="custom-control-label text-others" for="others">Orthers</label>
                    </div>
                    <textarea placeholder="Describe your problems" rows="6"></textarea>
                    <div class="button-group d-flex flex-wrap justify-content-center">
                        <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-red btn-decline">Decline</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalBlock">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <h5 class="text-center header">
                    Do you really want to block this account. They will not access to our system. Please choose a reason, this notification will notice by email
                </h5>
                <form>
                    <div class="alert alert-danger" style="display:none">
                        Please choose some reasons
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="invalid" name="invalid">
                        <label class="custom-control-label" for="invalid">Influencer invalid</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="exist" name="exist">
                        <label class="custom-control-label" for="exist">Influencer not exist</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="others-block" name="others-block">
                        <label class="custom-control-label" for="others-block">Orthers</label>
                    </div>
                    <textarea placeholder="Describe your problems" rows="6" class="text-others" disabled></textarea>
                    <div class="button-group d-flex flex-wrap justify-content-center">
                        <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-yellow submit-block">Block</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('datatables')
<script type="text/javascript" src="{{asset('js/admin/influencer-detail.js')}}"></script>
@endsection