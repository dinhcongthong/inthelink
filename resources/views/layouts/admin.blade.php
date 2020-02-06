<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>INTHELINK</title>
    <link rel="apple-touch-icon" href="{{ asset('images/new/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/small-logo-white.png') }}">
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
    <link rel="stylesheet" href="{{ asset('vendors/css/daterange.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/slick.css')}}">
    
    
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/style.css') }}">
    <link rel="stylesheet" type="text/css" media="print" href="{{ asset('css/admin/print.css')}}">
    
    <!-- END: Custom CSS-->
    
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item mr-auto">
                        <a href="#" class="align-items-center h-100 d-flex navbar-brand waves-effect waves-dark p-0">
                            <img src="{{ asset('images/logo/logo-white.png') }}" alt="logo brand" width="140">
                        </a>
                        <a class="name-mobile text-center"><img src="{{ asset('images/logo/small-logo-white.png') }}" alt="logo brand" width="30"></a>
                    </li>
                    <li class="nav-item d-lg-none dropdown dropdown-user ml-auto">
                        <a class="dropdown-toggle nav-link dropdown-user-link d-flex align-items-center" href="#" data-toggle="dropdown">
                            <span class="mr-1 user-name text-bold-700">{{ Auth::user()->user_name }}</span>
                            <span class="avatar avatar-online">
                                <img src="{{ optional(Auth::user()->getAvatar)->url ?? asset('images/overview/user-no-avatar.png') }}" alt="avatar"><i></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-avatar">
                            <a class="dropdown-item" href="{{ url('logout') }}"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="dropdown dropdown-user nav-item ml-auto">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="user-name text-bold-700" style="margin:3px 10px">{{ Auth::user()->user_name }}</span>
                                <span class="avatar avatar-online">
                                    <img src="{{ optional(Auth::user()->getAvatar)->url ?? asset('images/overview/user-no-avatar.png') }}" alt="avatar" alt="avatar">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-avatar">
                                <a class="dropdown-item" href="{{ url('logout') }}"><i class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->
    
    <!-- END: Header-->
    
    <!-- BEGIN: Main Menu-->
    <div class="main-menu material-menu menu-fixed menu-dark menu-accordion menu-expand">
        <div class="main-menu-content" style="height: 100% !important">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    
                    <li class="nav-item has-sub {{ $segment2 == 'order' }}">
                        <a href="#">
                            <i class="la la-file-text"></i>
                            <span class="menu-title">Order Status</span>
                        </a>
                        <ul class="menu-content">
                            <li class=" {{ ($segment3 == 'status') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.order.index') }}"><i></i><span >Status</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-sub {{ $segment2 == 'payment' }}">
                        <a href="#">
                            <i class="la la-credit-card"></i>
                            <span class="menu-title">Payment</span>
                        </a>
                        <ul class="menu-content">
                            <li class=" {{ ($segment2 == 'payment' && $segment3 == 'influencer') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.payment.influencer') }}"><i></i><span >Influencer</span></a>
                            </li>
                            <li class=" {{ ($segment3 == 'revenue') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.payment.revenue') }}"><i></i><span >Revenue</span></a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item has-sub {{ $segment2 == 'ecommerce' }}">
                        <a href="#">
                            <i class="la la-shopping-cart"></i>
                            <span class="menu-title" data-i18n="">Ecommerce</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a class="menu-item" href="{{ route('admin.ecommerce.category.index') }}"><i></i><span >Category</span>
                                </a>
                                <ul class="menu-content">
                                    <li class=" {{ ($segment3 == 'category'  && Request()->segment(4) != 'sub') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.ecommerce.category.index') }}"><i></i><span>Parent Category</span></a>
                                    </li>
                                    <li class=" {{ ($segment3 == 'category' && Request()->segment(4) == 'sub' ) ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.ecommerce.category.sub') }}"><i></i><span>Sub Category</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class=" {{ ($segment3 == 'product') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.ecommerce.product.index')}}"><i></i><span>Product</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-sub {{ $segment2 == 'users' }}">
                        <a href="#">
                            <i class="la la-user"></i>
                            <span class="menu-title" data-i18n="">Users</span>
                        </a>
                        <ul class="menu-content">
                            <li class=" {{ ($segment2 == 'users' && $segment3 == 'influencer') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.users.influencer') }}"><i></i><span >Influencer</span></a>
                            </li>
                            <li class=" {{ ($segment3 == 'manage') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.users.manage_users')}}"><i></i><span>Manage Users</span></a>
                            </li>
                            <li class=" {{ ($segment3 == 'blocklist') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.users.block_list')}}"><i></i><span>Block List</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-sub {{ $segment2 == 'setting' }}">
                        <a href="#">
                            <i class="la la-globe"></i>
                            <span class="menu-title">Setting</span>
                        </a>
                        <ul class="menu-content">
                            <li class=" {{ ($segment3 == 'profile') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.setting.profile') }}"><i></i><span >My Profile</span></a>
                            </li>
                            <li class=" {{ ($segment3 == 'inthelink') ? 'active' : ''}}"><a class="menu-item" href="{{ route('admin.setting.inthelink') }}"><i></i><span >Company Profile</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
        </div>
    </div>
    <!-- END: Main Menu-->
    
    {{-- content --}}
    <div class="alert-group"></div>
    @yield('content')
    {{-- end content --}}
    
    {{-- modal --}}
    <div>
        <div class="modal fade" id="modalBlock">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <h5 class="text-center header">
                            Do you really want to block this account. They will not access to our system. Please choose a
                            reason
                        </h5>
                        <form>
                            <div class="alert alert-danger" style="display:none">
                                Please choose some reasons
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="damage" name="damage">
                                <label class="custom-control-label" for="damage">Influencer invalid</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="bad" name="bad">
                                <label class="custom-control-label" for="bad">Influencer isn't exist</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="others" name="others">
                                <label class="custom-control-label" for="others">Orthers</label>
                            </div>
                            <textarea placeholder="Describe your problems" rows="6" class="text-others" disabled></textarea>
                            <div class="button-group d-flex flex-wrap justify-content-center">
                                <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-yellow submit-block">Block</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modalPaymentComplete">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body p-5">
                        <h5 class="text-center header">
                            Do you really want to change this payment to completed? You will not be able to change back.
                        </h5>
                        <form>
                            <div class="button-group d-flex flex-wrap justify-content-center mt-4">
                                <button type="button" class="btn btn-gray m-1" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success btn-accept m-1">Accept</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modalLogout">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <h2>Log Out</h2>
                        <p>Do you really you want to log out?</p>
                        <div class="button-group d-flex flex-wrap justify-content-center">
                            <a href="{{ url('/logout') }}" class="d-contents">
                                <button type="button" class="btn btn-blue active">Yes</button>
                            </a>
                            <button type="button" class="btn btn-gray" data-dismiss="modal">Cancel</button>
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
    {{-- <div class="footer-mobile d-block d-md-none">
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
    </div> --}}
    
    
    <script>
        var baseUrl = '{{url('/')}}'
    </script>
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('vendors/js/material-vendors.min.js') }}"></script>
    <script src="{{ asset('vendors/js/jquery.raty.js') }}"></script>
    <script src="{{ asset('vendors/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/js/jquery.bootstrap-touchspin.js') }}"></script>
    {{-- <script src="{{ asset('vendors/js/jquery.cookie.js') }}"></script> --}}
    <script src="{{ asset('vendors/js/slick.min.js')}}"></script>
    <script src="{{ asset('vendors/js/moment.min.js')}}"></script>
    <script src="{{ asset('vendors/js/daterangepicker.js')}}"></script>
    <script src="{{ asset('vendors/js/dragdrop.js')}}"></script>
    <script src="{{ asset('vendors/js/bootstrap-dialog.min.js') }}"></script>
    <script src="{{ asset('vendors/js/moment.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->
    
    <!-- BEGIN: Theme JS-->
    <script src="{{  asset('js/home/app-menu.min.js') }}"></script>
    <script src="{{  asset('js/home/app.min.js') }}"></script>
    <!-- END: Theme JS-->
    {{-- common --}}
    <script src="{{ asset('js/common.js')}}"></script>
    @yield('datatables')
    @yield('scripts')
    
</body>

</html>