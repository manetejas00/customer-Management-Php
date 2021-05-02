<?php
require_once "db.php";
?>
	<HTML>

	<HEAD>
		<TITLE>Login</TITLE>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
		<link href="assets/css/user-registration.css" type="text/css" rel="stylesheet" />
		<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
		<script>
		$(document).ready(function() {
			window.localStorage.setItem("loggedin_user_id", '');
			window.localStorage.setItem("loggedin_user_name", '');
			window.localStorage.setItem("loggedin_user_Admin", '');
		});
		</script>
	</HEAD>

	<BODY>
		<div class="phppot-container">
			<div class="sign-up-container">
				<div class="login-signup"> <a class="btn btn-primary" href="user-registration.php">Sign up</a> </div>
				<div class="signup-align">
					<form name="login" action="" method="post" onsubmit="return loginValidation(event)">
						<div class="signup-heading">Login</div>
						<?php if(!empty($loginResult)){?>
							<div class="error-msg">
								<?php echo $loginResult;?>
							</div>
							<?php }?>
								<div class="row">
									<div class="inline-block">
										<div class="form-label"> <span class="required error"></span>Username </div>
										<input class="input-box-330" type="text" name="username" onchange="getchangeError(this)" id="username">
										<div style="text-align:left"> <span id="username-info"></span> </div>
									</div>
								</div>
								<div class="row">
									<div class="inline-block">
										<div class="form-label"> <span class="required error"></span> Password </div>
										<input class="input-box-330" type="password" onchange="getchangeError(this)" name="login-password" id="login-password">
										<div style="text-align:left"> <span id="login-password-info"></span> </div>
									</div>
								</div>
								<div class="row">
									<input class="btn" type="submit" name="login-btn" id="login-btn" value="Login"> </div>
					</form>
				</div>
			</div>
		</div>
		<script>
		function getchangeError(getid) {
			$("#" + getid.id + '-info').html("").css("color", "#9a9a9a").show();
			$("#" + getid.id + '-info').removeClass("error-field");
			$("#" + getid.id + '-info').addClass("error-remove-field");
			loginValidation(event);
		}

		function loginValidation(e) {
			e.preventDefault();
			var valid = true;
			$("#username").removeClass("error-field");
			$("#password").removeClass("error-field");
			var UserName = $("#username").val();
			var Password = $('#login-password').val();
			$("#username-info").html("").hide();
			if(UserName.trim() == "") {
				$("#username-info").html("Please enter username.").css("color", "#ee0000").show();
				$("#username").addClass("error-field");
				valid = false;
			}
			if(Password.trim() == "") {
				$("#login-password-info").html("Please enter password.").css("color", "#ee0000").show();
				$("#login-password").addClass("error-field");
				valid = false;
			}
			if(valid == false) {
				$('.error-field').first().focus();
				valid = false;
			}
			if(valid == true) {
				$.ajax({
					type: "POST",
					url: "fetch-login.php",
					dataType: 'json',
					data: 'username=' + UserName.trim() + '&password=' + Password.trim(),
					success: function(response) {
						if(response['status'] == 1) {
							$.ajax({
								type: "POST",
								url: "getuserdetails.php",
								dataType: 'json',
								data: 'username=' + UserName.trim(),
								success: function(response) {
									window.localStorage.setItem("loggedin_user_id", response[0].id);
									window.localStorage.setItem("loggedin_user_name", response[0].username);
									window.localStorage.setItem("loggedin_user_Admin", response[0].IsAdmin);
                                    window.location = "index.php";
								}
							});
						} else {
							alert('Invalid Credentials');
						}
					}
				});
			} else {
				return valid;
			}
		}
		</script>
	</BODY>

	</HTML>