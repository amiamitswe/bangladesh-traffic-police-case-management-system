<?php
$error_msg = $error_user_id = $error_email = "";
$user_id = "";
include('include/config.php');
include('include/security.php');
$db = new Admin_Database();
?>
<?php

if (isset($_POST['submit'])){
    $user_id = test_input($_POST['user_id']);
    $user_email = test_input($_POST['email']);
    if (empty($user_id)){
        $error_user_id = "Provide Correct UserID";
    }
    elseif (empty($user_email)){
        $error_email = "Provide User Email ID";
    }
    else{
        $check_reset_value = $db->check_reset_value("traffic_police", $user_id, $user_email);

        if($check_reset_value->num_rows > 0){
            $row = $check_reset_value->fetch_assoc();
            $email = $row['email_id'];
            $name = $row['full_name'];
            // function for new password
            function reset_pass() {
                $alphabet = "wxyla0mb1nc2od3pe4qf5rg6sh7ti8uj9vzk";
                $pass = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 6; $i++) { // here 6 is for password digit
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                }
                return implode($pass); //turn the array into a string
            }
            $new_pass = reset_pass(); // New Password
            $new_pass_md5 = md5($new_pass);
            $update_at = date("d.m.Y" . " " . "h:i:s");
            // insert new password
            $set_new_reset_pass = $db->set_new_pass("traffic_police", $user_id, $new_pass_md5,$update_at);
            if($set_new_reset_pass){


                // email sent with id
                $Subject = "New Traffic Police Reset Password :)";
                $message = "Hello Mr./Miss. ".$name."\r\n"
                    ."\r\n"."Your Traffic Police User ID is : ".$user_id
                    ."\r\n"."Your Password is Reset Successfully."
                    ."\r\n"."Your Current Password is : ".$new_pass
                    ."\r\n\r\n"."Please Change Your Password After login..."
                    ."\r\n"."Thank You. :)";
                // police id and Name comes from Database, and new password is auto generate here
                $headers = "From: bd.trafficpolice@gmail.com" . "\r\n";

                $sentMail =  mail($email,$Subject,$message,$headers);

                if($sentMail){ ?>
                    <script>
                        alert("Please Check Your Email ....");
                        window.location = "index.php";
                    </script>

                    <?php

                }
                else{
                    $error_msg = "Something WrongcWith Mail";
                }
            }
            else{
                $error_msg = "Something Wrong";
            }
        }
        else{
            $error_msg = "User ID Or Email is Not Correct";
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
                <a class="navbar-brand" href="../index.php">Bangladesh Traffic Police</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Login</a></li>
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
            <h2 style="text-align: center; color: #419641">Traffic Police Reset Password</h2>
            <form action="<?php echo $html_check;?>" method="post" onsubmit="return admin_login_validation()" autocomplete="on">
                <div class="form-group">
                    <label for="username">Traffic Police Use ID:</label><span class="error" id="user_id_alert">&nbsp;&nbsp;<?php echo $error_user_id;?></span>
                    <input type="number" class="form-control" id="user_id" placeholder="Enter Traffic Use ID" name="user_id" value="<?php echo $user_id?>" onfocusout="check_user_id()" autofocus>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label><span class="error" id="email_alert">&nbsp;&nbsp;<?php echo $error_email;?></span>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email ID" name="email" onfocusout="check_email()">
                </div>
                <button type="submit" class="btn btn-success" name="submit">Reset</button>
                <a style="text-decoration: none;" href="index.php">&nbsp;&nbsp;Login Here</a>
                <span class="error">&nbsp;&nbsp;<?php echo $error_msg;?></span>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<script src="../js_time/js_time.js"></script>

<div style="margin-top: 510px">
    <div style="text-align: center; background-color: gray;" class="well well-sm">Bangladesh Police &copy; 2018</div>
</div>


</body>
</html>