<?php
require 'config\config.php';

class MovieData{

    //deklarisanje varijabli
    public $movieId;
    public $title;
    public $releaseYear;
    public $genre;
    public $director;
    public $leadingActor;
    public $country;
    public $language;
    public $summary;
    public $imdbRating;
    public $imageUrl;
    public $image;

    // funkcija konstruktor
    public function __construct($movieId, $title, $releaseYear, $genre, $director, $leadingActor, $country, $language, $summary, $imdbRating, $imageUrl, $image)
    {
        $this->movieId = $movieId; 
        $this->title = $title;
        $this->releaseYear = $releaseYear;
        $this->genre = $genre;
        $this->director = $director;
        $this->leadingActor = $leadingActor;
        $this->country = $country;
        $this->language = $language;
        $this->summary = $summary;
        $this->imdbRating = $imdbRating;
        $this->imageUrl = $imageUrl;
        $this->image = $image;

    }
    // funcija koja ce prikupljati podatke o svim filmovima iz baze
    public static function GetAllMovies()
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();
        ///odaberemo sve
        $query = "SELECT * FROM movies";
        $result = mysqli_query($db, $query);
        if ($result) {
            $movies = [];
            while ($row = mysqli_fetch_assoc($result))
            {
                $movies [] = $row;
            }
            return $movies;
        } else {
            return [];
        }
    }

    // funcija koja ce prikupljati podatke o filmovima iz baze koje je korisnik odabrao
    public static function GetSomeMovies($movieId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca movieId

        // odaberemo konkretan film
        $query = "SELECT * FROM movies WHERE movieId=$movieId";
        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }

    // funkcija za ubacivanje filmova u bazu ako zelimo da je koristimo 
    public static function CreateMovie($newfilm)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        $title = $newfilm['Title'];
        $releaseYear = $newfilm['ReleaseYear'];
        $genre = $newfilm['Genre'];
        $director = $newfilm['Director'];
        $leadingActor = $newfilm['LeadingActor'];
        $country = $newfilm['Country'];
        $language = $newfilm['Language'];
        $summary = $newfilm['Summary'];
        $imdbRating = $newfilm['ImdbRating'];
        $imageUrl = $newfilm['ImageUrl'];
        $image = $newfilm['Image'];

        // ubacivanje filmova u bazu 	 	 	
        $query = "INSERT INTO movies ('MovieId ', 'Title', ' ReleaseYear', 'Genre', 'Director', 'LeadingActor', 'Country', 'Language', 'Summary', 'ImdbRating', 'ImageUrl', 'Image') 
        VALUES ('', '$title', ' $releaseYear', '$genre', '$director', '$leadingActor', '$country', '$language', '$summary', '$imdbRating', '$imageUrl', '$image')";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje filmova iz bazu ako zelimo da je koristimo
    public static function DeleteOneMovie($movieId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca movieId

        // brisanje filmova iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM movies WHERE movieId=$movieId";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
	 		 	 	 	 	 	 	 	 	

?>