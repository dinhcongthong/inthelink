@extends('layouts.influencer')


@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0 d-inline-block">Products</h3>
            </div>
        </div>
        
        <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content sidebar-shop">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="get">
                                <div class="search">
                                    <input id="basic-search" type="text" name="keyword" value="{{ Request()->keyword }}"
                                    placeholder="Search here..." class="basic-search">
                                    <i class="ficon ft-search"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="categories-list">
                                <div class="category-title pb-1">
                                    <h4 class="card-title mb-0">Categories</h4>
                                    <hr>
                                </div>
                                <div class="product-cat" id="categories">
                                    <ul class="product-category">
                                        <li class="open">
                                            <span class="{{ $category_selected == '' ? 'active' : '' }}">
                                                <a href="{{ route('influencer.products') }}">All</a>
                                            </span>
                                        </li>
                                        @foreach ($category_list as $cate)
                                        <li class="open">
                                            <span class="{{ $cate->name == $category_selected ? 'active' : '' }}">
                                                <a href="{{ route('influencer.products', 'category=' . make_slug($cate->name) . '-' . $cate->id) }}"
                                                    class="" data-name="{{ $cate->name }}">
                                                    {{ $cate->name }} ({{ $cate->parents_products_count ?? 0 }})
                                                </a>
                                            </span>
                                            <ul>
                                                @foreach ($cate->getChilds as $child)
                                                <li>
                                                    <span class="{{ $child->name == $category_selected ? 'active' : '' }}">
                                                        <a href="{{ route('influencer.products', 'category=' . make_slug($child->name) . '-' . $child->id) }}"
                                                            class="" data-name="{{ $child->name }}">
                                                            {{ $child->name }} ({{ $child->get_products_count }})
                                                        </a>
                                                    </span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- /Categories List -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-detached content-right">
            <div class="content-body">
                <div class="product-shop">
                    <div class="card">
                        <div class="card-body">
                            <span class="shop-title">{{ $category_selected ?? 'All' }}</span>
                            <span class="float-right">
                                {{ $product_list->total() }} results
                                <span class="result-text mr-1"> </span>
                            </span>
                        </div>
                    </div>
                    <div class="row match-height">
                        @foreach ($product_list as $product)
                        @php
                        if (Auth::user()->user_type == 'influencer') {
                            $refUrl = route('product_detail', make_slug($product->name) . '-' . $product->id) . '?ref=' . $influencer_id;
                        }
                        @endphp
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="{{ $refUrl }}">
                                            <div class="product-img d-flex align-items-center">
                                                <img class="img-fluid" src="{{ $product->getMainImg()->first()->url }}" alt="Card image cap">
                                            </div>
                                            <h4 class="product-title">{{ $product->name }}</h4>
                                            <div class="price-reviews">
                                                <span class="price-box">
                                                    <span class="price">{{ number_format($product->price)}} VND</span>
                                                </span>
                                                <span class="ratings float-right"></span>
                                            </div>
                                        </a>
                                        <div class="product-action d-flex justify-content-around">
                                            <a href="javascript:void(0)" class="text-dark w-100 text-center">
                                                <i class="product-heart {{ !is_null($product->product_selected) ? 'la la-heart' : 'ft-heart' }}"
                                                    data-product='{{$product->id}}' data-name='{{$product->name}}'></i>
                                                </a>
                                                <span class="saperator">|</span>
                                                <div data-toggle="modal" data-target="#modalPost" class="ref-link w-100 text-center pointer"
                                                data-url="{{ $refUrl }}"><i class="ft-share-2"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Click here to share"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="col-12">
                                <div class="card" style="">
                                    <div class="card-content">
                                        {{ $product_list->links() }}
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