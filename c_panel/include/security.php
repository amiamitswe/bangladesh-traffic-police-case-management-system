<?php
//check html special chars
$html_check = htmlspecialchars($_SERVER["PHP_SELF"]);

//-----------------------------------------------------------------//
date_default_timezone_set('Asia/Dhaka');


// check some html issues
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>
