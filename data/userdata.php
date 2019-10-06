<?php
require_once 'config\config.php';

// klasa uz ciju pomoc cemo pristupati korisnickim podacima
class UserData{

    public $userId;
    public $fname;
    public $lname;
    public $username;
    public $em;
    public $password;
    public $date;
    public $profile_picture;


    // funkcija konstruktor
    public function __construct($userId, $fname, $lname, $userName, $em, $password, $date, $profile_picture)
    {
        $this->userId = $userId; 
        $this->fname = $fname;
        $this->$lname = $$lname;
        $this->userName = $userName;
        $this->em = $em;
        $this->password = $password;
        $this->$date = $date;
        $this->profile_picture = $profile_picture;

    }

    // funcija koja ce prikupljati podatke o svim korisnicima iz baze
    public static function GetAllUsers()
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();
        ///odaberemo sve
        $query = "SELECT * FROM users_data";
        $result = mysqli_query($db, $query);
        if ($result) {
            $userData = [];
            while ($row = mysqli_fetch_assoc($result))
            {
                $userData [] = $row;
            }
            return $userData;
        } else {
            return [];
        }
    }

    // funcija koja ce prikupljati podatke o korisnicima iz baze
    public static function GetSomeUsers($userId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users_data WHERE userId='$userId'";
        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }


    // funkcija za ubacivanje korisnika u bazu
    public static function CreateUser($fname, $lname, $username, $em, $password, $date, $profile_picture)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        $query = "INSERT INTO users_data (`UserId`,`FirstName`,`LastName`,`UserName`,`Email`,`Password`,`RegistrationDate`,`ProfilePicture`) 
        VALUES (DEFAULT, '$fname', '$lname','$username','$em','$password','$date','$profile_picture')";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje korisnika iz baze
    public static function DeleteOneUser($userId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // brisanje filmova iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM users_data WHERE UserId='$userId'";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za update korisnika iz bazu
    public static function UpdateUser($userId, $fname, $lname, $username, $password)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        //  update emaila u bazi	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE users_data SET FirstName='$fname', LastName='$lname', UserName='$username',  Password='$password' WHERE UserId='$userId'";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //provera da li email vec postoji u bazi
    public static function CheckEmail($em)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // odaberemo konkretan email
        $query = "SELECT Email FROM users_data WHERE Email ='$em'";
        $e_check = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($e_check);
        //ako ima vise redova od 0 postoji u bazi
        if ($num_rows>0) {
            return false;
        } else{
            return true;
        }
    
    }

    // proverava da li postoji korisnik u bazi
    public static function CheckUser($em, $password)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // odaberemo konkretan email
        $query = "SELECT Email FROM users_data WHERE Email ='$em' AND Password='$password'";
        $e_check = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($e_check);
        //ako ima vise redova od 0 postoji u bazi
        if ($num_rows>0) {
            return true;
        } else{
            return false;
        }
    
    }

    // funcija koja ce prikupljati podatke o korisnicima iz baze koje cemo koristiti
    public static function GetUserRow($em, $password)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users_data WHERE Email ='$em' AND Password='$password'";
        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }

    public static function CheckUserName($username)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca $username

        // odaberemo konkretnog korisnika
        $query = "SELECT UserName FROM users_data WHERE UserName = '$username'";
        $check_username_query = mysqli_query($db, $query);
        return $check_username_query;
    }
	
}

?>
