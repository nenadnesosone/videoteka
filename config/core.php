<?php
// ako ima greska
error_reporting(E_ALL);
 
// default time-zone // ovo smo stavili i u config.php - nepotrebno da bude i ovde?
date_default_timezone_set("Europe/Belgrade");
 
// promenljive za jwt
$key = "example_key"; //jedinstven tajni kljuc
$iss = "http://example.org";
$aud = "http://example.com";
$iat = 1356999524;
$nbf = 1357000000;

// iss (issuer) ko je izdao JWT.

// aud (audience) za koga je  JWT namenjen. 

// iat (issued at) vreme kad je JWT izdat.

// nbf (not before) vreme pre kog JWT nesme biti prihvacen.

// exp (expiration time) vreme do kad JWT mora biti prihvacen, posle nece biti privacen.
?>