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