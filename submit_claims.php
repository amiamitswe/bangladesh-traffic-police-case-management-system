<?php
require("need/database.php");
require("need/security.php");

$name = $email = $case_id = $police_id = $details = "";
$name_error = $email_error = $details_error = $insert_failed = "";

if(isset($_POST['claim_submit'])){
//   function test_input($data){
//         $data = trim($data);
//         $data = stripslashes($data);
//         $data = htmlspecialchars($data);
//         return $data;
//     }
    $name = test_input($_POST['name']);
    $case_id = test_input($_POST['case_id']);
    $email = test_input($_POST['email']);
    $police_id = test_input($_POST['police_id']);
    $details = test_input($_POST['details']);
    $date = date('Y-m-d');
    $time = date("h:i:sa");

    if(empty($name)){
        $name_error = "Please Provide Your Name";
    }
    else if(empty($email)){
        $email_error = "Please Provide Email";
    }
    else if(empty($details)){
        $details_error = "Please Provide Some Details";
    }
    else{
        $db = new Vioctim_Database();
        $insert_claim_data = $db->insert_claim_data("victims_claim",$name,$email,$case_id,$police_id,$details,$time,$date);
        if($insert_claim_data){?>
            <script>
                alert("Your Claim Saved Successfully  \n\r Press OK")
                window.location = "index.php";
            </script>
    <?php }
        else{
            $insert_failed = "Claim Insert Failed";
        }
    }

}
?>

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
        .error{
            color: red;
        }
        .success{
            color: green;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse" style="margin-bottom: auto; background-color: #122b40">
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <h1 style="text-align: center;">Submit Claims</h1>
                
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <a href="index.php">Go Back</a>
                <hr>
                <form method="POST" action="">
                        <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label><span class="error"> * <?php echo $name_error; ?></span>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>" placeholder="Full Name..">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="case_id">Case ID</label>
                                <input type="text" class="form-control" id="case_id" name="case_id" value="<?php echo $case_id;?>" placeholder="Case ID (optional)">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label><span class="error"> * <?php echo $email_error; ?></span>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="police_id">Police ID</label>
                                <input type="number" class="form-control" id="police_id" name="police_id" value="<?php echo $police_id;?>" placeholder="Police ID (optional)">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="details">Details</label><span class="error"> * <?php echo $details_error; ?></span>
                                <textarea name="details" id="details" class="form-control" rows="4" placeholder="Details Please . . ." ></textarea>
                                <br>
                                <button name="claim_submit" class="btn btn-info">Submit Claim</button>
                                <span class="error"><?php echo $insert_failed; ?></span>
                            </div>
                        </div>
                        </div>
                        </form>  
                    </div>               
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>

</body>
</html>