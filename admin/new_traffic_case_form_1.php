<?php include("admin_header.php");?>
<!--jequery scripr for datepicker start-->

<script>
    $( function() {
        $( "#next_appo_date" ).datepicker({ dateFormat: 'dd-M-yy', minDate: '+2m', maxDate: '+3m'});
    } );
</script>
<!--jequery scripr for datepicker end-->
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
<?php
$d_name_error = $d_address_error = $d_mobile_error = $owner_n_error = $owner_mail_error = $car_no_error = $division_error = $place_error =$police_station_error = $appo_date_error = $vehicle_check_error = "";
$driver_name = $driver_address = $driver_mobile = $owner_name = $owner_email = $car_no = $occurrence_place = $police_station = $appointment_date = "";
if (isset($_POST['continue'])){

    //traffic police user id-------------------------------------------------------
    $police_id = $admin_user_id;

    //user id comes from session---------------------------------------------------
    $driver_name = test_input($_POST['driver_name']);
    $driver_address = test_input($_POST['d_address']);
    $driver_mobile = test_input($_POST['d_mobile']);
    $owner_name = test_input($_POST['owner_name']);
    $owner_email = test_input($_POST['owner_email']);
    $car_no = strtoupper(test_input($_POST['vehicle_no']));
    $division = test_input($_POST['division']);
    $occurrence_place = test_input($_POST['occurrence_place']);
    $address = $occurrence_place.", ".$division;
    $police_station = test_input($_POST['police_station']);
    // $appointment_date = test_input($_POST['next_appo_date']);
    $next_date = strtotime(test_input($_POST['next_appo_date']));
    $appointment_date = date("Y-m-d", $next_date);
    //--------------------------------------------------------------------------
    // end of generate random password
    function case_id() {
        $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) { // here 6 is for password degite
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    $case = case_id(); // case id
    $case_number = base64_encode($case);

    // end of generate random password
    //----------------------------------------------------------------------------

    //date and time start
    $date = date('Y-m-d');
    // $date = date("d-M-Y");
    $time = date("h:i:sa");
    //echo $date;
    //date and time end


    if (empty($driver_name)){
        $d_name_error = "Driver Name is Required";
    }
    //---------------------------------------------------------
    // name validation
    //---------------------------------------------------------
    elseif (!preg_match("/^[a-zA-Z ]*$/",$driver_name)) {
        $d_name_error = "Only letters and white space allowed";
    }
    elseif (empty($driver_address)){
        $d_address_error = "Driver Address is Required";
    }
    elseif (empty($driver_mobile)){
        $d_mobile_error = "Driver Mobile no is Required";
    }
    elseif (empty($owner_name)){
        $owner_n_error = "Owner Name is Required";
    }
    elseif (empty($owner_email)){
        $owner_mail_error = "Owner Email is Required";
    }
    //---------------------------------------------------------
    // email validation
    //---------------------------------------------------------
    elseif (!filter_var($owner_email, FILTER_VALIDATE_EMAIL)) {
        $owner_mail_error = "Invalid email format";
    }
    elseif (empty($car_no)){
        $car_no_error = "Vehicle No is Required";
    }
    elseif (empty($division)){
        $division_error = "Please Select Division";
    }
    elseif (empty($occurrence_place)){
        $place_error = "Occurrence Place is Required";
    }
    elseif (empty($police_station)){
        $police_station_error = "Police Station is Required";
    }
    elseif (empty($appointment_date)){
        $appo_date_error = "Next Date is Required";
    }
    else {
        $check_vehicle_value = $db->check_vehicle_value("driver_owner_details","driver_occurrence_details",$car_no);
        if($check_vehicle_value->num_rows > 0){
            $row = $check_vehicle_value->fetch_assoc();
            $case_number = base64_encode($row['case_number']);
            $vehicle_check_error = '<a class="error" href="case_search_result.php?case_id='.$case_number.'">You Have an Incomplete case </a> ';
        }
        else{

        $insert_from_1_data = $db->insert_from_1_data("driver_owner_details",$case_number,$police_id,$driver_name,$driver_address,$driver_mobile,$owner_name,$owner_email,$car_no,$address,$date,$time,$police_station,$appointment_date);
        //var_dump($insert_from_1_data);
        if ($insert_from_1_data == true){
            $_SESSION['case_id'] = $case_number;
           // header("location:new_traffic_case_form_2.php?caseid=$pass");?>
            <script>
                alert("Your Cae ID is : <?php echo $case;?> \n\rContinue... \n\r Press OK")
                window.location = "new_traffic_case_form_2.php";
            </script>
    <?php    }
        else{
            echo "Sorry";
        }
        }

    }


}
?>
<div class="container-fluid">
    <div class="row">
        <h1 style="text-align: center;">New Traffic Case</h1>
        <div class="col-sm-12">
            <p style="text-align: center; font-size: 25px;">Driver Owner Details</p>
            <p style="text-align: center" class="error"> All * Field is Required!</p>
            
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <hr>
                <form class="form-horizontal" action="<?php echo $html_check;?>" method="post" onsubmit="return validation()">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="driver_name">Driver Name:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Enter Driver Full Name" value="<?php echo $driver_name?>" >
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $d_name_error; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="d_address">Driver Address:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="d_address" name="d_address" placeholder="Enter Driver Address" value="<?php echo $driver_address?>">
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $d_address_error; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="d_mobile">Driver Mobile No:</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="d_mobile" name="d_mobile" placeholder="Enter Driver Mobile No" value="<?php echo $driver_mobile?>">
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $d_mobile_error; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Owner_name">Owner Name:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Enter Owner Full Name" value="<?php echo $owner_name?>">
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $owner_n_error; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="owner_email">Owner Email:</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" id="owner_email" name="owner_email" placeholder="aaaaaaaaa@gmail.com" value="<?php echo $owner_email?>">
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $owner_mail_error; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="vehicle_no">Vehicle No:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" placeholder="Enter Vehicle No" value="<?php echo $car_no?>">
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $car_no_error; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-sm-2" for="division">Select Division:</label>
                        <div class="col-sm-7">
                        <select class="form-control" id="division" name="division">
                            <option></option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Sylhet">Sylhet</option>
                        </select>
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $division_error; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="occurrence_place">Occurrence Place:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="occurrence_place" name="occurrence_place" placeholder="Occurrence Place" value="<?php echo $occurrence_place?>">
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $place_error; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="police_station">Police Station:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="police_station" name="police_station" placeholder="Police Station" value="<?php echo $police_station?>">
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $police_station_error; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="next_appo_date">Last Date Of Case Hearing:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="next_appo_date" name="next_appo_date" placeholder="Last Date Of Case Hearing" value="<?php echo $appointment_date?>">
                        </div>
                        <div class="col-sm-3">
                            <span class="error">* <?php echo $appo_date_error; ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default" name="continue">Continue</button>
                            &nbsp;&nbsp;&nbsp;
                            <span class="error"><?php echo $vehicle_check_error; ?></span>
                        </div>
                    </div>
                    <div style="color: white;">B</div>
                    <div style="color: white;">B</div>
                </form>
            </div>
            <div class="col-sm-2"></div>

        </div>
    </div>
</div>
<?php include("admin_footer.php");?>
