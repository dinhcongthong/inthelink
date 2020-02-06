<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>In The Link</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/bootstrap.min.css')}}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/small-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css')}}">

</head>

<body style="margin:0">
    <div class="admin-front">
        <form action="{{ route('admin.post_login') }}" method="POST">
            @csrf
            <h1>Let’s get started Admin <br> In The Link</h1>
            @if($errors->any())
            <div class="form-group mb-1 alert alert-danger w-100">
                <ul class="m-0">
                    @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group mb-1">
                <label class="col-sm-4 col-form-label">Username</label>
                <div class="col-sm-12">
                    <div class="input-wrap">
                        <i class="ft-user"></i>
                        <input class="form-control" name="user_name" value="{{ old('user_name') ?? '' }}" type="text" placeholder="">
                    </div>
                </div>

            </div>
            <div class="form-group ">
                <label class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-12">
                    <div class="input-wrap">
                        <i class="ft-lock"></i>
                        <input class="form-control" name="password" type="password" placeholder="">
                    </div>
                </div>

            </div>
            <button class="btn btn-yellow" type="submit">Log in</button>
        </form>
    </div>
    <script src="{{ asset('vendors/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('vendors/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('vendors/js/popper.min.js')}}"></script>

</body>

</html>