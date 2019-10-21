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
    $userId = $this->id;

    //brisemo podatke iz sesije i brisemo korisnika
    // token nemozemo obrisati, jer bi to znacilo brisanje na klijentskoj strani, token ce isteci, a posto je korisnik obrisan nece se moci ponovo ulogovati
    session_destroy();
    Userdata::DeleteOneUser($userId);

}
 
// brisanje nije uspelo
else{
 
    // kod za neautorizovan pokusaj brisanja
    http_response_code(401);
 
    // reci korisniku da nije uspeo
    array_push($error_array,"Email or password was incorrect!<br>");
    echo json_encode(array("message" => "Delete failed."));
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
 
// uzimamo jwt
$jwt = isset($data->jwt) ? $data->jwt : "";

// ako jwt nije prazan
if($jwt){
 
    // ako nije prazan prikazati korisnicka podatke
    try {
 
        // dekodiramo jwt
        $decoded = JWT::decode($jwt, $key, array('md5'));
 
        // iz podataka koje postoje u jwt moze da dekodira i uzmu podaci koji ce nam trebati u funkciji JWTDeleteUser()
        $user->userId = $decoded->data->userId;
  
        if($user->JWTDeleteUser()){

            // kod pozitivnog odgovora
            http_response_code(200);
            // brisemo podatke iz sesije
            session_destroy();
            // token nemozemo obrisati, jer bi to znacilo brisanje na klijentskoj strani, token ce isteci, a posto je korisnik obrisan nece se moci ponovo ulogovati
            header('Location: main.php');
        }       
        // brisanje nije uspelo
        else{
                // kod za neautorizovan pokusaj brisanja
                http_response_code(401);
            
                // reci korisniku da nije uspeo
                echo json_encode(array("message" => "Delete failed."));
            }
    }    
    // ako nije uspelo
    catch (Exception $e){
    
        // kod za odgovor
        http_response_code(401);
        
        // poruka o gresci
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }  
}
*/
?>