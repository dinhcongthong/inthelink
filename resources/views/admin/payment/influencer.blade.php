@extends('layouts.admin')
@section('content')
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
                    <div class="card-body">
                        <div class="page-table--wrap">
                            <div class="table-responsive">
                                <table id="table_payment_influencer" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Status</th>
                                            <th>Influencer</th>
                                            <th>Customer</th>
                                            <th>Commission(VND)</th>
                                            <th>Order Date</th>
                                            <th>Total Amount(VND)</th>
                                            <th>Payment Status</th>
                                            <th>Payment Date</th>
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