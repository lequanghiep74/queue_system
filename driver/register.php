<?php
require "../include/DB.php";
$db = new DB();
if (isset($_POST['username'])
    && isset($_POST['password'])
    && isset($_POST['full_name'])
    && isset($_POST['identity_card'])
    && isset($_POST['day_of_birth'])
    && isset($_POST['driver_license'])
    && isset($_POST['staff_id'])
    && isset($_POST['sex'])
    && isset($_POST['phone_number'])
) {
    $data = $db->queryOneRow("select *from driver");
    if ($data->num_rows > 0) {
    } else {
        $db->query("insert into driver (username, password, fullname,"
            ." identity_card, dob, driver_license, staff_id, sex, phone)"
            ."VALUES ('".$_POST['username']."'),"
            ."'".$_POST['password']."',"
            ."'".$_POST['fullname']."',"
            ."'".$_POST['identity_card']."',"
            ."'".$_POST['dob']."',"
            ."'".$_POST['driver_license']."',"
            ."'".$_POST['staff_id']."',"
            ."".$_POST['sex'].","
            ."'".$_POST['phone']."',"
            .");");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Import font google-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!--Import font-awesome-->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.css">

    <!--Import jQuery js-->
    <script src="../bower_components/jquery/dist/jquery.js"></script>

    <!--Import materialize-->
    <link rel="stylesheet" href="../bower_components/materialize/dist/css/materialize.css">

    <!--Import style.css-->
    <link rel="stylesheet" href="../resource/css/register.css">


    <!--Import materialize js-->
    <script src="../bower_components/materialize/dist/js/materialize.js"></script>

    <!--Import custom js-->
    <script src="../resource/js/register.js"></script>

    <!--import clockpicker-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav id="nav-color">
    <div class="nav-wrapper">
        <a href="#!" class="center brand-logo">REGISTER</a>
    </div>
</nav>    <!--end nav-->

<section class="container">
    <h5></h5>
    <div class="row">
        <form class="col s12" action="register.php" method="POST">
            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m3">
                    <input name="username" placeholder="Enter username" id="username" type="text" class="validate">
                    <label for="username">User Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m3">
                    <input name="password" placeholder="Enter password" id="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m3">
                    <input name="full_name" placeholder="Enter full name" id="full_name" type="text" class="validate">
                    <label for="full_name">Full Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m3">
                    <input placeholder="Enter identiry card" id="identity_card" name="identity_card" type="text"
                           class="validate">
                    <label for="identity_card">Identity Card</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m3">
                    <input name="day_of_birth" type="date" class="datepicker" id="day_of_birth"
                           placeholder="Enter day of birth">
                    <label for="day_of_birth">Day of birth</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m3">
                    <input name="driver_license" placeholder="Enter driver's license" id="driver_license" type="text"
                           class="validate">
                    <label for="driver_license">Driver's License</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m3">
                    <input name="staff_id" placeholder="Enter staff's id" id="staff_id" type="text" class="validate">
                    <label for="staff_id">Staff's ID</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m3">
                    <input name="phone_number" placeholder="Enter Phone Number" id="phone_number" type="number"
                           class="validate">
                    <label for="phone_number">Phone Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m3 inline no-margin">
                    <div class="row">
                        <div class="col s12 m12 no-padding">
                            <p class="col s6 m4">
                                <input name="sex" type="radio" id="male"/>
                                <label for="male">Male</label>
                            </p>
                            <p class="col s6 m4">
                                <input name="sex" type="radio" id="female"/>
                                <label for="female">Female</label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn waves-effect waves-light col s4 m6 offset-s4 offset-m3" type="submit" name="action"
                    id="submit-btn">
                Register
            </button>
        </form>
    </div>
</section>
</body>
</html>