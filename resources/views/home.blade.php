@extends('layouts.home')
@section('content')

<div id="web-vision" class="d-none d-md-block">
    <aside class="float-left">
        <div class="aside">
            <p class="title">IN THE</p>
            <ul>
                <li>
                    <a href="{{route('home')}}" class="active">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{route('home_influencer')}}">
                        Influencers
                    </a>
                </li>
                <li>
                    <a href="{{route('team')}}">
                        Our team
                    </a>
                </li>
            </ul>
        </div>
        <div class="d-flex flex-wrap social">
            <i class="fab fa-instagram"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-facebook-f"></i>
            <i class="far fa-envelope"></i>
        </div>
    </aside>

    <div class="container-fluid home d-none d-lg-block">
        <div class="home__nav d-flex justify-content-between">
            <p class="title">LINK</p>
            @if (!Auth::check())
            <div class="d-flex home__nav-sign">
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}" class="home__nav-signup">Sign up</a>
            </div>
            @else
            <div class="d-flex home__nav-sign">
                <a href="{{ url('logout') }}" class="home__nav-signup">Logout</a>
            </div>
            @endif
        </div>
        <div class="home__content slick">
            <div class=" home__1">
                <div class="row  w-100">
                    <div class="col-left  col-12 col-lg-6">
                        <h1>Influencer Commerce</h1>
                        <p>We enable influencers with millions of followers to sell products to their fans</p>
                        <a href="{{ route('register', 'influencer') }}">
                            <button class="button">Get started</button>
                        </a>
                    </div>
                    <div class="col-right  col-12 col-lg-6 p-0">
                        <img src="{{asset('images/home/plane.svg')}}" height="370" class="float-right" alt="plan">
                    </div>
                </div>
            </div>
            <div class="home__2 ">
                <div class="row  w-100">
                    <div class="col-left  col-12 col-lg-6">
                        <p class="sub">The future of commerce is social <br>and influencers hold the key</p>
                        <div class="progress-wrap">
                            <div class="d-flex justify-content-between">
                                <p>SOCIAL'S USERS</p>
                                <p>829,910 as 90%</p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar--su" role="progressbar" aria-valuenow="90"
                                    aria-valuemin="0" aria-valuemax="100" style="width:90%">
                                    <span class="sr-only">90% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="d-flex justify-content-between">
                                <p>INFLUENCERS are depended on consumers</p>
                                <p>293,792 as 56%</p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar--inf" role="progressbar" aria-valuenow="56"
                                    aria-valuemin="0" aria-valuemax="100" style="width:56%">
                                    <span class="sr-only">90% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="d-flex justify-content-between">
                                <p>CONSUMERS trust social media</p>
                                <p>98,321 as 74%</p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar--cons" role="progressbar" aria-valuenow="74"
                                    aria-valuemin="0" aria-valuemax="100" style="width:74%">
                                    <span class="sr-only">90% Complete</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('register', 'influencer') }}">
                            <button class="button" style="margin-top:63px">Get started</button>
                        </a>
                    </div>
                    <img src="{{asset('images/home/computer.png')}}" width="40%" class="float-right" alt="computer">
                </div>
            </div>
            <div class="home__3">
                <div class="row  w-100">
                    <div class="col-left  col-12">
                        <p class="sub">How it works</p>
                        <div class="d-flex home__3-wrap">
                            <div class="image-wrap d-flex">
                                <div class="circle">
                                    Our platform matches influencers to products
                                </div>
                                <img src="{{asset('images/home/phone1.png')}}" width="" alt="phone">
                            </div>
                            <div class="image-wrap d-flex step2">
                                <img src="{{asset('images/home/phone2.png')}}" width="" alt="phone">
                                <div class="circle">
                                    Influencers sell these products on social network.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="home__4">
                <div class="row  w-100">
                    <div class="col-left  col-12 col-lg-5">
                        <p class="sub">The future of business model is here</p>
                        <p>From factory to Instagram, we enable <br>brands to reduce costs and influencers to <br> work
                            with
                            the best products.</p>
                        <p class="sub sub-notneed">Not need to:</p>
                        <div class="d-flex">
                            <div class="icon-wrap mr-5">
                                <img src="{{asset('images/home/marketing.png')}}" class="d-block" alt="marketing icon">
                                <span>Marketing through Ads</span>
                            </div>
                            <div class="icon-wrap">
                                <img src="{{asset('images/home/store.png')}}" class="d-block ml-2" alt="store icon">
                                <span>Distribution through Retailers</span>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="image-right" src="{{asset('images/home/influ5.svg')}}" alt="influencers">
            </div>
            <div class="home__5">
                <div class="row  w-100">
                    <div class="col-left  col-12 col-lg-5">
                        <p class="sub">Why choose Us</p>
                        <p>With our proprietary technology and deep understanding of influencers, we are able to connect
                            the
                            best brands with the most suitable influencers</p>

                    </div>
                    <div class="col-right  col-12 col-lg-7">
                        <p class="w-50  m-auto text-center">Database of 200,000+ influencers with 10K to 10M
                            followers<br><span>Global</span></p>
                        <img src="{{asset('images/home/slide5.svg')}}" width="50%" class="d-block m-auto" alt="plan">
                        <div class="d-flex justify-content-between">
                            <p class="w-50 mt-0 text-center"><span class="mb-3">Performance - Driven</span>We reward
                                results
                                based on performance</p>
                            <p class="w-50 mt-0 text-center"><span class="mb-3">Al - Driven Matching</span>We match
                                influencers to the right products</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="step-progress-count">
            01 / 05
        </div>
    </div>

    <div class="container-fluid mobile p-0 d-block d-lg-none">
        <div class="mobile__nav d-flex justify-content-between" id="mobile__home">
            <p class="title mb-0 w-100 text-center">IN THE LINK</p>
            <a href="{{ route('login') }}"><img src="{{asset('images/home/menu_res.svg')}}" alt="sign"></a>
        </div>
        <div class="mobile__slick">
            <div class="item">
                <img src="{{asset('images/home/plane.svg')}}" alt="plane">
                <p class="mobile__slick-sub">We enable influencers with millions of followers to sell products to their
                    fans
                </p>
                <a href="{{ route('register') }}" class="d-contents"><button class="button">Join InTheLink</button></a>
            </div>
            <div class="item">
                <img src="{{asset('images/home/computer.png')}}" width="100%" alt="computer">
                <p class="mobile__slick-sub">The future of commerece is social and influencers hold the key</p>
                <a href="{{ route('register') }}" class="d-contents"><button class="button">Join InTheLink</button></a>
            </div>
            <div class="item">
                <img src="{{asset('images/home/phone-mobile.png')}}" alt="phone">
                <p class="mobile__slick-sub">Our platform matches influencers to products. Influencers sell these
                    products
                    and get a cut of sale</p>
                <a href="{{ route('register') }}" class="d-contents"><button class="button">Join InTheLink</button></a>
            </div>
            <div class="item">
                <img src="{{asset('images/home/influ5.svg')}}" alt="">
                <p class="mobile__slick-sub">The future of business model is here. From factory to Instagram, we enable
                    brands to reduce costs and influencers</p>
                <a href="{{ route('register') }}" class="d-contents"><button class="button">Join InTheLink</button></a>
            </div>
            <div class="item">
                <p class="w-50  m-auto text-center">Database of 200,000+ influencers with 10K to 10M
                    followers<br><span>Global</span></p>
                <img src="{{asset('images/home/slide5.svg')}}" style="height: 35vh" class="height-adjust d-block m-auto"
                    alt="plan">
                <div class="d-flex justify-content-between">
                    <p class="w-50 mt-0 text-center"><span class="mb-3">Performance - Driven</span>We reward results
                        based
                        on performance</p>
                    <p class="w-50 mt-0 text-center"><span class="mb-3">Al - Driven Matching</span>We match influencers
                        to
                        the right products</p>
                </div>
                <p class="mobile__slick-sub mt-3">With our proprietary technology and deep understanding of influencers,
                    we
                    are able to connect the best brands with the most</p>
                <a href="{{ route('register') }}" class="d-contents"><button class="button">Join InTheLink</button></a>
            </div>
        </div>
        <div class="moblie__hiw" id="moblie__hiw">
            <h3 class="mb-4">How it works?</h3>
            <div class="step">
                <p>Step 1</p>
                <img src="{{asset('images/home/iphone-1.png')}}" alt="phone">
                <p class="mt-3">Sign in or sign up for new account to connect with us with best benefit</p>
            </div>
            <div class="step">
                <p>Step 2</p>
                <img src="{{asset('images/home/iphone-2.png')}}" alt="phone">
                <p class="mt-3">
                    Choose products you want to sell from our wide catalog of
                    well-known and upcoming brands
                </p>
            </div>
            <div class="step">
                <p>Step 3</p>
                <img src="{{asset('images/home/iphone-3.png')}}" alt="phone">
                <p class="mt-3">
                    Promote them on your social media by sharing a personal discount code or affiliate link
                </p>
            </div>
            <div class="step">
                <p>Step 4</p>
                <img src="{{asset('images/home/iphone-4.png')}}" alt="phone">
                <p class="mt-3">
                    Earn a commission on each purchase and build a stable income as an influencer and content creator
                </p>
            </div>
            <button class="button">Join InTheLink</button>
        </div>
        <div class="mobile__team" id="mobile__team">
            <h3 class="mb-4">Our team</h3>
            <div class="mobile__team-all">
                <div class="mobile__team-item">
                    <img src="{{asset('images/home/vision.png')}}" alt="vision">
                    <h2>Our vision</h2>
                    <p>Moderate Intensity</p>
                </div>
                <div class="mobile__team-item">
                    <img src="{{asset('images/home/team.png')}}" alt="team">
                    <h2>Meditation</h2>
                    <p>Low Intensity</p>
                </div>
                <div class="mobile__team-item">
                    <img src="{{asset('images/home/team.png')}}" alt="team">
                    <h2>Weight Lifting</h2>
                    <p>High Intensity</p>
                </div>
            </div>
            <p class="mobile__team-text">
                Becoming one of the leading content producer.
                <br>
                <span class="d-block mt-3">With our team, our development service will be provided with high quality
                    service
                    with reasonable price as possible.</span>
            </p>
        </div>
        <div class="mobile__footer">
            <a href="#mobile__home">Home</a>
            <a href="#moblie__hiw">How it works</a>
            <a href="#mobile__team">Our team</a>
            <div class="d-flex flex-wrap mobile__footer-social">
                <i class="la la-instagram"></i>
                <i class="la la-twitter"></i>
                <i class="la la-facebook"></i>
                <i class="la la-envelope"></i>
            </div>
        </div>
    </div>
</div>

<div id="app-vision" class="row align-items-center d-md-none h-100" style="background: #53368D;">
    <div class="col-12 text-center">
        <img src="{{ asset('images/logo/logo.png') }}" alt="" class="img-fluid w-50">
    </div>
    <div class="col-12 position-relative" style="top: 13%; bottom:0;">
        <div class="row">
            @auth
            <div class="col-12 px-3">
                <a href="{{ url('logout') }}" class="btn btn-lg w-100" style="background: #FFFFFF; color:black;box-shadow: 0px 1px 2px #FFFFFF;">Logout</a>
            </div>
            @else
            <div class="col-12 px-3 py-1">
                <a href="{{ route('login') }}" class="btn btn-lg w-100" style="background: #FFFFFF; color:black;box-shadow: 0px 1px 2px #FFFFFF;">Login</a>
            </div>
            <div class="col-12 px-3 py-1 text-dark">
                <a href="{{ route('register') }}" class="btn btn-lg w-100" style="border-color:white; color:white;">Sign up</a>
            </div>
            @endauth
        </div>
    </div>
</div>
@stop