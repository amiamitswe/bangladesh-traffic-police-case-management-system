<?php
class Admin_Database{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "traffic_v3.3";
    
    
    // private $db_host = "localhost";
    // private $db_user = "id1884376_traffic_police_case_bd";
    // private $db_pass = "Amit1234";
    // private $db_name = "id1884376_traffic_police_case";

    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if (!$this->conn) {
            die("Connect error");
        }
    }
    // index.php
    public function admin_login_check($traffic_police, $user_id, $password){
        $sql = "SELECT * FROM $traffic_police WHERE police_user_id = '$user_id' AND password = '$password' LIMIT 1";
        $result = $this->conn->query($sql);
        return $result;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////
    // see traffic user details
    public function see_user_details($traffic_police, $admin_user_id){
        $sql = "SELECT * FROM $traffic_police WHERE police_user_id = '$admin_user_id' LIMIT 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    // check total registered case of an traffic
    public function total_register_case($driver_owner_details, $admin_user_id){
        $sql = "SELECT COUNT(*) AS 'ides' FROM $driver_owner_details WHERE traffic_police_id = '$admin_user_id' AND confrim_check = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    // check total paid case
    public function total_paid_case($driver_owner_details,$driver_occurrence_details,$admin_user_id){
        $sql = "SELECT COUNT(*) AS 'paid_case' FROM $driver_owner_details INNER JOIN $driver_occurrence_details ON $driver_owner_details.case_number = $driver_occurrence_details.case_id WHERE $driver_owner_details.traffic_police_id = '$admin_user_id' AND $driver_occurrence_details.confirm = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    // check pending case
    public function total_pending_case($driver_owner_details,$driver_occurrence_details,$admin_user_id){
        $sql = "SELECT COUNT(*) AS 'pending_case' FROM $driver_owner_details INNER JOIN $driver_occurrence_details ON $driver_owner_details.case_number = $driver_occurrence_details.case_id WHERE $driver_owner_details.traffic_police_id = '$admin_user_id' AND $driver_occurrence_details.confirm = 0";
        $result = $this->conn->query($sql);
        return $result;
    }

    // total amount_received_from_case
    public function amount_received_from_case($payment, $admin_user_id){
        $sql = "SELECT COUNT(amount) AS 'total_received_case' FROM $payment WHERE police_user_id = '$admin_user_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // total amount receive
    public function take_amount_received($payment, $admin_user_id){
        $sql = "SELECT * FROM $payment WHERE police_user_id = '$admin_user_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // total paid amount
    public function total_paid_amount($payment, $admin_user_id){
        $sql = "SELECT * FROM $payment WHERE police_user_id = '$admin_user_id' AND paid_status = 1";
        $result = $this->conn->query($sql);
        return $result;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////

    // check vehicle number is any case peinding or not
    public function check_vehicle_value($driver_owner_details,$driver_occurrence_details,$car_no){
        $sql = "SELECT * FROM $driver_owner_details INNER JOIN $driver_occurrence_details ON $driver_owner_details.case_number = $driver_occurrence_details.case_id WHERE $driver_owner_details.vehicle_no = '$car_no' AND $driver_occurrence_details.confirm = 0 LIMIT 1";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    //new_traffic_case_form_1.php start
    public function insert_from_1_data($table,$case_number,$police_id,$driver_name,$driver_address,$driver_mobile,$owner_name,$owner_email,$car_no,$address,$date,$time,$police_station,$appointment_date){
        $sql = "INSERT INTO $table VALUES ('','$case_number','$police_id','$driver_name','$driver_address','$driver_mobile','$owner_name','$owner_email','$car_no','$address','$date','$time','$appointment_date','$police_station',0)";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    
    public function check_email_id($driver_owner_details, $case_id){
        $sql = "SELECT * FROM $driver_owner_details WHERE case_number = '$case_id' LIMIT 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function upload_image_in_db($upload,$name,$image){
        $sql = "INSERT INTO $upload VALUES ('','$name','$image')";
        $result = $this->conn->query($sql);
        return $result;
    }

    // select offence to display 1 to 8
    public function offence_1_8($offence){
        $sql = "SELECT * FROM $offence WHERE id BETWEEN 1 AND 8";
        $result = $this->conn->query($sql);
        return $result;
    }

    // select offence to display 9 to 16
    public function offence_9_16($offence){
        $sql = "SELECT * FROM $offence WHERE id BETWEEN 9 AND 16";
        $result = $this->conn->query($sql);
        return $result;
    }

    // select given proves 1 to 5
    public function prove_1_5($proves){
        $sql = "SELECT * FROM $proves WHERE id BETWEEN 1 AND 5";
        $result = $this->conn->query($sql);
        return $result;
    }

    // select given proves 6 to 10
    public function prove_6_10($proves){
        $sql = "SELECT * FROM $proves WHERE id BETWEEN 6 AND 10";
        $result = $this->conn->query($sql);
        return $result;
    }

    // insert driver offences
    public function insert_offence($driver_offence,$case_id,$offence_value){
        $sql = "INSERT INTO $driver_offence VALUES ('','$case_id','$offence_value')";
        $result = $this->conn->query($sql);
        return $result;
    }

    // insert driver given documents
    public function insert_documents($given_prove,$case_id,$documents_value){
        $sql = "INSERT INTO $given_prove VALUES ('','$case_id','$documents_value')";
        $result = $this->conn->query($sql);
        return $result;
    }

    // incomplete case id check
    public function check_case_id_form_db($driver_owner_details,$case_id){
        $sql = "SELECT * FROM $driver_owner_details WHERE case_number = '$case_id' AND confrim_check = 0 LIMIT 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    // new_traffic_case_form_2.php
    public function insert_from_2_data($driver_occurrence_details,$case_id,$fine,$comments, $name, $image){
        $sql = "INSERT INTO $driver_occurrence_details VALUES ('','$case_id','$fine','$comments','$name','$image','0')";
        $result = $this->conn->query($sql);
        return $result;
    }

    // new_traffic_case_form_2.php
    public function insert_conform($driver_owner_details, $case_id){
        $sql = "UPDATE $driver_owner_details SET confrim_check = 1 WHERE case_number = '$case_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // case_search_result.php
    public function find_case_data($driver_owner_details,$driver_occurrence_details,$case_id_no){
        $sql = "SELECT * FROM $driver_owner_details INNER JOIN $driver_occurrence_details ON $driver_owner_details.case_number = $driver_occurrence_details.case_id AND $driver_owner_details.case_number = '$case_id_no'";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    // transer_case_to_thana.php
    public function case_confrom($driver_owner_details,$case_id_no){
        $sql = "SELECT * FROM $driver_owner_details WHERE case_number = '$case_id_no' LIMIT 1";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    // update new thana (police station)
    public function update_police_station($driver_owner_details, $case_id_no,$case_transfer){
        $sql = "UPDATE $driver_owner_details SET police_station = '$case_transfer' WHERE case_number = '$case_id_no'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // my_case.php
    public function my_all_case($driver_owner_details,$driver_occurrence_details,$police_id){
        $sql = "SELECT * FROM $driver_owner_details INNER JOIN $driver_occurrence_details ON $driver_owner_details.case_number = $driver_occurrence_details.case_id WHERE $driver_owner_details.traffic_police_id = '$police_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // payment.php check amount
    public function check_amount($driver_occurrence_details,$case_id_no){
        $sql = "SELECT * FROM $driver_occurrence_details WHERE case_id = '$case_id_no'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // payment.php insert amount
    public function insert_amount($payment,$police_id, $case_id_no,$amount_taka,$date,$time){
        $sql = "INSERT INTO $payment VALUES ('','$police_id','$case_id_no','$amount_taka','$date','$time',0)";
        $result = $this->conn->query($sql);
        return $result;
    }

    // payment.php update amount conform
    public function update_payment_confirm($driver_occurrence_details,$case_id_no){
        $sql = "UPDATE $driver_occurrence_details SET confirm = 1 WHERE case_id = '$case_id_no'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // my_global_case.php
    public function my_global_case($driver_owner_details,$payment,$police_id){
        $sql = "SELECT * FROM $driver_owner_details INNER JOIN $payment ON $driver_owner_details.case_number = $payment.case_number WHERE $payment.police_user_id = '$police_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // driver_offence_document.php
    public function driver_offence_list($driver_offence,$offence,$case_id_no){
        $sql = "SELECT * FROM $driver_offence INNER JOIN $offence ON $driver_offence.offence_id = $offence.law_no WHERE $driver_offence.case_id = '$case_id_no'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // driver_offence_document.php
    public function driver_documents($given_prove,$proves,$case_id_no){
        $sql = "SELECT * FROM $given_prove INNER JOIN $proves ON $given_prove.prove_id = $proves.prove_id WHERE $given_prove.driver_id = '$case_id_no'";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    // reset password
    public function check_reset_value($traffic_police, $user_id, $user_email){
        $sql = "SELECT * FROM $traffic_police WHERE police_user_id = '$user_id' AND email_id = '$user_email' LIMIT 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    // insert password works for both reset password and change password
    public function set_new_pass($traffic_police, $user_id, $new_pass_md5,$update_at){
        $sql = "UPDATE $traffic_police SET password = '$new_pass_md5', update_on_date = '$update_at' WHERE police_user_id = '$user_id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // change password
    public function check_current_pass($traffic_police, $police_id, $current_pass){
        $sql = "SELECT * FROM $traffic_police WHERE police_user_id = '$police_id' AND password = '$current_pass' LIMIT 1";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    // payment status pdf
    public function payment_status($driver_owner_details,$payment,$case_id_no){
        $sql = "SELECT * FROM $driver_owner_details INNER JOIN $payment ON $driver_owner_details.case_number = $payment.case_number WHERE $payment.case_number = '$case_id_no'";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    //see_all_case
    public function see_all_case($driver_owner_details,$driver_occurrence_details){
        $sql = "SELECT * FROM $driver_owner_details INNER JOIN $driver_occurrence_details ON $driver_owner_details.case_number = $driver_occurrence_details.case_id";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    /////////////////////////////////////////////////////////////////////
    // ajax
    //////////////////////////////////////////////////////////////////////

    public function check_ajax_data($driver_owner_details,$driver_occurrence_details,$from,$to,$police_id){
        $sql = "SELECT * FROM driver_owner_details INNER JOIN $driver_occurrence_details ON $driver_owner_details.case_number = $driver_occurrence_details.case_id WHERE traffic_police_id = '$police_id' AND occurrence_date BETWEEN '$from' AND '$to'";
        $result = $this->conn->query($sql);
        return $result;
    }
}
?>