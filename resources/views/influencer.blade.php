@extends('layouts.home')


@section('content')
<aside class="float-left">
    <div class="aside">
        <p class="title">IN THE</p>
        <ul>
            <li>
                <a href="{{route('home')}}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{route('home_influencer')}}" class="active">
                    Influencers
                </a>
            </li>
            <li>
                <a  href="{{route('team')}}" >
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
        <div class="home__3 step1">
            <div class="row w-100 ">
                <div class="col-left  col-12 col-lg-5">
                    <p class="sub">Earn from your favorite brands</p>
                    <p>We enable influencers like you to sell products to your customer</p>
                    <a href="{{ route('register') }}">
                        <button class="button">Be a new INFLUENCERS</button>
                    </a>
                </div>
                <div class="col-mid  col-12 col-lg-4">
                    <img src="{{asset('images/home/iphone-1.png')}}" class="m-auto" width="210" alt="plan">
                </div>
                <div class="text-right col-right  col-12 col-lg-3">
                    <p class="step-desc">Step 1</p>
                    <p>Sign in or sign up for new account to connect with us with best benefit</p>
                </div>
            </div>
        </div>
        <div class="home__3 step2">
            <div class="row w-100">
                <div class="col-left  col-12 col-lg-4">
                    <p class="sub">Earn from your favorite brands</p>
                    <a href="{{ route('register') }}">
                        <button class="button">Be a new INFLUENCERS</button>
                    </a>
                </div>
                <div class="col-mid  col-12 col-lg-5">
                    <div class="image-wrap">
                        <p>Our products?</p>
                        <img src="{{asset('images/home/arrow1.svg')}}" alt="arrow">
                        <img src="{{asset('images/home/iphone-2.png')}}" class="phone d-block m-auto" width="210" alt="plan">
                        <img src="{{asset('images/home/arrow2.svg')}}" alt="arrow">
                        <p>This one?</p>
                    </div>
                </div>
                <div class="text-right col-right col-10 col-lg-3">
                    <p class="step-desc">Step 2</p>
                    <p>Choose products you want to sell from our wide catalog of well-known and upcoming brands</p>
                </div>
            </div>
        </div>
        <div class="home__3">
            <div class="row  w-100">
                <div class="col-left  col-12 col-lg-5">
                    <p class="sub">Earn from your favorite brands</p>
                    <p>We enable influencers like you to sell products to your customer</p>
                    <a href="signup/Influencer">
                        <button class="button">Be a new INFLUENCERS</button>
                    </a>
                </div>
                <div class="col-mid  col-12 col-lg-4">
                    <img src="{{asset('images/home/iphone-3.png')}}" class="m-auto" width="210" alt="plan">
                </div>
                <div class="text-right col-right  col-12 col-lg-3">
                    <p class="step-desc">Step 3</p>
                    <p>Promote them on your social media by sharing a personal discount code or affiliate link</p>
                </div>
            </div>
        </div>
        <div class="home__3">
            <div class="row  w-100">
                <div class="col-left  col-12 col-lg-5">
                    <p class="sub">Earn from your favorite brands</p>
                    <p>We enable influencers like you to sell products to your customer</p>
                    <a href="signup/Influencer">
                        <button class="button">Be a new INFLUENCERS</button>
                    </a>
                </div>
                <div class="col-mid  col-12 col-lg-4">
                    <img src="{{asset('images/home/iphone-4.png')}}" class="m-auto" width="210" alt="plan">
                </div>
                <div class="text-right col-right  col-12 col-lg-3">
                    <p class="step-desc">Step 4</p>
                    <p>Earn a commission on each purchase and build a stable income as an influencer and content creator</p>
                </div>
            </div>
        </div>
    </div>
    <div class="step-progress-count">
        01 / 04
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
            <p class="mobile__slick-sub">We enable influencers with millions of followers to sell products to their fans</p>
            <a href="{{ route('register') }}" class="d-contents"><button class="button">Join InTheLink</button></a>
        </div>
        <div class="item">
            <img src="{{asset('images/home/computer.png')}}" width="100%" alt="computer">
            <p class="mobile__slick-sub">The future of commerece is social and influencers hold the key</p>
            <a href="{{ route('register') }}" class="d-contents"><button class="button">Join InTheLink</button></a>
        </div>
        <div class="item">
            <img src="{{asset('images/home/phone-mobile.png')}}" alt="phone">
            <p class="mobile__slick-sub">Our platform matches influencers to products. Influencers sell these products and get a cut of sale</p>
            <a href="{{ route('register') }}" class="d-contents"><button class="button">Join InTheLink</button></a>
        </div>
        <div class="item">
            <img src="{{asset('images/home/influ5.svg')}}" alt="">
            <p class="mobile__slick-sub">The future of business model is here. From factory to Instagram, we enable brands to reduce costs and influencers</p>
            <a href="{{ route('register') }}" class="d-contents"><button class="button">Join InTheLink</button></a>
        </div>
        <div class="item">
            <p class="w-50  m-auto text-center">Database of 200,000+ influencers with 10K to 10M followers<br><span>Global</span></p>
            <img src="{{asset('images/home/slide5.svg')}}" style="height: 35vh" class="height-adjust d-block m-auto" alt="plan">
            <div class="d-flex justify-content-between">
                <p class="w-50 mt-0 text-center"><span class="mb-3">Performance - Driven</span>We reward results based on performance</p>
                <p class="w-50 mt-0 text-center"><span class="mb-3">Al - Driven Matching</span>We match influencers to the right products</p>
            </div>
            <p class="mobile__slick-sub mt-3">With our proprietary technology and deep understanding of influencers, we are able to connect the best brands with the most</p>
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
            <span class="d-block mt-3">With our team, our development service will be provided with high quality service with reasonable price as possible.</span>
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


@stop