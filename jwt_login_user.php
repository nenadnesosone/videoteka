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
 
// dobijamo podatke preko JSON
$data = json_decode(file_get_contents("php://input"));
 

$user->email = $data->email; // prikupljamo email iz podataka
$em = $user->email; // stavljamo ga u promenljivu na nekucamo nonstop $user-email
$em = htmlspecialchars(strip_tags($em)); //uklanja HTML elemente
$em = str_replace(' ', '', $em); //uklanja razmake
$em = filter_var($em, FILTER_SANITIZE_EMAIL);
$_SESSION['log_email'] = $em; //cuva u sesiji email

$user->password = $data->password;// prikupljamo lozinku iz podataka
$password = $user->password;// stavljamo ga u promenljivu na nekucamo nonstop $user-password
$password = htmlspecialchars(strip_tags($password)); //uklanja HTML elemente
$password = str_replace(' ', '', $password); //uklanja razmake
$password = md5($password);  //enkripcija lozinke

 
// generisemo json web token
include_once 'config/core.php';
include_once 'php-jwt-master/src/BeforeValidException.php';
include_once 'php-jwt-master/src/ExpiredException.php';
include_once 'php-jwt-master/src/SignatureInvalidException.php';
include_once 'php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;/// jwt tako zovemo bazu
 
// da li postoji email i da li lozinka odgovarajuca
if(UserData::CheckEmail($em) && UserData::CheckUser($em, $password)){
 
    // uzimamo podatke iz baze
    $row = UserData::GetUserRow($em, $password);
    $this->id = $row['UserId'];
    $this->firstname = $row['FirstName'];
    $this->lastname = $row['LastName'];
    $this->username = $row['UserName'];
    $this->userimage = $row['ProfilePicture'];

    // dajemo podatke sesiji ili cemo sve podatke citati to preko jwt
    $_SESSION['userid'] = $this->id;
    $_SESSION['username'] = $this->username;
    $_SESSION['userimage'] = $this->userimage;
    $_SESSION['log_email'] = "";

    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "UserId" => $user->id,// $this->id
           "FirstName" => $user->firstname,// $this->firstname
           "LastName" => $user->lastname,// $this->lastname
           "UserName" => $user->username,// $this->username
           "Email" => $user->email// $this-email
           "ProfilePicture" => $user->userimage// $this->userimage
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
    header("Location: watchlist.php");
    exit();

}
 
// ulogovanje nije uspelo
else{
 
    // kod za neautorizovan pokusaj ulaska
    http_response_code(401);
 
    // reci korisniku da nije uspeo
    array_push($error_array,"Email or password was incorrect!<br>");
    echo json_encode(array("message" => "Login failed."));
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
 
// dobijamo podatke preko JSON
$data = json_decode(file_get_contents("php://input"));
 

$user->email = $data->email; // prikupljamo email iz podataka

$email_exists = $user->JWTCheckEmail();/// da li vec postoji email u bazi
 
// generisemo json web token
include_once 'config/core.php';
include_once 'php-jwt-master/src/BeforeValidException.php';
include_once 'php-jwt-master/src/ExpiredException.php';
include_once 'php-jwt-master/src/SignatureInvalidException.php';
include_once 'php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;/// jwt tako zovemo bazu
 
// check if email exists and if password is correct
if($email_exists && password_verify($data->password, $user->password)){
 
    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
            "UserId" => $user->id,// $this->id
            "FirstName" => $user->fname, // $this->fname
            "LastName" => $user->lname, // $this->lname
            "UserName" => $user->username, // $this->username
            "Email" => $user->em, // $this-em
            "Password" =>  $user->password, //$this-password
            "ProfilePicture" => $user->userimage // $this->userimage
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
     header("Location: watchlist.php");
     exit();
 
}
 
// ulogovanje nije uspelo
else{
 
    // kod za neautorizovan pokusaj ulaska
    http_response_code(401);
 
    // reci korisniku da nije uspeo
    array_push($error_array,"Email or password was incorrect!<br>");
    echo json_encode(array("message" => "Login failed."));
}

*/

?>