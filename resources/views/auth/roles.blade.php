@extends('layouts.home')


@section('content')

<div class="app-content roles content d-flex flex-column justify-content-center">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
        </div>
        <div class="content-body">
            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="text-center  align-items-center">
                    <img src="{{ asset('images/logo/logo.png') }}" class="my-1" width="200" alt="logo brand">
                    <input type="hidden" name="is_redirect" value="{{ Request()->session()->has('previous_url') ?? '' }}">
                    <div class="d-flex justify-content-center flex-wrap">
                        <div class="roles-block col-lg-4 d-flex flex-column">
                            <img src="{{asset('images/home/influencer.svg')}}" alt="influencer">
                            <a href="{{ $segment1 == 'register' ? route('register', 'influencer') : route('login') }}"
                                style="display:contents">
                                <button class="btn btn-warning btn-min-width box-shadow-2">I'm an influencer</button>
                            </a>
                            <p class="text-dark">
                                Influencers have the most authentic and active relationships with their fans. Brands are now recognizing and encouraging this.
                            </p>
                        </div>
                        <div class="roles-block col-lg-4 d-flex flex-column">
                            <img src="{{asset('images/home/customer.svg')}}" alt="customer">
                            <a href="{{ $segment1 == 'register' ? route('register', 'customer') : route('login') }}" style="display:contents">
                                <button class="btn btn-warning btn-min-width box-shadow-2">I'm an customer</button>
                            </a>
                            <p class="text-dark">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('scripts')
<script>
    $(document).ready(function(){
        generateDateSelectbox();
        
        //show modal notice when redirect to page
        if($('input[name="is_redirect"]').val()){
            $('#modalSigninNotice').modal('show');
            localStorage.setItem('is_redirect',true);
        }
    });
</script>
@stop