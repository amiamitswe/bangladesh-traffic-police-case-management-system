<?php
session_start();
if (!(isset($_SESSION['admin_id']))  AND !(isset($_SESSION['admin_name'])) AND !(isset($_SESSION['user_id']))) {
    header("location:index.php");
    exit;
}
else{
require ("fpdf/fpdf.php"); // for fpdf
require_once ("include/config.php"); // for database
require_once ("include/security.php"); // for time

$case_id_no = $_GET['case_id'];
$user_id = $_SESSION['user_id'];
$print_by = $_SESSION['admin_name'];

$db = new Admin_Database();
$payment_pdf = $db->payment_status("driver_owner_details","payment",$case_id_no);
if ($payment_pdf->num_rows>0) {
    $row = $payment_pdf->fetch_assoc();


    $date = date("d-M-Y");
    $time = date("h:i:sa");
    $name = $row['driver_name'];
    $mobile = "+880".$row['driver_mobile'];
    $driver_address = $row['driver_address'];
    $vehicle_no = $row['vehicle_no'];
    $owner_name = $row['owner_name'];
    $owner_email = $row['owner_email'];
    $occurrence_place = $row['occurrence_place'];
    $occurrence_date_time = date('d-M-Y',strtotime($row['occurrence_date']))."    ".$row['occurrence_time'];
    $written_by = $row['traffic_police_id'];
    $police_station = $row['police_station'];

    $fine = $row['amount'];
    $checked_by = $row['police_user_id'];
    $payment_at_time = $row['payment_at_time'];
    $payment_at_date = date('d-M-Y',strtotime($row['payment_at_date']));


    $pdf = new FPDF("P",'mm','A4');
    $pdf->AddPage();

    $pdf->SetFont("Arial",'B',"18");
    $pdf->Cell(0,10,"Bangladesh Traffic Police Case",1,1, "C");


    $pdf->SetFont("Arial","I","16");
    $pdf->Cell(0,11,"PAYMENT STATUS",0,1, "C");


    // print date time and current status
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(33,10, "Print Date : ", 0,0, "R");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(30,10, $date, 0,0, "L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(33,10, "Print Time : ", 0,0, "R");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(30,10, $time, 0,0, "L");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(34,10, "Current Stratus : ", 0,0, "R");
    $pdf->SetFont("Arial","","10");
    $pdf->SetTextColor(0,128,0);
    $pdf->Cell(30,10, "Complete", 0,1, "L");



    // set default color in black
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont("Arial","","13");
    $pdf->Cell(0,7,"Details Of Case ID : ".base64_decode($case_id_no),0,1, "C");
    // Name and Mobile NO
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Driver Name", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $name, 1,0, "C");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Mobile NO", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $mobile, 1,1, "C");


    // Driver address and vehicle no
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Driver Address", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $driver_address, 1,0, "C");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Vehicle NO", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $vehicle_no, 1,1, "C");


    // Owner name and Owner email
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Owner Name", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $owner_name, 1,0, "C");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Owner Email", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $owner_email, 1,1, "C");



    //Occurrence place date and time
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Occurrence Place", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $occurrence_place, 1,0, "C");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Date & Time", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $occurrence_date_time, 1,1, "C");


    // Amount Details
    $pdf->SetFont("Arial","","13");
    $pdf->Cell(0,10,"Amount Details",0,1, "C");

    // payable amount and status
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Payable Amount", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $fine." TAKA", 1,0, "C");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Status", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->SetTextColor(0,128,0);
    $pdf->Cell(55,7, "Paid", 1,1, "C");

    // Payment date and time
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Payment Date", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $payment_at_date, 1,0, "C");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Payment Time", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $payment_at_time, 1,1, "C");

    $pdf->SetFont("Arial","","13");
    $pdf->Cell(0,10,"Traffic Police Information",0,1, "C");

    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Registered By", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $written_by, 1,0, "C");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Checked By", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $checked_by, 1,1, "C");
    
    $pdf->SetFont("Arial","I","10");
    $pdf->Cell(0,9, "Case Registered at : ".$police_station." Thana", 0,0, "L");
    $pdf->SetFont("Arial","I","10");
    $pdf->Cell(0,9, "Print By : ".$print_by." ( ".$user_id." )", 0,1, "R");

    $pdf->Ln();
    $pdf->Cell(0, 5, 'Bangladesh Traffic Police '.chr(169) . ' 2018', 0, 1, 'C', 0);


    $pdf->Output();
    ob_end_flush();
}
else{
    die("Error");
}
}
?>