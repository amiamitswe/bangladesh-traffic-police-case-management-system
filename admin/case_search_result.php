<?php include("admin_header.php");?>
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
    $case_id_no = $_GET['case_id'];
    $find_case_data = $db->find_case_data("driver_owner_details","driver_occurrence_details",$case_id_no);
    //var_dump($find_case_data);
    if ($find_case_data->num_rows>0){
        while ($row = $find_case_data->fetch_assoc()){?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="text-align: center; color:brown;">Case ID: <?php echo base64_decode($row['case_number'])?></h1>
                        <hr>
                        <div class="col-md-4">
                            <img style="border-radius: 20%;" width="300" height="300" src="data:image;base64,<?php echo $row['image']?>" alt="Driver Image">
                            <div class="form-group" style="padding-top: 20px;">
                                <div class="col-sm-offset-2 col-sm-10">
                                     <form action="payment.php" method="post">
                                                <?php
                                                if($row['confirm'] == 0){?>
                                                <a class="btn btn-info" href="payment.php?case_id=<?php echo $row['case_number']?>">Payment</a>
                                                <?php    }
                                                else{
                                                    ?>
                                                    <a class="btn btn-info" href="payment_status.php?case_id=<?php echo $row['case_number']?>">Payment Status</a>
                                            <?php    }
                                                ?>
                                                <a class="btn btn-primary" href="case_pdf.php?case_id=<?php echo $row['case_number']?> ">Print</a>
                                        </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td><?php echo $row['driver_name'];?></td>
                                </tr>
                                <tr>
                                    <td>Mobile No:</td>
                                    <td><?php echo "+880".$row['driver_mobile'];?></td>
                                <tr>
                                    <td>Address:</td>
                                    <td><?php echo $row['driver_address'];?></td>
                                </tr>
                                <tr>
                                    <td>Owner Name:</td>
                                    <td><?php echo $row['owner_name'];?></td>
                                </tr>
                                <tr>
                                    <td>Owner Email</td>
                                    <td><?php echo $row['owner_email'];?></td>
                                <tr>
                                    <td>Occurrence Place</td>
                                    <td><?php echo $row['occurrence_place'];?></td>
                                </tr>
                                <tr>
                                    <td>Occurrence Date & Time</td>
                                    <td><?php echo date('d-M-Y',strtotime($row['occurrence_date']))."&nbsp;&nbsp;".$row['occurrence_time'];?></td>
                                </tr>
                                <tr>
                                    <td>Vehicle No:</td>
                                    <td><?php echo $row['vehicle_no'];?></td>
                                </tr>
                                <tr>
                                    <td>Last Date of Hearing:</td>
                                    <td><?php echo date('d-M-Y',strtotime($row['last_appo_date']));?></td>
                                </tr>
                                <tr>
                                    <td>Police Station:</td>
                                    <td><?php echo $row['police_station'];?><a style="text-decoration: none;" href="transfer_case_to_thana.php?case_id=<?php echo $row['case_number']?>">&nbsp;&nbsp;&nbsp;Case Transer To</a></td>
                                </tr>
                                <tr>
                                    <td>Fine:</td>
                                    <td><?php echo $row['fine']." Taka";?></td>
                                </tr>
                                <tr>
                                    <td>Comment:</td>
                                    <td><?php echo $row['comment'];?></td>
                                </tr>
                                <tr>
                                    <td>Case Registered By:</td>
                                    <td style="font-size: 18px;;"><?php echo $row['traffic_police_id'];?></td>
                                </tr>
                                <tr>
                                    <td>Documents & Offences:</td>
                                    <td><a href="driver_offence_and_prove.php?case_id=<?php echo $row['case_number']?>">Click Here</a></td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="color: white;">B</div>
                    <div style="color: white;">B</div>
                        </div>
                    </div>
                </div>
            </div>
    <?php    }
    }
    else{?>
        <div class="container-fluid">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <h1 class="error" style="text-align: center">No Case In this Case Number.</h1>
                </div>
                <div class="form-group">
                    <h2 style="text-align: center; color: #c7254e;">Your Case ID Is Not Correct or Case Is Not Insert Yet.</h2>
                </div>
                <a style="text-decoration: none; font-size: 22px;" href="admin_home.php">Go Back</a>
            </div>
            <div class="col-md-3"></div>

        </div>

  <?php  }
?>

<?php include("admin_footer.php");?>