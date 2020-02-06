@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Product's Detail</h3>
            </div>
        </div>
        <div class="product-detail">
            @if (!is_null($product->deleted_at))
            <div class="product-warning">
                <i class="la la-exclamation-triangle"></i>
                <div class="">
                    <p>
                        You blocked this product at {{ $product->deleted_at->format('Y-m-d H:i:s') }}
                    </p>
                    <p class="mb-0">
                        The reason: The product is damage. This product could not be sold.
                    </p>
                </div>
            </div>
            @endif
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <div class="product-content container-fluid pt-5 pb-5">
                            <div class="row">
                                <div class="product-images d-flex m-auto col-lg-5">
                                    <div class="row w-100">
                                        <div class="d-flex flex-column col-12 col-lg-3">
                                            <img src="{{ $product->getMainImg()->first()->url }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class=" product-info col-lg-7">
                                    <div class="d-flex justify-content-between">
                                        <p class="product-head">{{ $product->name }}</p>
                                        <a href="{{ route('admin.ecommerce.product.get_update', ['id' => $product->id]) }}"
                                            data-toggle="tooltip" title="Edit">
                                            <i class="la la-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="product-cate">
                                        <label>Category: </label>
                                        <div>{{ $product->getCategory->name }}</div>
                                    </div>
                                    <div class="product-brand">
                                        <label>Brand: </label>
                                        <div>{{ $product->brand }}</div>
                                    </div>
                                    <div class="product-desc">
                                        <label>Description</label>
                                        <div>
                                            {{ $product->description }}
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <label>
                                            Price(VND):
                                        </label>
                                        <div>
                                            {{ number_format($product->price) }}
                                        </div>
                                    </div>
                                    <p class="product-head">
                                        Product specifications
                                    </p>
                                    <div class="product-weight">
                                        <label>Weight</label>
                                        <div>{{ number_format($product->weight) }} gram</div>
                                    </div>
                                    <div class="product-parcel">
                                        <label>Parcel size:</label>
                                        <div>W: {{ number_format($product->width) }} cm - L: {{ number_format($product->length) }} cm - H:
                                            {{ number_format($product->height) }} cm</div>
                                        </div>
                                    </div>
                                    
                                    <form class="button-groups d-flex flex-wrap w-100 justify-content-end"
                                    action="{{ route('admin.ecommerce.product.post_action', $product->id) }}" method="POST">
                                    <!-- show 1 of these 2 buttons -->
                                    @csrf
                                    @if (!is_null($product->deleted_at))
                                    <input type="hidden" name="action" value="1">
                                    <button class="btn btn-primary active mr-3 ">
                                        Re Active
                                    </button>
                                    @else
                                    <input type="hidden" name="action" value="0">
                                    <button class="btn btn-danger mr-3 ">
                                        Block
                                    </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div class="modal fade" id="modalBlock">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <h5 class="text-center header">Choose a reason to tell the seller that the product was blocked.</h5>
                <form action="{{ route('admin.ecommerce.product.post_action', $product->id) }}">
                    @csrf
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="damage" name="damage">
                        <label class="custom-control-label" for="damage">Damage product.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bad" name="bad">
                        <label class="custom-control-label" for="bad">The product is bad.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="others" name="others">
                        <label class="custom-control-label" for="others">Orthers</label>
                    </div>
                    <textarea placeholder="Describe your problems" rows="6"></textarea>
                    <div class="button-group d-flex flex-wrap justify-content-center">
                        <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-red">Block</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
@stop
@section('datatables')
<script src="{{asset('js/admin/product.js')}}"></script>
<script>
    $(document).ready(function() {
        // if ($('.page-content').find('.product-warning').length != 0) {
            //     $('#modalBlock').modal('show');
            // }
        })
    </script>
    @stop
    