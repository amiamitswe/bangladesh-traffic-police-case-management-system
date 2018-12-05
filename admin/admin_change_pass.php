<?php include("admin_header.php")?>
<?php
    $police_id = $admin_user_id;
    $error_current = $error_new = $error_new_2 = $error_msg = $success_msg = "";
    if(isset($_POST['submit'])){

        if(empty($_POST['current_pass'])){
            $error_current = "Please Provide Current Password";
        }
        elseif (empty($_POST['new_pass'])){
            $error_new = "Please Provide New Password";
        }
        elseif (empty($_POST['confirm_pass'])){
            $error_new_2 = "Please Provide Password Again";
        }
        elseif (strlen($_POST['confirm_pass'])<=5){
            $error_new_2 = "Password at list 6 Character";
        }
        else {
            $current_pass = md5($_POST['current_pass']);
            $new_pass = md5($_POST['new_pass']);
            $confirm_pass = md5($_POST['confirm_pass']);

            if($new_pass !== $confirm_pass){
                $error_msg = "Password Doesn't Match";
            }
            else {
                $check_current_pass = $db->check_current_pass("traffic_police", $police_id, $current_pass);
                if($check_current_pass->num_rows>0){
                    $update_at = date("d.m.Y" . " " . "h:i:s");
                    $change_password = $db->set_new_pass("traffic_police", $police_id, $confirm_pass,$update_at);
                    if($change_password){
                        $success_msg = "Password Changed Successfully";
                    }
                }
                else{
                    $error_msg = "Current Password Is Not Correct";
                }
            }

        }
    }






?>

    <style>
        hr {
            display: block;
            height: 1px;
            border: 0;
            border-top: 2px solid #ccc;
            margin: 1em 0;
            padding: 0;
            background-color: yellow;
        }
    </style>
    <div class="container-fluid" style="background-color: #e9ebee">
        <div class="row">
            <h1 style="text-align: center;">Change Password</h1>
            <div class="col-md-12">
                <h4 style="color: darkred; text-align: center;">New Password Must Be Contain At List 6 Character.</h4>

                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <hr>
                    <form class="form-horizontal" action="" method="post" onsubmit="return validation()">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="current_pass">Current Password:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="current_pass" name="current_pass" placeholder="Current Password">
                            </div>
                            <div class="col-sm-3">
                                <span class="error"><?php echo $error_current; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="new_pass">New Password:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="New Password" >
                            </div>
                            <div class="col-sm-3">
                                <span class="error"><?php echo $error_new;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="confirm_pass">Confirm Password:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Confirm Password" >
                            </div>
                            <div class="col-sm-3">
                                <span class="error"><?php echo $error_new_2;?></span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-info" name="submit">Change Password</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-size: 17px;" class="error"><?php echo $error_msg;?></span>
                                <span style="font-size: 17px;" class="success"><?php echo $success_msg;?></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>

            </div>
        </div>
    </div>
<?php include("admin_footer.php")?>