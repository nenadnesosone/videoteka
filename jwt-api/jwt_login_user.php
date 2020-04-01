<?php
header("Access-Control-Allow-Origin: http://localhost/videoteka-master");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../config/config.php';
require_once '../data/userdata.php';

$data = json_decode(file_get_contents("php://input"));

$em = $data->email;
$em = htmlspecialchars(strip_tags($em)); 
$em = str_replace(' ', '', $em); 
$em = filter_var($em, FILTER_SANITIZE_EMAIL);

$password = $data->password;
$password = htmlspecialchars(strip_tags($password)); 
$password = str_replace(' ', '', $password); 
$password = md5($password); 


require_once '../config/core.php';
require_once '../php-jwt-master/src/BeforeValidException.php';
require_once '../php-jwt-master/src/ExpiredException.php';
require_once '../php-jwt-master/src/SignatureInvalidException.php';
require_once '../php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT; 

if (UserData::CheckUser($em, $password)) {

    $row = UserData::GetUserRow($em, $password);
    $userid = $row['UserId'];
    $firstname = $row['FirstName'];
    $lastname = $row['LastName'];
    $username = $row['UserName'];
    $userimage = $row['ProfilePicture'];

    $token = array(
        "iss" => $iss,
        "aud" => $aud,
        "iat" => $iat,
        "nbf" => $nbf,
        "data" => array(
            "UserId" => $userid,
            "FirstName" => $firstname,
            "LastName" => $lastname,
            "UserName" => $username,
            "Email" => $em,
            "ProfilePicture" => $userimage
        )
    );

    http_response_code(200);

    $jwt = JWT::encode($token, $key);
    echo json_encode(
        array(
            "message" => "Successful login.",
            "jwt" => $jwt,
            "userId" => $userid
        )
    );
} else {

    http_response_code(401);

    echo json_encode(array("message" => "Login failed."));
}
