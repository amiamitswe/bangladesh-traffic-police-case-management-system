<?php

require('include/config.php');
if(isset($_POST["From"], $_POST["to"], $_POST["police_id"]))
{
	$from = date("Y-m-d",strtotime($_POST["From"]));
	$to = date("Y-m-d",strtotime($_POST["to"]));
	$police_id = $_POST["police_id"];
	$db = new Admin_Database();
	$check_data = $db->check_ajax_data("driver_owner_details","driver_occurrence_details",$from,$to,$police_id);
				if($check_data->num_rows > 0){
	?>

	<table class="table table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Driver Name</th>
                <th>Mobile No</th>
                <th>Case No</th>
                <th>Car No</th>
                <th>Last Date</th>
                <th>C.Status</th>
            </tr>
            </thead>
            <tbody>

			<?php
					$i = 1;
					while ($row = $check_data->fetch_assoc()) {
						?>
							<tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $row['driver_name'];?></td>
                            <td><?php echo "+880".$row['driver_mobile'];?></td>
                            <td><?php echo base64_decode($row['case_number']);?></td>
                            <td><?php echo $row['vehicle_no'];?></td>
                            <td><?php echo date('d-M-Y',strtotime($row['last_appo_date']));?></td>
                            <td>
                                <?php
                                    if($row['confirm'] == 0){?>
                                        <a style="color: red" href="case_search_result.php?case_id=<?php echo $row['case_number']?>">Pending</a>
                                <?php    }
                                    else{?>
                                        <a style="color: green" href="case_search_result.php?case_id=<?php echo $row['case_number']?>">Complete</a>
                                 <?php   }
                                ?>
                            </td>
                        </tr>

						<?php
					}

				}
				else{
					?>
						<h1 style="text-align: center; color: red;">No Case Found In Dates <br> From <?php echo $_POST["From"]." TO ".$_POST["to"];?></h1>
					<?php
				}
		}
?>