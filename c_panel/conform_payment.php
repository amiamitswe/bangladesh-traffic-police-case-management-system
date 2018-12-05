<?php
require ('include/config.php');
$amount = 0;
if(isset($_POST['traffic_user_id'],$_POST['amount'])){
    $traffic_id = $_POST['traffic_user_id'];
    $db = new C_Database();
    $payment_data = $db->payment_data("payment",$traffic_id);
    if($payment_data->num_rows>0){
        while ($row = $payment_data->fetch_assoc()){
            $amount += $row['amount'];
            $update_payment = $db->update_payment("payment", $traffic_id);
            if(!$update_payment){
                echo "Sorry";
            }
        }?>
        <h1 style="text-align: center; color: green;">Payment Successfully Done.</h1>
        <h2 style="text-align: center; color: green;">Paid Amount : <?php echo $_POST['amount']; ?> Taka</h2>
    <?php }
    else{
        echo "something wrong";
    }
}

?>