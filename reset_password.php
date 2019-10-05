<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

if (isset($_POST['reset_request_submit']) && (!empty($_POST['reset_email']))) {
    $email = $_POST['reset_email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        array_push($error_array, "<p>Invalid email adress. Please type valid format!</p>");
    }else {
        $query = mysqli_query($con, "SELECT * FROM users_data WHERE email = '$email'");
        $row = mysqli_num_rows($query);
        if ($row =="") {
           array_push($error_array, "<p>There is no user registered with this email adress!</p>");
            }
        }
   

    // if ($error_array !="") {
    //     //  echo "<div class=''error>".$error_array[0]."</div>;

    //     echo "error";
    // }else{
        $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
            );
        $expDate = date("Y-m-d H:i:s", $expFormat);

        $token = "0123456789hfksfosfkshfjsdifpwamcxcl";
        $token = str_shuffle($token);
        $token = substr($token, 0, 10);

        mysqli_query($con, "INSERT INTO `password_reset`  VALUES ('$email', '$token', '$expDate') ");
  
        $output='<p>Dear user,</p>';
        $output.='<p>Please click on the following link to reset your password.</p>';
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p><a href="https://www.videoclub.com/includes/password_recovery.php?
        token='.$token.'&email='.$email.'&action=reset_email" target="_blank">
        https://www.videoclub.com/includes/password_recovery.php
        ?token='.$token.'&email='.$email.'&action=reset</a></p>'; 
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p>Please be sure to copy the entire link into your browser.
        The link will expire after 1 day for security reason.</p>';
        $output.='<p>If you did not request this forgotten password email, no action 
        is needed, your password will not be reset. However, you may want to log into 
        your account and change your security password as someone may have guessed it.</p>';   
        $output.='<p>Thanks,</p>';
        $output.='<p>VideoClub Team</p>';
        $body = $output;
        $subject = "Password Recovery - Videoclub";

        $email_to =$email;
        $fromserver = "ljubicazeravic@gmail.com";
        require("PHPMailer/PHPMailerAutoload.php");
        $mail = new PHPMailer();
        $mail -> IsSMTP();
        $mail ->Host="localhost";
        $mail ->SMTPAuth = true;
        $email ->Username = "ljubicazeravic@gmail.com";
        $email -> Password = "12345";
        $email -> Port = 80;
        $mail->From = "ljubicazeravic@gmail.com";
        $mail->FromName = "Videoteka";
        $mail->Sender = $fromserver; 
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);

        if (!$email ->Send()) {
            echo "Mailer error: " . $email->ErrorInfo;
        }else{
            array_push($error_array, "<div class='error'>
            <p>An email has been sent to you with instructions on how to reset your password.</p>
            </div><br /><br /><br />");
        }
    }
//    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to MOVIECAMP</title></title>
    <link rel="stylesheet" href="css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/register.js"></script>
</head>
<body>

    
    
<div class="wrapper">
    <div class="login_box">
        <div class="login_header">
            <h2>Reset your password!</h2>
            <p>An email will be sent to you with instructions on how to reset your password.</p>
        </div>
            <form action="reset_password.php" method="POST">
                <input type="email" name="reset_email" id="reset_email" placeholder="Enter your email adress...">
                <br>
                <?php if (in_array("<p>Invalid email adress. Please type valid format!</p>", $error_array)) echo  "<p>Invalid email adress. Please type valid format!</p>
                <br><a href='javascript:history.go(-1)'>Go Back</a>"; ?>
                
                <?php if (in_array("<p>There is no user registered with this email adress!</p>", $error_array)) echo  "<p>There is no user registered with this email adress!</p>
                <br><a href='javascript:history.go(-1)'>Go Back</a>"; ?>

                <?php if (in_array("<div class='error'>
                <p>An email has been sent to you with instructions on how to reset your password.</p>
                </div><br /><br /><br />", $error_array)) echo  "<div class='error'>
                <p>An email has been sent to you with instructions on how to reset your password.</p>
                </div><br /><br /><br />
                <br><a href='javascript:history.go(-1)'>Go Back</a>"; ?>
                
                <br>
                <input type="submit" name="reset_request_submit" value="Receive new password by email.">
            </form>

            </div>
        </div>
    
</body>
</html>