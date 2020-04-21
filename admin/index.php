<?php
    $error_msg = $error_user_id = $error_pass = "";
    $user_id = "";
    include('include/config.php');
    include('include/security.php');
    $db = new Admin_Database();
    session_start();
?>
<?php

    if (isset($_POST['submit'])){
        $user_id = test_input($_POST['user_id']);

        if (empty($user_id)){
            $error_user_id = "Provide Correct UserID";
        }
        elseif (empty($_POST['pwd'])){
            $error_pass = "Provide Password";
        }
        else{
            $password = test_input(md5($_POST['pwd'])); // cehek password in md5
           
            $admin_login_check = $db->admin_login_check("traffic_police", $user_id, $password);
            if ($admin_login_check->num_rows>0){
                while ($row = $admin_login_check->fetch_assoc()){
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_name'] = $row['full_name'];
                    $_SESSION['user_id'] = $row['police_user_id'];

                    header('Location:admin_home.php');
                }
            }
            else{
                $error_msg = "UserID or Password Doesn't Match !!!";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Traffic Police Admin Panel</title>
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
<nav class="navbar custom-nav navbar-inverse" style="margin-bottom: auto; background-color: #122b40">
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
                <a class="navbar-brand" href="../index.php">Bangladesh Traffic Police</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="../index.php">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href=""><span id="txt" style="font-size: 1.5em;"></span></a href=""></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-sm-4" style="background-color:lavender; margin-top: 35px; padding-bottom: 15px;">
            <h2 style="text-align: center; color: #419641">Traffic Police User Login</h2>
            <form action="<?php echo $html_check;?>" method="post" onsubmit="return admin_login_validation()" autocomplete="on">
                <div class="form-group">
                    <label for="username">Traffic Police Use ID:</label><span class="error" id="user_id_alert">&nbsp;&nbsp;<?php echo $error_user_id;?></span>
                    <input type="number" class="form-control" id="user_id" placeholder="Enter Traffic Use ID" name="user_id" value="<?php echo $user_id?>" onfocusout="check_user_id()" autofocus>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label><span class="error" id="pass_alert">&nbsp;&nbsp;<?php echo $error_pass;?></span>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" onfocusout="check_password()">
                </div>
                <button type="submit" class="btn btn-success" name="submit">Login</button>
                <a style="text-decoration: none;" href="admin_forgot_pass.php">&nbsp;&nbsp;Forgot Password</a>
                <span class="error">&nbsp;&nbsp;<?php echo $error_msg;?></span>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<script src="../js_time/js_time.js"></script>

<div style="position: fixed; left: 0; bottom: 0; width: 100%; margin-bottom: -20px; "> 
        <div style="text-align: center; background-color: gray;" class="well well-sm">Bangladesh Police &copy; 2018</div>
    </div>


</body>
</html>