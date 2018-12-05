<?php
require ('c_panel_header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1 style="text-align: center; color: #2b669a;">New Claims</h1>
            <div id="new_content">
            <?php
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
            ?>
        </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#view').click(function(){
            var claim_id = "<?php echo $claim_id;?>";
            if(claim_id != '')
            {
                $.ajax({
                    url:"view_new_claims.php",
                    method:"POST",
                    data:{claim_id:claim_id},
                    success:function(data)
                    {
                        alert("View Success");
                        $('#new_content').html(data);
                    }
                });
            }
            else
            {
                alert("Something Wrong");
            }
        });
    });
</script>
<?php
require ('c_panel_footer.php');
?>
