@extends('layouts.influencer')


@section('content')
<div class="app-content content">
    <div class="ecommerce-cart content-head-image shopping-cart">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Your selected list</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                {{-- <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li> --}}
                                <li class="breadcrumb-item active">
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @if($selected_list->count() == 0 )
                            <div class="d-flex align-items-center flex-column justify-content-center">
                                <img src="{{ asset('images/admin/empty.png') }}" alt="empty">
                                <div class="pt-2">
                                    <h3>You haven't liked any products yet</h3>
                                </div>
                            </div>
                            @else
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Details</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($selected_list as $selected)
                                        @php
                                        if (Auth::user()->user_type == 'influencer') {
                                        $refUrl = route('product_detail', make_slug($selected->getProduct->name) . '-' .
                                        $selected->getProduct->id) . '?ref=' . $influencer_id;
                                        }
                                        @endphp
                                        <tr class="selected" data-href="{{ $refUrl }}">
                                            <td>
                                                <div class="product-img d-flex align-items-center">
                                                    <img class="img-fluid"
                                                        src="{{ $selected->getProduct->getMainImg()->first()->url }}"
                                                        alt="{{ $selected->getProduct->name }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product-title">{{ $selected->getProduct->name }}</div>
                                                <div class="product-size"><strong>ID: </strong>
                                                    {{ $selected->getProduct->id }}</div>
                                                <small
                                                    class="product-color w-50">{{ $selected->getProduct->description }}</small>
                                            </td>
                                            <td>
                                                <div class="total-price">
                                                    {{ number_format($selected->getProduct->price) }} VND</div>
                                            </td>
                                            <td>
                                                <div
                                                    class="product-action d-flex justify-content-start align-items-center">
                                                    <div
                                                        class="btn btn-social-icon mr-1 mb-1 btn-pinterest pointer btn-xs">
                                                        <i class="product-heart la la-remove" data-toggle="tooltip"
                                                            data-placement="top" title="" data-title="Remove product"
                                                            data-name="{{ $selected->getProduct->name }}"
                                                            data-product="{{ $selected->getProduct->id }}"></i>
                                                    </div>
                                                    <div data-toggle="modal" data-target="#modalPost"
                                                        class="ref-link btn btn-social-icon mr-1 mb-1 btn-facebook pointer btn-xs"
                                                        data-url="{{ $refUrl }}">
                                                        <i class="ft-share-2" data-toggle="tooltip" data-placement="top"
                                                            title="" data-title="Click here to share"></i>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
$(document).ready(function() {
    $('tr').on('click', function () {
        window.location = $(this).data("href");
    });
});
</script>
@endsection