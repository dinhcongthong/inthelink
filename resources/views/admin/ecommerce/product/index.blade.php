@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        @if (Request()->success == 1)
        <div class="alert alert-success alert-dismissible fade show w-100" role="alert">Your product was updated
            successful!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Products</h3>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <a href="{{route('admin.ecommerce.product.get_update')}}" class="btn btn-primary m-tb-1">
                            Add product
                    </a>
                </div>
            </div>
        </div>
        <div class="category">
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <div class="page-content">
                            <div class="page-table--wrap">
                                <div class="page-tool d-flex justify-content-between flex-wrap mb-1">
                                    <div class="input-wrap right">
                                        <input name="search-table" class="form-control" type="text" placeholder="Search...">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="table_products" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Price(VND)</th>
                                                <th>Inthelink commission</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Updated At</th>
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
</div>
@stop
@section('datatables')
<script src="{{asset('js/admin/product.js')}}"></script>
@stop