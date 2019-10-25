<?php
require_once 'config\config.php';

// klasa uz ciju pomoc cemo pristupati korisnickim podacima i njihovim filmovima
class WatchlistData
{

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
            while ($row = mysqli_fetch_assoc($result)) {
                $usersMoviesData[] = $row;
            }
            return $usersMoviesData;
        } else {
            return [];
        }
    }

    // funcija koja ce prikupljati podatke pojedinacnom korisniku koji je odabrao neke filmove
    public static function GetUsersWatchlist($userId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId medjutim, on se ulogovao i znamo ko je

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users_movies WHERE userId=$userId";
        $result = mysqli_query($db, $query);
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

    // funcija koja ce prikupljati podatke pojedinacnom korisniku koji je odabrao neke filmove i prikazivati ih
    public static function CreateWatchlist($userId){
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId medjutim, on se ulogovao i znamo ko je

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users_movies WHERE userId=$userId";
        $result = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                    $movieId = $row["MovieId"];

                    $data = MovieData::GetMovie($movieId);
                    $filmid = $data['MovieId'];
                    $title = $data['Title'];
                    $leadingActor = $data['LeadingActor'];
                    $posterUrl = $data['PosterUrl'];
                    
                echo
                        "<div class='col-md-6 col-lg-3'>
                        <div class='card border-0'>
                            <div class='modal'>
                                <div class='modal-content'>
                                    <button class='btn btn-small mb-2 watch'>Add To Watchlist</button>
                                    <button role='button' class='btn btn-small moreInfo'> <a href='localhost/movies/$filmid' class='btn-link'>More Info</a></button>
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
            return [];
        }

    }

    // funkcija za ubacivanje filma kojeg je korisnik odabrao
    public static function AddMovieToWatchlist($selected)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();
        // podatke stavljamo u promenljive
        $userId = $selected->userId;
        $movieId = $selected->movieId;

        $query = "INSERT INTO users_movies (`UserId`,`MovieId`) VALUES ('$userId', '$movieId')";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    // // funkcija za brisanje svih korisnikovih filmova iz baze ako zelimo da je koristimo
    // public static function DeleteAllMoviesFromWatchlist($userId)
    // {
    //     //povezujemo se s bazom
    //     $db = Database::getInstance()->getConnection();

    //     // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

    //     // brisanje filmova iz baze 	 	 	 	 	 	 	 	 	 	 	
    //     $query = "DELETE FROM users_movies WHERE UserId=$userId";
    //     $result = mysqli_query($db, $query);
    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // funkcija za brisanje jednog korisnikovog filma iz baze
    public static function DeleteMovieFromWatchlist($selected)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId i movieid
        $userId = $selected->userId;
        $movieId = $selected->movieId;
        // brisanje odabranog filma iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM users_movies WHERE UserId=$userId AND MovieId=$movieId";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
