<?php
require_once 'config\config.php';

// klasa uz ciju pomoc cemo pristupati podacima o filmovima
class MovieData
{

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
    /*
    public $image2;
    public $image3;
    public $image4;
    public $image5;
*/ // za videoteka.sql

    // funkcija konstruktor
    public function __construct($movieId, $title, $releaseYear, $genre, $director, $leadingActor, $country, $language, $summary, $imdbRating, $imageUrl, $image) // za cinema sql
    //public function __construct($movieId, $title, $releaseYear, $genre, $director, $leadingActor, $country, $language, $summary, $imdbRating, $imageUrl, $image, $image_2, $image_3, $image_4, $image_5)// za videoteka.sql
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
        /*
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->image4 = $image4;
        $this->image5 = $image5;
        
*/ // za videoteka.sql

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
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data []=$row;
            } 
            return $data;
        } else {
            return [];
            echo "No Movies To Display.";
        }
    }

    // funcija koja ce prikupljati podatke o filmovima iz baze koje je korisnik odabrao
    public static function GetMovie($id)
    {
        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca movieId
        
        $db = Database::getInstance()->getConnection();

        // odaberemo konkretan film
        $query = "SELECT * FROM movies WHERE movieId=$id";
        $result = mysqli_query($db, $query);
        mysqli_set_charset($db, 'utf8');
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
        /*
        $image2 = $newfilm['Image2'];
        $image3 = $newfilm['Image3'];
        $image4 = $newfilm['Image4'];
        $image5 = $newfilm['Image5'];
*/ // za videoteka.sql

        // ubacivanje filmova u bazu 	 	 	
        $query = "INSERT INTO movies (`MovieId`,`Title`,`ReleaseYear`,`Genre`,`Director`,`LeadingActor`,`Country`,`Language`,`Summary`,`ImdbRating`,`ImageUrl`,`Image`) 
        VALUES (DEFAULT,'$title','$releaseYear','$genre','$director','$leadingActor','$country','$language','$summary','$imdbRating','$imageUrl','$image')";
        /*
        $query = "INSERT INTO movies (`MovieId`,`Title`,`ReleaseYear`,`Genre`,`Director`,`LeadingActor`,`Country`,`Language`,`Summary`,`ImdbRating`,`ImageUrl`,`Image_1`, `Image_2`, `Image_3`, `Image_4`, `Image_5`) 
        VALUES (DEFAULT,'$title','$releaseYear','$genre','$director','$leadingActor','$country','$language','$summary','$imdbRating','$imageUrl','$image', '$image2','$image3','$image4','$image5')";
*/ // za videoteka.sql

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


    // pretraga filmova
    public static function FindMovie()
    {

        $db = Database::getInstance()->getConnection();
        if (isset($_POST['submit_search'])) {
            $search  = mysqli_real_escape_string($db, $_POST['search']);
            $sql = "SELECT * FROM movies WHERE Title LIKE '%$search%' OR ReleaseYear LIKE '%$search%' OR Genre  LIKE '%$search%' OR Country  LIKE '%$search%'";
            $result = mysqli_query($db, $sql);
            $queryResult = mysqli_num_rows($result);
            if ($queryResult > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row['Title'];
                    $leadingActor = $row['LeadingActor'];
                    $imageUrl = $row['ImageUrl'];
                    $movieId = $row['MovieId'];
                    echo   "<div class='col-md-6 col-lg-3'>
                        <div class='card border-0'>
                            <div class='modal'>
                                <div class='modal-content'>
                                    <button class='btn btn-small mb-2 watch'>Add To Watchlist</button>
                                    <button role='button' class='btn btn-small moreInfo'> <a href='localhost/movies/$movieId' class='btn-link'>More Info</a></button>
                                </div>
                            </div>
                            <img src='$imageUrl' alt='Card Image' class='card-img-top'/>
                            <div class='card-body'>
                                <h6>" . $title . "</h6>
                                <p class='text-muted card-text'> " . $leadingActor . "</p>
                            </div>
                        </div>
                    </div> ";
                }
            } else {
                echo "<p class='lead text-white'>There are no results matching your search!</p>";
            }
        }
    }
}
?>