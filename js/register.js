$(document).ready(() =>{

    $("#signup").click(() =>{
        $("#first").slideUp("slow", () =>{
            $("#second").slideDown("slow");
        })
    });
    $("#signin").click(() =>{
        $("#second").slideUp("slow", () =>{
            $("#first").slideDown("slow");
        })
    });


    $(document).ready(() =>{
        let errorMessage = document.querySelector('#errorMessage');

        $('#reg_fname').keyup(() =>{
            let $th = $(this);
            $th.val($th.val().replace(/[^a-zA-Z0-9]/g, () =>{ return ''; }));
            if ($th.val().length > 25 || $th.val().length < 2) {
                errorMessage.textContent = "Your first name must be between 2 and 25 characters!";
                return false;
            } else {
                errorMessage.textContent = "";
            }
        });

        $('#reg_lname').keyup(() =>{
            let $th = $(this);
            $th.val($th.val().replace(/[^a-zA-Z0-9]/g, () =>{ return ''; }));
            if ($th.val().length > 25 || $th.val().length < 2) {
                errorMessage.textContent = "Your last name must be between 2 and 25 characters!";
                return false;
            } else {
                errorMessage.textContent = "";
            }

        });
        $('#reg_email').keyup(() =>{
            let $th = $(this);
            if ($th.val().lastIndexOf(".") < $th.val().indexOf("@") || $th.val().indexOf("@") === -1 || $th.val().lastIndexOf(".") === -1) {
                errorMessage.textContent = "Invalid email adress!"
                return false;
            } else {
                errorMessage.textContent = "";
            }

        });
        $('#reg_email2').keyup(() =>{
            let $th = $(this);
            if ($th.val().lastIndexOf(".") < $th.val().indexOf("@") || $th.val().indexOf("@") === -1 || $th.val().lastIndexOf(".") === -1) {
                errorMessage.textContent = "Invalid email adress!"
                return false;
            } else {
                errorMessage.textContent = "";
            }
            if ($th.val() !== $('#reg_email').val()) {
                errorMessage.textContent = "Emails don't match!"
            } else {
                errorMessage.textContent = "";
            }
        });
        $('#reg_password').keyup(() =>{
            let $th = $(this);
            if ($th.val().length < 5 || $th.val().length > 30) {
                errorMessage.textContent = "Your password must be between 5 and 30 characters!";
                return false;
            } else {
                errorMessage.textContent = "";
            }
        });
        $('#reg_password2').keyup(() =>{
            let $th = $(this);
            if ($th.val() !== $('#reg_password').val()) {
                errorMessage.textContent = "Passwords don't match!";
                return false;
            } else {
                errorMessage.textContent = "";
            }
        });
    });


    $('#button').click(() => {

        let email = $('#email').val().trim();
        let password = $('#password').val().trim();

        let loginServerUrl = 'jwt-api/jwt_login_user.php';

        let data = {
            email: email,
            password: password,
        }

        $.ajax({
            type: 'POST',
            url: loginServerUrl,
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            success: (data)=> {
                localStorage.setItem('token', data.jwt);
                localStorage.setItem('userId', data.userId);
                console.log(data)
            },
            error: (e) =>{
                console.log("Login Failed");
                console.log(e);
            }
        });
    });

});