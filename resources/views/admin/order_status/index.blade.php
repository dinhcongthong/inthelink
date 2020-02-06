@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Order Status</h3>
            </div>
        </div>
        <div class="">
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <ul class="page-tabs d-flex justify-content-center nav nav-pills">
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary active" data-toggle="pill" href="#all">
                                                All
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary " data-toggle="pill" href="#pending">
                                                Pending
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary " data-toggle="pill" href="#confirmed">
                                                Confirmed
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary" data-toggle="pill" href="#ongoing">
                                                On going
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary" data-toggle="pill" href="#delivered">
                                                Delivered
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary" data-toggle="pill" href="#cancelled">
                                                Cancelled
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 p-0 tab-content">
                                    <div id="all" class="tab-pane  active page-table--wrap">
                                        <div class="page-tool d-flex justify-content-start">
                                            <div class="d-flex flex-wrap align-items-center mt-1 mb-3">
                                                <div class="mr-1 font-weight-bold">Filter order date by date range</div>
                                                <div class="input-group ">
                                                    <input name="dates" readonly type="text" class="form-control showdropdowns" placeholder="Choose date">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <span class="la la-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="table_all" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Order Date</th>
                                                        <th>Total</th>
                                                        <th>Payment Method</th>
                                                        <th>Updated At</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="pending" class="tab-pane page-table--wrap">
                                        <div class="table-responsive">
                                            <table id="table_pending" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Order Date</th>
                                                        <th>Total</th>
                                                        <th>Payment Method</th>
                                                        <th>Updated At</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="confirmed" class="tab-pane page-table--wrap">
                                        <div class="table-responsive">
                                            <table id="table_confirmed" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Order Date</th>
                                                        <th>Total</th>
                                                        <th>Payment Method</th>
                                                        <th>Updated At</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="ongoing" class="tab-pane page-table--wrap">
                                        <div class="table-responsive">
                                            <table id="table_ongoing" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Order Date</th>
                                                        <th>Total</th>
                                                        <th>Payment Method</th>
                                                        <th>Updated At</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="delivered" class="tab-pane page-table--wrap">
                                        <div class="table-responsive">
                                            <table id="table_delivered" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Order Date</th>
                                                        <th>Total</th>
                                                        <th>Payment Method</th>
                                                        <th>Updated At</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="cancelled" class="tab-pane page-table--wrap">
                                        <div class="table-responsive">
                                            <table id="table_cancelled" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Customer</th>
                                                        <th>Product</th>
                                                        <th>Order Date</th>
                                                        <th>Total</th>
                                                        <th>Payment Method</th>
                                                        <th>Updated At</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>


@stop
@section('datatables')
<script type="text/javascript" src="{{asset('js/admin/order_status.js')}}"></script>
@endsection