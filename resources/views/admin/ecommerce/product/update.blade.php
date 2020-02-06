@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">{{ $product->id == '' ? 'Add New Product' : 'Edit Product'}}</h3>
            </div>
        </div>
        <div class="product-create">
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    @if ($errors->any())
                                    <div class="w-100 alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="m-0">
                                            @foreach ($errors->all() as $item)
                                            <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    
                                    <form action="{{ route('admin.ecommerce.product.post_update', $product->id) }}" id="form_product" method="POST" novalidate="" class="needs-validation" enctype="multipart/form-data" name="newpost">
                                        @csrf
                                        <div class="form-section section-product">
                                            <div class="form-group row d-flex flex-wrap">
                                                <label class="col-md-2">Product name <span class="red">*</span></label>
                                                <div class="col-md-6 p-0">
                                                    <input type="text" class="form-control product-name" value="{{ $product->name }}"
                                                    name="name" required>
                                                    <div class="invalid-feedback">Please fill product name</div>
                                                </div>
                                            </div>
                                            <div class="form-group row mt-3 mb-2 d-flex flex-wrap">
                                                <label class="col-md-2">Root category <span class="red">*</span></label>
                                                <div class="select-wrap col-md-6 p-0 has-validiation flex-wrap">
                                                    <select class="form-control w-100" name="category_id" id="cate" required>
                                                        <option value="">None</option>
                                                        @foreach ($category->where('parent_id', 0) as $item)
                                                        @if ($item->id == $product->category_id || (!is_null($product->getCategory) && optional($product->getCategory->getParent)->id == $item->id))
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                        @else 
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Error</div>
                                                </div>
                                            </div>
                                            <div class="form-group row mt-3 mb-2 d-flex flex-wrap">
                                                <label class="col-md-2">Subcategory</label>
                                                <div class="select-wrap col-md-6 p-0">
                                                    <select class="form-control" name="sub_category_id" id="sub-cate">
                                                        <option value="">none</option>
                                                        @foreach ($category->where('parent_id', '<>', 0) as $item)
                                                        <option value="{{ $item->id }}" {{ $product->category_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mt-3 mb-2 d-flex flex-wrap">
                                                <div class="col-md-2">
                                                    <label class="">Media <span class="red">*</span></label>
                                                </div>
                                                <div class="col-md-10 pt-3">
                                                    <div class="d-flex flex-wrap media-blocks">
                                                        @php
                                                        $img_main_url = asset('images/seller/plus.png');
                                                        $img_1 = asset('images/seller/plus.png');
                                                        $img_2 = asset('images/seller/plus.png');
                                                        $img_3 = asset('images/seller/plus.png');
                                                        if ($product->getImgs->count() > 0) {
                                                            foreach ($product->getImgs as $item) {
                                                                if ($item->target_type == 0) $img_main_url = $item->url;
                                                                if ($item->target_type == 1) $img_1 = $item->url;
                                                                if ($item->target_type == 2) $img_2 = $item->url;
                                                                if ($item->target_type == 3) $img_3 = $item->url;
                                                            }
                                                        }
                                                        @endphp
                                                        <div class="media-block">
                                                            <div class="media-upload">
                                                                <label for="image-0">
                                                                    <img src="{{ $img_main_url }}">
                                                                </label>
                                                                <input type="file" id="image-0" class="d-none" name="main_image">
                                                                <i class="la la-trash m-0" onclick="removeImage(this)"></i>
                                                            </div>
                                                            <p class="text-center text-truncate">(Main photo)</p>
                                                        </div>
                                                        <div class="media-block">
                                                            <div class="media-upload">
                                                                <label for="image-1">
                                                                    <img src="{{ $img_1 }}">
                                                                </label>
                                                                <input type="file" id="image-1" class="d-none" name="image1">
                                                                <i class="la la-trash m-0" onclick="removeImage(this)"></i>
                                                            </div>
                                                            <p class="text-center text-truncate">(Add image)</p>
                                                        </div>
                                                        <div class="media-block">
                                                            <div class="media-upload">
                                                                <label for="image-2">
                                                                    <img src="{{ $img_2 }}">
                                                                </label>
                                                                <input type="file" id="image-2" class="d-none" name="image2">
                                                                <i class="la la-trash m-0" onclick="removeImage(this)"></i>
                                                            </div>
                                                            <p class="text-center text-truncate">(Add image)</p>
                                                        </div>
                                                        <div class="media-block">
                                                            <div class="media-upload">
                                                                <label for="image-3">
                                                                    <img src="{{ $img_3 }}">
                                                                </label>
                                                                <input type="file" id="image-3" class="d-none" name="image3">
                                                                <i class="la la-trash m-0" onclick="removeImage(this)"></i>
                                                            </div>
                                                            <p class="text-center text-truncate">(Add image)</p>
                                                        </div>
                                                    </div>
                                                    <div class="invalid-feedback">Please choose main image for product</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-section section-seller">
                                            <div class="row form-group d-flex flex-wrap align-items-center">
                                                <label class="col-md-2">Seller info</label>
                                                <input type="text" value="{{ $product->seller_info }}" name="seller_info"
                                                class="form-control col-md-6">
                                            </div>
                                            <div class="row form-group d-flex flex-wrap align-items-center">
                                                <label class="col-md-2">Brand</label>
                                                <input type="text" value="{{ $product->brand }}" name="brand"
                                                class="form-control col-md-6">
                                            </div>
                                            <div class="row form-group d-flex flex-wrap align-items-center">
                                                <label class="col-md-2">Inthelink commission(%) <span class="red">*</span></label>
                                                <div class="col-md-6 p-0">
                                                    <input type="number" min="0" value="{{ $product->inthelink_commission ?? '5' }}" name="inthelink_commission"
                                                    class="form-control" placeholder="%" required>
                                                    <div class="invalid-feedback">Inthelink commission is required</div>
                                                </div>
                                            </div>
                                            <div class="row form-group d-flex flex-wrap align-items-center">
                                                <label class="col-md-2">Description <span class="red">*</span></label>
                                                <div class="col-md-6 p-0">
                                                    <textarea class="form-control" name="description"
                                                    rows="5" required>{{ $product->description }}</textarea>
                                                    <div class="invalid-feedback">Please fill description of product</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-section section-info">
                                            <div class="row form-group d-flex flex-wrap align-items-center">
                                                <label class="col-md-2">Price(VND) &nbsp;<span class="red"> *</span></label>
                                                <div class="col-md-6 p-0">
                                                    <input type="number" name="price" class="form-control"
                                                    value="{{ $product->price }}" required>
                                                    <div class="invalid-feedback">Price is required</div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-head">
                                                Product specifications
                                            </div>
                                            <div class="row form-group d-flex flex-wrap align-items-center">
                                                <label class="col-md-2">Weight(kg)</label>
                                                <input type="number" name="weight" class="form-control col-md-6"
                                                value="{{ $product->weight }}">
                                            </div>
                                            <div class="row d-flex flex-wrap">
                                                <div class="col-md-4">
                                                    <div class="row form-group d-flex flex-wrap align-items-center">
                                                        <label class="col-md-6">Width(cm)</label>
                                                        <input type="number" name="width" class="form-control col-md-6"
                                                        value="{{ $product->width }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group d-flex flex-wrap align-items-center">
                                                        <label class="col-md-6">Length(cm)</label>
                                                        <input type="number" name="length" class="form-control col-md-6"
                                                        value="{{ $product->length }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row form-group d-flex flex-wrap align-items-center">
                                                        <label class="col-md-6">Height(cm)</label>
                                                        <input type="number" min="0" name="height" class="form-control col-md-6"
                                                        value="{{ $product->height }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap justify-content-center">
                                            <a class="btn btn-cancel mr-3" href="{{ url()->previous() }}">Back</a>
                                            <button type="submit" class="btn btn-next mr-3 submit_form">Save</button>
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
</div>
@stop

@section('datatables')
<script src="{{asset('js/admin/product.js')}}"></script>
<script>
    function removeImage(el){
        $(el).closest('.media-upload').find('img').attr('src',baseUrl+'/images/seller/plus.png');
        $(el).closest('.media-upload').removeClass('has-image');
        $(el).closest('.media-upload').find('img').attr('alt','plus');
        $(el).closest('.media-upload').next().html('(Add image)');
        $(el).closest('.media-upload').find('input').val('');
    }
    $(document).ready(function() {
        $('body').on('change', 'input[type="file"]', function(e) {
            let self = this;
            let img = $(this).prev().find('img');
            let iconRemove = $(this).next();
            if(this.files[0].type.indexOf('image') != -1){
                $(self).prev().find('img').attr('src', URL.createObjectURL(self.files[0]));
                $(self).prev().next().next().removeClass('d-none');
                $(self).prev().parent().addClass('has-image');
                $(self).prev().parent().next().html(self.files[0].name);
            }
        });
        
        
        $('#form_product').on('submit', function(event) {
            if($('label[for="image-0"]').find('img').attr('alt') == 'plus'){
                event.preventDefault();
                $('label[for="image-0"]').closest('.media-blocks').next().css('display','block');
            }
            else{
                $('label[for="image-0"]').closest('.media-blocks').next().css('display','none');
            }
        });
    });
</script>
@stop