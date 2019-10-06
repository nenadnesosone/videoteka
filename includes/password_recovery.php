<?php

require "../config/config.php";

if (isset($_GET["token"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"])) {
    $token = $_GET["token"];
    $email = $_GET["email"];
    $curDate = date("Y-m-d H:i:s");
    $query = mysqli_query($con, "SELECT * FROM `password_reset` WHERE  `token` = '$token' and `email` = '$email'");
    $row = mysqli_num_rows($query);
    if ($row =="") {
        array_push($error_array, '<h2>Invalid Link</h2>
        <p>The link is invalid/expired. Either you did not copy the correct link
        from the email, or you have already used the token in which case it is 
        deactivated.</p>
        <p><a href="https://www.allphptricks.com/forgot-password/index.php">
        Click here</a> to reset password.</p>');
    }else{
        $row = mysqli_fetch_assoc($query);
        $expDate = $row['expDate'];
        if ($expDate >= $curDate) {
            ?>
            <br />
            <form method="POST" action="" name="update">
            <input type="hidden" name="action" value="update" />
            <br /><br />
            <label><strong>Enter New Password:</strong></label><br />
            <input type="password" name="pass1" maxlength="15" required />
            <br /><br />
            <label><strong>Re-Enter New Password:</strong></label><br />
            <input type="password" name="pass2" maxlength="15" required/>
            <br /><br />
            <input type="hidden" name="email" value="<?php echo $email;?>"/>
            <input type="submit" value="Reset Password" />
            </form>
            <?php
        }else{
            array_push($error_array, "<h2>Link expired!</h2><p>The link is expired. You are trying to use the expired link which 
            as valid only 24 hours (1 days after request).<br /><br /></p>
            ");
        }
    }

    if (isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")) {
        $pass1 = mysqli_real_escape_string($con, $_POST["pass1"]);
        $pass2 = mysqli_real_escape_string($con, $_POST["pass2"]);
        $email = $_POST["email"];
        $curDate = date("Y-m-d H:i:s");
        
        if ($pass1!=$pass2) {
            array_push($error_array, "<p>Password do not match, both password should be the same.<br /><br /></p>");
        }
            if ($error_array!="") {
                
            }else{
                $pass1 = mb5($pass1);
                mysqli_query($con, "UPDATE users_data SET password = '$pass1' WHERE email = '$email'");

                mysqli_query($con, "DELETE  FROM password_reset WHERE email = '$email'");

                echo '<p>Congratulations! Your password has been updated successfully.</p>
                <p><a href="../../register.php">Click here to login</a></p>';

            }
        

    }
}


?>