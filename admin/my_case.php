<?php include("admin_header.php");?>
<?php
$police_id = $admin_user_id;

?>
<div class="container">
<h2 align="center"><u>My Assign Cases</u></h2>
<br/>
<br/>
<!-- <div class="col-md-6"></div> -->
<div class="col-md-2">
<input type="text" name="From" id="From" class="form-control" placeholder="From Date"/>
</div>
<div class="col-md-2">
<input type="text" name="to" id="to" class="form-control" placeholder="To Date"/>
</div>
<div class="col-md-8">
<input type="button" name="range" id="range" value="Range" class="btn btn-success"/>
</div>
<div class="clearfix"></div>
<div id="filtered_case">
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
                $my_all_case = $db->my_all_case("driver_owner_details","driver_occurrence_details",$police_id);
                if($my_all_case->num_rows>0){
                    $i = 1;
                    while ($row = $my_all_case->fetch_assoc()){
                        //$ddd = ;
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
                        <?php }
                }
                else{
                    ?>
                    <h1 style="text-align: center; color: #900000">No Records Found</h1>
                    <?php
                }?>

            </tbody>
        </table>
    </div>
    </div>
    <script>
$(document).ready(function(){
    $.datepicker.setDefaults({
        dateFormat: 'dd-M-yy'
    });
    $(function(){
        $("#From").datepicker();
        $("#to").datepicker();
    });
    $('#range').click(function(){
        var From = $('#From').val();
        var to = $('#to').val();
        var police_id = "<?php echo $police_id;?>";
        if(From != '' && to != '')
        {
            $.ajax({
                url:"filter_ajax.php",
                method:"POST",
                data:{From:From, to:to, police_id:police_id},
                success:function(data)
                {
                    $('#filtered_case').html(data);
                }
            });
        }
        else
        {
            alert("Please Select the Date");
        }
    });
});
</script>
<?php include("admin_footer.php");?>