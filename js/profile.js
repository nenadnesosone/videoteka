$(document).ready(function(){

        // Reakcija na klik dugmeta
        $('#update_button').click(() => {
    
            // Reference na input elemente iz kojih cemo citati podatke
    
            let em = $('#profile_email').val().trim();
            let password = $('#profile_password').val().trim();
            let fname = $('#update_fname"').val().trim();
            let lname = $('#update_lname').val().trim();
            let newpassword = $('#new_password').val().trim();
            let newpassword2 = $('#new_password2').val().trim();
            let newuserimage = $('#new_image').val().trim();
    
            // Server url - Konfigurisite ga u skladu sa vasim racunarem
            const updateServerUrl = 'jwt_update_user.php';
            // Pravimo podatke koji ce biti poslati serveru
            
            let data = {
                'em': em,
                'password': password,
                'fname': fname,
                'lname': lname,
                'newpassword': newpassword,
                'newpassword2': newpassword2,
                'newuserimage' : newuserimage,
            }
    
            // Vrsimo POST zahtev na server.
            // Vazno je podatke pretvoriti u JSON string!
            $.ajax({
                type: 'POST',
                url: updateServerUrl,
                data: JSON.stringify(data),
                contentType: "application/json; charset=utf-8",
                success: function(serverResponse) {
                    console.log("Odgovor servera");
                    console.log(serverResponse);
                    if (serverResponse['success']) {
    
                        // alert("update ok"); // alert za proveru
                        //  korisnik promenio svoje podatke
                    } else {
                        //alert("update not ok");// alert za proveru
                        // korisnik nije promenio svoje podatke
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
        $('#delete_button').click(() => {
    
            // Reference na input elemente iz kojih cemo citati podatke navedene iznad
            let em = $('#profile_email').val().trim();
            let password = $('#profile_password').val().trim();

            // Server url - Konfigurisite ga u skladu sa vasim racunarem
            const deleteServerUrl = 'jwt_delete_user.php'

            // Pravimo podatke koji ce biti poslati serveru
            let data = {
                'email': em,
                'password': password,
            }
    
            // Vrsimo POST zahtev na server.
            // Vazno je podatke pretvoriti u JSON string!
            $.ajax({
                type: 'POST',
                url: deleteServerUrl,
                data: JSON.stringify(data),
                contentType: "application/json; charset=utf-8",
                success: function(serverResponse) {
                    console.log("Odgovor servera");
                    console.log(serverResponse);
                    if (serverResponse['success']) {
                        //alert("user deleted");// alert za proveru
                        // obrisan je korisnik poruka koju treba da dobijemo od servera
                    } else {
                        //alert("user not deleted");// alert za proveru
                        // nije obrisan korisnik poruka koju treba da dobijemo od servera
                    }
                },
                error: function(e) {
                    //alert("error");// alert za proveru
                    console.log("error");
                    console.log(e);
                }
            });
        });
    
    
    
    
    
    
    });