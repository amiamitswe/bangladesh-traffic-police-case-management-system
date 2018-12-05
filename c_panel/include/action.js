// c_panel_login check start
function check_username(){
    var username = document.getElementById('username').value;
    if (username == '') {
        document.getElementById('username_alert').innerHTML = "Username is Required";
    }
    else{
        document.getElementById('username_alert').innerHTML = "";
    }
}

function check_password(){
    var pwd = document.getElementById('pwd').value;
    if (pwd == '') {
        document.getElementById('pass_alert').innerHTML = "Password is Required";
    }
    else{
        document.getElementById('pass_alert').innerHTML = "";
    }
}

function c_panel_login_validation() {
    var username = document.getElementById('username').value;
    var pwd = document.getElementById('pwd').value;

    if (username ==''){
        document.getElementById('username_alert').innerHTML = "Username is Required";
        return false;
    }
    else if(pwd == ''){
        document.getElementById('pass_alert').innerHTML = "Password is Required";
        return false;
    }
}

// c_panel_login check end

//---------------------------------------------------------------------------//

// new police validation start

function new_police_validation() {
    var full_name = document.getElementById('full_name').value;
    var email = document.getElementById('email').value;
    var number = document.getElementById('number').value;
    var police_id = document.getElementById('police_id').value;
    var password = document.getElementById('password').value;
    var password2 = document.getElementById('password2').value;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (full_name == '') {
        document.getElementById('name_alert').innerHTML = "Name is Required";
        return false;
    }

    else if (email == '') {
        document.getElementById('email_alert').innerHTML = "Email is Required";
        return false;
    }
    else if (!email.match(mailformat)) {
        document.getElementById('email_alert').innerHTML = "Provide Valid Email";
        return false;
    }

    else if (number == '') {
        document.getElementById('number_alert').innerHTML = "Mobile no is Required";
        return false;
    }

    else if (police_id == '') {
        document.getElementById('police_id_alert').innerHTML = "Police Id is Required";
        return false;
    }

    else if (password == '') {
        document.getElementById('password_alert').innerHTML = "Password is Required";
        return false;
    }
    else if (password.length<=5){
        document.getElementById('password_alert').innerHTML = "Password at list 6 Character";
        return false;
    }

    else if (password2 == '') {
        document.getElementById('password2_alert').innerHTML = "password is Required Again";
        return false;
    }
    else if (password != password2){
        document.getElementById('password2_alert').textContent = "Password Doesn't match!!!";
        return false;
    }

}
function check_name(){
    var full_name = document.getElementById('full_name').value;
    if (full_name == '') {
        document.getElementById('name_alert').innerHTML = "Name is Required";
    }
    else{
        document.getElementById('name_alert').innerHTML = "";
    }
}
// check valid email address --------------------------------------------------------------------------------
function check_email()
{
    var email = document.getElementById('email').value;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email == '') {
        document.getElementById('email_alert').innerHTML = "Email is Required";
    }
    else {
        if (email.match(mailformat)) {
            document.getElementById('email_alert').innerHTML = "";
            return true;
        }
        else {
            document.getElementById('email_alert').innerHTML = "Invalid email address!!!";
            return false;
        }
    }
}
//-----------------------------------------------------------------------------------------------------------

function check_number(){
    var number = document.getElementById('number').value;
    if (number == '') {
        document.getElementById('number_alert').innerHTML = "Mobile no is Required";
    }
    else{
        document.getElementById('number_alert').innerHTML = "";
    }
}

function check_p_id(){
    var police_id = document.getElementById('police_id').value;
    if (police_id == '') {
        document.getElementById('police_id_alert').innerHTML = "Police Id is Required";
    }
    else{
        document.getElementById('police_id_alert').innerHTML = "";
    }
}

function check_pass1(){
    var password = document.getElementById('password').value;
    if (password == '') {
        document.getElementById('password_alert').innerHTML = "Password is Required";
    }
    else{
        if (password.length<=5){
            document.getElementById('password_alert').innerHTML = "Password at list 6 Character";
            return false;
        }
        else {
            document.getElementById('password_alert').innerHTML = "";
            return true;
        }
    }
}

function check_pass2(){
    var password2 = document.getElementById('password2').value;
    var password = document.getElementById('password').value;
    if (password2 == '') {
        document.getElementById('password2_alert').innerHTML = "password is Required Again";
    }
    else{
        if (password != password2){
            document.getElementById('password2_alert').textContent = "Password Doesn't match!!!";
            return false;
        }
        else {
            document.getElementById('password2_alert').innerHTML = "";
            return true;
        }
    }
}

function check_traffic_id_hover() {
    var traffic_user_id = document.getElementById('traffic_user_id').value;

    if (traffic_user_id ==''){
        document.getElementById('Provide_Police_id').innerHTML = "Valid Traffic User ID is Required !!!";
    }
    else{
        document.getElementById('Provide_Police_id').innerHTML = "";
    }
}



// new police validation end

//----------------------------------------------------------------------------//