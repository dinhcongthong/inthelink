@extends('layouts.influencer')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Sell History</h3>
            </div>
        </div>
        <div class="">
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table_total" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                        <thead>
                                            <th></th>
                                            <th>OrderId</th>
                                            <th>Product</th>
                                            <th>Customer</th>
                                            <th>Phone number</th>
                                            <th>QTY</th>
                                            <th>Total Amount(VND)</th>
                                            <th>Commission(%)</th>
                                            <th>Order Status</th>
                                            <th>Payment Status</th>
                                            <th>Sold Date</th>
                                            <th>Payment Date</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
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
@section('scripts')
<script type="text/javascript" src="{{ asset('js/influencer/sell-history.js') }}"></script>
@stop

