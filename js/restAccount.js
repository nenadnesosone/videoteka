$(document).ready( ()=> {    
    let errorMessage = document.querySelector('#errorMessageUpdate');
    // reakcija na keyup
    $('#update_fname').keyup(()=> {
        let $th = $(this);
        $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, ()=>{ return ''; }) );
        if ($th.val().length > 25 || $th.val().length < 2) {
            errorMessage.textContent = "Your first name must be between 2 and 25 characters!";
            return false;
        }else{
            errorMessage.textContent ="";
        }
    });

    $('#update_lname').keyup(()=> {
        let $th = $(this);
        $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, ()=>{ return ''; }) );
        if ($th.val().length > 25 || $th.val().length < 2) {
            errorMessage.textContent = "Your last name must be between 2 and 25 characters!";
            return false;
        }else{
            errorMessage.textContent = "";
        }

    });
    $('#profile_email').keyup(()=> {
        let $th = $(this);
        if ($th.val().lastIndexOf(".") < $th.val().indexOf("@") || $th.val().indexOf("@") ===-1 || $th.val().lastIndexOf(".") ===-1 ) {
           errorMessage.textContent = "Invalid email adress!"
           return false; 
        }else{
            errorMessage.textContent = "";
        }

    });
    
    $('#new_password').keyup(()=> {
        let $th = $(this);
        if ($th.val().length <5 || $th.val().length >30 ) {
           errorMessage.textContent = "Your password must be between 5 and 30 characters!";
           return false; 
        }else{
            errorMessage.textContent = "";
        }
    });
    $('#new_password2').keyup(()=> {
        let $th = $(this);
        if ($th.val() !== $('#reg_password').val()) {
           errorMessage.textContent = "Passwords don't match!";
           return false; 
        }else{
            errorMessage.textContent = "";
        }
    });
});
