$(document).ready(function(){
    let image            = $("input[name='image']");
    let username         = $("input[name='username']");
    let email            = $("input[name='email']");
    let confirm_pass     = $("input[name='confirm_password']");
    let password         = $("input[name='password']");
    let registerForm     = $('#registerForm');

    $(registerForm).submit(function(e){
        if($(username).val() == "" ){
            e.preventDefault();
            toastr['warning']("User name Field is Required..!");
            return false;
        }
        if($(email).val() == "" ){
            e.preventDefault();
            toastr['warning']("Email Field is Required..!");
            return false;
        }
        if($(password).val() == "" ){
            e.preventDefault();
            toastr['warning']("Password Field is Required..!");
            return false;
        }
        if($(password).val() != "" && $(password).val().length < 8 ){
            e.preventDefault();
            toastr['warning']("Password must be greater then 8-characters..!");
            return false;
        }
        if($(confirm_pass).val() == "" ){
            e.preventDefault();
            toastr['warning']("Confirm Password Field is Required..!");
            return false;
        }
        if($(password).val() != $(confirm_pass).val() && $(password).val() != "" && $(confirm_pass).val() != ""){
            e.preventDefault();
            toastr['warning']("Password not matched..!");
            return false;
        }
    });
});
