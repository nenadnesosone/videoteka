<?php
require 'config\config.php';

class UserData{

    public $userId;
    public $fname;
    public $$lname;
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

    // funcija koja ce prikupljati podatke o svim korisnicima iz baze (nisam siguran da li nam je potrebno)
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

    // funcija koja ce prikupljati podatke o korisnicima iz baze koje cemo koristiti
    public static function GetSomeUsers($userId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users_data WHERE userId=$userId";
        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }


    // funkcija za ubacivanje korisnika u bazu ako zelimo da je koristimo 
    public static function CreateUser($reg)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        $fname = $reg['FirstName'];
        $lname = $reg['LastName'];
        $username = $reg['UserName'];
        $em = $reg['Email'];
        $password = $reg['Password'];
        $date = $reg['RegistrationDate'];
        $profile_picture = $reg['ProfilePicture'];

        $query = "INSERT INTO users_data ('UserId','FirstName','LastName','UserName','Email','Password','RegistrationDate','ProfilePicture') 
        VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_picture')";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje korisnika iz bazu ako zelimo da je koristimo
    public static function DeleteOneUser($userId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // brisanje filmova iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM users_data WHERE UserId=$userId";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        // brise podatke u sesiji i vraca ga na pocetnu stranu
            session_destroy();
            header('Location: main.php');
        } else {
            return false;
        }
    }

    // funkcija za update korisnika iz bazu ako zelimo da je koristimo
    public static function UpdateOneUser($userId, $newem)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // brisanje filmova iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE users_data WHERE UserId=$userId SET Email=$newem";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }



    
}
	 		 	 	 	 	 	 	 	 	

?>