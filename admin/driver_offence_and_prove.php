<?php include("admin_header.php");?>
<?php
    $case_id_no = $_GET['case_id'];
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="text-align: center; color:brown;">Case ID: <?php echo base64_decode($case_id_no);?></h1>
                <a class="btn-block" href="case_search_result.php?case_id=<?php echo $case_id_no;?>">Go Back</a>
                <hr>
                <div class="col-md-6">
                    <h2>Offences Here</h2>
                    <div class="list-group">
                    <?php
                        $driver_offence_list = $db->driver_offence_list("driver_offence","offence",$case_id_no);
                        if($driver_offence_list->num_rows>0){
                            while ($row = $driver_offence_list->fetch_assoc()){?>
                                    <a href="#" class="list-group-item"><?php echo $row['law_details']?></a>
                        <?php }
                        }
                    ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>Given Documents</h2>
                    <div class="list-group">
                        <?php
                            $driver_documents = $db->driver_documents("given_prove","proves",$case_id_no);
                            if($driver_documents->num_rows>0){
                                while ($row = $driver_documents->fetch_assoc()){ ?>
                                    <a href="#" class="list-group-item"><?php echo $row['prove_details']?></a>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



















<?php include("admin_footer.php");?>