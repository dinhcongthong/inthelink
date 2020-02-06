@extends('layouts.home')
@section('content')

<div class="app-content content d-flex align-items-center">
    <div class="content-wrapper  w-100">
        <div class="content-header row mb-1">
        </div>
        <div class="content-body">
            <section>
                @if ($errors->any())
                <div class="col-6 offset-md-3 alert alert-danger text-center">
                    @foreach ($errors->all() as $item)
                    <p class="m-0">{{ $item }}</p>
                    @endforeach
                </div>
                @endif
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                            <div class="card-header border-0 pb-0">
                                <div class="card-title text-center">
                                    <img src="{{ asset('images/logo/logo.png') }}" class="my-1" width="200" alt="branding logo">
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>{{ session('sent') ?? 'We will send you a link to reset password.' }}</span></h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form-horizontal" id="form_check" action="{{ route('post_forgot') }}" method="POST">
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="email" class="form-control name" name="email" id="user-email" placeholder="Your Email Address" required="">
                                            <div class="form-control-position">
                                                <i class="ft-mail"></i>
                                            </div>
                                        </fieldset>
                                        <button type="submit" class="btn btn-outline-info btn-lg btn-block submit"><i class="ft-unlock"></i> Recover Password</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer border-0">
                                <p class="float-sm-left text-center"><a href="{{ route('login') }}" class="card-link">Login</a></p>
                                <p class="float-sm-right text-center">New to Inthelink? <a href="{{ route('register') }}" class="card-link">Create Account</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@stop