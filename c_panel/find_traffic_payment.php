<?php
require('include/config.php');
require ('include/security.php');
if(isset($_POST['traffic_user_id'])){
    $traffic_id = test_input($_POST['traffic_user_id']);

    $db = new C_Database();
    $police_details = $db->police_details("traffic_police",$traffic_id);
    if($police_details->num_rows>0){
        $row = $police_details->fetch_assoc();?>
        <h2 style="text-align: center; color: #1b6d85;">Traffic Police Details</h2>
        <table class="table table-hover">
            <tbody>
            <tr>
                <td>Name : <?php echo $row['full_name'];?></td>
                <td>User ID : <?php echo $row['police_user_id'];?></td>
            </tr>
            <tr>
                <td>Email : <?php echo $row['email_id'];?></td>
                <td>Mobile NO: <?php echo "+880".$row['phone_number'];?></td>
            </tr>
            </tbody>
        </table>
        <h2 style="text-align: center; color: #1b6d85;">Payment Details</h2>
        <div id="final_payment">
  <?php
    $payment_data = $db->payment_data("payment", $traffic_id);
    if($payment_data->num_rows>0){?>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>NO</th>
                <th>Case ID</th>
                <th>Amount</th>
                <th>Paid At</th>
            </tr>
        </thead>
        <?php $i = 1;
        $amount = 0;
        while ($row = $payment_data->fetch_assoc()){ ?>
            <tbody>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo base64_decode($row['case_number']);?></td>
                <td><?php echo $row['amount']." /=";?></td>
                <td><?php echo date('d-M-Y',strtotime($row['payment_at_date']))." &nbsp;&nbsp;".$row['payment_at_time'];?></td>
            </tr>
            </tbody>

        <?php
        $amount +=  $row['amount'];
        }
        ?>
        </table>
        <div class="col-md-8">
        <h4 style="color: darkred">Total Payable Amount : <?php echo $amount." Taka";?></h4>
        <h4 style="color: #900000;">Total Unpaid case is : <?php echo $i-1;?></h4>
        </div>
        <div class="col-md-4">
            <br>
            <button type="button" class="btn btn-success" id="take_payment">Take Payment</button>
        </div>
        <?php
            }
            else{?>
                <h1 style="text-align: center;color: #900000;">No Data Found Or Payment Complete</h1>
                <br><br><br>
        <?php    }
        ?>
        </div>
        <?php
        }
    else{?>
        <h1 style="text-align: center;color: #900000;">No Match Found</h1>
        <br><br><br>
   <?php }
}
?>
<script>
    $(document).ready(function(){

        $('#take_payment').click(function(){
            var traffic_user_id = "<?php echo $traffic_id;?>";
            var amount = prompt("Please Provide Total Amount","");
            var payable_amount = "<?php echo $amount;?>"
            if(traffic_user_id != '' && amount != ''){
                if(!isNaN(amount)){
                    if(amount === payable_amount){
                        $.ajax({
                            url:"conform_payment.php",
                            method:"POST",
                            data:{traffic_user_id:traffic_user_id, amount:amount},
                            success:function(data)
                            {
                                $('#final_payment').html(data);
                            }
                        });
                    }
                    else {
                        alert("Please provide correct amount!!! " +
                            "\n\rYour Payable amount "+payable_amount+
                            "\n\rBut you provide "+amount);
                    }
                }
                else{
                    alert("Please Provide A Number Not String");
                }
            }
            else
            {
                alert("Please Provide Total Amount of "+traffic_user_id);
            }
        });
    });
</script>