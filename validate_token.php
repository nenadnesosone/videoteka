<?php
// headers da bi ovaj fajl prihvatao samo JSON data
header("Access-Control-Allow-Origin: http://localhost/videoteka-master/"); /// promenite kod sebe ako vam je folder videoteka-master na drugom mestu
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// da bi dekodirali jwt
include_once 'config/core.php';
include_once 'php-jwt-master/src/BeforeValidException.php';
include_once 'php-jwt-master/src/ExpiredException.php';
include_once 'php-jwt-master/src/SignatureInvalidException.php';
include_once 'php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// dobijamo podatke iz php
$data = json_decode(file_get_contents("php://input"));
 
// dobijamo jwt
$jwt=isset($data->jwt) ? $data->jwt : "";// da su podaci token ili je prazno
 
// ako je jwt prazan
if($jwt){
    //ako je token moramo da ga dekodiramo
 
    // ako smo ga dekorirali pokazati korisnicke detalje
    try {
        // dekodiramo
        $decoded = JWT::decode($jwt, $key, array('md5'));
 
        // kod odgovora
        http_response_code(200);
 
        // prikazi korisnicke podatke
        echo json_encode(array(
            "message" => "Access granted.",
            "data" => $decoded->data
        ));
 
    }
 
    // ako dekodiranje ne uspe jwt nije dobar
    catch (Exception $e){
    
        // kod odgovora
        http_response_code(401);
    
        // kazati korisniku da je odbijen i prikazati poruku
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
} else  { 
    // prikazati gresku ako je jwt prazan
    // kod odogovora
    http_response_code(401);
 
    // poruka korisniku da je pristup odbijen
    echo json_encode(array("message" => "Access denied."));
}
?>