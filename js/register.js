$(document).ready(function() {
    //
    $("#signup").click(function() {
        $("#first").slideUp("slow", function() {
            $("#second").slideDown("slow");
        })
    });
    //
    $("#signin").click(function() {
        $("#second").slideUp("slow", function() {
            $("#first").slideDown("slow");
        })
    });
    
    //frontend validacija
    $(document).ready(function () {    
        let errorMessage = document.querySelector('#errorMessage');
        // reakcija na keyup
        $('#reg_fname').keyup(function() {
            let $th = $(this);
            $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
            if ($th.val().length > 25 || $th.val().length < 2) {
                errorMessage.textContent = "Your first name must be between 2 and 25 characters!";
                return false;
            }else{
                errorMessage.textContent ="";
            }
        });

        $('#reg_lname').keyup(function() {
            let $th = $(this);
            $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(){ return ''; }) );
            if ($th.val().length > 25 || $th.val().length < 2) {
                errorMessage.textContent = "Your last name must be between 2 and 25 characters!";
                return false;
            }else{
                errorMessage.textContent = "";
            }

        });
        $('#reg_email').keyup(function() {
            let $th = $(this);
            if ($th.val().lastIndexOf(".") < $th.val().indexOf("@") || $th.val().indexOf("@") ===-1 || $th.val().lastIndexOf(".") ===-1 ) {
               errorMessage.textContent = "Invalid email adress!"
               return false; 
            }else{
                errorMessage.textContent = "";
            }

        });
        $('#reg_email2').keyup(function() {
            let $th = $(this);
            if ($th.val().lastIndexOf(".") < $th.val().indexOf("@") || $th.val().indexOf("@") ===-1 || $th.val().lastIndexOf(".") ===-1 ) {
               errorMessage.textContent = "Invalid email adress!"
               return false; 
            }else{
                errorMessage.textContent = "";
            }
            if ($th.val() !== $('#reg_email').val()) {
                errorMessage.textContent = "Emails don't match!"
            }else{
                errorMessage.textContent = "";
            }
        });
        $('#reg_password').keyup(function() {
            let $th = $(this);
            if ($th.val().length <5 || $th.val().length >30 ) {
               errorMessage.textContent = "Your password must be between 5 and 30 characters!";
               return false; 
            }else{
                errorMessage.textContent = "";
            }
        });
        $('#reg_password2').keyup(function() {
            let $th = $(this);
            if ($th.val() !== $('#reg_password').val()) {
               errorMessage.textContent = "Passwords don't match!";
               return false; 
            }else{
                errorMessage.textContent = "";
            }
        });
    });

    // Reakcija na klik dugmeta
    $('#login_button').click(() => {
        // Reference na input elemente iz kojih cemo citati podatke

        let email = $('#log_email').val().trim();
        let password = $('#log_password').val().trim();

        // Server url - Konfigurisite ga u skladu sa vasim racunarem
        let loginServerUrl = 'jwt-api/jwt_login_user.php';

        // Pravimo podatke koji ce biti poslati serveru
        let data = {
            email: email,
            password: password,
        }

        // Vrsimo POST zahtev na server.
        // Vazno je podatke pretvoriti u JSON string!
        $.ajax({
            type: 'POST',
            url: loginServerUrl,
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            success: function(data) {
                localStorage.setItem('token', data.jwt);
                localStorage.setItem('userId', data.userId);
                // alert('Sucessfully retrieved token from the server');
            },
            error: function(e) {
                console.log("Login Failed");
                console.log(e);
            }
        });
    });



});