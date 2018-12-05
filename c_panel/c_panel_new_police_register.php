<?php require("c_panel_header.php");?>


<?php
    $name = $email = $number = $police_id = $success = "";
    $error_msg = $error_name = $error_email = $error_number = $error_p_id = $err_pass1 = $err_pass2 = "";
    if (isset($_POST['submit'])) {
        $name = test_input($_POST['full_name']);
        $email = test_input($_POST['email']);
        $number = test_input($_POST['number']);
        $police_id = test_input($_POST['police_id']);
        $police_user_id = (rand(100000, 1000000));
        $save_at = date("d.m.Y" . " " . "h:i:sa");
        $update_at = date("d.m.Y" . " " . "h:i:sa");

        if (empty($name)) {
            $error_name = "Name is Required";
        }

        elseif (empty($email)){
            $error_email = "Email is Required";
        }

        elseif (empty($number)){
            $error_number = "Number is Required";
        }
        elseif (empty($police_id)){
            $error_p_id = "Police ID is Required";
        }
        if (empty($_POST['password'])){
            $err_pass1 = "Password is Required";
        }
        if (empty($_POST['password2'])){
            $err_pass2 = "Password Required Again";
        }
        //---------------------------------------------------------
        // name validation
        //---------------------------------------------------------
        elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $error_name = "Only letters and white space allowed";
        }
        //---------------------------------------------------------
        // email validation
        //---------------------------------------------------------
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_email = "Invalid email format";
        }
        //----------------------------------------------------
        // password length check
        //----------------------------------------------------
        elseif (strlen($_POST['password2'])<=5){
            $err_pass1 = "Password at list 6 Character";
        }
        else {
            $password = md5($_POST['password']);
            $password2 = md5($_POST['password2']);
            // password match
            if ($password != $password2) {
                $error_msg = "Password doesn't match !!!";
            } else {
                //$pass = md5($password);
                $check_data = $db->check_old_data("traffic_police", $email, $police_id, $police_user_id);
                if ($check_data->num_rows > 0) {
                    $error_msg = "Email or User id Already Exist !!!";
                } else {
                    $insert_new_police = $db->new_insert("traffic_police", $name, $email, $number, $police_id, $police_user_id, $password, $save_at, $update_at);
                
                    if ($insert_new_police == true) {


                        // email sent with id

                        $Subject = "New Traffic Police ID :)";
                        $message = "Hello ".$name."\r\n"."Welcome to Bangladesh Traffic Police Case Online System."
                        ."\r\n"."You are Appointed as a Traffic Surgeon."
                        ."\r\n\r\n"."Your Bangladesh Police ID is : ".$police_id
                        ."\r\n"."Your New Traffic Police ID is : ".$police_user_id
                        ."\r\n"."Your Password is : ".$_POST['password']
                        ."\r\n\r\n"."Please Change Your Password After First login..."
                        ."\r\n"."Thank You. :)"; 
                        // police id and password comes from post method, and police user id is auto generatrd here
                        $headers = "From: bd.trafficpolice@gmail.com" . "\r\n";
                        
                        $sentMail =  mail($email,$Subject,$message,$headers); 
                        
                        if($sentMail){ ?>
                            <script>
                                alert("Welcome !\nYour New Traffic Surgeon Registration Success ....");
                                window.location = "c_panel_home.php";
                            </script>
                            
                    <?php  
                
                        }
                        else{
                            echo "Something Wrong";
                        }
                    } else {
                        echo "sorry";
                    }
                }
            }
        }
    }
?>


<div class="container-fluid" style="background-color: #e9ebee; height: 815px;">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1 style="text-align: center;">New Traffic Police Registration</h1>
                <p class="error" style="text-align: center; font-size: 20px;">* All section are Required. </p>
                <p style="font-size: 22px; color: green; text-align: center;"><?php echo $success;?></p>
                <hr>
                <form class="form-horizontal" method="post" action="<?php echo $html_check;?>" onsubmit="return new_police_validation()" autocomplete="on">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="full_name">Full Name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $name;?>" placeholder="Enter Full Name" onfocusout="check_name()" autofocus>
                        </div>
                        <div class="col-md-3">
                            <span class="error" id="name_alert">* <?php echo $error_name;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Email:</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>" placeholder="Enter email" onfocusout="check_email()">
                        </div>
                        <div class="col-md-3">
                            <span class="error" id="email_alert">* <?php echo $error_email;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="number">Mobile NO:</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="number" name="number" value="<?php echo $number;?>" placeholder="Enter Mobile No" onfocusout="check_number()">
                        </div>
                        <div class="col-md-3">
                            <span class="error" id="number_alert">* <?php echo $error_number;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="police_id">Police ID No:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="police_id" name="police_id" value="<?php echo $police_id;?>" placeholder="Enter Police ID No" onfocusout="check_p_id()">
                        </div>
                        <div class="col-md-3">
                            <span class="error" id="police_id_alert">* <?php echo $error_p_id?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="password">Password:</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" onfocusout="check_pass1()">
                        </div>
                        <div class="col-md-3">
                            <span class="error" id="password_alert">* <?php echo $err_pass1;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="password2">Password Again:</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Enter Password Again" onfocusout="check_pass2()">
                        </div>
                        <div class="col-md-3">
                            <span class="error" id="password2_alert">* <?php echo $err_pass2;?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            <span class="error">&nbsp;&nbsp;<?php echo $error_msg?></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<?php require("c_panel_footer.php");?>
