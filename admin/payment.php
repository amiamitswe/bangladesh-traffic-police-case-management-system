<?php include ("admin_header.php")?>
<?php
    $amount_error = $confirm = "";
    $date = date('Y-m-d');
    $time = date("h:i:sa");
    $police_id = $admin_user_id;
    $case_id_no = $_GET['case_id'];
    $check_amount = $db->find_case_data("driver_owner_details","driver_occurrence_details",$case_id_no);
        $row = $check_amount->fetch_assoc();
            $amount = $row['fine'];
            $confirm = $row['confirm'];
            $owner_name = $row['owner_name'];
            $owner_email = $row['owner_email'];
            $driver_name = $row['driver_name'];
            $car_number = $row['vehicle_no'];
if (isset($_POST['confirm'])) {
    $amount_taka = test_input($_POST['taka']);
    if (empty($amount_taka)){
        $amount_error = "Please Provide Amount";
    }
    elseif (!is_numeric($amount_taka)){
        $amount_error = "Please Provide Number";
    }
    else{
        if($amount != $amount_taka){
            $amount_error = "Amount is not Correct !!!";
        }
        else{
            $insert_amount = $db->insert_amount("payment",$police_id, $case_id_no,$amount_taka,$date,$time);
            if ($insert_amount){
                $update_payment_confirm = $db->update_payment_confirm("driver_occurrence_details",$case_id_no);
                if($update_payment_confirm){
                    
                    // sent mail about payment
                    $Subject = "Case Payment Confirmation :)";
                        $message = "Hello Mr./Mis.: ".$owner_name
                        ."\r\n"."Your are Driver Name : ".$driver_name
                        ."\r\n"."Your Vehicle Number is : ".$car_number
                        ."\r\n"."Your Case Number is : ".base64_decode($case_id_no)
                        ."\r\n"."Your Payable Amount is : ".$amount." Taka"
                        ."\r\n\r\n"."Is Paid SUCCESSFULLY "
                        ."\r\n"."At : ".$time." ".date('d-M-Y',strtotime($date))
                        ."\r\n\r\n"."Please Obey Traffic Low And Help Traffic Police."
                        ."\r\n"."Thank You. :)"; 
                        // police id and password comes from post method, and police user id is auto generatrd here
                        $headers = "From: bd.trafficpolice@gmail.com" . "\r\n";
                        
                        $sentMail =  mail($owner_email,$Subject,$message,$headers); 
                        
                        if($sentMail){ ?>
                            <script>
                                alert('Welcome, Payment Successful ...\n\r Press OK');
                                window.location = "payment_status.php?case_id=<?php echo $case_id_no;?>";
                            </script>
                            
                    <?php  
                
                        }
                        else{
                            $amount_error = "Something Wrong";
                        }
                    
                }
                else{
                    $amount_error = "update_payment_confirm ERROR";
                }
            }
            else{
                $amount_error = "insert_amount ERROR";
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
     <?php if($confirm == 0){?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="text-align: center">Payment Portal</h1>
                        <h3 style="text-align: center; color: darkred">Case ID: <?php echo base64_decode($case_id_no);?></h3>
                        <h2 style="color: red; text-align: center;">Your Payable Amount : <?php echo $amount;?> Taka</h2>
                        
                        <div class="col-md-3"></div>
                        
                        <form action="" method="post" onsubmit="return check_amount()">
                        
                        <div class="col-md-6">
                            <a class="btn-block" href="case_search_result.php?case_id=<?php echo $case_id_no;?>">Go Back</a>
                <hr>
                            <div class="form-group">
                                <label for="">Payable Amount In Taka:</label>&nbsp;&nbsp;<span style="color: red" id="amount_error"></span>
                               
                                <input class="form-control" type="text" id="amount" name="taka" placeholder="Amount in taka" >
                            </div>
                            <div class="form-group">
                                <input class="btn btn-info" type="submit" value="Confirm" name="confirm">&nbsp;&nbsp;&nbsp;
                                
                                <span class="error">* <?php echo $amount_error; ?></span>
                            </div>
                        </div>
                        </form>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        <?php
                    }
                    else{
                        ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 style="text-align: center">Payment Portal</h1>
                                    <h3 style="text-align: center; color: darkred">Case ID: <?php echo base64_decode($case_id_no);?></h3>
                                    <h2 style="color: red; text-align: center;">Your Payable Amount : <?php echo $amount;?> Taka</h2>
                                    <h1 style="text-align: center; color: green">Your Payment Successfully Compleated</h1>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
<?php include ("admin_footer.php")?>