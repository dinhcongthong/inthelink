@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Sub Category</h3>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <a href="{{route('admin.ecommerce.category.get_update')}}" class="btn btn-primary m-tb-1">
                        New category
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
                                    <table id="table_category_sub" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Parent Name</th>
                                                <th>Is Show</th>
                                                <th>Update At</th>
                                                <th>Action</th>
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
<script type="text/javascript" src="{{asset('js/admin/category.js')}}"></script>
@endsection