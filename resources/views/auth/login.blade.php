@extends('layouts.home')
@section('content')

<div class="app-content content d-flex flex-column justify-content-center">
	<div class="content-wrapper">
		<div class="content-header row mb-1">
		</div>
		<div class="content-body">
			<section class="flexbox-container">
				<div class="col-12 d-flex align-items-center justify-content-center">
					<div class="col-lg-5 col-md-8 col-12 box-shadow-2 p-0">
						<div class="card border-grey border-lighten-3 px-1 py-1 m-0">
							<div class="card-header border-0">
								<div class="card-title text-center">
									<img src="{{ asset('images/logo/logo.png') }}" class="my-1" width="200" alt="branding logo">
								</div>
							</div>
							<div class="card-content">
								<div class="card-body">
									<form class="form-horizontal" id="form_login" action="{{ route('post_login') }}" method="POST">
										@csrf
										<div class="col-sm-12 p-0">
											@if ($errors->any())
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Error !</strong> 
												@foreach ($errors->all() as $item)
												{{ $item }}
												<br>
												@endforeach
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											@endif
										</div>
										@if (session()->has('status'))
										<div class="col-12">
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
												<strong>Message !</strong> {{ session('status') }}
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										</div>
										@endif
										<fieldset class="form-group position-relative has-icon-left">
											<input type="text" name="email" class="form-control name" placeholder="Your Email" required value="{{ old('email') ?? '' }}">
											<div class="form-control-position">
												<i class="ft-user"></i>
											</div>
										</fieldset>
										<fieldset class="form-group position-relative has-icon-left">
											<input type="password" name="pass" class="form-control pass" id="user-password" placeholder="Enter Password" required>
											<div class="form-control-position">
												<i class="la la-key"></i>
											</div>
										</fieldset>
										<div class="form-group row">
											<div class="col-sm-6 col-12 text-center text-sm-left pr-0">
												<fieldset>
													<label class="custom-checkbox text-left" for="remember">Remember me
														<input type="text" class="d-none" name="remember" value="">
														<input type="checkbox" checked="checked" name="remember" id="remember">
														<span class="checkmark"></span>
													</label>
												</fieldset>
											</div>
											<div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="{{ route('forgot_password') }}" class="card-link">Forgot Password?</a></div>
										</div>
										<button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
									</form>
								</div>
								<p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>New to Inthelink?</span></p>
								<div class="card-body">
									<a href="{{ route('register') }}" class="btn btn-outline-danger btn-block"><i class="ft-user"></i>Register</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			
		</div>
	</div>
</div>
<input type="hidden" name="is_redirect" value="{{ Request()->session()->has('previous_url') ?? '' }}">

@stop
@section('scripts')
<script>
	$(document).ready(function(){
		//show modal notice when redirect to page
		if(localStorage.getItem('is_redirect')){
			localStorage.removeItem('is_redirect');
		}
		else
		if($('input[name="is_redirect"]').val()){
			$('#modalSigninNotice').modal('show');
		}
	});
	
</script>
@stop