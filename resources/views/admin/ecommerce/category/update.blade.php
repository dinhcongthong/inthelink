@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">{{ $category->id == '' ? 'Add New Category' : 'Edit Category'}}</h3>
            </div>
        </div>
        <div class="category">
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <div class="page-content tab-content">
                            <div class='tab-pane  page-info active' id="info">
                                <h4 class="main-blue mb-3">Category's Detail</h4>
                                <form action="{{ route('admin.ecommerce.category.post_update', $category->id ?? 0) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group row">
                                                <label for="cate-name" class="col-sm-4 col-form-label">Category name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name" id="cate-name"
                                                        value="{{ $category->name }}" placeholder="Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6 col-left">
                                            <div class="form-group row">
                                                <label for="cate-parent" class="col-sm-4 col-form-label">Parent Category</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="cate-show" name="parent_id">
                                                        <option value="">(none)</option>
                                                        @foreach ($parent_list as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $category->parent_id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cate-description" class="col-sm-4 col-form-label">Description</label>
                                                <div class="col-sm-8">
                                                    <textarea type="text" rows="5" name="description" class="form-control"
                                                        id="cate-description"
                                                        placeholder="Ex: Heath & Care is...">{{ $category->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6 col-right">
                                            <div class="form-group row">
                                                <label for="cate-show" class="col-sm-4 col-form-label">Is show</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="cate-show" name="show">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cate-id" class="col-sm-4 col-form-label">ID</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="id" value="{{ $category->id }}" placeholder="" readonly
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cate-time" class="col-sm-4 col-form-label">Update at</label>
                                                <div class="col-sm-8">
                                                    <div class="input-wrap right h-100">
                                                        <input type="text" name="date"
                                                            value="{{ $category->updated_at ? $category->updated_at->format('Y-m-d') : '' }}"
                                                            readonly class="form-control" disabled placeholder="Choose date">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row buttons-group justify-content-end mt-3">
                                        <button class="btn btn-gray my-1 mr-1">Cancel</button>
                                        <button class="btn btn-primary active my-1 mr-1" type="submit">Save changes</button>
                                    </div>
                                </form>
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