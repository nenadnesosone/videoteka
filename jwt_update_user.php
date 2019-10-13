<?php
// headers da bi ovaj fajl prihvatao samo JSON data
header("Access-Control-Allow-Origin: http://localhost/videoteka-master/"); /// promenite kod sebe ako vam je folder videoteka-master na drugom mestu
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// fajlovi potrebni da bi se konektovali na bazu
include_once 'config/config.php';
include_once 'data/userdata.php';
 
// prikupljamo podake preko JSON
$data = json_decode(file_get_contents("php://input"));

// postavljamo vrenosti
$user->em = $data->em;
$user->password = $data->password;
$user->newfname = $data->newfname;
$user->newlname = $data->newlname;
$user->newpassword = $data->newpassword;
$user->newpassword2 = $data->newpassword2;
$user->newuserimage = $data->newuserimage;

 // ako su ispunjeni uslovi menjamo podatke korisnika
if(!empty($user->em) && !empty($user->password)){

    //provera da li postoji korisnik
    if (!Userdata::CheckUser($em, $password)) {
        array_push($error_array,"Email or password was incorrect!<br>");
        
    } else {

        // uzimamo podatke iz baze
        $row = UserData::GetUserRow($em, $password);
        $userId = $row['UserId'];
        $fname = $row['FirstName'];
        $lname = $row['LastName'];
        $username = $row['UserName'];
        $password = $row['Password'];
        $userimage = $row['ProfilePicture'];
        $error_array = array();
        $uploadOK = 1;


        if(!empty($user->newfname)){

            $newfname = $this->fname; // $user->newfname
            $newfname = htmlspecialchars(strip_tags($newfname)); //uklanja HTML elemente
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

        if(!empty($user->newlname)){

            $newlname = $this->newlname; //$user->newlname
            $newlname = htmlspecialchars(strip_tags($newlname)); //uklanja HTML elemente
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
        if((!empty($user->newpassword)) && (!empty($user->newpassword2))){


            $newpassword = $this->newpassword; //$user->newpassword
            $newpassword2 = $this->newpassword2; //$user->newpassword2

            //Lozinka
            $newpassword = htmlspecialchars(strip_tags($newpassword)); //uklanja HTML elemente
            $newpassword2 = htmlspecialchars(strip_tags($newpassword2)); //uklanja HTML elemente

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

        if (isset($user->newuserimage)){

            $newuserimage = $this->newuserimage //$user->newuserimage
            $file_name = $newuserimage['name'];
            $file_size = $newuserimage['size'];
            $file_tmp = $newuserimage['tmp_name'];
            $file_type =  $newuserimage['type'];
            $splitParts = explode('.',  $newuserimage['name']);
            $file_ext = strtolower(end($splitParts));
            $exts = array("jpg", "jpeg", "png");
            $userphoto = $username. '.'.$file_ext;
            $image_location = "images/profile_pictures/" .$userphoto;// gde cemo staviti sliku kad je ucitamo
    
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
                array_push($error_array,"You have updated your image!");

                }
        }

        // kod kad je korisnik izmenio podatke
        http_response_code(200);

        // displej poruka
        echo json_encode(array("message" => "User was updated."));

    }
} else{

    // kod kad korisnik nije promenio podatke
    http_response_code(400);
    
    // displej poruka da korisnik prokmenio podatke
    echo json_encode(array("message" => "Unable to update user."));
}

 

/// ako kod gore neradi ovaj bi trebalo da radi
/*
// headers da bi ovaj fajl prihvatao samo JSON data
header("Access-Control-Allow-Origin: http://localhost/videoteka-master/"); /// promenite kod sebe ako vam je folder videoteka-master na drugom mestu
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// fajlovi potrebni da bi se konektovali na bazu
include_once 'config/config.php';
include_once 'data/userdata.php';
 
// konektujemo se s bazom
$database = new Database();

$db = $database->getInstance()->getConnection();
 
// pravimo nov objekat korisnika
$user = new UserData($db);
 
 
// prikupljamo podake preko JSON
$data = json_decode(file_get_contents("php://input"));
 
// postavljamo vrenosti iz podataka
$user->em = $data->em;
$user->password = $data->password;
$user->newfname = $data->newfname;
$user->newlname = $data->newlname;
$user->newpassword = $data->newpassword;
$user->newpassword2 = $data->newpassword2;
$user->newuserimage = $data->newuserimage;

$email_exists = $user->JWTCheckEmail();/// da li vec postoji email u bazi

$userId = $this->userId; // $userid = $user->userId
$em = $this->em; // $em = $user->em
$password = $this->password; // $password = $user->password
$fname = $this->fname; // $user->fname
$lname = $this->lname; // $user->lname

// generisemo json web token
include_once 'config/core.php';
include_once 'php-jwt-master/src/BeforeValidException.php';
include_once 'php-jwt-master/src/ExpiredException.php';
include_once 'php-jwt-master/src/SignatureInvalidException.php';
include_once 'php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;/// jwt tako zovemo bazu
 
// check if email exists and if password is correct
if(($email_exists) && password_verify($data->password, $user->password) && $user->JWTUpdateUser()){

        // kod odgovora
        http_response_code(200);
 
    // display message: user was updated
    echo json_encode(array("message" => "User was updated."));
}
 
    // ako je korisnik
else{
 
    // kod kad korisnik nije promenio podatke
    http_response_code(400);
 
    // displej poruka da korisnik nije promenio podatke
    echo json_encode(array("message" => "Unable to update user."));
}
*/



?>