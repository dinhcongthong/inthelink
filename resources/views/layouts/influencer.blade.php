<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>INTHELINK</title>
    <link rel="apple-touch-icon" href="{{ asset('images/new/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/small-logo.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/nouislider.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/jquery.rateyo.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/jquery.bootstrap-touchspin.css')}}">
    
    <!-- END: Vendor CSS-->
    
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/material-colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/vertical-menu-modern.css') }}">
    <!-- END: Theme CSS-->
    
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/material-vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/ecommerce-shop.css') }}">
    <!-- END: Page CSS-->
    
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/overview/dragdrop.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/overview/style.css') }}">
    <!-- END: Custom CSS-->
    
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu material-vertical-layout material-layout 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-primary navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    {{-- <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li> --}}
                    <li class="nav-item mr-auto">
                        {{-- <a class="mb-0 nav-brand align-items-center name-expand mr-auto" href="index.html">IN THE&nbsp;<span>LINK</span>
                        </a> --}}
                        <a href="#" class="align-items-center h-100 navbar-brand waves-effect waves-dark p-0">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="logo brand" width="140">
                        </a>
                        <a class="name-mobile text-center"><img src="{{ asset('images/logo/small-logo.png') }}" alt="logo brand" width="30"></a>
                    </li>
                    <li class="nav-item d-md-none dropdown dropdown-user ml-auto">
                        <a class="dropdown-toggle nav-link dropdown-user-link d-flex align-items-center" href="#" data-toggle="dropdown">
                            <span class="mr-1 user-name text-bold-700">{{ optional(Auth::user())->user_name }}</span>
                            <span class="avatar avatar-online">
                                <img src="{{ optional(Auth::user()->getAvatar)->url ?? asset('images/overview/user-no-avatar.png') }}" alt="avatar"><i></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-avatar">
                            @auth
                            <a class="dropdown-item" href="{{ url('/logout') }}"><i class="ft-power"></i> Logout</a>
                            @else 
                            <a class="dropdown-item" href="{{ route('register') }}"><i class="ft-power"></i> Sign up</a>
                            <a class="dropdown-item" href="{{ route('login') }}"><i class="ft-power"></i> Login</a>
                            @endauth
                        </div>
                    </li>
                </ul>
            </div>
            <div class="navbar-container">
                <div class="collapse navbar-collapse" >
                    <ul class="nav navbar-nav w-100">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle waves-effect waves-dark is-active" href="#"><i class="ft-menu"></i></a></li>
                        <li class="dropdown dropdown-user nav-item ml-auto">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="mr-1 user-name text-bold-700">{{ optional(Auth::user())->user_name }}</span>
                                <span class="avatar avatar-online">
                                    <img src="{{ optional(Auth::user()->getAvatar)->url ?? asset('images/overview/user-no-avatar.png') }}" alt="avatar"><i></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-avatar">
                                @auth
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i class="ft-power"></i> Logout</a>
                                @else 
                                <a class="dropdown-item" href="{{ route('register') }}"><i class="ft-power"></i> Sign up</a>
                                <a class="dropdown-item" href="{{ route('login') }}"><i class="ft-power"></i> Login</a>
                                @endauth
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->
    
    <!-- BEGIN: Main Menu-->
    <div class="main-menu material-menu menu-fixed menu-light menu-accordion menu-expand">
        <div class="user-profile">
            <div class="user-info text-center pt-1 pb-1"><img class="user-img img-fluid rounded-circle border-0" src="{{ optional(Auth::user()->getAvatar)->url ?? asset('images/overview/user-no-avatar.png') }}" alt="avatar" style="object-fit:contain; height: 60px;">
                <div class="name-wrapper d-block ">
                    <span class="white user-name">{{ Auth::user()->user_name }}</span>
                    <div class="text-light">Influencer - {{ Auth::user()->id }}</div>
                </div>
            </div>
        </div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ $segment2 == 'products' || $segment1 == 'products' ? 'active' : '' }}"><a href="{{ route('influencer.products') }}"><i class="la la-th-large"></i><span class="menu-title" data-i18n="">Products</span></a>
                </li>
                <li class="{{ $segment2 == 'selected-list' ? 'active' : '' }}"><a href="{{ route('influencer.get_selected') }}"><i class="la la-heart"></i><span class="menu-title" data-i18n="">Selected</span></a>
                </li>
                <li class="{{ $segment2 == 'sell-history' ? 'active' : '' }}"><a href="{{ route('influencer.sell_history') }}"><i class="la la-list"></i><span class="menu-title" data-i18n="">Sell History</span></a>
                </li>
                <li class="{{ $segment2 == 'profile' ? 'active' : '' }}"><a href="{{ route('influencer.get_profile') }}"><i class="la la-user"></i><span class="menu-title" data-i18n="">Profile</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->
    
    {{-- content --}}
    <div class="alert-group"></div>
    @yield('content')
    
    {{-- modal --}}
    <div>
        <div class="modal fade text-left" id="modalPost">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2"><i class="la la-road2"></i>Share Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <h5 class="mb-1"><i class="la la-arrow-right"></i>Copy and paste your personal url</h5>
                        <input type="text" readonly id="ref-link-text">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-primary" onclick="copyToClipboard(this)" onmouseout="removeCopy(this)">
                            Copy
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<div class="overlay-loading justify-content-center align-items-center" id="loader-spinner">
    <div class="loader-wrapper">
        <div class="loader-container">
            <div class="folding-cube loader-blue-grey text-white">
                <div class="cube1 cube"></div>
                <div class="cube2 cube"></div>
                <div class="cube4 cube"></div>
                <div class="cube3 cube"></div>
            </div>
            <p class="text-white mt-3">Please wait...</p>
        </div>
    </div>
    
