<?php
require ("include/config.php");
if(isset($_POST['claim_id'])){
    $db = new C_Database();
    $claim_id = $_POST['claim_id'];
    $update_claim_data = $db->update_claim_data("victims_claim", $claim_id);
    if(!$update_claim_data){
      echo "Something Wrong";
    }
    else{

                $see_new_claims = $db->see_new_claims("victims_claim");
                if($see_new_claims->num_rows>0){
                    while ($row = $see_new_claims->fetch_assoc()){
                        $claim_id = $row['id'];
                        ?>
                        <div class="well">
                            <h4>Name : <?php echo $row['name'];?></h4>
                            <h4>Email : <?php echo $row['email'];?></h4>
                            <h4>Case ID : <?php echo $row['case_id'];?></h4>
                            <h4>Police ID : <?php echo $row['police_id'];?></h4>
                            <h4>Time & Date : <?php echo date('d-M-Y',strtotime($row['date']))." ".$row['time'];?></h4>
                            <h4>Claim Details : </h4>
                            <p><?php echo $row['detials'];?></p>
                            <button id="view">view</button>
                        </div>
                        <?php
                    }
                }
                else{?>
                    <h2 style="color: #900000; text-align: center">No Claims Found</h2>
                <?php   }

    }
}
?>