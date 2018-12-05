<?php
    $error_msg = "";
    include('include/config.php');
    include('include/security.php');
    $db = new C_Database();
    session_start();
?>
<?php
    if (isset($_POST['submit'])) {
        $username = test_input($_POST['username']);
        $pass = test_input($_POST['pwd']);

        $c_panel_login = $db->c_panel_login($username, $pass, "c_panel_user");
        if ($c_panel_login->num_rows>0) {
            while ($row=$c_panel_login->fetch_assoc()) {
                 $_SESSION['idno'] = $row['id'];
                 $_SESSION['name'] = $row['name'];
                 $_SESSION['username'] = $row['username'];

                header('Location:c_panel_home.php');

                }
        }
        else{
            $error_msg = "Username or Password Doesn't Match !!!";
        }
    }

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
        <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
        <script type="text/javascript" language="JavaScript" src="include/action.js">

        </script>
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
                <div class="col-sm-4" style="background-color:lavender; margin-top: 65px; padding-bottom: 15px;">
                    <h2 style="text-align: center; color: #2aabd2;">Traffic Police Admin Panel Login</h2>
                    <form action="<?php echo $html_check;?>" method="post" onsubmit="return c_panel_login_validation()" autocomplete="off">
                        <div class="form-group">
                            <label for="username">Username:</label> <span class="error"  id="username_alert"></span>
                            <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" onfocusout="check_username()" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label> <span class="error" id="pass_alert"></span>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" onfocusout="check_password()">
                        </div>

                        <button type="submit" class="btn btn-default" name="submit">Login</button>
                        <span class="error">
                            <strong class="error"><?php echo $error_msg;?></strong>
                        </span>
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