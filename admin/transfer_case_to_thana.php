<?php include ("admin_header.php")?>
<?php
    $transfer_error = "";
    $police_id = $admin_user_id;
    $case_id_no = $_GET['case_id'];
    
    $case_confrom = $db->case_confrom("driver_owner_details",$case_id_no);
    if($case_confrom->num_rows>0){
        $row = $case_confrom->fetch_assoc();
            $owner_name = $row['owner_name'];
            $owner_email = $row['owner_email'];
            $vehicle_no = $row['vehicle_no'];
            $police_station = $row['police_station'];
                if (isset($_POST['confirm'])) {
                $case_transfer = test_input($_POST['case_transfer']);
                if (empty($case_transfer)){
                    $transfer_error = "Please Provide Police Station Name";
                }
                elseif (is_numeric($case_transfer)){
                    $transfer_error = "Please Provide Text";
                }
                else{
                        $update_police_station = $db->update_police_station("driver_owner_details", $case_id_no,$case_transfer);
                        if ($update_police_station){
                            
                            
                            
                            // email sent with id

                        $Subject = "Case Transfer Notifications :)";
                        $message = "Hello Mr./Mis.: ".$owner_name
                        ."\r\n"."The Case ID : ".base64_decode($case_id_no)
                        ."\r\n"."Aginst your Vehcle Number : ".$vehicle_no
                        ."\r\n"."Is Transferred Into New Police Station"
                        ."\r\n\n\r"."Your Previous Police station Was : ".$police_station
                        ."\r\n"."Your Current Police station Is : ".$case_transfer
                        ."\r\n"."Please Contact With : ".$case_transfer." Police Station."
                        ."\r\n\r\n"."Please Obey Traffic Low And Help Traffic Police"
                        ."\r\n"."Thank You. :)"; 
                        // police id and password comes from post method, and police user id is auto generatrd here
                        $headers = "From: bd.trafficpolice@gmail.com" . "\r\n";
                        
                        $sentMail =  mail($owner_email,$Subject,$message,$headers); 
                        
                         if($sentMail){ ?>
                            <script>
                                alert("Case ID: <?php echo $case_id_no;?> Transfer Successfully Done. \n\r Press OK");
                                window.location = "case_search_result.php?case_id=<?php echo $case_id_no;?>";
                            </script>
                            
                    <?php    
                
                        }
                        else{
                            echo "Something Wrong";
                        }
                        }
                    else{
                        $transfer_error = "insert_amount ERROR";
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 style="text-align: center">Transfer Case Portal</h1>
            <h3 style="text-align: center; color: darkred">Case ID: <?php echo base64_decode($case_id_no);?></h3>
            <h2 style="color: red; text-align: center;">Your Current Police Station : <?php echo $police_station;?></h2>
            
            
            <form action="" method="post" onsubmit="return check_thana()">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <a class="btn-block" href="case_search_result.php?case_id=<?php echo $case_id_no;?>">Go Back</a>
                <hr>
                <div class="form-group">
                    <label for="">Case Transfer To:</label>&nbsp;&nbsp;<span style="color: red" id="transfer_error"></span>
                    <input class="form-control" type="text" id="case_transfer" name="case_transfer" placeholder="Case Transfer To New PoliceStation" >
                </div>
                <div class="form-group">
                    <input class="btn btn-info" type="submit" value="Transfer To" name="confirm">&nbsp;&nbsp;&nbsp;
                    <span class="error">* <?php echo $transfer_error; ?></span>
                </div>
            </div>
            </form>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
<?php
}
?>
<?php include ("admin_footer.php")?>