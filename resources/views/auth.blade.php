<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="assets/img/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fonts/auth/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/auth-util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/auth-main.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="assets/img/login.png" alt="IMG">
				</div>
				
				<form class="login100-form validate-form" action="{{ URL('admin/dashboard') }}" id="submit-form">
					<span class="login100-form-title">
						Admin Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" id="username" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" id="password" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="button" class="login100-form-btn" id="btn-save">
							Login
						</button>
					</div>

					<div class="text-center p-t-100">
						<a class="txt2" href="{{ URL('user/category') }}">
							Continue as a Guest
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/select2/select2.min.js"></script>
	<script src="assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >$('.js-tilt').tilt({ scale: 1.1 })</script>
	<script src="assets/js/auth-main.js"></script>
	<script type="text/javascript">
		$('#btn-save').click(function (e) {
			// to not allowed to submission by clicking "Enter"
			//e.preventDefault();

			var username = document.getElementById('username');
			var password = document.getElementById('password');
			if (username.value == 'admin' && password.value == '12345')
			{
				$('#submit-form').submit();
			} else
			{
				//alert('Error in username or password, Please try again');
				username.style = "border-bottom: 1px solid crimson";
				password.style = "border-bottom: 1px solid crimson";
			}
		});
	</script>
</body>
</html>