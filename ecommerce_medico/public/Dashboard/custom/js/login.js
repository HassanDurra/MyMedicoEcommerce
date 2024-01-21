$(document).ready(function(){
    let email     = $("input[name='email']");
    let password  = $("input[name='password']");
    let loginForm = $('#loginForm');

    $(loginForm).submit(function(e){
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
    });
});
