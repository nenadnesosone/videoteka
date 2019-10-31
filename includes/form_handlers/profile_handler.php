<?php
require_once './config/config.php';
require_once './data/userdata.php';

$userId = '';
$em = "";
$fname = "";
$newfname = "";
$lname = "";
$newlname = "";
$password = "";
$newpassword = "";
$newpassword2 = "";
$error_array = array();
$userimage = "";
$uploadOK = 1;

if ((isset($_POST['update_button'])) or (isset($_POST['delete_button']))) {
    
    $em = filter_var($_POST['profile_email'], FILTER_SANITIZE_EMAIL);
    $em = htmlspecialchars(strip_tags($em)); //uklanja HTML elemente
    $em = str_replace(' ', '', $em); //uklanja razmake

    $password = htmlspecialchars(strip_tags($_POST['profile_password'])); //uklanja HTML elemente
    $password = str_replace(' ', '', $password); //uklanja razmake
    $password = md5($password);    //enkripcija lozinke

    //provera da li postoji korisnik
    if (!Userdata::CheckUser($em, $password)) {
        array_push($error_array,"Email or password was incorrect!<br>");
        
    }else{
        // uzimamo podatke iz baze
        $row = UserData::GetUserRow($em, $password);
        $userId = $row['UserId'];
        $fname = $row['FirstName'];
        $lname = $row['LastName'];
        $username = $row['UserName'];
        $password = $row['Password'];
        $userimage = $row['ProfilePicture'];
        if(isset($_POST['delete_button'])){
            //brisemo podatke iz sesije i brisemo korisnika
            session_destroy();
            Userdata::DeleteOneUser($userId);
        } else {
            if(!empty($_POST['update_fname'])){

                $newfname = htmlspecialchars(strip_tags($_POST['update_fname'])); //uklanja HTML elemente
                $newfname = str_replace(' ', '', $newfname); //uklanja razmake
                $newfname = ucfirst(strtolower($newfname)); //ostavlja samo prvo slovo veliko
                    //provera duzine imena
                if (strlen($newfname)>25 || strlen($newfname)<2) {
                    array_push($error_array,  "Your first name must be between 2 and 25 characters");
                } else {

                    $fname = $newfname;
                    $username = strtolower($newfname . "_" . $lname);// username ce biti napisan malim slovima

                    //povezivanje imena i prezimena u username
                    $username = strtolower($newfname . "_" . $lname);
                    UserData::CheckUserName($username);
                    $i = 0;
                    // Ako postoji u bazi username, dodati mu broj
                    while (mysqli_num_rows(UserData::CheckUserName($username)) !=0) {
                        $i++;
                        $username = $username . "_" . $i;
                        UserData::CheckUserName($username);
                    }
                    // menjamo podatke u sesiji
                    $_SESSION['username'] = $username;
                   // menjamo podatke u bazi
                    UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    array_push($error_array, "You have updated your First Name!");
                }
            }
            if(!empty($_POST['update_lname'])){

                $newlname = htmlspecialchars(strip_tags($_POST['update_lname'])); //uklanja HTML elemente
                $newlname = str_replace(' ', '', $newlname); //uklanja razmake
                $newlname = ucfirst(strtolower($newlname)); //ostavlja samo prvo slovo veliko

                //provera duzine prezimena
                if (strlen($newlname)>25 || strlen($newlname)<2) {
                    array_push($error_array, "Your last name must be between 2 and 25 characters"); 
                } else {

                    $lname = $newlname;
                    $username = strtolower($fname . "_" . $lname);// username ce biti napisan malim slovima

                    //povezivanje imena i prezimena u username
                    $username = strtolower($fname . "_" . $lname);
                    UserData::CheckUserName($username);
                    $i = 0;
                    // Ako postoji u bazi username, dodati mu broj
                    while (mysqli_num_rows(UserData::CheckUserName($username)) !=0) {
                        $i++;
                        $username = $username . "_" . $i;
                        UserData::CheckUserName($username);
                    }
                    // menjamo podatke u sesiji
                    $_SESSION['username'] = $username;
                    // menjamo podatke u bazi
                    UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    array_push($error_array, "You have updated your Last Name!");
                }
                
            }
            // ako su ukucane nove sifre
            if((!empty($_POST['new_password'])) and (!empty($_POST['new_password2']))){

                //Lozinka
                $newpassword = htmlspecialchars(strip_tags($_POST['new_password'])); //uklanja HTML elemente
                $newpassword2 = htmlspecialchars(strip_tags($_POST['new_password2'])); //uklanja HTML elemente

                if ($newpassword != $newpassword2) {
                    array_push($error_array, "Your passwords do not match");
                }else if (preg_match('/[^A-Za-z0-9]/', $newpassword)) {
                    //lozinka moze da sadrzi samo slova i brojeve
                    array_push($error_array,  "Your password can only contain english characters and numbers");
                }else if(strlen($newpassword) >30 || strlen($newpassword) < 5) {
                    //neodgovarajuca duzina lozinke
                    array_push($error_array, "Your password must be between 5 and 30 characters"); 
                } else {
                    $newpassword = md5($newpassword);    //enkripcija lozinke
                    
                    $password = $newpassword;// tek kad smo sve proverili menjamo lozinku

                    // menjamo podatke u bazi
                    UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    array_push($error_array, "You have updated your Password!");
                }
            } 
            if (isset($_FILES['new_image'])){

                $file_name = $_FILES['new_image']['name'];
                $file_size = $_FILES['new_image']['size'];
                $file_tmp = $_FILES['new_image']['tmp_name'];
                $file_type =  $_FILES['new_image']['type'];
                $splitParts = explode('.',  $_FILES['new_image']['name']);
                $file_ext = strtolower(end($splitParts));
                $exts = array("jpg", "jpeg", "png");
                $userphoto = $username. '.'.$file_ext;
                $image_location = "images/profile_pictures/" .$userphoto;
                // gde cemo staviti sliku kad je ucitamo
        
                //proveravamo da li je fajl prazan
                if($file_size == 0) {
                    $uploadOK = 0;
                // proveravamo da li je slika odgovarajuce velicine
                }else if($file_size > 10240){
                    array_push($error_array,"Your image is too large!");
                    $uploadOK = 0;
                // proveravamo da li je extenzija dobra
                }else if(in_array($file_ext, $exts) === false){
                    array_push($error_array,"Extention must be JPEG, PNG or JPG!");
                    $uploadOK = 0;
                } else if($uploadOK !== 0){
                    if(file_exists($image_location)){ 
                        // brisemo predhodnu sluku ako je bilo takve slike s istim korisnickim imenom
                        unlink($image_location);
                    }
                    // vrsi se upload u odredjeni folder
                    move_uploaded_file($file_tmp, $image_location);
                    $userimage = $image_location;
                    // menjamo podatke u bazi
                    UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    $_SESSION['userimage'] = $userimage;
                    array_push($error_array,"You have updated your profile picture!");
    
                }
        
            }
          
        }

    } 
}

?>