<?php
require ('c_panel_header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1 style="text-align: center; color: #2b669a;">All Claims</h1>
            <?php
            $see_all_claims = $db->see_all_claims("victims_claim");
            if($see_all_claims->num_rows>0){
                while ($row = $see_all_claims->fetch_assoc()){
                    ?>
                    <div class="well">
                        <h4>Name : <?php echo $row['name'];?></h4>
                        <h4>Email : <?php echo $row['email'];?></h4>
                        <h4>Case ID : <?php echo $row['case_id'];?></h4>
                        <h4>Police ID : <?php echo $row['police_id'];?></h4>
                        <h4>Time & Date : <?php echo date('d-M-Y',strtotime($row['date']))." ".$row['time'];?></h4>
                        <h4>Claim Details : </h4>
                        <p><?php echo $row['detials'];?></p>
                        <a href="#">Delete</a>
                    </div>
                    
                    <?php
                }
                ?>
                <div>Bangladesh</div>
                <?php
            }
            else{?>
                <h2 style="color: #900000; text-align: center">No Claims Found</h2>
            <?php   }
            ?>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php
require ('c_panel_footer.php');
?>
