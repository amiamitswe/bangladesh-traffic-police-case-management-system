<?php require("admin_header.php");?>
    <div class="container-fluid" style="background-color: #e9ebee">
        <div class="row">
            <div class="col-md-12" style="margin-top: 20px">
                <div class="col-md-3"></div>
                <div class="col-md-2">
                    <img src="images/logo.png" class="admin-home-logo">
                </div>
                <div class="col-md-6">
                    <h1 class="admin-home-title">Bangladesh Traffic Police</h1>
                </div>
                <div class="col-md-1"></div>
            </div>
    <?php
        $see_user_details = $db->see_user_details("traffic_police", $admin_user_id);
        if($see_user_details->num_rows>0){
        $row = $see_user_details->fetch_assoc();
        ?>

            <div class="col-md-2" style=""></div>
                <div class="col-md-8">
                    <hr>
                    <marquee><h4 style="color: green">Bangladesh Traffic Police Case System Online &copy; 2018 == বাংলাদেশ ট্রাফিক পুলিশ কেচ সিস্টেম অনলাইন &copy; ২০১৮ </h4></marquee>
                    <div class="admin-home-content-details row">
                        <div class="col-md-6" >
                            <h1 style="text-align: center;color: #2b669a">Your Information Details</h1>
                            <h3>User ID : <?php echo $admin_user_id;?></h3>
                            <h3>Police ID : <?php echo $row['police_id_no'];?></h3>
                            <h3>Name : <?php echo $row['full_name'];?></h3>
                            <h3>Email ID : <?php echo $row['email_id'];?></h3>
                            <h3>Mobile No : <?php echo "+880".$row['phone_number'];?></h3>
                            <h3>Registered at : <?php echo $row['save_date'];?></h3>
                            <h3>Update At : <?php echo $row['update_on_date'];?></h3>
                        </div>
                        <?php
                        // for total registered case
                            $total_register_case = $db->total_register_case("driver_owner_details", $admin_user_id);
                            if($total_register_case->num_rows>0){
                                $row = $total_register_case->fetch_assoc();
                                $count = $row['ides'];
                            }
                            else{
                                $count = 0;
                            }
                        // for total paid case
                            $total_paid_case = $db->total_paid_case("driver_owner_details","driver_occurrence_details",$admin_user_id);
                            if($total_paid_case->num_rows>0){
                                $row = $total_paid_case->fetch_assoc();
                                $paid_case = $row['paid_case'];
                            }
                            else{
                                $paid_case = 0;
                            }
                        // for total pending case
                            $total_pending_case = $db->total_pending_case("driver_owner_details","driver_occurrence_details",$admin_user_id);
                            if($total_pending_case->num_rows>0){
                                $row = $total_pending_case->fetch_assoc();
                                $pending_case = $row['pending_case'];
                            }
                            else{
                                $pending_case = 0;
                            }
                        // for total Received amount from case
                            $amount_received_from_case = $db->amount_received_from_case("payment", $admin_user_id);
                            if($amount_received_from_case->num_rows>0){
                                $row = $amount_received_from_case->fetch_assoc();
                                $total_received_case = $row['total_received_case'];
                            }
                            else{
                                $total_received_case = 0;
                            }

                        // total received amount
                            $take_amount_received = $db->take_amount_received("payment", $admin_user_id);
                            if($take_amount_received->num_rows>0){
                                $received_taka = 0;
                                while ($row = $take_amount_received->fetch_assoc()){
                                    $received_taka += $row['amount'];
                                }
                            }
                            else{
                                $received_taka = 0;
                            }

                        // total paid amount
                            $total_paid_amount = $db->total_paid_amount("payment", $admin_user_id);
                            if($total_paid_amount->num_rows>0){
                                $paid_taka = 0;
                                while ($row = $total_paid_amount->fetch_assoc()){
                                    $paid_taka += $row['amount'];
                                }
                            }
                            else{
                                $paid_taka = 0;
                            }
                        ?>
                        <div class="col-md-6">
                            <h1 style="text-align: center;color: #2b669a">Your Case Details</h1>
                            <h3>Total Registered Case : <?php echo $count;?></h3>
                            <h3>Total Case Paid : <?php echo $paid_case;?></h3>
                            <h3>Total Case Pending : <?php echo $pending_case;?></h3>
                            <h3>Received Amount From Case: <?php echo $total_received_case;?></h3>
                            <h3>Total Received Amount : <?php echo $received_taka." Taka";?></h3>
                            <h3>Total Paid Amount : <?php echo $paid_taka." Taka";?></h3>
                            <h3>Total Due : <?php echo ($received_taka - $paid_taka)." Taka";?></h3>
                        </div>
                        </div>
                        
                        <div class="well well-lg admin-home-police-info row">
                            <h3 style="margin-top: 5px;">About Bangladesh Police</h3>
                            The Bangladesh Police (Bengali: বাংলাদেশ পুলিশ) is the main law enforcement agency of Bangladesh. It is administered under the Ministry of Home Affairs[4] of the Government of Bangladesh. It plays a crucial role in maintaining peace, and enforcement of law and order within Bangladesh. Though the police are primarily concerned with the maintenance of law and order and security of persons and property of individuals, they also play a big role in the criminal justice system.
                            <a href="https://en.wikipedia.org/wiki/Bangladesh_Police" target="_blank">Bangladesh Police Click Here</a>
                        </div>
                    </div>
                <br>
  
            <?php
        }
    ?>
    </div>
</div>
<?php require("admin_footer.php");?>