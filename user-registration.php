<?php
require_once "db.php";
?>
<HTML>

<HEAD>
    <TITLE>User Registration</TITLE>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/user-registration.css" type="text/css" rel="stylesheet" />
    <script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>

<BODY>
    <div class="phppot-container">
        <div class="sign-up-container">
            <div class="login-signup">
                <a class="btn btn-primary" href="login.php">Login</a>
            </div>
            <div class="">
                <form name="sign-up" action="" method="">
                    <div class="signup-heading">Registration</div>
                    <hr>
                    <div class="error-msg" id="error-msg"></div>
                    <div class="row col-md-12">
                        <div class="row col-md-6">
                            <div class="inline-block ">
                                <div class="form-label">
                                    Username<span class="required error"></span>
                                </div>
                                <input class="input-box-330" onchange="getchangeError(this)" type="text" name="username" id="username" placeholder="Enter UserName">
                                <div style="text-align:left">
                                    <span id="username-info"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-6">
                            <div class="inline-block ">
                                <div class="form-label">
                                    Email<span class="required error"></span>
                                </div>
                                <input class="input-box-330" type="email" onchange="getchangeError(this)" name="email" id="email" placeholder="abc@abc.com">
                                <div style="text-align:left">
                                    <span id="email-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <div class="row col-md-6">
                            <div class="inline-block">
                                <div class="form-label">
                                    Password<span class="required error" id=""></span>
                                </div>
                                <input class="input-box-330" type="password" onchange="getchangeError(this)" name="password" id="signup-password" placeholder="*********">
                                <div style="text-align:left">
                                    <span id="signup-password-info"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-6">
                            <div class="inline-block">
                                <div class="form-label">
                                    Confirm Password<span class="required error" id=""></span>
                                </div>
                                <input class="input-box-330" type="password" onchange="getchangeError(this)" name="confirm-password" id="confirm-password" placeholder="*********">
                                <div style="text-align:left">
                                    <span id="confirm-password-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <div class="row col-md-6">
                            <div class="inline-block">
                                <div class="form-label">
                                    Mobile Number<span class="required error" id=""></span>
                                </div>
                                <input class="input-box-330" type="mob" onchange="getchangeError(this)" name="mob" id="signup-mob" placeholder="Enter Mobile No">
                                <div style="text-align:left">
                                    <span id="signup-mob-info"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row  col-md-6">
                            <div class="inline-block">
                                <div class="form-label">
                                    Address<span class="required error" id=""></span>
                                </div>
                                <input class="input-box-330" type="address" onchange="getchangeError(this)" name="address" id="signup-address" placeholder="Enter Address">
                                <div style="text-align:left">
                                    <span id="signup-address-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <div class="row col-md-6">
                            <div class="inline-block">
                                <div class="form-label">
                                    Gender<span class="required error" id=""></span>
                                </div>
                                <select class="input-box-330" type="gender" onchange="getchangeError(this)" name="gender" id="signup-gender" style="width:250px">
                                    <option value="0">Please Select Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>

                                </select>

                                <div style="text-align:left">
                                    <span id="signup-gender-info"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row  col-md-6">
                            <div class="inline-block">
                                <div class="form-label">
                                    Birth Date<span class="required error" id=""></span>
                                </div>
                                <input class="input-box-330" type="date" onchange="getchangeError(this)" name="dob" id="signup-dob">
                                <div style="text-align:left">
                                    <span id="signup-dob-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <input class="btn" type="button" name="signup-btn" id="signup-btn" onclick="signupValidation()" value="Sign up">
            </div>
            </form>
        </div>
    </div>
    </div>

    <script>
        function displayMessage(message) {
            $(".response").html("<div class='success'>" + message + "</div>");
            setInterval(function() {
                $(".success").fadeOut();
            }, 1000);
        }

        function getchangeError(getid) {

            $("#" + getid.id + '-info').html("").css("color", "#9a9a9a").show();
            $("#" + getid.id + '-info').removeClass("error-field");
            $("#" + getid.id + '-info').addClass("error-remove-field");
            $("#" + getid.id + '-info').hide();


        }

        function signupValidation() {
            var valid = true;

            $("#username").removeClass("error-field");
            $("#email").removeClass("error-field");
            $("#password").removeClass("error-field");
            $("#confirm-password").removeClass("error-field");
            $("#mob").removeClass("error-field");
            $("#address").removeClass("error-field");
            $("#gender").removeClass("error-field");
            $("#dob").removeClass("error-field");

            var UserName = $("#username").val();
            var email = $("#email").val();
            var Password = $('#signup-password').val();
            var ConfirmPassword = $('#confirm-password').val();
            var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
            var mob = $('#signup-mob').val();
            var address = $('#signup-address').val();
            var gender = $('#signup-gender').val();
            var dob = $('#signup-dob').val();


            $("#username-info").html("").hide();
            $("#email-info").html("").hide();

            if (UserName.trim() == "") {
                $("#username-info").html("Please enter User Name.").css("color", "#ee0000").show();
                $("#username").addClass("error-field");
                valid = false;
            }
            if (email == "") {
                $("#email-info").html("Please enter Email Id").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (email.trim() == "") {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (!emailRegex.test(email)) {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000")
                    .show();
                $("#email").addClass("error-field");
                valid = false;
            }
            if (Password.trim() == "") {
                $("#signup-password-info").html("Please enter Password.").css("color", "#ee0000").show();
                $("#signup-password").addClass("error-field");
                valid = false;
            }
            if (ConfirmPassword.trim() == "") {
                $("#confirm-password-info").html("Please enter Confirm Password.").css("color", "#ee0000").show();
                $("#confirm-password").addClass("error-field");
                valid = false;
            }
            if (Password != ConfirmPassword) {
                $("#error-msg").html("Both passwords must be same.").show();
                valid = false;
            }
            if (mob.trim() == "") {
                $("#signup-mob-info").html("Please enter Mob. Number.").css("color", "#ee0000").show();
                $("#mob").addClass("error-field");
                valid = false;
            }

            if (mob.trim() != "") {
                if (mob.length != 10) {
                    $("#signup-mob-info").html("Please enter 10 digit Mob. Number.").css("color", "#ee0000").show();
                    $("#mob").addClass("error-field");
                    valid = false;
                }

            }

            if (address.trim() == "") {
                $("#signup-address-info").html("Please enter Address.").css("color", "#ee0000").show();
                $("#address").addClass("error-field");
                valid = false;
            }
            if (gender.trim() == "0") {
                $("#signup-gender-info").html("Please select Gender.").css("color", "#ee0000").show();
                $("#gender").addClass("error-field");
                valid = false;
            }
            if (dob.trim() == "") {
                $("#signup-dob-info").html("Please select DOB.").css("color", "#ee0000").show();
                $("#dob").addClass("error-field");
                valid = false;
            }
            if (dob.trim() != "") {
                var today = new Date();
                var birthDate = new Date(dob.trim());
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                var da = today.getDate() - birthDate.getDate();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                if (m < 0) {
                    m += 12;
                }
                if (da < 0) {
                    da += 30;
                }
                if (age < 18 || age > 100) {
                    $("#signup-dob-info").html("Above 18 is valid.").css("color", "#ee0000").show();
                    $("#dob").addClass("error-field");
                    valid = false;

                }

            }
            if (valid == false) {
                $('.error-field').first().focus();
                valid = false;
            }

            if (valid == true) {

                $.ajax({
                    type: "POST",
                    url: "isuseralredyregister.php",
                    dataType: 'json',
                    data: 'username=' + UserName.trim() + '&email=' + email.trim() + '&mob=' + mob.trim(),
                    success: function(response) {
                        if (response['status'] == 0) {
                            $.ajax({
                                type: "POST",
                                url: "add-signup.php",
                                data: 'username=' + UserName.trim() + '&password=' + Password.trim() + '&email=' + email.trim() + '&mob=' + mob.trim() + '&address=' + address.trim() + '&gender=' + gender.trim() + '&dob=' + dob.trim(),
                                success: function(response) {
                                    $("#username").val('');
                                    $("#email").val('');
                                    $('#signup-password').val('');
                                    $('#confirm-password').val('');

                                    $('#signup-mob').val('');
                                    $('#signup-address').val('');
                                    $('#signup-gender').val('');
                                    $('#signup-dob').val('');
                                    alert("Added Successfully");
                                }
                            });
                        } else {
                            alert('User alreday created');
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
