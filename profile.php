<?php
require 'config/config.php';
require 'includes/form_handlers/profile_handler.php';

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
    <script src="js/profile.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/register_style.css">
</head>

<body>
    <?php

    if (isset($_POST['delete_button'])) {
        header('Location: main.php');
    }
    ?>


    <!-- NAV -->
    <nav class="navbar fixed-top navbar-dark bg-transparent navbar-expand-md py-2" id="main-nav">
        <div class="container">
            <a href="main.php" class="navbar-brand mr-auto">
                <img src="images/Logo/logo1.png" width="250" height="100" alt="" class="img-fluid">
            </a>

            <button role="button" class="navbar-toggler" data-toggle="collapse" data-target="#idcollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="idcollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="main.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Your Watchlist</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="wrapper">
        <div class="update_box">
            <div class="update_header">
                <h2>MovieCamp</h2>
                <p>Here you can update or delete your account!</p>
            </div>
            <div id="first">

                <form action="signout.php" method="POST">
                <input type="submit" name="sign_out" value="Sign Out">
                    <br>

                    <a href="#" id="signout" class="signout">You want do update or delete your account?</a>
                </form>
                </div>

            <div id="second">
                <form action="profile.php" method="POST">
                    <input type="email" name="profile_email" placeholder="Email Address" value="<?php
                                                                                            if (isset($_SESSION['profile_email'])) {
                                                                                                echo $_SESSION['profile_email'];
                                                                                            } ?>" required>
                    <br>
                    <input type="password" name="profile_password" placeholder="Password">
                    <br>
                    <?php if (in_array("Email or password was incorrect!<br>", $error_array)) {
                        echo "Email or password was incorrect!<br>";
                    } ?>
                    <br>
                    <input type="text" name="update_fname" placeholder="New First Name" value="<?php
                                                                                        if (isset($_SESSION['update_fname'])) {
                                                                                            echo $_SESSION['update_fname'];
                                                                                        } ?>">
                    <br>
                    <?php if (in_array("Your first name must be between 2 and 25 characters", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>

                    <input type="text" name="update_lname" placeholder="New Last Name" value="<?php
                                                                                        if (isset($_SESSION['update_lname'])) {
                                                                                            echo $_SESSION['update_lname'];
                                                                                        } ?>">
                    <br>
                    <?php if (in_array("Your last name must be between 2 and 25 characters", $error_array)) echo  "Your last name must be between 2 and 25 characters<br>"; ?>

                    <input type="password" name="new_password" placeholder="New Password">
                    <br>
                    <input type="password" name="new_password2" placeholder="Confirm New Password">
                    <br>
                    <?php if (in_array("Your passwords do not match", $error_array)) echo "Your passwords do not match<br>";
                    else if (in_array("Your password can only contain english characters and numbers", $error_array)) echo  "Your password can only contain english characters and numbers<br>";
                    else if (in_array("Your password must be between 5 and 30 characters", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>


                    <input type="submit" name="update_button" value="Update">
                    
                                                                <?php

                                                                    if (isset($_POST["newpwd"])) {
                                                                        if ($_POST["newpwd"] == "passwordupdated") {
                                                                            echo '<p class="signupsuccess">Your password has been reset!</p>';
                                                                        }
                                                                    }

                                                                ?>
                    <input type="submit" name="delete_button" value="Delete">
                    <?php if (in_array("<span style='color:#14C800;'>You have updated your account!</span><br>", $error_array)) echo "<span style='color:#14C800;'>You have updated your account!</span><br>"; ?>
                    <br>
                    <a href="reset_password.php">Forgot your password?</a>
                    <br>
                    <a href="#" id="update" class="update">You want to Sign out?</a>

                </form>
            </div>

        </div>
    </div>
</body>

</html>