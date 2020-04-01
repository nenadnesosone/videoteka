<?php
require_once 'config\config.php';

class MovieData
{

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
    public $posterUrl;
    public $imageUrl_1;
    public $imageUrl_2;
    public $imageUrl_3;
    public $imageUrl_4;
    public $imageUrl_5;

    public function __construct($movieId, $title, $releaseYear, $genre, $director, $leadingActor, $country, $language, $summary, $imdbRating, $posterUrl, $imageUrl_1, $imageUrl_2, $imageUrl_3, $imageUrl_4, $imageUrl_5) // za cinema sql
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
        $this->posterUrl = $posterUrl;
        $this->imageUrl_1 = $imageUrl_1;
        $this->imageUrl_2 = $imageUrl_2;
        $this->imageUrl_3 = $imageUrl_3;
        $this->imageUrl_4 = $imageUrl_4;
        $this->imageUrl_5 = $imageUrl_5;
    }

    public static function GetAllMovies()
    {
        $db = Database::getInstance()->getConnection();
        
        $query = "SELECT * FROM movies";
        $result = mysqli_query($db, $query);
        mysqli_set_charset($db, 'utf8');
        if ($result) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return [];
        }
    }

    
    public static function GetAllMoviesForWatchlist($data)
    {
        $db = Database::getInstance()->getConnection();
        
        $query = "SELECT * FROM movies WHERE movieId IN (".implode(',', $data).")";
        $result = mysqli_query($db, $query);
        mysqli_set_charset($db, 'utf8');
        if ($result) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return [];
        }
    }

    public static function GetMovie($id)
    {

        $db = Database::getInstance()->getConnection();

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
    public static function CreateMovie($newfilm)
    {
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
        $posterUrl = $newfilm['PosterUrl'];
        $imageUrl_1 = $newfilm['ImageUrl_1'];
        $imageUrl_2 = $newfilm['ImageUrl_2'];
        $imageUrl_3 = $newfilm['ImageUrl_3'];
        $imageUrl_4 = $newfilm['ImageUrl_4'];
        $imageUrl_5 = $newfilm['ImageUrl_5'];

	 	 	
        $query = "INSERT INTO movies (`MovieId`,`Title`,`ReleaseYear`,`Genre`,`Director`,`LeadingActor`,`Country`,`Language`,`Summary`,`ImdbRating`,`PosterUrl`,`ImageUrl_1`,`ImageUrl_2`,`ImageUrl_3`,`ImageUrl_4`,`ImageUrl_5` ) 
        VALUES (DEFAULT,'$title','$releaseYear','$genre','$director','$leadingActor','$country','$language','$summary','$imdbRating','$posterUrl','$imageUrl_1', '$imageUrl_2', '$imageUrl_3', '$imageUrl_4', '$imageUrl_5')";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function DeleteOneMovie($movieId)
    {
        $db = Database::getInstance()->getConnection();
 	 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM movies WHERE movieId=$movieId";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

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
                    $posterUrl = $row['PosterUrl'];
                    $movieId = $row['MovieId'];
                    echo   "<div class='col-md-6 col-xl-3'>
                        <div class='card border-0'>
                            <div class='modal'>
                            <div class='modal-content'>
                            <button class='btn btn-small mb-2 watch' data-id='` + $movieId + `'>Add To Watchlist</button>
                            <button class='btn btn-small mb-2 remove' data-id='` + $movieId + `' style='display:none;'>Remove From Watchlist</button>
                            <button role='button' class='btn btn-small moreInfo' data-id='` + $movieId + `'><a href='#'>More Info</a></button>
                        </div>
                            </div>
                            <img src='$posterUrl' alt='Card Image' class='card-img-top'/>
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
