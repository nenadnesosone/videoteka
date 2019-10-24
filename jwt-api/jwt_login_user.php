<?php

// headers da bi ovaj fajl prihvatao samo JSON data
header("Access-Control-Allow-Origin: http://localhost/videoteka-master"); /// promenite kod sebe ako vam je folder videoteka-master na drugom mestu
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// fajlovi potrebni da bi se konektovali na bazu
//require_once './config/config.php';
require_once '../data/userdata.php';
 
// dobijamo podatke preko JSON
$data = json_decode(file_get_contents("php://input"));
 
// $user->email = $data->email; // prikupljamo email iz podataka
$em = $data->email; // stavljamo ga u promenljivu na nekucamo nonstop $user-email
$em = htmlspecialchars(strip_tags($em)); //uklanja HTML elemente
$em = str_replace(' ', '', $em); //uklanja razmake
$em = filter_var($em, FILTER_SANITIZE_EMAIL);
$_SESSION['log_email'] = $em; //cuva u sesiji email

//$user->password = $data->password;// prikupljamo lozinku iz podataka
$password = $data->password;// stavljamo ga u promenljivu na nekucamo nonstop $user-password
$password = htmlspecialchars(strip_tags($password)); //uklanja HTML elemente
$password = str_replace(' ', '', $password); //uklanja razmake
$password = md5($password);  //enkripcija lozinke

 
// generisemo json web token
require_once '../config/core.php';
require_once '../php-jwt-master/src/BeforeValidException.php';
require_once '../php-jwt-master/src/ExpiredException.php';
require_once '../php-jwt-master/src/SignatureInvalidException.php';
require_once '../php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;/// jwt tako zovemo bazu
 
// da li postoji email i da li lozinka odgovarajuca
if(UserData::CheckEmail($em) && UserData::CheckUser($em, $password)){
 
    // uzimamo podatke iz baze
    $row = UserData::GetUserRow($em, $password);
    $userid = $row['UserId'];
    $firstname = $row['FirstName'];
    $lastname = $row['LastName'];
    $username = $row['UserName'];
    $userimage = $row['ProfilePicture'];

    // dajemo podatke sesiji ili cemo sve podatke citati to preko jwt
    // $_SESSION['userid'] = $this->id;
    // $_SESSION['username'] = $this->username;
    // $_SESSION['userimage'] = $this->userimage;
    // $_SESSION['log_email'] = "";

    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "UserId" => $userid,// $this->id
           "FirstName" => $firstname,// $this->firstname
           "LastName" => $lastname,// $this->lastname
           "UserName" => $username,// $this->username
           "Email" => $em,// $this-email
           "ProfilePicture" => $userimage// $this->userimage
       )
    );
 

    // kod pozitivnog odgovora
    http_response_code(200);
 
    // generisemo jwt
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );

}
 
// ulogovanje nije uspelo
else{
 
    // kod za neautorizovan pokusaj ulaska
    http_response_code(401);
 
    // reci korisniku da nije uspeo
    array_push($error_array,"Email or password was incorrect!<br>");
    echo json_encode(array("message" => "Login failed."));
}

/*
// headers da bi ovaj fajl prihvatao samo JSON data
header("Access-Control-Allow-Origin: http://localhost/videoteka-master"); /// promenite kod sebe ako vam je folder videoteka-master na drugom mestu
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// fajlovi potrebni da bi se konektovali na bazu
//require_once '../config/config.php';
require_once '../data/userdata.php';
 
// konektujemo se s bazom
//$database = new Database();

$db = Database::getInstance()->getConnection();
 
// pravimo nov objekat korisnika
$user = new UserData($db);
 
// dobijamo podatke preko JSON
$data = json_decode(file_get_contents("php://input"));
 
$em = $data->email; // prikupljamo email iz podataka

$email_exists = JWTCheckEmail($em);/// da li vec postoji email u bazi
 
// generisemo json web token
require_once '../config/core.php';
require_once '../php-jwt-master/src/BeforeValidException.php';
require_once '../php-jwt-master/src/ExpiredException.php';
require_once '../php-jwt-master/src/SignatureInvalidException.php';
require_once '../php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;/// jwt tako zovemo bazu
 
// check if email exists and if password is correct
if($email_exists && password_verify($data->password, $user->password)){
 
    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
            "UserId" => $userId,// $this->id
            "FirstName" => $fname, // $this->fname
            "LastName" => $lname, // $this->lname
            "UserName" => $username, // $this->username
            "Email" => $em, // $this-em
            "Password" =>  $password, //$this-password
            "ProfilePicture" => $userimage // $this->userimage
       )
    );
 
     // kod pozitivnog odgovora
     http_response_code(200);
 
     // generisemo jwt
     $jwt = JWT::encode($token, $key);
     echo json_encode(
             array(
                 "message" => "Successful login.",
                 "jwt" => $jwt
             ));

}
 
// ulogovanje nije uspelo
else{
 
    // kod za neautorizovan pokusaj ulaska
    http_response_code(401);
 
    // reci korisniku da nije uspeo
    //array_push($error_array,"Email or password was incorrect!<br>");
    echo json_encode(array("message" => "Login failed."));
}

*/


?>