@extends('layouts.customer')


@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Product Detail</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            @if (!is_null($article->getParent))
                            <li class="breadcrumb-item text-dard">{{ $article->getCategory->getParent->name }}</li>
                            @else
                            <li class="breadcrumb-item text-dark">{{ $article->getCategory->name }}</li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">{{ $article->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="col-12 alert alert-danger">
                <ul class="m-0">
                    <li>{{ $error }}</li>
                </ul>
            </div>
            @endforeach
            @endif
        </div>
        <div class="content-body">
            <div class="product-detail">
                <div class="card">
                    <div class="card-body">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-sm-4">
                                    {{-- <div class="badge badge-success round">
                                        -50%
                                    </div> --}}
                                    <div class="image-group">
                                        <div id="product-images" class="carousel slide h-100" data-ride="carousel">
                                            <!-- Indicators -->
                                            @if($article->getImgs->count() != 1)
                                            <ul class="carousel-indicators h-100">
                                                @foreach ($article->getImgs as $key => $item)
                                                <li data-target="#product-images" data-slide-to="{{ $key }}"
                                                    class="{{ $item->target_type == 0 ? 'active' : '' }}"></li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            <!-- The slideshow -->
                                            <div class="carousel-inner w-100 d-flex align-items-center"
                                                style="height:300px">
                                                @foreach ($article->getImgs as $key => $item)
                                                <div
                                                    class="carousel-item {{ $item->target_type == 0 ? 'active' : '' }}">
                                                    <img src="{{ $item->url }}" alt="product" class="m-auto d-block">
                                                </div>
                                                @endforeach
                                            </div>

                                            <!-- Left and right controls -->
                                            @if($article->getImgs->count() != 1)
                                            <a class="carousel-control-prev" href="#product-images" data-slide="prev">
                                                <span>
                                                    <i class="la la-arrow-circle-left"></i>
                                                </span>
                                            </a>
                                            <a class="carousel-control-next" href="#product-images" data-slide="next">
                                                <span>
                                                    <i class="la la-arrow-circle-right"></i>
                                                </span>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8 mt-2 mt-sm-0">
                                    <div class="title-area clearfix">
                                        <h2 class="product-title float-left">
                                            {{ $article->name }}
                                        </h2>
                                        <div class="stars d-flex float-right">
                                            <span data-stars="{{ $article->starNumber}}"></span>
                                            <div id="info-rate">
                                            </div>
                                        </div>
                                        {{-- <span class="ratings float-right">
                                        </span> --}}
                                    </div>
                                    <div class="price-reviews clearfix">
                                        <span class="price-box">
                                            <span class="price h4">
                                                {{ number_format($article->price) }} VND
                                            </span>
                                            {{-- <span class="old-price h4">
                                                $500
                                            </span> --}}
                                        </span>
                                        <span class="float-right">
                                            ({{ $article->totalComment }} ratings)
                                        </span>
                                    </div>
                                    <!-- Product Information -->
                                    <div class="product-info">
                                        <p>
                                            {{ $article->description }}
                                        </p>
                                    </div>
                                    <!-- Product Information Ends-->
                                    <!-- Size Options Ends-->
                                    <div class="row no-gutters">
                                        <form class="w-100 d-flex"
                                            action="{{ Auth::check() ? route('customer.get_checkout') : route('login') }}"
                                            method="get">
                                            <div class="">
                                                <div class="product-count pr-1">
                                                    <div class="input-group">
                                                        <input name="quantity" min="1" class="count touchspin"
                                                            type="text" value="1">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="ref" value="{{ Request()->ref }}">
                                                <input type="hidden" name="id" value="{{ $article->id }}">
                                            </div>
                                            <div class="d-flex flex-wrap justify-content-center">
                                                <button class="mr-1 btn btn-danger btn-sm h-100">
                                                    <i class="ft-shopping-cart mr-1"></i>
                                                    Buy now
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="product-tabs nav nav-tabs nav-underline no-hover-bg">
                                <li class="nav-item">
                                    <a aria-controls="desc" aria-expanded="true" class="nav-link active"
                                        data-toggle="tab" href="#desc" id="description">
                                        Description
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a aria-controls="ratings" aria-expanded="false" class="nav-link" data-toggle="tab"
                                        href="#ratings" id="review">
                                        Comments
                                    </a>
                                </li>
                            </ul>
                            <div class="product-content tab-content px-1 pt-1">
                                <div aria-expanded="true" aria-labelledby="description" class="tab-pane active"
                                    id="desc" role="tabpanel">
                                    <h2 class="my-1">
                                        {{ $article->name }}
                                    </h2>
                                    <p>{{ $article->description }}</p>
                                    <br>
                                    <h4 class="my-1">
                                        Special Features :
                                    </h4>
                                    <div>
                                        <div>Brand: {{ $article->brand }}</div><br>
                                        <div>Weight: {{ $article->weight }} cm </div><br>
                                        <div>Length: {{ $article->length }} cm </div><br>
                                        <div>Height: {{ $article->height }} cm </div><br>
                                        <div>Width: {{ $article->width }} cm </div>
                                    </div>
                                    <br>
                                </div>
                                <div aria-labelledby="review" class="tab-pane" id="ratings">
                                    <h2 class="my-1">
                                        Customer Rating & Review
                                    </h2>
                                    <div class="media-list media-bordered">
                                    @forelse ($article->getEvaluations as $item)
                                    @if ($loop->index < 2)
                                    <div class="media">
                                        <span class="media-left m-auto">
                                            <img alt="users" class="media-object"
                                                src="{{ optional($item->getUser->getAvatar)->url ?? asset('images/overview/user-no-avatar.png') }}"
                                                style="width: 64px;height: 64px;" />
                                        </span>
                                        <div class="media-body">
                                            <div class="rate float-right">
                                                <div class="desc--rate pt-2 pb-2"></div>
                                            </div>
                                            <span class="rated" data-rated="{{ $item->stars_number }}"></span>

                                            <h5 class="media-heading mb-0 text-bold-600">
                                                {{ $item->getUser->user_name }}
                                            </h5>
                                            <div class="media-notation mb-1">
                                                {{ $item->updated_at->format('Y-m-d') }}
                                            </div>
                                            {!! $item->content !!}
                                        </div>
                                    </div>
                                    @endif
                                    @empty
                                    <p>There are no reviews</p>
                                    @endforelse
                                </div>
                                @if ($article->get_evaluations_count >= 2)
                                <div class="text-center">
                                    <a class="text-warning" id="load_more">Load more ...</a>
                                    <div class="spinner-border text-warning spinner-loading d-none" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="{{ asset('js/home/product_detail.js') }}"></script>
@endsection