<!-- <?php

if (isset($_POST['reset_password_submit'])) {
    
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd_repeat"];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: ../create_new_password.php?newpwd=empty");
        exit();
    }else if ($password!=$passwordRepeat){
        header("Location: ../create_new_password.php?newpwd=pwdnotsame");
        exit();
    }

    $currentDate = date("U");
    require '../config/config.php';

    $sql = "SELECT * FROM pdwReset where pwdResetSelector=? AND pwdResetExpires >=?";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    }else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You nedd to re-submit your reset request!";
            exit();
        }else{
            $tokenBin =hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false) {
                echo "You nedd to re-submit your reset request!";
            }elseif ($tokenCheck === true){ 
                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users_data where email=?;";
                $stmt = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error!";
                    exit();
                }else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                if (!$row = mysqli_fetch_assoc($result)) {
                    echo "There was an error!";
                    exit();
                }else{

                    $sql = "UPDATE users_data SET password=? WHERE email=?";
                    $stmt = mysqli_stmt_init($con);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "There was an error!";
                        exit();
                    }else {
                        $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                        mysqli_stmt_execute($stmt);


                        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                        $stmt = mysqli_stmt_init($con);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error!";
                            exit();
                        }else {
                            mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                            mysqli_stmt_execute($stmt);
                            header("Location: ../register.php?newpwd=passwordupdated");
                        }
                    }

                }
                }
                
            }
        }
    }
}else {
    header("Location: ../index.php");
}

?> -->