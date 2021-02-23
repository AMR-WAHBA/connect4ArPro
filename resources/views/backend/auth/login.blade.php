<!DOCTYPE html>
<html lang="ar">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="{{asset('images/favicon.ico')}}">
	<title>@lang('website.title')</title>
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('css/vendors_css.css')}}">
	<!-- Style-->
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	<link rel="stylesheet" href="{{asset('css/skin_color.css')}}">
</head>
<body class="hold-transition theme-primary bg-img rtl" style="background-image: url(images/auth-bg/bg-9.jpg)">
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
			<div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded10 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">@lang('website.title')</h2>
								<p class="mb-0">@lang('website.login.box_header')</p>
							</div>
							<div class="p-40">
								<form action="{{ route('admin.attempt_login') }}" method="post">
									@csrf
									@method('POST')
									<div class="form-group @error('name') error @enderror">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											<input type="text" name="name" class="form-control ps-15 bg-transparent"
												placeholder="{{__('custom-attributes.admin.name')}}"
												value="{{old('name')}}">
										</div>
										@error('name')
										<div class="help-block">
											<ul role="alert">
												<li>{{$message}}</li>
											</ul>
										</div>
										@enderror
									</div>
									<div class="form-group @error('password') error @enderror">
										<div class="input-group mb-3">
											<span class="input-group-text  bg-transparent"><i
													class="ti-lock"></i></span>
											<input type="password" name="password"
												class="form-control ps-15 bg-transparent"
												placeholder="{{__('custom-attributes.admin.password')}}"
												value="{{old('password')}}">
										</div>
										@error('password')
										<div class="help-block">
											<ul role="alert">
												<li>{{$message}}</li>
											</ul>
										</div>
										@enderror
									</div>
									<div class="row">
										<div class="col-6">
											<div class="checkbox">
												<input type="checkbox" id="basic_checkbox_1" name="remmber_me">
												<label
													for="basic_checkbox_1">{{ __('website.login.remmber_me') }}</label>
											</div>
										</div>
										<!-- /.col -->
										<div class="col-6">
											<div class="fog-pwd text-end">
												<a href="javascript:void(0)" class="hover-warning"><i
														class="ion ion-locked"></i>
													@lang('website.login.forgot_password')</a><br>
											</div>
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
											<button type="submit"
												class="btn btn-danger mt-10">@lang('website.login.login')</button>
										</div>
										<!-- /.col -->
									</div>
								</form>
								{{-- <div class="text-center">
									<p class="mt-15 mb-0">Don't have an account? <a href="auth_register.html" class="text-warning ms-5">Sign Up</a></p>
								</div> --}}
							</div>
						</div>
						{{-- <div class="text-center">
						  <p class="mt-20 text-white">- Sign With -</p>
						  <p class="gap-items-2 mb-20">
							  <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
							  <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
							  <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
							</p>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Vendor JS -->
	<script src="{{asset('js/vendors.min.js')}}"></script>
	<script src="{{asset('assets/icons/feather-icons/feather.min.js')}}"></script>
</body>

</html>
