<!DOCTYPE html>
<html lang="en">
<head>
	<title>Restoran - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link type="text/css" href="{{ asset('public') }}/vendor/select2/select2.min.css" rel="stylesheet">
<!--===============================================================================================-->
    <link type="text/css" href="{{ asset('public') }}/css/util.css" rel="stylesheet">
    <link type="text/css" href="{{ asset('public') }}/css/main.css" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('public') }}/img/img-01.png" class="navbar-brand-img" alt="...">
				</div>
				<form class="login100-form validate-form" method="POST" action="{{ url('/auth/signin') }}">
                {{ csrf_field() }}
					<span class="login100-form-title">
						Member Login
                    </span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Enter Username" aria-describedby="emailHelp">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" id="exampleInputPassword"
                            name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
                    </div>
                    <div class="text-center p-t-136">

                    </div>
				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->

    <script src="{{ asset('public') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public') }}/vendor/bootstrap/js/popper.js"></script>

    <script src="{{ asset('public') }}/vendor/bootstrap/js/bootstrap.min.js"></script>

<!--===============================================================================================-->
    <script src="{{ asset('public') }}/vendor/select2/select2.min.js"></script>
	<!-- <script src="/vendor/select2/select2.min.js"></script> -->
<!--===============================================================================================-->
	<script src="{{ asset('public') }}/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.2
		})
	</script>
<!--===============================================================================================-->
    <!-- <script src="js/main.js"></script> -->
    <script src="{{ asset('public') }}/js/main.js"></script>

</body>
</html>

