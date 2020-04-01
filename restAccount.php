<?php
require_once 'config/config.php';
require_once 'includes/form_handlers/profile_handler.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to MOVIECAMP</title>
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/register_style.css">
    <script src="js/restAccount.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
    <?php

    if (isset($_POST['delete_button'])) {
        header('Location: main.php');
    }

    require_once 'php\partials\mainheader.php';
    ?>



    <div class="wrapper">
        <div class="update_box">
            <div class="update_header">
                <h2>MovieCamp</h2>
                <p>Here you can update or delete your account!</p>
            </div>

            <div id="first">
                <form action="restAccount.php" method="POST" enctype="multipart/form-data">
                    <input id="profile_email" type="email" name="profile_email" placeholder="Email" value="<?php
                        if (isset($_SESSION['profile_email'])) {
                            echo $_SESSION['profile_email'];
                        } ?>" required>
                    <br>
                    <input id="profile_password" type="password" name="profile_password" placeholder="Password" required>
                    <br>
                    <?php if (in_array("Email or password was incorrect!<br>", $error_array)) {
                        echo "Email or password was incorrect!<br>";
                    } ?>
                    <br>
                    <input id="update_fname" type="text" name="update_fname" placeholder="New First Name" value="<?php
                        if (isset($_SESSION['update_fname'])) {
                            echo $_SESSION['update_fname'];
                        } ?>">
                    <br>
                    <?php if (in_array("Your first name must be between 2 and 25 characters", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>

                    <input id="update_lname" type="text" name="update_lname" placeholder="New Last Name" value="<?php
                        if (isset($_SESSION['update_lname'])) {
                            echo $_SESSION['update_lname'];
                        } ?>">
                    <br>
                    <?php if (in_array("Your last name must be between 2 and 25 characters", $error_array)) echo  "Your last name must be between 2 and 25 characters<br>"; ?>

                    <input id="new_password" type="password" name="new_password" placeholder="New Password">
                    <br>
                    <input id="new_password2" type="password" name="new_password2" placeholder="Confirm New Password">
                    <br>
                    <p>Add new profile picture?</p>
                    <input id="new_image" type="file" name="new_image"><br><br>

                    <?php if (in_array("Your passwords do not match", $error_array)) echo "Your passwords do not match<br>";
                    else if (in_array("Your password can only contain english characters and numbers", $error_array)) echo  "Your password can only contain english characters and numbers<br>";
                    else if (in_array("Your password must be between 5 and 30 characters", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>

                    <?php if (in_array("Your image is too large!", $error_array)) echo  "Your image is to large!<br>";
                        else if (in_array("Extention must be JPEG, PNG or JPG!", $error_array)) echo "Extention must be JPEG, PNG or JPG!<br>";
                        ?>
                    <div style="color:red" class="errorMessageUpdate" id="errorMessageUpdate"> </div>

                    <input id="update_button" type="submit" name="update_button" value="Update">
                    <input id="delete_button" type="submit" name="delete_button" value="Delete"><br>
                    <?php if (in_array("You have updated your First Name!", $error_array)) echo "<span style='color:#14C800;'>You have updated your First Name!</span><br>"; ?>
                    <?php if (in_array("You have updated your Last Name!", $error_array)) echo "<span style='color:#14C800;'>You have updated your Last Name!</span><br>"; ?>
                    <?php if (in_array("You have updated your Password!", $error_array)) echo "<span style='color:#14C800;'>You have updated your Password!</span><br>"; ?>
                    <?php if (in_array("You have updated your image!", $error_array)) echo "<span style='color:#14C800;'>You have updated your profile picture!</span><br>"; ?>
                    
                    <?php
                    ?> 
                    <a href="reset_password.php" style="color:blue;">Forgot your password?</a>
                </form>
            </div>

        </div>
    </div>
    <script src="js/restAccount.js"></script>

    <?php
    require_once 'php/partials/footer.php';
    ?>
</body>

</html>