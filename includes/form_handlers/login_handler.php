<?php

if (isset($_POST['login_button'])) {
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
    $_SESSION['log_email'] = $email; //cuva u sesiji email

    $password = md5($_POST['log_password']);

    //provera da li se uneti podaci slazu sa podacima u bazi
    $check_database_query = mysqli_query($con, "SELECT * FROM users_data WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if ($check_login_query == 1) {
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];

        $_SESSION['username'] = $username;
        header("Location: index.php");
        
        $_SESSION['log_email'] = "";

        exit();
    }else {
        array_push($error_array,"Email or password was incorrect!<br>");

    }
}

?>