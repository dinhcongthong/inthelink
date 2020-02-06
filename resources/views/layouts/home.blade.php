<!doctype html>
<html lang="{{ app()->getLocale() }}">
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
    
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/components.css') }}">
    <!-- END: Vendor CSS-->
    
    <!-- BEGIN: Theme CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/colors.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/template/palette-gradient.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/slick.css') }}">
    <!-- END: Theme CSS-->
    
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home/style.css') }}">
    <!-- END: Custom CSS-->
    
</head>
<!-- END: Head-->
<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    @yield('content')
    <div class="modal fade" id="modalSigninNotice">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <i class="fas fa-info-circle fa-5x d-block text-center m-4"></i>
                    <b class="text-center">
                        <h4>
                            You have to sign in before redirect to this page
                        </h4>
                    </b>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
    
    <script src="{{ asset('vendors/js/material-vendors.min.js') }}"></script>
    <script src="{{ asset('vendors/js/slick.min.js') }}"></script>
    <script src="{{ asset('vendors/js/daterangepicker.js') }}"></script>
    
    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="{{ asset('vendors/js/ui/jquery.sticky.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendors/js/forms/tags/form-field.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->
    
    <!-- BEGIN: Theme JS-->
    {{-- <script src="{{ asset('js/core/app-menu.js') }}"></script>
    <script src="{{ asset('js/core/app.js') }}"></script> --}}
    <!-- END: Theme JS-->
    
    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('js/scripts/pages/material-app.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/scripts/forms/custom-file-input.js') }}"></script> --}}
    <!-- END: Page JS-->
    
    <script src="{{ asset('js/common.js')}}"></script>
    @yield('scripts')
    <script>
        $('.mobile__footer a').on('click', function () {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function () {
                    window.location.hash = hash;
                });
            }
        });
        $('.mobile__slick').slick({
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear'
        });
        $('.slick').slick({
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear'
        });
        $('.slick , .mobile__slick').on('beforeChange', function (e, slick, currentSlide, nextSlide) {
            $('.step-progress-count').html(`${Number(nextSlide) + 1 < 10 ? '0'+ (Number(nextSlide)+1) : Number(nextSlide)+1 } / ${Number(slick.slideCount) < 10 ? '0'+ (Number(slick.slideCount)) : Number(slick.slideCount) }`);
            for (let i = 0; i < nextSlide; i++) {
                $($('li[role="presentation"]')[i]).addClass('white');
            }
            for (let i = nextSlide + 1; i <= slick.slideCount; i++) {
                $($('li[role="presentation"]')[i]).removeClass('white');
                
            }
            if (nextSlide == 1) {
                $('.home , .mobile').css('background-image', 'url("images/home/Map.svg")');
            } else {
                $('.home , .mobile').css('background-image', 'unset');
            }
            
        });
    </script>
</body>
</html>
