<?php
require('include/config.php');
include('include/security.php');
$db = new Admin_Database();
session_start();
?>
<?php
if (!(isset($_SESSION['admin_id']))  AND !(isset($_SESSION['admin_name'])) AND !(isset($_SESSION['user_id']))) {
    header("location:index.php");
    exit;
}
else {
$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];
$admin_user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bangladesh Traffic Police</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="CASE,TRAFFIC,TRAFFIC POLICE CASE">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="datepicker/jquery-ui.css">
    <link rel="stylesheet" href="include/style.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="datepicker/jquery-1.12.4.js"></script>
    <script src="datepicker/jquery-ui.js"></script>
    <script src="include/action.js"></script>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
</head>
<body onload="startTime()">
<nav class="navbar navbar-inverse" style="margin-bottom: auto; background-color: #122b40">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img style="border-radius: 10px; height: 52px; width: 144px;" src="images/logo__.png" alt="Bangladesh Police">
            &nbsp; &nbsp;&nbsp;
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_home.php">BTPCSO</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="admin_home.php">Home</a></li>
<!--                <li class="dropdown">-->
<!--                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">NEW <span class="caret"></span></a>-->
<!--                    <ul class="dropdown-menu" style="background-color: ">-->
<!--                        <li><a href="#">new</a></li>-->
<!--                        <li><a href="#">new</a></li>-->
<!--                        <li><a href="#">new</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
                <!--<li class="dropdown">-->
                <!--    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Jobs <span class="caret"></span></a>-->
                <!--    <ul class="dropdown-menu" style="background-color: ">-->
                <!--        <li><a href="">New Job</a></li>-->
                <!--        <li><a href="">My Job Requests</a></li>-->
                <!--        <li><a href="#">Some Task</a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                <li><a href="admin_see_all_case.php">Traffic Cases</a></li>
                <li><a href="new_traffic_case_form_1.php">New Case</a></li>
                <li><a href="incomplete_case.php">Incomplete Case</a></li>
                <li><a href="my_case.php">My Cases</a></li>
                <li><a href="my_global_case.php">My Global Cases</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href=""><span id="txt" style="font-size: 1.5em;"></span></a href=""></li>
                <li>
                    <div style="padding-top: 9px;">
                        <form class="form-inline" action="" method="post">
                            <input class="form-control" type="text" name="search" placeholder="Search ..." required>
                             
                            <button type="submit" name="search_btn" class="btn btn-default" onsubmit="asa()">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </form>
                    </div>
                </li>
                <?php
                    if (isset($_POST['search_btn'])){
                        $case_id_no = strtoupper($_POST['search']);
                        ?>
                        <script>
                            window.location = "case_search_result.php?case_id=<?php echo base64_encode($case_id_no);?>";
                        </script>
                    <?php
                    }
                ?>
              

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $admin_name;?></a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="#">View Profile</a></li>-->
                        <li><a href="admin_change_pass.php">Change Password</a></li>
                        <li><a href="admin_logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<script src="../js_time/js_time.js"></script>
<?php
}
?>
