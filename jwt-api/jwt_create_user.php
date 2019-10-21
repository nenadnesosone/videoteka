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
$user->fname = $data->fname;
$user->lname = $data->lname;
$user->em = $data->em;
$user->em2 = $data->em2;
$user->password = $data->password;
$user->password2 = $data->password2;

 // ako su ispunjeni uslovi pravimo korisnika
if(
    !empty($user->fname) &&
    !empty($user->lname) &&
    !empty($user->em) &&
    !empty($user->em2) &&
    !empty($user->password) &&
    !empty($user->password2)
){

    // deklarisanje promenljivih da nekucamo nonstop $this
    $fname = $this->fname; // $fname = $user->fname
    $lname = $this->lname; // $lname = $user->lname
    $em = $this->em; // $em = $user->em
    $em2 = $this->em2; // $em2 = $user->em2
    $password = $this->password; // $password = $user->password
    $password2 = $this->password2; // $password = $user->password
    $date = "";
    $error_array = array();
    
    //Ime
    $fname = htmlspecialchars(strip_tags($fname));//uklanja HTML elemente
    $fname = str_replace(' ', '', $fname); //uklanja razmake
    $fname = ucfirst(strtolower($fname)); //ostavlja samo prvo slovo veliko
    $_SESSION['reg_fname'] = $fname; //cuva se u sesiji ime

    //Prezime
    $lname = htmlspecialchars(strip_tags($lname));//uklanja HTML elemente
    $lname = str_replace(' ', '', $lname); //uklanja razmake
    $lname = ucfirst(strtolower($lname)); //ostavlja samo prvo slovo veliko
    $_SESSION['reg_lname'] = $lname; //cuva se u sesiji prezime

    //Email 
    $em = htmlspecialchars(strip_tags($em));//uklanja HTML elemente
    $em = str_replace(' ', '', $em); //uklanja razmake
    $_SESSION['reg_email'] = $em; //cuva se u sesiji email

    $em2 = htmlspecialchars(strip_tags($em2));//uklanja HTML elemente
    $em2 = str_replace(' ', '', $em2); //uklanja razmake
    $_SESSION['reg_email2'] = $em2; //cuva se u sesiji email

    //Lozinka
    $password = htmlspecialchars(strip_tags($password));//uklanja HTML elemente
    $password = str_replace(' ', '', $password); //uklanja razmake
    
    $password2 = htmlspecialchars(strip_tags($password2));//uklanja HTML elemente
    $password2 = str_replace(' ', '', $password2); //uklanja razmake

    $date = date("Y-m-d"); //uzima trenutni datum

    if ($em == $em2) {
        if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            //provera da li je vec koriscen taj email
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

        //unos podataka u bazu
        UserData::CreateUser($fname, $lname, $username, $em, $password, $date, $profile_picture);
        
        array_push($error_array, "<span style='color:#14C800;'>You're all set! Go ahead and login!</span><br>");

        //brisanje podataka iz sesija
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";

        // kod kad je napravljen korisnik
        http_response_code(200);
    
        // displej poruka
        echo json_encode(array("message" => "User was created."));
    }
}
 
    // ako nije napravljen korisnik
else{
 
    // kod kad nije napravljen korisnik
    http_response_code(400);
 
    // displej poruka da nije napravljen korisnik
    echo json_encode(array("message" => "Unable to create user."));
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
 
// postavljamo vrenosti
$user->ftname = $data->firstname;
$user->lname = $data->lastname;
$user->em = $data->email;
$user->em2 = $data->email2;
$user->password = $data->password;
$user->password2 = $data->password2;

// ako su ispunjeni uslovi pravimo korisnika
if(
    !empty($user->fname) &&
    !empty($user->lname) &&
    !empty($user->em) &&
    !empty($user->em2) &&
    !empty($user->password) &&
    !empty($user->password2) &&
    $user->JWTCreateUser()
){
        
        array_push($error_array, "<span style='color:#14C800;'>You're all set! Go ahead and login!</span><br>");

        //brisanje podataka iz sesija
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";

        // kod odgovora
        http_response_code(200);
 
    // displej poruka da je napravljen korisnik
    echo json_encode(array("message" => "User was created."));
}
 
    // ako nije napravljen korisnik
else{
 
    // kod kad nije napravljen korisnik
    http_response_code(400);
 
    // displej poruka da nije napravljen korisnik
    echo json_encode(array("message" => "Unable to create user."));
}

*/


?>