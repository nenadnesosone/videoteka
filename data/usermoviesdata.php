<?php
require 'config\config.php';

class UserMovieData{

    //deklarisanje varijabli
    public $userId;
    public $movieId;

    // funkcija konstruktor
    public function __construct($userId, $movieId)
    {
        $this->userId = $userId; 
        $this->movieId = $movieId;
      
    }

    // funcija koja ce prikupljati podatke o svim korisnicima i svim selektovanim filmovima
    public static function GetAllSelected()
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();
        ///odaberemo sve
        $query = "SELECT * FROM users_movies";
        $result = mysqli_query($db, $query);
        if ($result) {
            $usersMoviesData = [];
            while ($row = mysqli_fetch_assoc($result))
            {
                $usersMoviesData [] = $row;
            }
            return $usersMoviesData;
        } else {
            return [];
        }
    }

    // funcija koja ce prikupljati podatke pojedinacnom korisniku koji je odabrao neke filmove
    public static function GetAllUsersMovies($userId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId medjutim, on se ulogovao i znamo ko je

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users_movies WHERE userId=$userId";
        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }


    // funkcija za ubacivanje filma kojeg je korisnik odabrao
    public static function CreateUserMovies($selected)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();
        // podatke stavljamo u promenljive
        $userId = $selected['Userid'];
        $movieId = $selected['MovieId'];
        
        $query = "INSERT INTO users_movies (`UserId`,`MovieId`) VALUES ('$userId', '$movieId')";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje svih korisnikovih filmova iz baze ako zelimo da je koristimo
    public static function DeleteUserMovies($userId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // brisanje filmova iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM users_movies WHERE UserId=$userId";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje jednog korisnikovog filma iz baze
    public static function DeleteOneUserMovie($userId, $movieId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId i movieid

        // brisanje odabranog filma iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM users_movies WHERE UserId=$userId AND MovieId=$userId";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    
}
	 		 	 	 	 	 	 	 	 	

?>