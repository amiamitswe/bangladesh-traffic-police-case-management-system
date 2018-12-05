<?php require("c_panel_header.php");?>
<?php
$error_msg = $error_output = "";
?>
<div class="container-fluid" style="background-color: #e9ebee; height: 815px;">
    <div class="row">
        <h1 style="text-align: center;">Take Payments From Traffic User</h1>
        <br>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="user_id">Traffic User ID :</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="traffic_user_id" name="traffic_user_id" placeholder="Enter Traffic Police ID..." onfocusout="check_traffic_id_hover()" autofocus>
                            <br>
                        </div>

                    </div>
                    <div class="form-group" >
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-info" id="submit" name="submit">Submit</button>

                            &nbsp;&nbsp;<span id="Provide_Police_id" class="error"><?php echo $error_output;?></span>
                            <br><br>
                        </div>
                    </div>
            </div>

        <div class="col-md-12"></div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div id="traffic_police_amount">

                </div>
            </div>
            <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('#submit').click(function(){
            var traffic_user_id = $('#traffic_user_id').val();
            if(traffic_user_id != '')
            {
                $.ajax({
                    url:"find_traffic_payment.php",
                    method:"POST",
                    data:{traffic_user_id:traffic_user_id},
                    success:function(data)
                    {
                        $('#traffic_police_amount').html(data);
                    }
                });
            }
            else
            {
                document.getElementById('Provide_Police_id').textContent = "Please Provide Traffic User ID";
            }
        });
    });
</script>

<?php require("c_panel_footer.php");?>
