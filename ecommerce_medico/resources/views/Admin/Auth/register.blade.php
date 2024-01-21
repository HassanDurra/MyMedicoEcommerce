<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from travl.dexignlab.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Oct 2023 22:01:07 GMT -->
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Travl : Hotel Admin Dashboard Bootstrap 5 Template" />
	<meta property="og:title" content="Travl : Hotel Admin Dashboard Bootstrap 5 Template" />
	<meta property="og:description" content="Travl : Hotel Admin Dashboard Bootstrap 5 Template" />
	<meta property="og:image" content="social-image.png" />
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>Travl Hotel Admin Dashboard</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('Dashboard/images/favicon.png') }}" />
    <link href="{{ asset('Dashboard/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Dashboard/vendor/toastr/css/toastr.min.css') }}">
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="{{ asset('Dashboard/images/logo-full.png') }}" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">Register Admin Account</h4>
                                    <form action="{{ route('auth.register') }}" enctype="multipart/form-data" method="Post" id="registerForm">
                                        @csrf
                                        <input type="hidden" value="1" name="role">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Profile Image</strong></label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="username" placeholder="Enter your username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" placeholder="hello@gmail.com">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" placeholder="***********">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Confirm Password</strong></label>
                                            <input type="password" class="form-control" name="confirm_password" placeholder="***********">
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="{{ route('admin.login.view') }}">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('Dashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('Dashboard/js/custom.min.js') }}"></script>
    <script src="{{ asset('Dashboard/js/dlabnav-init.js') }}"></script>
	<script src="{{ asset('Dashboard/js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('Dashboard/vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset("Dashboard/custom/js/register.js") }}"></script>

</body>
@if(Session::has('error'))
<script>
    toastr['error']('{{ session()->get('error') }}');
</script>
@endif
@if(Session::has('success'))
<script>
    toastr['success']('{{ session()->get('success') }}');
</script>
@endif
<!-- Mirrored from travl.dexignlab.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Oct 2023 22:01:07 GMT -->
</html>
