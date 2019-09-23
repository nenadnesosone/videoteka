<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

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
    <?php 
    
    if(isset($_POST['register_button'])) {
        echo '
            <script>
            $(document).ready(function() {
                $("#first").hide();
                $("#second").show();
            });
            </script>
        ';
        }
        ?>

<div class="wrapper">
    <div class="login_box">
        <div class="login_header">
            <h2>Reset your password!</h2>
            <p>An email will be sent to you with instructions on how to reset your password.</p>
        </div>
            <form action="includes/reset_request.php" method="POST">
                <input type="email" name="reset_email" id="reset_email" placeholder="Enter your email adress...">
                <br>
                <input type="submit" name="reset_request_submit" value="Receive new password by email.">
            </form>
            
            <?php
                if (isset($_GET["reset"])) {
                    if ($_GET["reset"] == "success") {
                        echo '<p class="signupsuccess">Check your email!</p>';
                    }
                }
            
            
            ?>

            </div>
        </div>
    
</body>
</html>