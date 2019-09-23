<!-- <?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
require 'includes/reset_password.inc.php'

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
            
            <?php
                $selector = $_POST["selector"];
                $validator = $_POST["validator"];
                
                if (empty($selector) || empty($validator)) {
                    echo "Could not validate your request!";
                }else {
                    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false ) {
                        ?>

                <form action="includes/reset_password.inc.php" method="POST">
                        <input type="hidden" name="selector" id="selector" value="<?php echo $selector?>">
                        <input type="hidden" name="validator" id="validator" value="<?php echo $validator?>">
                        <input type="password" name="pwd" placeholder="Enter new password.." >
                        <input type="password" name="pwd_repeat" placeholder="Repeat new password..">
                        <input type="submit" name="reset_password_submit" value="Reset password">
                </form>
                        <?php
                    }
                }

            
            ?>
            
            
            </div>
        </div>
    
</body>
</html> -->