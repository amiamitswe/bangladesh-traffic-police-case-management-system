<?php
class Vioctim_Database{
    private $db_host = "localhost";
    private $db_user = "id5392896_btpc_user";
    private $db_pass = "Amit1234";
    private $db_name = "id5392896_btpc";
    
    
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
    
    // case details for victim search
    public function case_details_for_victim($driver_owner_details,$driver_occurrence_details,$case_id){
        $sql = "SELECT * FROM $driver_owner_details INNER JOIN $driver_occurrence_details ON $driver_owner_details.case_number = $driver_occurrence_details.case_id AND $driver_owner_details.case_number = '$case_id'";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    // driver_offence_document.php and for case_pdf.php
    public function driver_offence_list($driver_offence,$offence,$case_id_no){
        $sql = "SELECT * FROM $driver_offence INNER JOIN $offence ON $driver_offence.offence_id = $offence.law_no WHERE $driver_offence.case_id = '$case_id_no'";
        $result = $this->conn->query($sql);
        return $result;
    }

    // driver_offence_document.php and for case_pdf.php
    public function driver_documents($given_prove,$proves,$case_id_no){
        $sql = "SELECT * FROM $given_prove INNER JOIN $proves ON $given_prove.prove_id = $proves.prove_id WHERE $given_prove.driver_id = '$case_id_no'";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    //submit claims
    public function insert_claim_data($victims_claim,$name,$email,$case_id,$police_id,$details,$time,$date){
        $sql = "INSERT INTO $victims_claim VALUES ('','$name','$email','$case_id','$police_id','$details','$time','$date',0)";
        $result = $this->conn->query($sql);
        return $result;
    }
    
    
    
}
?>