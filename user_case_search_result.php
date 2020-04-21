<!doctype html>
<html lang="en">
<head>
    <title>Bangladesh Traffic Police</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon"/>
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

        .custom-nav {
            border-radius: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar custom-nav navbar-inverse" style="margin-bottom: auto; background-color: #122b40; ">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img style="border-radius: 10px; height: 52px; width: 144px;" src="admin/images/logo__.png" alt="Bangladesh Police">
                &nbsp; &nbsp;&nbsp;
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Bangladesh Traffic Police</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                </ul>
                <ul>
                    <li>
                    <div style="padding-top: 9px; float: right;">
                        <form class="form-inline" action="" method="post">
                            <input class="form-control" type="text" name="search" placeholder="Search ..." required>
                             
                            <button type="submit" name="search_btn" class="btn btn-default" onsubmit="asa()">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </form>
                    </div>
                </li>
                <?php
                    // check for html input
                    function test_input($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                        if(isset($_POST['search_btn'])){
                            $case_id = test_input(strtoupper($_POST['search']));
                            ?>
                                <script>
                                    window.location = "user_case_search_result.php?caseno=<?php echo base64_encode($case_id);?>";
                                </script>      
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
        require("need/database.php");
        $db = new Vioctim_Database();
        $case_id = $_GET['caseno'];
        $case_details_for_victim = $db->case_details_for_victim("driver_owner_details","driver_occurrence_details",$case_id);
        if($case_details_for_victim->num_rows>0){
            $row = $case_details_for_victim->fetch_assoc();?>
       
    <div class="container-fluid" style="height: 815px;">
        <div class="row">
            <div class="col-md-12">
                <h1 style="text-align: center; color:brown;">Case ID: <?php echo base64_decode($case_id);?></h1>
                <?php
                    if($row['confirm'] == 1){?>
                        <h2 style="color: green; text-align: center;">Payment Complete</h2>
                   <?php     
                    }
                    else{
                       ?>
                        <h2 style="color: red; text-align: center;">Payment Incomplete</h2>
                   <?php 
                    }
                ?>
                
                <hr>
                <div class="col-md-4">
                    <img style="border-radius: 20%;" src="images/Capture.JPG" alt="Driver Image">
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
                            <td><?php echo date('d-M-Y',strtotime($row['occurrence_date']))."   ".$row['occurrence_time'];?></td>
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
                            <td><?php echo $row['police_station'];?></td>
                        </tr>
                        <tr>
                            <td>Registered By:</td>
                            <td><?php echo $row['traffic_police_id'];?></td>
                        </tr>
                        <tr>
                            <td>Fine:</td>
                            <td><?php echo $row['fine']." Taka";?></td>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                            <td><?php echo $row['comment'];?></td>
                        </tr>
                        <tr>
                            <td>Offences & Documents:</td>
                            <td><a href="victim_offence_and_prove.php?caseno=<?php echo $row['case_number']?>">Click Here</a></td>
                        </tr>
                        </tbody>
                    </table>
                    <div style="color: white;">Bangladesh</div>
                </div>
                
            </div>
        </div>
    </div>
    <?php     
        }
        else{?>
            <div class="container-fluid" style="height: 815px;">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <h1 class="error" style="text-align: center">No Case In this Case Number : <?php echo base64_decode($case_id)?></h1>
                </div>
                <div class="form-group">
                    <h3 style="text-align: center; color: #c7254e;">It might be Wrong Case ID or Case may be Dismiss.</h3>
                </div>
                <a style="text-decoration: none; font-size: 22px;" href="index.php">Go Back</a>
            </div>
            <div class="col-md-3"></div>

        </div>
        
      <?php  }
    ?>
    
    <div style="position: fixed; left: 0; bottom: 0; width: 100%; margin-bottom: -20px; "> 
        <div style="text-align: center; background-color: gray;" class="well well-sm">Bangladesh Police &copy; 2018</div>
    </div>
</body>
<html>