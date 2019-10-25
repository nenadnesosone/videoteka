<?php

if (isset($_POST['login_button'])) {

    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
    $email = htmlspecialchars(strip_tags($_POST['log_email'])); //uklanja HTML elemente
    $email = str_replace(' ', '', $email); //uklanja razmake
    $_SESSION['log_email'] = $email; //cuva u sesiji email

    $password = htmlspecialchars(strip_tags($_POST['log_password'])); //uklanja HTML elemente
    $password = str_replace(' ', '', $password); //uklanja razmake
    $password = md5($password);  //enkripcija lozinke

    //provera da li se uneti podaci slazu sa podacima u bazi
    $check_database_query = mysqli_query($con, "SELECT * FROM users_data WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if ($check_login_query == 1) {
            
            $row = mysqli_fetch_array($check_database_query);
            $_SESSION['username'] = $row['UserName'];
            $_SESSION['userid'] = $row['UserId'];
            $_SESSION['userimage'] = $row['ProfilePicture'];
    
            header("Location: main.php");
            
            $_SESSION['log_email'] = "";
    
            exit();

        
    }else {
        array_push($error_array,"Email or password was incorrect!<br>");

    }
}

?>