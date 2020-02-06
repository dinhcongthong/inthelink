@extends('layouts.admin')
@section('content')
<!-- ecommerce/category/new/category 1/product -->
<div class="page-content">
    <div class="container-fluid detail ecommerce__product-create  ">
        <div class="row">
            <div class="col-12">
                <form action="" id="form_product">
                    <div class="form-section section-product">
                        <div class="form-group row d-flex flex-wrap">
                            <label class="col-md-2">Product name <span class="red">*</span></label>
                            <input type="text" class="form-control col-md-6 product-name" placeholder="">
                        </div>
                        <div class="form-group row mt-3 mb-2 d-flex flex-wrap">
                            <label class="col-md-2">Brand</label>
                            <input class="form-control col-md-6" readonly placeholder="Innisfree">
                        </div>
                        <div class="form-group row mt-3 mb-2 d-flex flex-wrap">
                            <label class="col-md-2">Root category</label>
                            <input class="form-control col-md-6" readonly placeholder="New">
                        </div>
                        <div class="form-group row mt-3 mb-2 d-flex flex-wrap">
                            <label class="col-md-2">Subcategory</label>
                            <input class="form-control col-md-6" readonly placeholder="Subcategory 1">
                        </div>
                        <div class="form-group row mt-3 mb-2 d-flex flex-wrap">
                            <div class="col-md-2">
                                <label class="">Media</label>
                            </div>
                            <div class="col-md-10 pt-3">
                                <div class="d-flex flex-wrap media-blocks">
                                    <div class="media-block">
                                        <div class="media-upload">
                                            <label for="cover-photo">
                                                <img src="{{ asset('images/seller/clipboard.png')}}" alt="plus">
                                            </label>
                                            <input type="file" id="cover-photo" class="d-none" name="cover_image">
                                        </div>
                                        <p class="text-center">(Cover photo)</p>
                                    </div>
                                    <div class="media-block">
                                        <div class="media-upload">
                                            <label for="video">
                                                <img src="{{ asset('images/seller/plus.png')}}" alt="plus">
                                                <video width="73" height="73" class="d-none">
                                                    <!-- <source src="{{asset('video/video.mp4')}}" alt="plus" type="video/mp4"> -->
                                                </video>
                                            </label>
                                            <input type="file" id="video" class="d-none" name="video">
                                        </div>
                                        <p class="text-center">(Video clip)</p>
                                    </div>
                                    <div class="media-block media-block-images">
                                        <div class="media-upload">
                                            <label for="image-multi">
                                                <img src="{{ asset ('images/seller/plus.png')}}" alt="plus">
                                            </label>
                                            <input type="file" id="image-multi" class="d-none" name="image[]" multiple>
                                        </div>
                                        <p class="text-center">(Add images)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-section section-seller">
                        <div class="row form-group d-flex flex-wrap">
                            <label class="col-md-2">Seller info</label>
                            <input type="text" class="form-control col-md-6" placeholder="">
                        </div>
                        <div class="row form-group d-flex flex-wrap">
                            <label class="col-md-2">Description</label>
                            <textarea class="form-control col-md-6" placeholder="" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-section section-info">
                        <div class="row form-group d-flex flex-wrap">
                            <label class="col-md-2">Price info(VND) &nbsp;<span class="red"> *</span></label>
                            <input type="text" class="form-control col-md-6" placeholder="">
                        </div>
                        <div class="form-head">
                            Delivery
                        </div>
                        <div class="row form-group d-flex flex-wrap">
                            <label class="col-md-2">Weight</label>
                            <input type="text" class="form-control col-md-6" placeholder="">
                        </div>
                        <div class="row d-flex flex-wrap">
                            <div class="col-md-4">
                                <div class="row form-group d-flex flex-wrap">
                                    <label class="col-md-6">Width(cm)</label>
                                    <input type="text" class="form-control col-md-6" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="row form-group d-flex flex-wrap">
                                    <label class="col-md-6">Long(cm)</label>
                                    <input type="text" class="form-control col-md-6" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="row form-group d-flex flex-wrap">
                                    <label class="col-md-6">Height(cm)</label>
                                    <input type="text" class="form-control col-md-6" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center">
                        <button class="mt-3 btn-gray mr-3">
                            Cancel
                        </button>
                        <button class="btn btn-next mr-3 submit_form">
                            Add product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</div>
@stop
@section('datatables')
<script src="{{asset('js/admin/product.js')}}"></script>
<script>
    $(document).ready(function() {
        var count = 1;
        $('body').on('change', 'input[type="file"]', function(e) {
            let self = this;
            if ($(this).attr('id') == 'video') {
                if ($(this)[0].files[0].type == 'video/mp4') {
                    $(this).prev().find('img').addClass('d-none');
                    $(this).prev().find('video').remove();
                    $(this).prev().append(`<video width="73" height="73"><source src="${URL.createObjectURL(this.files[0])}" alt="plus" type="video/mp4"></video>`);
                } else return;
            } else {
                if ($(this).attr('id') == 'cover-photo' && $(this)[0].files[0].type != 'video/mp4') {
                    $(this).prev().find('img').attr('src', URL.createObjectURL(this.files[0]));
                    $(this).prev().find('img').attr('style', 'width:100%;height:100%');
                } else {

                    $.each(this.files, function(i, e) {
                        if (e.type != 'video/mp4') {
                            $(`<div class="media-block">
                                    <div class="media-upload">
                                        <label for="image-${count}">
                                            <img src="{{asset('images/seller/plus.png')}}" class="image-${count}" alt="images">
                                            
                                        </label>
                                        <input type="file" id="image-${count}" class="d-none">
                                    </div>
                                    
                                    <p class="text-center">(Image ${count})</p>
                                </div>`).insertBefore($('.media-block-images'));
                            $(`img.image-${count}`).attr('src', URL.createObjectURL(self.files[i]));
                            $(`img.image-${count}`).attr('style', 'width:100%;height:100%');
                            count++;
                        }
                    })
                }
            }
        });
    });
</script>
@stop