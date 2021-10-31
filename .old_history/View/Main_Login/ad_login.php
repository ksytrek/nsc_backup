<!DOCTYPE html>
<html lang="en">
<?php


?>

<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	<?php
		session_start();
		if (!empty($_SESSION['success_Login'])) {
			header("location: ../../Controller/check_login.php");
		}
	?>
	<!--===============================================================================================-->

</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>
				<!-- <form id="form_member" name="member_form" class="login100-form validate-form"  action="../../Controller/Controller_Click.php" method="POST">
					<?php if(isset($_SESSION['success'])):?>
						<span class="login100-form-title">
							<div class="alert alert-info" role="alert">
								<?php 
									echo $_SESSION['success'];
									unset($_SESSION['success']);
									session_destroy();
								?> 
							</div>
						</span>
					<?php endif?>
					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input " data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button name="btn_member_Login" class="login100-form-btn">
							Login
						</button>
					</div>

					<?php if (false) { ?>
						<div class="text-center p-t-12">
							<span class="txt1">
								Forgot
							</span>
							<a class="txt2" href="#">
								Username / Password?
							</a>
						</div>
					<?php } ?>
					<div class="text-center p-t-12">
						<span class="txt1">
							For
						</span>
						<a id="show_admin" class="txt2" onclick="show_form(this.id)">
							Admin
						</a>
					</div>
					<div class="text-center p-t-136">
						<a class="txt2" href="../Register/">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form> -->


				<form  id="form_admin" name="admin_form" class="login100-form validate-form" action="../../Controller/Controller_Click.php" method="POST">
					<span class="login100-form-title">
						Admin Login
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button name="btn_admin_Login" class="login100-form-btn">
							Login
						</button>
					</div>
					<?php if (false) { ?>

						<div class="text-center p-t-12">
							<span class="txt1">
								Forgot
							</span>
							<a class="txt2" href="#">
								Username / Password?
							</a>
						</div>

					<?php } ?>
					<div class="text-center p-t-12">
						<span class="txt1">
							For
						</span>
						<a id="show_mamber" class="txt2" href="./" >
							Mamber
						</a>
					</div>

					<!-- <div class="text-center p-t-136">
						<a class="txt2" href="../Register/">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div> -->
				</form>

			</div>

		</div>



	</div>

	<script>
		// function show_form(id) {
		// 	if (id == "show_admin") {
		// 		document.getElementById("form_admin").style.display = "";
		// 		document.getElementById("form_member").style.display = "none";
		// 	} else if (id == "show_mamber") {

		// 		// document.getElementById("form_member").style.display = "";
		// 		// document.getElementById("form_admin").style.display = "none";
		// 	}
		// }
	</script>


	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>