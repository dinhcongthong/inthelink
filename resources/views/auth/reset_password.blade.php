
@extends('layouts.home')
@section('content')

<div class="app-content content d-flex align-items-center">
    <div class="content-wrapper  w-100">
        <div class="content-header row mb-1">
        </div>
        <div class="content-body">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                        <div class="card-header border-0 pb-0">
                            <div class="card-title text-center">
                                <img src="{{ asset('images/logo/logo.png') }}" class="my-1" width="200" alt="branding logo">
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Please fill your new password</span></h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="form" action="{{ route('post_reset_password') }}" method="post">
                                    @csrf
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control pass" placeholder="Fill your new address" name="password" >
                                        <div class="form-control-position">
                                            <i class="ft-lock"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control pass" placeholder="Re-enter your new address" name="re_password" >
                                        <div class="form-control-position">
                                            <i class="ft-lock"></i>
                                        </div>
                                    </fieldset>
                                    <input type="hidden" name="token_reset" value="{{ $segment2 }}">
                                    <button type="submit" class="btn btn-outline-info btn-lg btn-block submit"><i class="ft-unlock"></i>Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop