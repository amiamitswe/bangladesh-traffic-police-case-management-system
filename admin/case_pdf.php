<?php
session_start();
if (!(isset($_SESSION['admin_id']))  AND !(isset($_SESSION['admin_name'])) AND !(isset($_SESSION['user_id']))) {
    header("location:index.php");
    exit;
}
else{
//ob_start();
// require ("../fpdf/fpdf.php"); // for fpdf
require ("fpdf/fpdf.php"); // for fpdf
require_once ("include/config.php"); // for database
require_once ("include/security.php"); // for time

$case_id_no = $_GET['case_id'];

$admin_name = $_SESSION['admin_name'];
$printed_by = $_SESSION['user_id'];

$db = new Admin_Database();
$case_pdf = $db->find_case_data("driver_owner_details","driver_occurrence_details",$case_id_no);
if ($case_pdf->num_rows>0) {
    $row = $case_pdf->fetch_assoc();


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
    $case_last_date = date('d-M-Y',strtotime($row['last_appo_date']));
    $fine = $row['fine'];
    $comment = $row['comment'];
    $police_station = $row['police_station'];
    $written_by = $row['traffic_police_id'];

    $pdf = new FPDF("P",'mm','A4');
    $pdf->AddPage();

    $pdf->SetFont("Arial",'B',18);
    $pdf->Cell(0,10,"Bangladesh Traffic Police Case",1,1, "C");


    $pdf->SetFont("Arial",'',15);
    $pdf->Cell(0,8,"Case ID : ".base64_decode($case_id_no),1,1, "C");


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
    if($row['confirm'] == 1){
        $pdf->SetTextColor(0,128,0);
        $pdf->Cell(30,10, "Complete", 0,1, "L");
    }
    else{
        $pdf->SetTextColor(255,0,0);
        $pdf->Cell(30,10, "Pending", 0,1, "L");
    }


    // set default color in black
    $pdf->SetTextColor(0,0,0);

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


    // Last meeting date and fine amount
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Last Meeting Date", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $case_last_date, 1,0, "C");
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(40,7, "Fine (Amount)", 1,0, "C");
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(55,7, $fine." TAKA", 1,1, "C");


    // Driver Offences
    $driver_offence_list = $db->driver_offence_list("driver_offence","offence",$case_id_no);
    if($driver_offence_list->num_rows>0) {
        $pdf->SetFont("Arial","B","10");
        $pdf->Cell(190,9, "Driver Offences :",0,1);
        $pdf->SetFont("Arial","","10");
        while ($row = $driver_offence_list->fetch_assoc()){
            $pdf->Cell(190, 7, $row['law_details'], 1,1);
    }
    }

    // Submitted Documents
    $driver_documents = $db->driver_documents("given_prove","proves",$case_id_no);
    if($driver_documents->num_rows>0) {
        $pdf->SetFont("Arial","B","10");
        $pdf->Cell(190,9, "Driver Given Documents :",0,1);
        $pdf->SetFont("Arial","","10");
        while ($row = $driver_documents->fetch_assoc()){
            $pdf->Cell(190, 6, $row['prove_details'], 1,1);
        }
    }


    // comment
    $pdf->SetFont("Arial","B","10");
    $pdf->Cell(190,9, "Comments :",0,1);
    $pdf->SetFont("Arial","","10");
    $pdf->Cell(190,7, $comment, 1,1);

    $pdf->SetFont("Arial","I","10");
    $pdf->Cell(0,9, "Police Station : ".$police_station, 0,0, "L");
    $pdf->SetFont("Arial","I","10");
    $pdf->Cell(0,9, "Registered By : ".$written_by."  Printed By : ".$admin_name." ( ".$printed_by." )", 0,1, "R");

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