<?php

require_once 'config/config.php';
require_once 'data/moviedata.php';
require_once 'data/watchlistdata.php';


$response_messages = array(
    405 => "Method Not Allowed",
    200 => "OK",
    400 => "Bad Request",
    404 => "File Not Found",
    500 => "Internal Server Error"
);

$response = new stdClass();
$response->status = 0;
$response->message = "";
$response->data = NULL;
$response->error = false;



$supported_methods = array("POST", "GET", "DELETE");
$method = strtoupper($_SERVER['REQUEST_METHOD']);



if (!in_array($method, $supported_methods)) {
    $response->status = 405;
    $response->data = NULL;
} else {
    $url_parts_counter = 0;
    $url_parts = array();

    if (isset($_SERVER['PATH_INFO'])) {

        $path_info = $_SERVER['PATH_INFO'];

        $url_parts = explode("/", $path_info);

        $url_parts_counter = count($url_parts) - 1;
    }

    try {


        switch ($method) {
            case "GET":

                if ($url_parts_counter == 1 and $url_parts[1] == "movies") {

                    $response->data = MovieData::getAllMovies();

                    $response->status = 200;
                } else {
                    if ($url_parts_counter == 1 and $url_parts[1] == "watchlist") {

                        $response->data = WatchlistData::GetAllSelected();
                        $response->status = 200;
                    } else {

                        if ($url_parts_counter == 2 and $url_parts[1] == "movies") {

                            $id = intval($url_parts[2]);

                            if ($id > 0) {
                                $movie = MovieData::GetMovie($id);
                                if ($movie == NULL) {
                                    $response->status = 404;
                                    $response->data = NULL;
                                } else {
                                    $response->data = $movie;
                                    $response->status = 200;
                                }
                            } else {
                                $response->status = 400;
                                $response->data = NULL;
                            }
                        } else {
                            if ($url_parts_counter == 2 and $url_parts[1] == "watchlist") {

                                $id = intval($url_parts[2]);
                                if ($id > 0) {
                                    $userWatchlist = WatchlistData::CreateWatchlist($id);

                                    if ($userWatchlist == NULL) {
                                        $response->status = 404;
                                        $response->data = NULL;
                                    } else {
                                        $response->data = $userWatchlist;
                                        $response->status = 200;
                                    }
                                } else {
                                    $response->status = 400;
                                    $response->data = NULL;
                                }
                            } else {
                                $response->status = 400;
                                $response->data = NULL;
                            }
                        }
                    }
                }
                break;

            case "POST":
                if ($url_parts_counter == 1 and $url_parts[1] == "watchlist") {

                    $data = json_decode(file_get_contents("php://input"));

                    if (!isset($data->userId) or !isset($data->movieId)) {
                        $response->status = 400;
                        $response->data = NULL;
                    } else {
                        $id = WatchlistData::AddMovieToWatchlist($data);

                        if ($id == -1) {
                            $response->status = 400;
                            $response->data = NULL;
                        } else {
                            $response->data = $id;
                            $response->status = 201;
                        }
                    }
                } else {
                    $response->status = 400;
                    $response->data = NULL;
                }

                break;

            case "DELETE":
                if ($url_parts_counter == 3 and $url_parts[1] == "watchlist") {

                    
                    $userId = intval($url_parts[2]);
                    $movieId = intval($url_parts[3]);

                    $isDeleted = WatchlistData::DeleteMovieFromWatchlist($userId, $movieId);

                    if ($id == -1) {
                        $response->status = 400;
                        $response->data = NULL;
                    } else {
                        $response->data = $isDeleted;
                        $response->status = 201;
                    }
                }
                break;
        }
    } catch (PDOException $e) {
        $response->status = 500;
        $response->data = NULL;
        $response->error = true;
    }

    $response->message = $response_messages[$response->status];
    header("HTTP/1.1 " . $response->status . " " . $response->message);


    header("Content-Type: application/json");

    if ($response->data != NULL) {

        echo json_encode($response->data);
    }
}
