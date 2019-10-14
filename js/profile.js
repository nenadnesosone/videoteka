$(document).ready(function(){
    /*
        // zakomentarisano dok sve ne bude gotovo
     
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
    
        // Reakcija na klik dugmeta
        $('#update_button').click(() => {
    
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
    
                        //  korisnik promenio svoje podatke
                    } else {
    
                        // korisnik nije promenio svoje podatke
                    }
                },
                error: function(e) {
                    console.log("error");
                    console.log(e);
                }
            });
        });
    
    
        // Reference na input elemente iz kojih cemo citati podatke navedene iznad
    
        // Server url - Konfigurisite ga u skladu sa vasim racunarem
        const deleteServerUrl = 'jwt_delete_user.php'
    
        // Reakcija na klik dugmeta
        $('#delete_button').click(() => {
    
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
    
                        // ulogovan je korisnik poruka koju treba da dobijemo od servera
                    } else {
    
                        // nije ulogovan korisnik poruka koju treba da dobijemo od servera
                    }
                },
                error: function(e) {
                    console.log("error");
                    console.log(e);
                }
            });
        });
    
    
    
    */
    
    
    });