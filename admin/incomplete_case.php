<?php include("admin_header.php");?>
<?php
    $error_msg = $error_output = "";
    if (isset($_POST['submit'])){
        $case = test_input(strtoupper($_POST['case_id']));
        if (empty($case)){
            $error_msg = "Please Provide Case ID";
        }
        elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",$case)) {
            $error_msg = "PLS Provide Valid Case ID";
        }
        else{
            $case_id = base64_encode($case);
            $check_case_id_form_db = $db->check_case_id_form_db("driver_owner_details",$case_id);
            if ($check_case_id_form_db->num_rows>0){
                $_SESSION['case_id'] = $case_id; ?>
                <script>
                    window.location = "new_traffic_case_form_2.php";
                </script>
            <?php }
            else{
                $error_output = "Your Case ID is Wrong Or Complete";
            }
        }
    }
?>
<div class="container-fluid" style="background-color: #e9ebee; height: 815px;">
    <div class="row">
        <h1 style="text-align: center;">Incomplete Traffic Case</h1>
        <p style="text-align: center; color: red; font-size: 20px;">Please Provide Incomplete Case ID no.</p>
        <div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-7">
                <form class="form-horizontal" action="<?php echo $html_check;?>" method="post" onsubmit="return validation_incomplete_case()">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="case_id">Case ID NO:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="case_id" name="case_id" placeholder="Enter Case ID number..." onfocusout="check_case_id_hover()" autofocus>
                    </div>
                    <div class="col-sm-3">
                        <span class="error" id="case_id_error"> <?php echo $error_msg;?></span>
                    </div>
                </div>
                <div class="form-group" >
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="submit">Submit</button>
                        &nbsp;&nbsp;<span class="error"><?php echo $error_output;?></span>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<?php include("admin_footer.php");?>
