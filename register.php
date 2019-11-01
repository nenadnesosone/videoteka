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
    <title>Welcome to MOVIECAMP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/register_style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
    <?php

    if (isset($_POST['register_button'])) {
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
    <?php

    require 'php\partials\mainheader.php';

    ?>


    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h2>MovieCamp</h2>
                <p>Login or sign up below!</p>
            </div>
            <div id="first">
                <form action="register.php" method="POST">
                    <input id="log_email" type="email" name="log_email" placeholder="Email" value="<?php
                     if (isset($_SESSION['log_email'])) {
                    echo $_SESSION['log_email'];
                   } ?>" required>
                    <br>
                    <input id="log_password" type="password" name="log_password" placeholder="Password">
                    <br>
                    <?php if (in_array("Email or password was incorrect!<br>", $error_array)) {
                        echo "Email or password was incorrect!<br>";
                    } ?>
                    <br>
                    <input id="login_button" type="submit" name="login_button" value="Login">
                    <br>

                    <a href="reset_password.php" id="reset_link" style="color:blue;">Forgot your password?</a>
                    <br>
                    <a href="#" id="signup" class="signup">Need an account? Register here!</a>

                </form>
            </div>
            <div id="second">

                <form action="register.php" method="POST" id="register">
                    <input id="reg_fname" type="text" name="reg_fname" placeholder="First name" value="<?php
                    if (isset($_SESSION['reg_fname'])) {
                     echo $_SESSION['reg_fname'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Your first name must be between 2 and 25 characters", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>

                    <input id="reg_lname" type="text" name="reg_lname" placeholder="Last name" value="<?php
                    if (isset($_SESSION['reg_lname'])) {
                       echo $_SESSION['reg_lname'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Your last name must be between 2 and 25 characters", $error_array)) echo  "Your last name must be between 2 and 25 characters<br>"; ?>

                    <input id="reg_email" type="email" name="reg_email" placeholder="Email" value="<?php
                    if (isset($_SESSION['reg_email'])) {
                     echo $_SESSION['reg_email'];
                    } ?>" required>
                    <br>

                    <input id="reg_email2" type="email" name="reg_email2" placeholder="Confirm email" value="<?php
                    if (isset($_SESSION['reg_email2'])) {
                     echo $_SESSION['reg_email2'];
                    } ?>" required>
                    <br>
                    <?php if (in_array("Email already in use", $error_array)) echo  "Email already in use<br>";
                    else if (in_array("Invalid email format", $error_array)) echo  "Invalid email format<br>";
                    else if (in_array("Emails don't match", $error_array)) echo  "Emails don't match<br>"; ?>

                    <input id="reg_password" type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input id="reg_password2" type="password" name="reg_password2" placeholder="Confirm password" required>
                    <br>
                    <?php if (in_array("Your password do not match", $error_array)) echo "Your password do not match<br>";
                    else if (in_array("Your password can only contain english characters and numbers", $error_array)) echo  "Your password can only contain english characters and numbers<br>";
                    else if (in_array("Your password must be between 5 and 30 characters", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>
                    <br>
                    <span><img src="includes/captcha_code.php" id="captcha_image"></span>
                    <br>
                    <input type="text" name="captcha_code" id="captcha_code" placeholder="Enter Code" required>
                    <br>
                    <?php if (in_array("Invalid code! Please, try again.<br>", $error_array)) echo "Invalid code! Please, try again.<br>"; ?>
                    <br>
                    <div style="color:red" class="errorMessage" id="errorMessage"> </div>
                    <br>                      
                    <input id="register_button" type="submit" name="register_button" value="Register">
                    <br>
                    <?php if (in_array("<span style='color:#14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color:#14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
                    <a href="#" id="signin" class="signin">Already have an account? Log in here!</a>
                    <br>                     

                </form>
            </div>
        </div>
    </div>
    <script src="js/register.js"></script>

<!-- 
     <?php
    include 'php/partials/footer.php';
    ?>  -->
</body>

</html>