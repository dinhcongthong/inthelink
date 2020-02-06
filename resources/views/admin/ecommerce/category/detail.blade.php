@extends('layouts.admin')
@section('content')
<div class="common-wrap ecommerce__category-index">
    <ul class="page-tabs d-flex justify-content-center nav nav-pills">
        <li class="nav-item">
            <button class="btn btn-blue " data-toggle="pill" href="#info">
                Category info
            </button>
        </li>
        <li class="nav-item">
            <button class="btn btn-blue active" data-toggle="pill" href="#sub">
                Subcategories
            </button>
        </li>
    </ul>
    <div class="page-content tab-content">
        <div class="page-table--wrap tab-pane active " id="sub">
            <div class="page-tool d-flex justify-content-between flex-wrap">
                <a href="{{ route('admin.ecommerce.category.get_update') }}" class="d-contents">
                    <button class="btn btn-white-yellow m-tb-1">New category</button>
                </a>
                <div class="input-wrap right m-tb-1">
                    <input name="search-table" class="form-control" type="text" placeholder="Search...">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="page-table table-responsive">
                <table id="table_category_index" class="table dataTable-wrap w-100">    
                    <thead>
                        <tr>
                            <th class="no-sort">#</th>
                            <th>ID</th>
                            <th>
                                Subcategory
                                <i class="fas fa-question-circle main-blue" data-toggle="tooltip"></i>
                            </th> 
                            <th>Products</th>
                            <th>Is Show</th>
                            <th>Update At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='tab-pane  page-info fade' id="info">
            <form action="{{ route('admin.ecommerce.category.post_update') }}">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group row">
                            <label for="cate-name" class="col-sm-4 col-form-label">Category name</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="cate-name" placeholder="New">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-6 col-left">
                        <div class="form-group row">
                            <label for="cate-parent" class="col-sm-4 col-form-label">Parent Category</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly id="cate-parent" placeholder="Health & Care">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cate-description" class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <textarea type="text" rows="5" class="form-control" id="cate-description" placeholder="Heath & Care is..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 col-right">
                        <div class="form-group row">
                            <label for="cate-show" class="col-sm-4 col-form-label">Is show</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="cate-show">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cate-id" class="col-sm-4 col-form-label">ID</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cate-time" class="col-sm-4 col-form-label">Update at</label>
                            <div class="col-sm-8">
                                <div class="input-wrap right h-100">
                                    <input type="text" name="date" readonly class="form-control" disabled placeholder="Choose date">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row buttons-group justify-content-end mt-3">
                    <button class="btn btn-gray">Cancel</button>
                    <button class="btn btn-blue active">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('datatables')
<script type="text/javascript" src="{{asset('js/admin/category.js')}}"></script>
@endsection
