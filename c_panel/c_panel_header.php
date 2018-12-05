<?php
    require('include/config.php');
    include('include/security.php');
    $db = new C_Database();
    session_start();
?>
<?php
if (!(isset($_SESSION['idno']))  AND !(isset($_SESSION['name'])) AND !(isset($_SESSION['username']))) {
    header("location:c_panel_login.php");
    exit;
}
else {
    $c_id = $_SESSION['idno'];
    $c_name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Traffic Police C Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="include/style.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="include/action.js"></script>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
</head>
<body onload="startTime()">
<nav class="navbar navbar-inverse" style="margin-bottom: auto; background-color: #122b40;">
    <div class="container-fluid" style="">
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
                <a class="navbar-brand" href="c_panel_home.php">BTPCSO</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="c_panel_home.php">Home</a></li>
                <!--<li class="dropdown">-->
                <!--    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Police <span class="caret"></span></a>-->
                <!--    <ul class="dropdown-menu" style="background-color: ">-->
                <!--        <li><a href="#">All Traffic Police</a></li>-->
                        <!--<li><a href="#">new</a></li>-->
                        <!--<li><a href="#">new</a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                <?php
                $see_new_claims = $db->see_new_claims("victims_claim");
                if($see_new_claims->num_rows>0) {
                    ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle " style="color: mediumvioletred" data-toggle="dropdown" href="#">Claims <span
                                    class="caret "></span></a>
                        <ul class="dropdown-menu" style="background-color: ">
                            <li><a style="color: mediumvioletred" href="see_new_claims.php"><span class="glyphicon glyphicon-globe"> New Claims</span></a></li>
                            <li><a href="see_all_claims.php">All Claims</a></li>
                        </ul>
                    </li>
                    <?php
                }
                else{
                    ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Claims <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" style="background-color: ">
<!--                            <li><a href="see_new_claims.php">New Claims</a></li>-->
                            <li><a href="see_all_claims.php">All Claims</a></li>
                        </ul>
                    </li>
                <?php    }
                ?>
                <!--<li><a href="#">Traffic Cases</a></li>-->
                <li><a href="take_payment.php">Take Payment</a></li>
                <li><a href="c_panel_new_police_register.php">Traffic Police Register</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href=""><span id="txt" style="font-size: 1.5em;"></span></a href=""></li>
                <li>
                    <div style="padding-top: 9px;">
                        <form class="form-inline" action="#" method="post">
                            <input class="form-control" type="text" name="search" placeholder="Search ..." required>
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </form>
                    </div>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $c_name;?></a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="#">View Profile</a></li>-->
                        <!--<li><a href="#">Edit Profile</a></li>-->
                        <!--<li><a href="#">Change Password</a></li>-->
                        <li><a href="c_panel_logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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
