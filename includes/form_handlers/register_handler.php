<?php
require_once 'data\userdata.php';

//Deklarisanje varijabli
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();

if (isset($_POST['register_button'])) {
    
    //Ime
    $fname = htmlspecialchars(strip_tags($_POST['reg_fname'])); //uklanja HTML elemente
    $fname = str_replace(' ', '', $fname); //uklanja razmake
    $fname = ucfirst(strtolower($fname)); //ostavlja samo prvo slovo veliko
    $_SESSION['reg_fname'] = $fname; //cuva se u sesiji ime

    //Prezime
    $lname = htmlspecialchars(strip_tags($_POST['reg_lname'])); //uklanja HTML elemente
    $lname = str_replace(' ', '', $lname); //uklanja razmake
    $lname = ucfirst(strtolower($lname)); //ostavlja samo prvo slovo veliko
    $_SESSION['reg_lname'] = $lname; //cuva se u sesiji prezime
    
    //Email
    $em = htmlspecialchars(strip_tags($_POST['reg_email'])); //uklanja HTML elemente
    $em = str_replace(' ', '', $em); //uklanja razmake
    // $em = ucfirst(strtolower($em));
    $_SESSION['reg_email'] = $em; //cuva se u sesiji email


    //email 2
    $em2 = htmlspecialchars(strip_tags($_POST['reg_email2'])); //uklanja HTML elemente
    $em2 = str_replace(' ', '', $em2); //uklanja razmake
    // $em2= ucfirst(strtolower($em2));
    $_SESSION['reg_email2'] = $em2; //cuva se u sesiji email2

    //Lozinka
    $password = htmlspecialchars(strip_tags($_POST['reg_password'])); //uklanja HTML elemente
    $password2 = htmlspecialchars(strip_tags($_POST['reg_password2'])); //uklanja HTML elemente

    $password = str_replace(' ', '', $password); //uklanja razmake
    $password2 = str_replace(' ', '', $password2); //uklanja razmake


    $date = date("Y-m-d"); //uzima trenutni datum

    if ($em == $em2) {
        if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            //provera da li je vec koriscen taj email

            /*$e_check = mysqli_query($con, "SELECT Email FROM users_data WHERE Email ='$em'");
            $num_rows = mysqli_num_rows($e_check);*/

            if (UserData::CheckEmail($em)) {
                array_push($error_array, "Email already in use");
            }

        }else {
            array_push($error_array, "Invalid email format"); 
        }   
    }else{
        array_push($error_array, "Emails don't match"); 
    }
 
    //provera duzine imena
    if (strlen($fname)>25 || strlen($fname)<2) {
        array_push($error_array,  "Your first name must be between 2 and 25 characters");
    }
    //provera duzine prezimena
    if (strlen($lname)>25 || strlen($lname)<2) {
        array_push($error_array, "Your last name must be between 2 and 25 characters"); 
    }
    //password i password2 moraju da budu isti
    if ($password != $password2) {
        array_push($error_array, "Your passwords do not match");
    }else {
        //lozinka moze da sadrzi samo slova i brojeve
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array,  "Your password can only contain english characters and numbers");
        }
    }
    //odgovarajuca duzina lozinke
    if (strlen($password) >30 || strlen($password) < 5) {
        array_push($error_array, "Your password must be between 5 and 30 characters"); 
    }

    if (isset($_SESSION['captcha_code']) && $_POST['captcha_code'] == $_SESSION['captcha_code']) {
        unset($_SESSION['captcha_code']);

    }else{
        array_push($error_array, "Invalid code! Please, try again.<br>"); 
    }
    if (empty($error_array)) {
        $password = md5($password); //enkripcija lozinke

        //povezivanje imena i prezimena u username
        $username = strtolower($fname . "_" . $lname);
        // Ako postoji u bazi username, dodati mu broj
        UserData::CheckUsername($username);
        
        //$check_username_query = mysqli_query($con, "SELECT UserName FROM users_data WHERE UserName = '$username'");
        $i = 0;
        
        while (mysqli_num_rows(UserData::CheckUsername($username)) !=0) {
            $i++;
            $username = $username . "_" . $i;
            UserData::CheckUsername($username);
        }

        //dodeljujemo korisniku random profilnu sliku 
        $rand = rand(1, 7);
        if ($rand == 1) {
            $profile_picture = "images/profile_pictures/head_alizarin.png";   
        }else if($rand == 2){
            $profile_picture = "images/profile_pictures/head_belize_hole.png";
        }else if($rand == 3){
            $profile_picture = "images/profile_pictures/woman_128.png";
        }else if($rand == 4){
            $profile_picture = "images/profile_pictures/avatar_128.png";
        }else if($rand == 5){
            $profile_picture = "images/profile_pictures/avatar (1)_128.png";
        }else if($rand == 6){
            $profile_picture = "images/profile_pictures/avatar (2)_128.png";
        }else if($rand == 7){
            $profile_picture = "images/profile_pictures/avatar (3)_128.png";
        }

        if (isset($_SESSION['captcha_code']) && $_POST['captcha_code'] == $_SESSION['captcha_code']) {
            unset($_SESSION['captcha_code']);
    
        }else{
            array_push($error_array, "Invalid code!"); 
        }
        
        
        //unos podataka u bazu
        // UserData::CreateUser($fname, $lname, $username, $em, $password, $date, $profile_picture);
     
         //unos podataka u bazu
         $query = mysqli_query($con, "INSERT INTO users_data VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_picture')");
        array_push($error_array, "<span style='color:#14C800;'>You're all set! Go ahead and login!</span><br>");

        //brisanje podataka iz sesija
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    }
}


?>

