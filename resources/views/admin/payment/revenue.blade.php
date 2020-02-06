@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Revenue</h3>
            </div>
        </div>
        <div class="">
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <div class="page-table--wrap payment">
                            <div class="page-tool d-flex flex-wrap justify-content-between">
                                <div class="d-flex flex-wrap align-items-center mt-1 mb-3">
                                    <div class="mr-1 font-weight-bold">Filter by date range</div>
                                    <div class="input-group ">
                                        <input name="dates" readonly="" type="text" class="form-control showdropdowns" placeholder="Choose date">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <span class="la la-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="table_revenue" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Status</th>
                                            <th>Product</th>
                                            <th>Customer</th>
                                            <th>Commission(VND)</th>
                                            <th>Order Date</th>
                                            <th>Total Amount(VND)</th>
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
    </div>
</div>
@stop
@section('datatables')
<script src="{{asset('js/admin/payment.js')}}"></script>
@stop
