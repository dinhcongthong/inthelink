<!doctype html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>INTHELINK</title>
    <link rel="apple-touch-icon" href="{{ asset('images/new/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/small-logo.png') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/nouislider.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/jquery.rateyo.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/jquery.bootstrap-touchspin.css')}}">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/material-colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/ecommerce-shop.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/overview/dragdrop.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/overview/style.css') }}">
    <!-- END: Custom CSS-->

</head>


<!-- BEGIN: Body-->

<body class="vertical-layout content-detached-left-sidebar" data-open="click" data-menu="vertical-menu-modern"
    data-col="content-detached-left-sidebar">
    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
        <div class="navbar-wrapper">
            @php
            $avatar_url = Auth::user() ? (optional(Auth::user()->getAvatar)->url ??
            asset('images/overview/user-no-avatar.png')) : asset('images/overview/user-no-avatar.png');
            @endphp
            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li class="nav-item mr-auto">
                        <a href="#" class="d-contents">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="logo brand" width="140">
                        </a>
                    </li>
                    <li class="nav-item d-lg-none dropdown">
                        <a class="nav-link d-flex align-items-center dropdown-toggle" href="#" id="userDropdown"
                            data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-1 user-name text-bold-700">{{ optional(Auth::user())->user_name }}</span>
                            <span class="avatar avatar-online">
                                <img src="{{ $avatar_url }}" alt="avatar">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-avatar dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ url('/logout') }}"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="navbar-container d-none d-lg-block" style="box-shadow: 0px 0 35px 0px #dfdfdf73">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link dropdown-user-link" href="#" id="userDropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-1 user-name text-bold-700">
                                    {{ optional(Auth::user())->user_name }}
                                </span>
                                <span class="avatar avatar-online">
                                    <img src="{{ $avatar_url }}" alt="avatar">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-avatar" id="userDropdown" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="sticky-wrapper"
        class="w-100 header-navbar sticky-top navbar-expand-sm navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow navbar-brand-center"
        role="navigation" data-menu="menu-wrapper" data-nav="brand-center">
        <div class="w-100 navbar-container w-100" data-menu="menu-container">
            <ul class="nav navbar-nav w-100" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item active" data-menu="dropdown">
                    <a class=" nav-link text-white" href="{{ route('customer.ordered') }}">
                        <i class="la la-file"></i>
                        <span>Ordered</span>
                    </a>
                </li>
                <li class=" nav-item" data-menu="dropdown">
                    <a class=" nav-link text-white" href="{{ route('customer.get_profile') }}">
                        <i class="ft-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class=" nav-item active" data-menu="dropdown">
                    <a class=" nav-link text-white" href="{{ route('customer.get_addresses') }}">
                        <i class="la la-map-marker"></i>
                        <span>Addresses</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Header-->

    {{-- content --}}
    <div class="alert-group"></div>
    @yield('content')

    {{-- modal --}}
    <div>
        <div class="modal fade" id="modalCredit">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <b>
                            Credit card
                        </b>
                        <form>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Credit:</label>
                                <div class="col-9">
                                    <input type="text" readonly class="form-control-plaintext" value="Vietcombank">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Account No:</label>
                                <div class="col-9">
                                    <input type="text" readonly class="form-control-plaintext" style="font-size:14px"
                                        value="******* 120">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Region:</label>
                                <div class="col-9">
                                    <input type="text" readonly class="form-control-plaintext" value="District 3">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
        <div class="modal fade" id="modalAddCredit">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p class="head">
                            Add credit card
                        </p>
                        <form id="formAddCredit">
                            <div class="input-wrap">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Name's card" name="name_card">
                            </div>
                            <div :class="{ 'invalid-feedback d-block' : $v.name_card.$error }" class="d-none">
                                Name's card is required
                            </div>
                            <div class="d-flex flex-wrap">
                                <div class="input-wrap d-flex flex-wrap w-100">
                                    <input type="number" placeholder="Number's card" name="number_card">
                                    <div class="d-flex card__category mt-2 mb-2">
                                        <img src="{{asset('images/customer/mastercard.png')}}" alt="mastercard">
                                        <img src="{{asset('images/customer/jcb.png')}}" alt="jcb">
                                        <img src="{{asset('images/customer/visa-2.png')}}" alt="visa">
                                    </div>
                                </div>
                                <div :class="{ 'invalid-feedback d-block' : $v.number_card.$error }" class="d-none">
                                    Number's card is required
                                </div>
                            </div>
                            <div class="d-flex select-group d-flex flex-wrap ">
                                <div class="col-12 col-lg-4 p-0 ">
                                    <div class="select-wrap ">
                                        <select class="form-control">
                                            <option selected="" disabled="" hidden="" value="0">DD</option>
                                        </select>
                                        <i class="fas fa-chevron-down"></i>

                                    </div>
                                    <div :class="{ 'invalid-feedback d-block ' : $v.date_card.$model == 0 && $v.date_card.$dirty==true }"
                                        class="d-none">Date is required
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 p-0 pl-lg-2 pr-lg-2">
                                    <div class="select-wrap ">
                                        <select class="form-control">
                                            <option selected="" disabled="" hidden="" value="0">MM</option>
                                        </select>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div :class="{ 'invalid-feedback d-block ' : $v.month_card.$model == 0 && $v.month_card.$dirty==true }"
                                        class="d-none">Month is required
                                    </div>
                                </div>
                                <div class=" col-12 col-lg-4 p-0">
                                    <div class="select-wrap">

                                        <select class="form-control" name="year">
                                            <option selected disabled hidden value="0">YYYY</option>
                                        </select>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div :class="{ 'invalid-feedback d-block ' : $v.year_card.$model == 0 && $v.year_card.$dirty==true }"
                                        class="d-none">Year is required
                                    </div>
                                </div>
                            </div>
                            <div class="input-wrap">
                                <input type="text" placeholder="Bill address" name="bill_card">
                            </div>
                            <div :class="{ 'invalid-feedback d-block ' : $v.bill_card.$model == 0 && $v.bill_card.$dirty==true }"
                                class="d-none">Bill's address is required
                            </div>
                            <h5>We work with CyberSouce, a VISA organization, to ensure that your Credit / Debit
                                card information is safe and secure</h5>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning"
                            @click.prevent="submit($v,$event,'#formAddCredit', arr2)">Next</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalSignin">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content sign__content">
                    <!-- Modal body -->
                    <form>
                        <p class="title">
                            Sign in
                        </p>
                        <div class="input-wrap">
                            <i class="fas fa-user"></i>
                            <input type="text" class="name" placeholder="Please enter account name">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="input-wrap">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="pass">
                            <i class="fas fa-check"></i>
                        </div>

                        <div class="d-flex sign__sub">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember" name="">
                                <label class="custom-control-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" data-target="#modalForgot" data-toggle="modal"
                                class="forget ml-auto text-right">Forget password?</a>
                        </div>
                        <button class="submit">Sign in</button>
                    </form>
                    <a data-target="#modalSignup" data-toggle="modal" class="signup">New to INTHELINK, Sign
                        up?</a>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalSignup">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content sign__content">
                    <!-- Modal body -->
                    <form>
                        <p class="title">
                            Sign up
                        </p>
                        <div class="input-wrap">
                            <i class="fas fa-user"></i>
                            <input type="text" class="name" placeholder="Please enter account name">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="input-wrap">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="pass">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="input-wrap">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="text" class="" placeholder="01000-0000-0">
                            <span class="verify-code">
                                Send verification code
                            </span>
                        </div>
                        <div class="input-wrap">
                            <input type="text" class="" placeholder="Confirm code">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="input-wrap">
                            <i class="fas fa-envelope"></i>
                            <input type="email">
                        </div>
                        <div class="term__agree">
                            <div class="custom-control custom-checkbox text-center">
                                <input type="checkbox" class="custom-control-input" id="agree" name="">
                                <label class="custom-control-label" for="agree">
                                    I have read the Privacy Policy and agree to the Terms of Service.
                                </label>
                            </div>
                        </div>
                        <button class="submit" data-toggle="modal" data-target="#modalSuccess">Sign up</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalForgot">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content sign__content">
                    <!-- Modal body -->
                    <form>
                        <p class="title">
                            Forgot password
                        </p>
                        <p class="text-center">Enter your email below to reset password.</p>
                        <div class="input-wrap">
                            <i class="fas fa-envelope"></i>
                            <input type="text" class="name" placeholder="mail@gmail.com">
                        </div>
                        <button data-toggle="modal" data-target="#modalSendSuccess" class="submit">Send</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalSendSuccess">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content sign__content">
                    <!-- Modal body -->
                    <form>
                        <p class="title-yellow">
                            Forgot password
                        </p>
                        <p class="text-center">
                            We have sent the reset link password to your email. Please check and reset your
                            password to login.
                        </p>
                        <button data-toggle="modal" class="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalSuccess">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content sign__content">
                    <!-- Modal body -->
                    <form>
                        <div class="success">
                            <i class="fas fa-check"></i>
                        </div>
                        <p class="title">
                            Congratulation
                            <br>Sign up successfully
                        </p>
                        <button data-toggle="modal" data-target="#modalSignin" class="submit">Continue
                            shopping</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019
                <a class="text-bold-800 grey darken-2" href="{{ url('/') }}" target="_blank">
                    INTHELINK
                </a>
            </span>
        </p>
    </footer>
    <!-- END: Footer-->
    <script>
        var baseUrl = '{{ url('/') }}';
    </script>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('vendors/js/jquery.raty.js') }}"></script>
    <script src="{{ asset('vendors/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/js/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('vendors/js/moment.min.js') }}"></script>
    {{-- <script src="{{ asset('vendors/js/jquery.treeview.js') }}"></script> --}}
    <script src="{{ asset('vendors/js/daterangepicker.js')}}"></script>

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

</html>