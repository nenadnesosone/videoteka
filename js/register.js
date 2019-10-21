$(document).ready(function () {
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

    // zakomentarisano dok sve ne bude gotovo
    /*   
       // Reference na input elemente iz kojih cemo citati podatke
       let fname = $('#reg_fname').val().trim();
       let lname = $('#reg_lname').val().trim();
       let em = $('#reg_email').val().trim();
       let em2 = $('#reg_email2').val().trim();
       let password = $('#reg_password').val().trim();
       let password2 = $('#reg_password2').val().trim();
   
       // Server url - Konfigurisite ga u skladu sa vasim racunarem
       const createServerUrl = 'jwt_create_user.php'
   
       // Reakcija na klik dugmeta
       $('#register_button').click(() => {
   
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
   
                       // registrovan je korisnik poruka koju treba da dobijemo od servera
                   } else {
   
                       // nije registrovan je korisnik poruka koju treba da dobijemo od servera
                   }
               },
               error: function(e) {
                   console.log("error");
                   console.log(e);
               }
           });
       });
   
   
       // Reference na input elemente iz kojih cemo citati podatke
   
       let email = $('#log_email').val().trim();
       let password = $('#log_password').val().trim();
   
       // Server url - Konfigurisite ga u skladu sa vasim racunarem
       let loginServerUrl = 'jwt_login_user.php'
   
       // Reakcija na klik dugmeta
       $('#login_button').click(() => {
   
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


    // captcha

})
    
    let code;
    function createCaptcha() {
        //clear the contents of captcha div first 
        document.getElementById('captcha').innerHTML = "";
        let charsArray =
            "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
        let lengthOtp = 6;
        let captcha = [];


        for (let i = 0; i < lengthOtp; i++) {
            //below code will not allow Repetition of Characters
            let index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
            if (captcha.indexOf(charsArray[index]) == -1)
                captcha.push(charsArray[index]);
            else i--;
        }

        const canv = document.createElement("canvas");

        canv.id = "captcha";
        canv.width = 100;
        canv.height = 50;

        let ctx = canv.getContext("2d");
        ctx.font = "25px Georgia";
        ctx.strokeText(captcha.join(""), 0, 30);
        //storing captcha so that can validate you can save it somewhere else according to your specific requirements
        code = captcha.join("");
        document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
    }


    function validateCaptcha() {
        event.preventDefault();
        debugger
        if (document.getElementById("captchaTextBox").value == code) {
            alert("Valid Captcha")
        } else {
            alert("Invalid Captcha. Try Again");
            createCaptcha();
        }
    }
