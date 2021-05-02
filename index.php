<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>

    <link rel="stylesheet" href="assets/css/sweetalert.css">

    <script src="vendor/jquery/sweetalert.min.js"></script>
    <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

    <script>
        $(document).ready(function() {
            var CreatedBy = window.localStorage.getItem("loggedin_user_id");
            var username = window.localStorage.getItem("loggedin_user_name");
            if (CreatedBy == null || CreatedBy == '') {
                window.location = "login.php";
            } else {
                $('#txtlogout').html(username + ' Logout');
            }
        });

    </script>


    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'fetch-category.php',
                type: "POST",
                dataType: "json",
                contentType: "application/json",

                success: function(data) {
                    var items = "";
                    items += "<option value='0'  selected>Please select</option>";
                    $.each(data, function(i, item) {
                        items += "<option value='" + item.ID + "'>" + (item.Category    ) + "</option>";
                    });
                    $("#category").html(items);
                }
            

            });

        })

    </script>


    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: "fetch-event.php",
                displayEventTime: false,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                eventSources: [{
                    events: '',
                }],
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');

                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                        $.ajax({
                            url: 'add-event.php',
                            data: 'title=' + title + '&start=' + start + '&end=' + end,
                            type: "POST",
                            success: function(data) {
                                displayMessage("Added Successfully");

                            }
                        });
                        calendar.fullCalendar('renderEvent', {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                            true
                        );
                    }
                    calendar.fullCalendar('unselect');
                },

                editable: true,
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function(response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
                eventClick: function(event) {
                    var deleteMsg = confirm("Do you really want to delete?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: "delete-event.php",
                            data: "&id=" + event.id,
                            success: function(response) {
                                if (parseInt(response) > 0) {
                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                    displayMessage("Deleted Successfully");
                                }
                            }
                        });
                    }
                }

            });
        });

        function displayMessage(message) {
            $(".response").html("<div class='success'>" + message + "</div>");
            setInterval(function() {
                $(".success").fadeOut();
            }, 1000);
        }

        function daysdifference(firstDate, secondDate) {
            var startDay = new Date(firstDate);
            var endDay = new Date(secondDate);

            var millisBetween = startDay.getTime() - endDay.getTime();
            var days = millisBetween / (1000 * 3600 * 24);

            return Math.round(Math.abs(days));
        }

        function todoValidation(e) {

            var valid = true;
            var enddate = '';
            var starttime = '';
            var endtime = '';

            var startdate = $('#startdate').val();
            enddate = $('#enddate').val();
            if (enddate == undefined) {
                enddate = '';
            }
            var todolist = $('#add-todolist').val();
            starttime = $('#starttime').val();
            if (starttime == undefined) {
                starttime = '';
            }
            endtime = $('#endtime').val();
            if (endtime == undefined) {
                endtime = '';
            }
            var category = $('#category').val();
            if (startdate != '') {
                var date = new Date(startdate.trim());
                var _getformdate = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
                var _getvalidatefromdate = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
            }
            if (endtime != '') {
                var date1 = new Date(enddate.trim());
                _gettodate = (date1.getMonth() + 1) + '/' + date1.getDate() + '/' + date1.getFullYear();
                var _getvalidatetodate = date1.getFullYear() + '-' + (date1.getMonth() + 1) + '-' + date1.getDate();
            }

            if (startdate.trim() == "") {
                alert('Please Enter Start Date');
                $('#startdate').focus();
                valid = false;
            } else if (starttime.trim() == "") {
                alert('Please Enter start time');
                $('#starttime').focus();
                valid = false;
            } else if (enddate.trim() == "") {
                alert('Please Enter End Date');
                $('#enddate').focus();
                valid = false;
            } else if (endtime.trim() == "") {
                alert('Please Enter end time');
                $('#endtime').focus();
                valid = false;
            } else if (todolist.trim() == "") {
                alert('Please Enter Key-Word in TODO List');
                $('#add-todolist').focus();
                valid = false;
            } else if (category == "0") {
                alert('Please Enter category');
                $('#category').focus();
                valid = false;
            } else if (e.id == 'daily') {
                var diff = daysdifference(_getformdate, _gettodate);
                if (diff != 0) {
                    alert("To date should be equal  Start date");
                    $('#add-todolist').focus();
                    valid = false;
                }

            }


            var _result = (new Date(_getvalidatefromdate) <= new Date(_getvalidatetodate));

            if (_result == false) {
                alert("End date should be greater than Start date");
                valid = false;
            }
            if (valid == false) {
                valid = false;
            }

            if (valid == true) {
                var start = startdate.trim().split("-");
                var startdate = start[0] + '-' + start[1] + '-' + start[2];
                var end = enddate.trim().split("-");
                var enddate = end[0] + '-' + end[1] + '-' + end[2];
                $.ajax({
                    url: 'add-event.php',
                    data: 'title=' + todolist.trim() + '&start=' + startdate + '&end=' + enddate + '&category=' + category + '&starttime=' + starttime + '&endtime=' + endtime + '&list=' + e.id,
                    type: "POST",
                    success: function(data) {
                        displayMessage("Added Successfully");
                        $('#startdate').val('');
                        $('#enddate').val('');
                        $('#add-todolist').val('');
                        $('#category').val('');
                        $('#starttime').val('');
                        $('#endtime').val('');
                        window.location.href = window.location.href;
                    }
                });
            } else {
                return valid;
            }
        }

    </script>
    <script>
        $(document).ready(function() {
        var CreatedBy = window.localStorage.getItem("loggedin_user_id");
        var IsAdmin = window.localStorage.getItem("loggedin_user_Admin");
        $.ajax({
            url: 'getevent.php',
            data: 'CreatedBy=' + CreatedBy + '&IsAdmin=' + IsAdmin.trim(),
            type: "POST",
            success: function(data) {
                var datatableVariable = $('#tblautoformatecreation').DataTable({
                    orderCellsTop: true,
                    fixedHeader: true,
                    scrollY: "350px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: true,
                    data: JSON.parse(data),
                    responsive: true,
                    colReorder: true,
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    "columns": [{
                            "data": "id",
                            'visible': false,
                            sortable: false
                        }, {
                            'data': 'title'
                        }, {
                            'data': 'startend'
                        }, {
                            'data': 'category'
                        },
                        {
                            'data': 'list'
                        },
                        {
                            "data": 'id',
                            "Sortable": false,
                            "mRender": function(data) {
                                var isadmin = window.localStorage.getItem("loggedin_user_Admin");
                                if (isadmin != 'Admin') {
                                    return '<RejectButton class="" id="btnreject" style="cursor: pointer;">' + 'Reject' + '</RejectButton> <Approvedbutton class="btnApproved" style="cursor: pointer;">' + 'Approved' + '</Approvedbutton >';
                                } else {
                                    return '<RejectButton class="" id="btnreject" style="cursor: pointer;"></RejectButton> <Approvedbutton class="btnApproved" style="cursor: pointer;"></Approvedbutton >';
                                }
                            }
                        },
                                
                         {
                            'data': 'Status',
                            "Sortable": false,
                            "mRender": function(data) {
                                if (data == 'Approved') {
                                    return '<label style="color:green">'+data+'</label>';
                                } 
                                 
                                if (data == 'Rejected') {
                                    return '<label style="color:red">'+data+'</label>';
                                } 
                                
                               if (data == '') {
                                    return '<label style="color:blue">Open</label>';
                                } 
                                
                            }
                        }       
                    ]
                });
            }
        });
            
             //RejectButton Button click event
            $('#tblautoformatecreation').on('click', 'RejectButton', function(e) {
                e.preventDefault();
                var table = $('#tblautoformatecreation').DataTable();
                var data = table.row($(this).parents('tr')).data();
                slno = '';
                slno = data.id;
                _module = data.title;
                swal({
                    title: "Confirm ",
                    text: "Are you sure you want to Reject Module Name:- " + _module + " records?",
                    type: "warning",
                    confirmButtonText: "Reject",
                    showCancelButton: true
                }, function() {
                    $.ajax({
                        type: "POST",
                        url: "getrejected-event.php",
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
                _module = data.title;
                swal({
                    title: "Confirm ",
                    text: "Are you sure you want to Approved Module Name:- " + _module + " records?",
                    type: "warning",
                    confirmButtonText: "Approved",
                    showCancelButton: true
                }, function() {
                    $.ajax({
                        type: "POST",
                        url: "getApproved-event.php",
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
    </script>

    <style>
        body {

            text-align: center;
            font-size: 15px;
            font-family: "Courier", sans-serif;
        }

        #calendar {
            width: 95%;
            margin: 0 auto;
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
            padding: 5px;
            background-color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
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
                    <li><a href="report.php">Report</a></li>
                    <li><a href="Complaint.php">Add Complaint</a></li>
                    <li><a class="btn btn-danger" id="txtlogout" href="login.php" style="color:white;font-weight:bold"></a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="width: 100%;background:aliceblue;margin-top: 64px;">
        <div class="row">
            <div>


            </div>

            <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8" style="padding: 0px;">

                <div class="response"></div>
                <!--                <div id='calendar' style="background:#fff; padding: 2%;border-top: 3px solid #3a87ad;display: none;"></div>-->
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

                                                <th class="notshow">id</th>
                                                <th>title</th>
                                                <th>start-End</th>
                                                <th>category</th>
                                                <th>list</th>
                                                <th>Result </th>
                                                <th>Status </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4" style="padding: 8px;">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Book Event</b></h3>
                    </div>

                </div>
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row form-group col-md-12">

                            <label class="form-label" style=" float: left;">Start Date</label>
                            <input class="form-control" type="date" name="startdate" id="startdate">
                            <input class="form-control" type="time" name="starttime" id="starttime">


                        </div>
                        <div class="row form-group  col-md-12">

                            <label class="form-label" style=" float: left;">End Date</label>
                            <input class="form-control" type="date" name="enddate" id="enddate">
                            <input class="form-control" type="time" name="enddate" id="endtime">



                        </div>

                        <div class="row form-group  col-md-12">

                            <label class="form-label" style=" float: left;">Category</label>
                            <select class="form-control" type="category" name="category" id="category">

                            </select>
                        </div>



                        <div class="row form-group  col-md-12">

                            <label class="form-label" style=" float: left;">Daily Notes/TO Do List</label>
                            <textarea class="form-control" type="text" rows="4" cols="50" name="todolist" id="add-todolist"></textarea>
                        </div>
                        <div class="box-footer">
                            <button type="submit" id="daily" onclick="todoValidation(this)" class="btn btn-primary">Daily Note</button>
                            <button type="submit" id="todo" onclick="todoValidation(this)" class="btn btn-info">To-Do List</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
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
