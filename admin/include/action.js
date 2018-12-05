// c_panel_login check start
function check_user_id(){
    var user_id = document.getElementById('user_id').value;
    if (user_id == '') {
        document.getElementById('user_id_alert').innerHTML = " Username is Required";
    }
    else{
        document.getElementById('user_id_alert').innerHTML = "";
    }
}

function check_password(){
    var pwd = document.getElementById('pwd').value;
    if (pwd == '') {
        document.getElementById('pass_alert').innerHTML = " Password is Required";
    }
    else{
        document.getElementById('pass_alert').innerHTML = "";
    }
}

function admin_login_validation() {
    var user_id = document.getElementById('user_id').value;
    var pwd = document.getElementById('pwd').value;

    if (user_id ==''){
        document.getElementById('user_id_alert').innerHTML = " Username is Required";
        return false;
    }
    else if(pwd == ''){
        document.getElementById('pass_alert').innerHTML = " Password is Required";
        return false;
    }
}

// c_panel_login check end

// incomplete case id check
function validation_incomplete_case() {
    var case_id = document.getElementById('case_id').value;

    if (case_id ==''){
        document.getElementById('case_id_error').innerHTML = "Valid Case ID is Required !!!";
        return false;
    }
}

function check_case_id_hover() {
    var case_id = document.getElementById('case_id').value;

    if (case_id ==''){
        document.getElementById('case_id_error').innerHTML = "Valid Case ID is Required !!!";
    }
    else{
        document.getElementById('case_id_error').innerHTML = "";
    }
}

// new_traffic_case_form_2 validation
function validation_form_2() {
    var offence = document.getElementById("offence").value;
    if(offence == ''){
        document.getElementById('offence_error').innerHTML = "Offence is requird";
        return false;
    }
}

// check amount
function check_amount() {
    var amount = document.getElementById('amount').value;
    if(isNaN(amount)){
        document.getElementById('amount_error').innerHTML = "Please put A number";
        return false;
    }
    else {
        document.getElementById('amount_error').innerHTML = "";
    }
}

// check new thana
function check_thana() {
    var case_transfer = document.getElementById('case_transfer').value;
    if(case_transfer == ""){
        document.getElementById('transfer_error').innerHTML = "Please put Thana Name";
        return false;
    }
    else {
        document.getElementById('transfer_error').innerHTML = "";
    }
}





















