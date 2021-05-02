<?php
   session_start();
   require 'db.php';
   
   require 'vendor/autoload.php';
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require 'PHPMailer/src/Exception.php';
   require 'PHPMailer/src/PHPMailer.php';
   require 'PHPMailer/src/SMTP.php';
   
   //Instantiation and passing `true` enables exceptions
   $mail = new PHPMailer(true);
   ?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>

    <link rel="stylesheet" href="assets/css/sweetalert.css">

    <script src="vendor/jquery/sweetalert.min.js"></script>
    <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                var CreatedBy = window.localStorage.getItem("loggedin_user_id");
                var username = window.localStorage.getItem("loggedin_user_name");
                var isadmin = window.localStorage.getItem("loggedin_user_Admin");
                if (CreatedBy == null || CreatedBy == '') {
                    window.location = "login.php";
                } else {
                    $('#txtlogout').html(isadmin + ' ' + username + ' Logout');
                }
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            var CreatedBy = window.localStorage.getItem("loggedin_user_id");
            var IsAdmin = window.localStorage.getItem("loggedin_user_Admin");
            $.ajax({
                url: 'fetch-complaint.php',
                data: 'CreatedBy=' + CreatedBy + '&IsAdmin=' + IsAdmin.trim(),
                type: "POST",
                success: function(data) {
                    var datatableVariable = $('#tblautoformatecreation').DataTable({
                        orderCellsTop: true,
                        fixedHeader: true,
                        scrollY: "300px",
                        scrollX: true,
                        scrollCollapse: true,
                        paging: true,
                        data: JSON.parse(data),
                        responsive: true,
                        colReorder: true,
                        dom: 'Bfrtip',
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                        "columns": [{
                                "data": 'id',
                                "Sortable": false,
                                "mRender": function(data) {
                                    return '<button class="btn btn-default edit use-address" id="btnedit">' + '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>' + '</button> <deletebutton class="btn btn-danger btndelete">' + '<i class="fa fa-trash-o" aria-hidden="true"></i>' + '</deletebutton >';
                                }
                            }, {
                                "data": "id",
                                'visible': false,
                                sortable: false
                            }, {
                                'data': 'name'
                            }, {
                                'data': 'email'
                            }, {
                                'data': 'mob'
                            }, {
                                'data': 'address'
                            }, {
                                'data': 'Complaint'
                            },
                            {
                                'data': 'CretedBy'
                            },
                            {
                                'data': 'Status'
                            }, {
                                "data": 'id',
                                "Sortable": false,
                                "mRender": function(data) {
                                    var isadmin = window.localStorage.getItem("loggedin_user_Admin");
                                    if (isadmin == 'Admin') {
                                        return '<RejectButton class="" id="btnreject" style="cursor: pointer;">' + 'Reject' + '</RejectButton> <Approvedbutton class="btnApproved" style="cursor: pointer;">' + 'Approved' + '</Approvedbutton >';
                                    } else {
                                        return '<RejectButton class="" id="btnreject" style="cursor: pointer;"></RejectButton> <Approvedbutton class="btnApproved" style="cursor: pointer;"></Approvedbutton >';
                                    }
                                }
                            },
                        ]
                    });
                }
            });
            //edit
            $('#tblautoformatecreation').on('click', 'button', function(e) {
                e.preventDefault();
                var table = $('#tblautoformatecreation').DataTable();
                var data = table.row($(this).parents('tr')).data();
                $('#hfnid').val('0');
                $('#txtname').val('');
                $('#txtemail').val('');
                $('#txtmob').val('');
                $('#txtaddress').val('');
                $('#txtcomplaint').val('');
                $('#hfnid').val(data.id);
                $('#txtname').val(data.name);
                $('#txtemail').val(data.email);
                $('#txtmob').val(data.mob);
                $('#txtaddress').val(data.address);
                $('#txtcomplaint').val(data.Complaint);
                $('#formadd').show();
                $('#gridview').hide();
            });
            //delete Button click event
            $('#tblautoformatecreation').on('click', 'deletebutton', function(e) {
                e.preventDefault();
                var table = $('#tblautoformatecreation').DataTable();
                var data = table.row($(this).parents('tr')).data();
                slno = '';
                slno = data.id;
                _module = data.name;
                swal({
                    title: "Confirm ",
                    text: "Are you sure you want to delete Module Name:- " + _module + " records?",
                    type: "warning",
                    confirmButtonText: "Delete",
                    showCancelButton: true
                }, function() {
                    $.ajax({
                        type: "POST",
                        url: "delete-complaint.php",
                        data: "&id=" + slno,
                        success: function(response) {
                            if (parseInt(response) > 0) {
                                displayMessage("Deleted Successfully");
                                location.reload();
                            }
                        }
                    });
                });
            });

            //RejectButton Button click event
            $('#tblautoformatecreation').on('click', 'RejectButton', function(e) {
                e.preventDefault();
                var table = $('#tblautoformatecreation').DataTable();
                var data = table.row($(this).parents('tr')).data();
                slno = '';
                slno = data.id;
                _module = data.name;
                swal({
                    title: "Confirm ",
                    text: "Are you sure you want to Reject Module Name:- " + _module + " records?",
                    type: "warning",
                    confirmButtonText: "Reject",
                    showCancelButton: true
                }, function() {
                    $.ajax({
                        type: "POST",
                        url: "getrejected-complaint.php",
                        data: "&id=" + slno,
                        success: function(response) {
                            if (parseInt(response) > 0) {
                                displayMessage("Rejected Successfully");
                                location.reload();
                            }
                        }
                    });
                });
            });


            //Approved Button click event
            $('#tblautoformatecreation').on('click', 'Approvedbutton', function(e) {
                e.preventDefault();
                var table = $('#tblautoformatecreation').DataTable();
                var data = table.row($(this).parents('tr')).data();
                slno = '';
                slno = data.id;
                _module = data.name;
                swal({
                    title: "Confirm ",
                    text: "Are you sure you want to Approved Module Name:- " + _module + " records?",
                    type: "warning",
                    confirmButtonText: "Approved",
                    showCancelButton: true
                }, function() {
                    $.ajax({
                        type: "POST",
                        url: "getApproved-Complaint.php",
                        data: "&id=" + slno,
                        success: function(response) {
                            if (parseInt(response) > 0) {

                                displayMessage("Approved Successfully");
                                location.reload();
                            }
                        }
                    });
                });
            });
        });


        function RegisterComplaingtValidation(e) {
            var valid = true;
            var name = $('#txtname').val();
            var email = $('#txtemail').val();
            var mob = $('#txtmob').val();
            var add = $('#txtaddress').val();
            var Complaint = $('#txtcomplaint').val();
            var CreatedBy = window.localStorage.getItem("loggedin_user_id");
            var Status = 'Open';
            var d = new Date();

            var month = d.getMonth() + 1;
            var day = d.getDate();

            var CreatedDate = d.getFullYear() + '/' +
                (('' + month).length < 2 ? '0' : '') + month + '/' + (('' + day).length < 2 ? '0' : '') + day;
            if (name.trim() == "") {
                alert('Please Enter Name');
                $('#txtname').focus();
                valid = false;
            } else if (email.trim() == "") {
                alert('Please Enter Email');
                $('#txtemail').focus();
                valid = false;
            } else if (mob.trim() == "") {
                alert('Please Enter Mobile number');
                $('#txtmob').focus();
                valid = false;
            } else if (add.trim() == "") {
                alert('Please Enter Address');
                $('#txtaddress').focus();
                valid = false;
            } else if (Complaint.trim() == "") {
                alert('Please Enter Complaint');
                $('#txtcomplaint').focus();
                valid = false;
            }

            if (valid == true) {
                if ($('#hfnid').val() == '0') {
                    $.ajax({
                        url: 'add-complaint.php',
                        data: 'name=' + name.trim() + '&email=' + email.trim() + '&mob=' + mob.trim() + '&address=' + add.trim() + '&Complaint=' + Complaint.trim() + '&Status=' + Status.trim() + '&CreatedBy=' + CreatedBy + '&CreatedDate=' + CreatedDate,
                        type: "POST",
                        success: function(data) {
                            displayMessage("Added Successfully");
                            $('#txtname').val('');
                            $('#txtemail').val('');
                            $('#txtmob').val('');
                            $('#txtaddress').val('');
                            $('#txtcomplaint').val('');
                            $('#hfnid').val('0');
                            $('#formadd').hide();
                            $('#gridview').show();
                            location.reload();

                        }
                    });
                } else {
                    $.ajax({
                        url: 'edit-complaint.php',
                        data: 'id=' + $('#hfnid').val() + '&name=' + name.trim() + '&email=' + email.trim() + '&mob=' + mob.trim() + '&address=' + add.trim() + '&Complaint=' + Complaint.trim() + '&ModifiedBy=' + CreatedBy + '&ModifiedDate=' + CreatedDate,
                        type: "POST",
                        success: function(data) {
                            displayMessage("Update Successfully");
                            $('#txtname').val('');
                            $('#txtemail').val('');
                            $('#txtmob').val('');
                            $('#txtaddress').val('');
                            $('#txtcomplaint').val('');
                            $('#hfnid').val('0');
                            $('#formadd').hide();
                            $('#gridview').show();
                            location.reload();
                        }
                    });
                }
            } else {
                return valid;
            }
        }

        function displayMessage(message) {
            $(".response").html("<div class='success'>" + message + "</div>");
            setInterval(function() {
                $(".success").fadeOut();
            }, 1000);
        }

        function AddComplaint(message) {
            $('#formadd').show();
            $('#gridview').hide();
        }

        function CloseComplaint(message) {
            $('#formadd').hide();
            $('#gridview').show();
        }

    </script>
    <style>
        body {
            text-align: center;
            font-size: 15px;
            font-family: "Courier", sans-serif;
        }

        .response {
            height: 10px;
        }

        .success {
            background: #cdf3cd;
            padding: 10px 60px;
            border: #c3e6c3 1px solid;
            display: inline-block;
        }

        .sidebar-container {
            color: rgb(255, 255, 255);
            padding: 0px;
            display: block;
            height: 136vh;
            background: darkslategray;
        }

        .ul-class {
            list-style: none;
            float: left;
            text-align: left;
        }

        .box.box-primary {
            border-top-color: #3c8dbc;
        }

        .box {
            position: relative;
            border-radius: 3px;
            background: #ffffff;
            border-top: 3px solid #d2d6de;
            margin-bottom: 20px;
            width: 100%;
            box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
        }

        .box-header.with-border {
            border-bottom: 1px solid #f4f4f4;
        }

        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
        }

        .box-body {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            padding: 10px;
        }

        .box-footer {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            border-top: 1px solid #f4f4f4;
            padding: 10px;
            background-color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .well-test {
            min-height: 20px;
            padding: 0px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
            box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="glyphicon glyphicon-menu-hamburger"></span>
                </button>


                <div class="navbar-left logo">

                </div>
                <h1 class="brand brand-name navbar-left">
                    <div class"navbar-left">Adani
                </h1>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="report.php">Report</a></li>
                    <li><a class="btn btn-danger" id="txtlogout" href="login.php" style="color:white;font-weight:bold">Logout</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="width: 100%;background:aliceblue;  margin-top: 64px;">
        <div class="row">

            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12" style="padding: 8px;">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>User Complaint</b></h3>
                        <button type="Button" onclick="AddComplaint(this)" class="btn btn-primary login-button">ADD</button>
                    </div>
                </div>
                <div class="container" id="formadd" style="display:none">
                    <form class="well-test  form-horizontal" action="" method="post" id="registration_form" style="padding:0px">
                        <input type="hidden" id="hfnid" value="0">
                        <fieldset>
                            <div class="form-group">
                                <div class="response"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>
                                <div class="col-md-4 ">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="name" id="txtname" placeholder="Name" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail</label>
                                <div class="col-md-4 ">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input name="email" id="txtemail" maxlength="30" placeholder="E-Mail" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mobile Number</label>
                                <div class="col-md-4 ">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input name="Mob" id="txtmob" placeholder="Enter Mob No" class="form-control" type="Number">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Address</label>
                                <div class="col-md-4 ">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input name="address" id="txtaddress" maxlength="16" placeholder="Enter Address" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Register Complaint</label>
                                <div class="col-md-4 ">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <textarea name="complaint" id="txtcomplaint" cols="5" rows="3" placeholder="Enter Complaint" class="form-control" type="text"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-success" role="alert" style=" display: none;" id="registration_success">Registration Successfully Completed.</div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="Button" onclick="RegisterComplaingtValidation(this)" class="btn btn-primary login-button">Register</button>
                                    <button type="Button" onclick="CloseComplaint(this)" class="btn btn-primary login-button">Close</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="" id="gridview">
                    <form class="well-test  form-horizontal" action="" method="post" id="registration_form">
                        <fieldset>
                            <div class="form-group">
                                <div class="response"></div>
                            </div>
                            <div class="container-fluid">
                                <div class="col-md-12">
                                    <table id="tblautoformatecreation" class="table table-responsive table-hover" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th> </th>
                                                <th class="notshow">ID </th>
                                                <th> NAME</th>
                                                <th>Email</th>
                                                <th>Mob No</th>
                                                <th>Address</th>
                                                <th>Complaint</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                                <th>Update Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
</body>
<script>
    function openNav() {
        var x = document.getElementById("mySidebar");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

</script>

</html>