</div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 
            <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">
                INTHELINK
            </a>
        </span>
    </p>
</footer>
<!-- END: Footer-->

{{-- footer in mobile --}}
<div class="footer-mobile d-block d-md-none">
    <div class="d-flex">
        <a href="{{ route('influencer.products') }}" class="btn btn-float btn-cyan {{ Request()->segment(2) == 'products' ? 'active' : '' }}">
            <i class="la la-th-large"></i>
            <span>Products</span>
        </a>
        <a href="{{ route('influencer.get_selected') }}" class="btn btn-float btn-cyan {{ Request()->segment(2) == 'selected-list' ? 'active' : '' }}">
            <i class="la la-heart"></i>
            <span>Selected</span>
        </a>
        <a href="{{ route('influencer.sell_history') }}" class="btn btn-float btn-cyan {{ Request()->segment(2) == 'sell-history' ? 'active' : '' }}">
            <i class="la la-list"></i>
            <span>Sell History</span>
        </a>
        <a href="{{ route('influencer.get_profile') }}" class="btn btn-float btn-cyan {{ Request()->segment(2) == 'profile' ? 'active' : '' }}">
            <i class="la la-user"></i>
            <span>Profile</span>
        </a>
    </div>
</div>

<script>var baseUrl = '{{ url('/') }}';</script>

<!-- BEGIN: Vendor JS-->
<script src="{{ asset('vendors/js/material-vendors.min.js') }}"></script>
<script src="{{ asset('vendors/js/jquery.raty.js') }}"></script>
<script src="{{ asset('vendors/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/js/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('vendors/js/daterangepicker.js')}}"></script>
{{-- <script src="{{ asset('vendors/js/jquery.cookie.js') }}"></script> --}}
<script src="{{ asset('vendors/js/moment.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{  asset('js/home/app-menu.min.js') }}"></script>
<script src="{{  asset('js/home/app.min.js') }}"></script>
<!-- END: Theme JS-->
{{-- common --}}
<script src="{{ asset('js/common.js')}}"></script>

{{-- call js file follow user type --}}
@auth
<script src="{{ asset('js/' . Auth::user()->user_type . '/main.js') }}"></script>
@endauth
<!-- BEGIN: Page JS-->
@yield('scripts')
{{-- <script src="{{'js/content-panel-sidebar.js'}}"></script>
<script src="{{'js/ecommerce-product-shop.js'}}"></script> --}}
<!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>