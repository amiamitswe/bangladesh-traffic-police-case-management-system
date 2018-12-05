<?php
    class C_Database{
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

        //------------------------------------------------------------------------------------//
        // c_panel_login.php
        public function c_panel_login($username, $pass, $table){
            $sql = "SELECT * FROM $table WHERE username = '$username' AND password = '$pass'";
            $result = $this->conn->query($sql);
            return $result;
        }

        //----------------------------------------------------------------------------------//
        // c_panel_new_police_register.php

        public function check_old_data($traffic_police,$email, $police_id, $police_user_id){
            $sql = "SELECT * FROM $traffic_police WHERE email_id = '$email' OR police_id_no = '$police_id' OR police_user_id = '$police_user_id'";
            $result = $this->conn->query($sql);
            return $result;
        }

        // new traffic police register
        public function new_insert($table,$name,$email,$number,$police_id,$police_user_id,$password,$save_at,$update_at){
            $sql = "INSERT INTO $table VALUES ('','$name','$email','$number','$police_id','$police_user_id','$password','$save_at','$update_at')";
            $result = $this->conn->query($sql);
            return $result;
        }

        //traffic police details for take payment
        public function police_details($traffic_police,$traffic_id){
            $sql = "SELECT * FROM $traffic_police WHERE police_user_id = '$traffic_id' LIMIT 1";
            $result = $this->conn->query($sql);
            return $result;
        }

        // payment value for traffic police
        public function payment_data($payment, $traffic_id){
            $sql = "SELECT * FROM $payment WHERE police_user_id = '$traffic_id' AND paid_status = 0";
            $result = $this->conn->query($sql);
            return $result;
        }

        // update payment
        public function update_payment($payment, $traffic_id){
            $sql = "UPDATE $payment SET paid_status = 1 WHERE police_user_id = '$traffic_id' AND paid_status = 0";
            $result = $this->conn->query($sql);
            return $result;
        }
        
        // see victim new claims
        public function see_new_claims($victims_claim){
            $sql = "SELECT * FROM $victims_claim WHERE check_confrom = 0";
            $result = $this->conn->query($sql);
            return $result;
        }

        // see victim all claims
        public function see_all_claims($victims_claim){
            $sql = "SELECT * FROM $victims_claim WHERE check_confrom = 1 ORDER BY id DESC";
            $result = $this->conn->query($sql);
            return $result;
        }

        // update claim data
        public function update_claim_data($victims_claim, $claim_id){
            $sql = "UPDATE $victims_claim SET check_confrom = 1 WHERE id = '$claim_id' LIMIT 1";
            $result = $this->conn->query($sql);
            return $result;
        }

    }

?>