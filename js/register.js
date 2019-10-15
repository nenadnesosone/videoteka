$(document).ready(function(){
    //
    $("#signup").click(function () {
        $("#first").slideUp("slow", function () {
            $("#second").slideDown("slow");
        })
    });
    //
    $("#signin").click(function () {
        $("#second").slideUp("slow", function () {
            $("#first").slideDown("slow");
        })
    });

    // zakomentarisano dok sve nebude gotovo
  

    // Reakcija na klik dugmeta
    $('#register_button').click(() => {

    // Reference na input elemente iz kojih cemo citati podatke
    let fname = $('#reg_fname').val().trim();
    let lname = $('#reg_lname').val().trim();
    let em = $('#reg_email').val().trim();
    let em2 = $('#reg_email2').val().trim();
    let password = $('#reg_password').val().trim();
    let password2 = $('#reg_password2').val().trim();

    // Server url - Konfigurisite ga u skladu sa vasim racunarem
    const createServerUrl = 'jwt_create_user.php';

        // Pravimo podatke koji ce biti poslati serveru
        let data = {
            'fname': fname,
            'lname': lname,
            'em': em,
            'em2': em2,
            'password': password,
            'password': password2,
        }

        // Vrsimo POST zahtev na server.
        // Vazno je podatke pretvoriti u JSON string!
        $.ajax({
            type: 'POST',
            url: createServerUrl,
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            success: function(serverResponse) {
                console.log("Odgovor servera");
                console.log(serverResponse);
                if (serverResponse['success']) {

                    //alert("register ok");// alert za proveru
                    // registrovan je korisnik poruka koju treba da dobijemo od servera
                } else {
                    //alert("not register");// alert za proveru
                    // nije registrovan je korisnik poruka koju treba da dobijemo od servera
                }
            },
            error: function(e) {
                //alert("error");// alert za proveru
                console.log("error");
                console.log(e);
            }
        });
    });

    // Reakcija na klik dugmeta
    $('#login_button').click(() => {

        // Reference na input elemente iz kojih cemo citati podatke

        let email = $('#log_email').val().trim();
        let password = $('#log_password').val().trim();

        // Server url - Konfigurisite ga u skladu sa vasim racunarem
        let loginServerUrl = 'jwt_login_user.php';

        // Pravimo podatke koji ce biti poslati serveru
        let data = {
            'email': email,
            'password': password,
        }

        // Vrsimo POST zahtev na server.
        // Vazno je podatke pretvoriti u JSON string!
        $.ajax({
            type: 'POST',
            url: loginServerUrl,
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            success: function(serverResponse) {
                console.log("Odgovor servera");
                console.log(serverResponse);
                if (serverResponse['success']) {
                    //alert("login ok"); // alert za proveru
                    // ulogovan je korisnik poruka koju treba da dobijemo od servera
                } else {
                    alert("login not ok"); //ovo nisam testirao
                    // nije ulogovan korisnik poruka koju treba da dobijemo od servera
                }
            },
            error: function(e) {
                //alert("error"); //ovo sam testirao prikazuje se
                console.log("error");
                console.log(e);
            }
        });
    });







});