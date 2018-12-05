<?php include("admin_header.php");?>
<?php
$police_id = $admin_user_id;

?>
    <div class="container">
        <h2>See All Cases</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Driver Name</th>
                <th>Mobile No</th>
                <th>Case No</th>
                <th>Car No</th>
                <th>Amount</th>
                <th>Registered By</th>
                <th>Stutas</th>
                <th>View</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $see_all_case = $db->see_all_case("driver_owner_details","driver_occurrence_details");
            if($see_all_case->num_rows>0){
                $i = 1;
                while ($row = $see_all_case->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $row['driver_name'];?></td>
                        <td><?php echo "+880".$row['driver_mobile'];?></td>
                        <td><?php echo base64_decode($row['case_number']);?></td>
                        <td><?php echo $row['vehicle_no'];?></td>
                        <td><?php echo $row['fine']." /=";?></td>
                        <td><?php echo $row['traffic_police_id'];?></td>
                        <?php
                            if($row['confirm'] == 1){?>
                                <td style="color: #16ba42;">Complete</td>
                            <?php    
                            }
                            else{ ?>
                                <td style="color: #ce3025;">Incomplete</td>
                            <?php 
                            }
                        ?>
                        <td><a style="color: #449d44;" href="case_search_result.php?case_id=<?php echo $row['case_number']?>">View</a></td>
                    </tr>
                    <?php
                }
            }
            else{?>
                <h1 style="text-align: center; color: #900000">No Records Found</h1>
             <?php   }
             ?>
            </tbody>
        </table>
    </div>
<?php include("admin_footer.php");?>