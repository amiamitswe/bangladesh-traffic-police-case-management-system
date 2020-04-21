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
    <nav class="navbar custom-nav navbar-inverse" style="margin-bottom: auto; background-color: #122b40">
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
            </div>
        </div>
    </nav>
    <?php
        require("need/database.php");
        $db = new Vioctim_Database();
        $case_id = $_GET['caseno'];
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="text-align: center; color:brown;">Case ID: <?php echo base64_decode($case_id);?></h1>
                <a class="btn-block" href="user_case_search_result.php?caseno=<?php echo $case_id;?>">Go Back</a>
                <hr>
                <div class="col-md-6">
                    <h2>Offences Here</h2>
                    <div class="list-group">
                    <?php
                        $driver_offence_list = $db->driver_offence_list("driver_offence","offence",$case_id);
                        if($driver_offence_list->num_rows>0){
                            while ($row = $driver_offence_list->fetch_assoc()){?>
                                    <a href="#" class="list-group-item"><?php echo $row['law_details']?></a>
                        <?php }
                        }
                    ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>Given Documents</h2>
                    <div class="list-group">
                        <?php
                            $driver_documents = $db->driver_documents("given_prove","proves",$case_id);
                            if($driver_documents->num_rows>0){
                                while ($row = $driver_documents->fetch_assoc()){ ?>
                                    <a href="#" class="list-group-item"><?php echo $row['prove_details']?></a>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="position: fixed; left: 0; bottom: 0; width: 100%; margin-bottom: -20px; "> 
        <div style="text-align: center; background-color: gray;" class="well well-sm">Bangladesh Police &copy; 2018</div>
    </div>
</body>
<html>