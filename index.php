<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bangladesh Traffic Police</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        input[type=text] {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url('searchicon.png');
            padding: 19px 40px 18px 10px;
        }

        .custom-nav {
        border-radius: 0;
        }

        .footer-style {
            text-align: center;
            background-color: gray;
            padding: 10px;
            color: #fff;
        }

    </style>
</head>
<body onload="startTime()">
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
                <li><a href="submit_claims.php">Submit Claims</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin/index.php">Traffic Police User Login</a></li>
                <li><a href="c_panel/c_panel_login.php">Traffic Police Admin Login</a></li>
                <li><a href=""><span id="txt" style="font-size: 1.5em;"></span></a href=""></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid" style="background-color: #e9ebee;">
    <div class="col-md-12">
        <h3 style="text-align: center">Bangladesh Traffic Police</h3>
        <div class="col-md-2">
            <div style="text-align: center">
            <img src="admin/images/logo.png" alt="Bangladesh Police" style="width: 120px;">
            </div>
            <div style="text-align: center">
            <h4>Bangladesh Police Symbol</h4>
                <h5><a style="text-decoration: none" href="http://www.police.gov.bd">Bangladesh Police</a></h5>
            </div>
        </div>
        <div class="col-md-7">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                    <li data-target="#myCarousel" data-slide-to="4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                    <div class="item active">
                        <img src="images/1a.jpg" alt="Los Angeles" style="width:100%;">
                        <div class="carousel-caption">
                            <h3>Dhaka</h3>
                            <p>Dhanmondi 32, Dhaka-1207</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="images/2a.jpg" alt="Chicago" style="width:100%;">
                        <div class="carousel-caption">
                            <h3>Dhaka</h3>
                            <p>Dhanmondi 32, Dhaka-1207</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="images/3a.jpg" alt="New York" style="width:100%;">
                        <div class="carousel-caption">
                            <h3>Dhaka</h3>
                            <p>Dhanmondi 32, Dhaka-1207</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="images/a4.jpg" alt="New York" style="width:100%;">
                        <div class="carousel-caption">
                            <h3>Dhaka</h3>
                            <p>Dhanmondi 32, Dhaka-1207</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="images/a5.jpg" alt="New York" style="width:100%;">
                        <div class="carousel-caption">
                            <h3>Dhaka</h3>
                            <p>Dhanmondi 32, Dhaka-1207</p>
                        </div>
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-3">
<!--            <input type="text" name="search" placeholder="Search..">-->
            <form method="post" action="">
            <div class="input-group" style="margin-bottom: 10px;">

                    <input type="text" name="case_id" class="form-control" placeholder="Search Case..." required>
                    <div class="input-group-btn">
                        <button style="font-size: 18px;" class="btn btn-default" type="submit" name="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>

            </div>
            </form>
            <?php
            // check for html input
            function test_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
                if(isset($_POST['submit'])){
                    $case_id = test_input(strtoupper($_POST['case_id']));
                    ?>
                        <script>
                            window.location = "user_case_search_result.php?caseno=<?php echo base64_encode($case_id);?>";
                        </script>      
                    <?php
                }
            ?>
            <!--Login For Traffic User-->
            <div class="well well-lg" style="margin-top: 0px; text-align: center" >
                <p>Here is Login for Bangladesh Traffic Police </p>
                <a style="background-color: #2aabd2; color: white;" class="btn" href="admin/index.php">Login For Traffic User</a>
            </div>
            <hr>
            <!--Login For Traffic Admin-->
            <div class="well well-lg" style="text-align: center" >
                <p>Here is Login for Bangladesh Traffic Police Administrator</p>
                <a style="background-color: #2aabd2; color: white;" class="btn" href="c_panel/c_panel_login.php">Login For Traffic Admin</a>
            </div>
        </div>

        <div class="col-md-12">
            <hr>
            <div class="col-md-3" >
                
                <h1 style="text-align: center;">Traffic Map</h1>
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14606.936630209264!2d90.379553!3d23.7568576!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1509128447694"  frameborder="0" style="border:3px solid; height: 270px; width: 285px" allowfullscreen></iframe>
            
            </div>
            <div class="col-md-9">
                <h1 style="text-align: center">Traffic Police Activities</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <a href="" target="">
                                <img src="images/thm1.jpg" alt="Lights" style="width:100%">
                                <div class="caption">
                                    <p style="text-align: center">Some text about Bangladesh Traffic Police...</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <a href="" target="">
                                <img src="images/thm2.jpg" alt="Nature" style="width:100%">
                                <div class="caption">
                                    <p style="text-align: center">Some text about Bangladesh Traffic Police...</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <a href="" target="">
                                <img src="images/thm3.jpg" alt="Fjords" style="width:100%">
                                <div class="caption">
                                    <p style="text-align: center">Some text about Bangladesh Traffic Police...</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <a href="" target="">
                                <img src="images/thm4.jpg" alt="Fjords" style="width:100%">
                                <div class="caption">
                                    <p style="text-align: center">Some text about Bangladesh Traffic Police...</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="weather_info">
            <a class="weatherwidget-io" href="https://forecast7.com/en/23d6890d36/bangladesh/" data-label_1="BANGLADESH" data-label_2="WEATHER" data-font="Times New Roman" data-icons="Climacons Animated" data-theme="original" >BANGLADESH WEATHER</a>
        </div>
    </div>

</div>



<div>
    <div class="footer-style">Bangladesh Police &copy; 2018</div>
</div>

<!--Weather info-->
<script src="custom-js/weather.js"></script>
<script src="custom-js/js_time.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
