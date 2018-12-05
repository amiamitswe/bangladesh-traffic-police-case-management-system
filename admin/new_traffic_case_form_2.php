<?php
    include("admin_header.php");
    require_once("new_traffic_case_form_2.php");
?>

<?php
if (!(isset($_SESSION['case_id']))) {?>
    <script>
        window.location = "new_traffic_case_form_1.php";
</script>

<?php }

else {
    // running PHP with session
    ?>


<?php
$error_offence = $error_prove = $error_fine = $image_error = "";
if (isset($_POST['submit'])){
    $case_id = $_SESSION['case_id'];

    $check_email_id = $db->check_email_id("driver_owner_details", $case_id);
    if ($check_email_id->num_rows>0){
        while ($row = $check_email_id->fetch_assoc()) {
            $owner_email = $row['owner_email'];
            $driver_name = $row['driver_name'];
            $driver_mobile = $row['driver_mobile'];
            $owner_name = $row['owner_name'];
            $occurrence_place = $row['occurrence_place'];
            $date = $row['occurrence_date'];
            $time = $row['occurrence_time'];
            $car_no = $row['vehicle_no'];
            $last_date = $row['last_appo_date'];
            $case_id = $row['case_number'];
            
            if ($_FILES['image']['size'] > 512000) {
                $image_error = "File size should not be greater then 400kb";
            }
            elseif (empty($_FILES['image']['size'])){
                $image_error = "Please Provide a img file";
            }
            elseif (empty($_POST['offence'])) {
                $error_offence = "Please Select Offence";
            }
            elseif (empty($_POST['documents'])){
                $error_prove = "Please Select Given Prove";
            }
            elseif (empty($_POST['fine'])){
                $error_fine = "Please Provide Total Amount of Fine";
            }
            else {

                $offence = $_POST['offence'];
                $documents = $_POST['documents'];
                $comments = $_POST['comments'];
                $fine = $_POST['fine'];

                foreach ($offence as $offence_value) {
                    $insert_offence = $db->insert_offence("driver_offence", $case_id, $offence_value);
                    if (!$insert_offence == true) {
                        echo "Offence Sorry";
                    }
                }

                foreach ($documents as $documents_value) {
                    $insert_documents = $db->insert_documents("given_prove", $case_id, $documents_value);
                    if (!$insert_documents == true) {
                        echo "Document Sorry";
                    }
                }


                if (getimagesize($_FILES['image']['tmp_name']) == FALSE) {
                    $image_error =  "Please select an image";
                } else {
                    $image = addslashes($_FILES['image']['tmp_name']);
                    $name = addslashes($_FILES['image']['name']);
                    $image = file_get_contents($image);
                    $image = base64_encode($image);

                    $insert_from_2_data = $db->insert_from_2_data("driver_occurrence_details",$case_id,$fine,$comments, $name, $image);

                    if ($insert_from_2_data == true) {
                        $insert_conform = $db->insert_conform("driver_owner_details", $case_id);

                        if($insert_conform){
                            
                            
                            // email start --------------------------------------------------------------------------
                            //$from_email_name = "Bangladesh Traffic Police";
                            $from_email = 'bd.trafficpolice@gmail.com'; //from mail, it is mandatory with some hosts
                            $subject = "traffic police case";
                            
                            
                            $message = "Hello Mr/Miss. ".$owner_name
                            ."\r\n"."Your Driver Mr/Miss. ".$driver_name
                            ."\r\n"."Driver Mobile No is : +880".$driver_mobile
                            ."\r\n"."Vehicle NO : ".$car_no
                            ."\r\n"."Create some unwanted activities in : ".$occurrence_place
                            ."\r\n"."At Date : ".date('d-M-Y',strtotime($date))." Time : ".$time
                            ."\r\n"."Here Case ID is : ".base64_decode($case_id)
                            ."\r\n"."Last date for case dismiss is : ".date('d-M-Y',strtotime($last_date))
                            ."\r\n\r\n"."You are requested to dismiss the case within the date "
                            ."\r\n"."For more information please contact 0199-99-99999 "
                            ."\r\n"."or contact with nearest traffic Surgeon"
                            ."\r\n"."Thank You ";

                        
                           
                            //Get uploaded file data
                            $file_tmp_name    = $_FILES['image']['tmp_name'];
                            $file_name        = $_FILES['image']['name'];
                            $file_size        = $_FILES['image']['size'];
                            //$file_size        = ($_FILES['image']['size']) / 2;
                            $file_type        = $_FILES['image']['type'];
                            $file_error       = $_FILES['image']['error'];
                        
                            if($file_error > 0)
                            {
                                die('Upload error or No files uploaded');
                            }
                            //read from the uploaded file & base64_encode content for the mail
                            $handle = fopen($file_tmp_name, "r");
                            $content = fread($handle, $file_size);
                            fclose($handle);
                            $encoded_content = chunk_split(base64_encode($content));
                        
                                $boundary = md5("sanwebe");
                                //header
                                $headers = "MIME-Version: 1.0\r\n";
                                $headers .= "From:".$from_email."\r\n";
                                $headers .= "Reply-To: ".$from_email."" . "\r\n";
                                $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";
                               
                                //plain text
                                $body = "--$boundary\r\n";
                                $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
                                $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
                                $body .= chunk_split(base64_encode($message));
                               
                                //attachment
                                $body .= "--$boundary\r\n";
                                $body .="Content-Type: $file_type; name=".$file_name."\r\n";
                                $body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
                                $body .="Content-Transfer-Encoding: base64\r\n";
                                $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n";
                                $body .= $encoded_content;
                           
                            $sentMail = mail($owner_email, $subject, $body, $headers);
                            if($sentMail) //output success or failure messages
                            {      
                                ?>
                            <script>
                                alert('Welcome, Case Insert Success . \n\rCase Number is <?php echo base64_decode($case_id); ?>');
                                window.location = "case_search_result.php?case_id=<?php echo $case_id; ?>";
                            </script>
                            <?php
                            }else{
                                die('Could not send mail! Please check your PHP mail configuration.');  
                            }
                            // email end -----------------------------------------------------------------------
                            unset($_SESSION['case_id']);
                        }
                        else{
                            echo "Sorry";
                        }
                    } else {
                        echo "Image Sorry";
                    }
                }
            }

        }
    }
    else{
        echo "Total sorry";
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
            <h1 style="text-align: center;">New Traffic Case</h1>
            <h2 style="text-align: center; color: #003eff;">Case No: <?php echo base64_decode($_SESSION['case_id']); ?></h2>
            <div class="col-md-12">
                <h3 style="text-align: center">Offence Details</h3>
                
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <hr>
                    <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo $html_check;?>" method="post" onsubmit="return validation_form_2()">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="control-label col-sm-2" id="image_error" for="image">Driver Image:</label><span class="error"><?php echo $image_error;?></span>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                            <hr>
                            <label class="control-label col-sm-2" id="offence_error" for="offence_details">Offence Details:<span class="error">*<br><?php echo $error_offence;?></span></label>

                            <div class="col-sm-5">
                                <?php
                                    $offence_1_8 = $db->offence_1_8("offence");
                                    if ($offence_1_8->num_rows>0){
                                        while ($row = $offence_1_8->fetch_assoc()){?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" id="offence" name="offence[]" class="sum" value="<?php echo $row['law_no'];?>"><?php echo $row['law_details'];?></label>
                                            </div>
                                     <?php   }
                                    }
                                ?>

                            </div>
                            <div class="col-sm-5">
                                <?php
                                $offence_9_16 = $db->offence_9_16("offence");
                                if ($offence_9_16->num_rows>0){
                                    while ($row = $offence_9_16->fetch_assoc()){?>
                                        <div class="checkbox">
                                            <label><input type="checkbox" id="offence" name="offence[]" class="sum" value="<?php echo $row['law_no'];?>"><?php echo $row['law_details'];?></label>
                                        </div>
                                    <?php   }
                                }
                                ?>

                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="submitted_documents">Submitted Documents: <span class="error">*<br><?php echo $error_prove;?></span></label>

                            <div class="col-sm-5">
                                <?php
                                    $prove_1_5 = $db->prove_1_5("proves");
                                    if ($prove_1_5->num_rows>0){
                                        while ($row = $prove_1_5->fetch_assoc()){?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="documents[]" value="<?php echo $row['prove_id'];?>"><?php echo $row['prove_details'];?></label>
                                            </div>
                                    <?php    }
                                    }
                                ?>

                            </div>
                            <div class="col-sm-5">
                                <?php
                                $prove_6_10 = $db->prove_6_10("proves");
                                if ($prove_6_10->num_rows>0){
                                    while ($row = $prove_6_10->fetch_assoc()){?>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="documents[]" value="<?php echo $row['prove_id'];?>"><?php echo $row['prove_details'];?></label>
                                        </div>
                                    <?php    }
                                }
                                ?>

                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comments">Comments</label>
                            <div class="col-sm-9">
                            <textarea name="comments" class="form-control" rows="5" placeholder="Comments Please"></textarea>
                            <span style="color: #a94442; font-size: 17px;">Here are the comments for the driver how create offence.</span>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="fine">Total Fine In Taka: <span class="error">*<?php echo $error_fine;?></span> </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fine" name="fine" readonly="readonly">
                            </div>
                            <div class="col-sm-1"></div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            </div>
                        </div>
                        <div style="color: white;">B</div>
                    <div style="color: white;">B</div>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>

    <script>
        // take checkbox value and add them start
        $(document).ready(function() {
            function updateSum() {
                var total = 0;
                $(".sum:checked").each(function(i, n) {total += parseInt($(n).val());})
                $("#fine").val(total);
            }
            // run the update on every checkbox change and on startup
            $("input.sum").change(updateSum);
            updateSum();
        })
        // take checkbox value and add them stop
    </script>

<?php include("admin_footer.php");?>
