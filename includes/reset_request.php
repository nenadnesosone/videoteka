<!-- <?php

if (isset($_POST['reset_request_submit'])) {
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    //promeniti url na kraju!!!!!
    $url = "localhost/videoteka/register.php/create_new_password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    require '../config/config.php';

    $userEmail = $_POST['reset_email'];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    }else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    }else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);

    $to = $userEmail;

    $subject = 'Reset your password';
    $message = '<p>We received a password reset request. The link to reset your password</p>';

    $message .= '<br>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: videoteka <ljubicazeravic@gmail.com>\r\n";
    $headers = "Reply-To: ljubicazeravic@gamil.com\r\n";
    $headers = "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
    header("Location: ../reset_password.php?reset=success");

}else {
    header("Location: ../index.php");
}


?> -->