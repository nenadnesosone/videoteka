<?php
require_once 'config\config.php';

class WatchlistData
{

    public $userId;
    public $movieId;

    public function __construct($userId, $movieId)
    {
        $this->userId = $userId;
        $this->movieId = $movieId;
    }

    public static function GetAllSelected()
    {
        $db = Database::getInstance()->getConnection();
        
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

    public static function GetUsersWatchlist($userId)
    {
        $db = Database::getInstance()->getConnection();

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

    public static function CreateWatchlist($userId)
    {
        $db = Database::getInstance()->getConnection();

        $query = "SELECT * FROM users_movies WHERE userId=$userId";
        $result = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $movieId = $row["MovieId"];
                $data [] = $movieId;
            }
            return MovieData::GetAllMoviesForWatchlist($data);
        } else {
            return [];
        }
    }

    public static function AddMovieToWatchlist($data)
    {
        $db = Database::getInstance()->getConnection();
        
        $userId = $data->userId;
        $movieId = $data->movieId;

        $query = "INSERT INTO users_movies (`UserId`,`MovieId`) VALUES ('$userId', '$movieId')";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public static function DeleteMovieFromWatchlist($userId, $movieId)
    {
        $db = Database::getInstance()->getConnection(); 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM users_movies WHERE UserId=$userId AND MovieId=$movieId";
        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
