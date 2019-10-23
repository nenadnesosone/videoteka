<?php
/*
    Ovaj fajl demonstrira razvoj jednog rudimentarnog REST API-ja.

    Funkcionalnosti koje su podrzane API-jem su: 

    GET /movies
        Smisao ovog zahteva je dohvatanje svih informacija o filmovima
        (ime filma i ime reditelja). Informacije o filmovima se vracaju kroz
        telo odgovora u JSON formatu.

    POST /movies
        Smisao ovog zahteva je kreiranje novog filma.
        Podaci o novom filmu se ocekuju kroz telo zahteva u JSON formatu.
        Odgovor sadrzi identifikator novokreiranog filma.
        
    GET /movies/movie_id
        Smisao ovog zahteva je dohvatanje informacija o filmu sa identifikatorom
        movie_id. Informacije o filmu se vracaju kroz telo odgovora u JSON formatu.

    DELTE /movies/movie_id
        Smisao ovog zahteva je brisanje informacija o filmu sa identifikatorom 
        movie_id.

    Zbog konfiguracije u .htaccess datoteci, ovi zahtevi imaju svoje fizicke putanje
    server.php/movies i server.php/movies_id.
    
*/

/*
    U database.php fajlu se nalaze funkcije za rad sa bazom podataka koje
    se koriste za dohvatanje podataka i odgovarajuci upis i brisanje.
*/
require_once 'config/config.php';
require_once 'data/moviedata.php';
require_once 'data/watchlistdata.php';


/* 
    Niz u kojem se nalaze kodovi gresaka i njihovi opisi. U skladu sa smernicama za razvoj 
    REST API-ja izdvojene su neki relavantni kodovi i njihova znacenja. 
 */
$response_messages = array(
    405 => "Method Not Allowed",
    200 => "OK",
    400 => "Bad Request",
    404 => "File Not Found",
    500 => "Internal Server Error"
);

/*
    Response objekat treba da predstavlja odgovor koji ce server vratiti klijentu.
    Unutar ovog objekta se nalaze svojstva: 
    status - oznacava statusni kod odgovora (200, 404, 500, ...)
    message - oznacava statusnu poruku servera ('OK', 'File Not Found', ...)
    data - oznacava podatke koje server prosledjuje klijentu
    error - predstavlja indikator pojave greske i moze imati vrednosti true ili false
*/
$response = new stdClass();
$response->status = 0;
$response->message = "";
$response->data = NULL;
$response->error = false;



/* U ovom nizu su izlistane sve metode (tipovi HTTP zahteva) koje API podrzava. */
$supported_methods = array("POST", "GET", "DELETE");

/* 
    Prvo se ocitava tip zahteva klijenta. Ova informacije se moze dobiti iz $_SERVER niza.
    Ocitana niska se dalje transformise u zapis velikim slovima.
*/
$method = strtoupper($_SERVER['REQUEST_METHOD']);


/* 
    Proveravamo da li je procitani tip zahteva podrzan API-jem. */
if (!in_array($method, $supported_methods)) {
    /* Ako tip zahteva nije podrzan, postavljamo odgovarajuci statusni kod u odgovoru. */
    $response->status = 405;
    $response->data = NULL;
} else {
    /* Ako je tip zahteva podrzan, analizira se URL zahteva kako bi se odlucilo sta dalje treba uraditi. */

    /* 
        $url_parts_counter i $url_parts ce predstavljati broja delova kao i same 
        delove ocitanog URL-a. Na primer, URL server.php/movies/34 ce imati 
        2 parcica: movies i 34. ULR server.php/movies ce imati samo jedan paricic i to movies.
    */
    $url_parts_counter = 0;
    $url_parts = array();

    /* 
        Proveravamo da li u URL-u imamo putanju nakon server.php imena. 
        Putanja se moze procitati iz $_SERVER niza.
    */
    if (isset($_SERVER['PATH_INFO'])) {

        /* 
            Ako imamo informacije o putanji, ocekujemo da budu oblika npr. /movies/34 ili /movies, 
            pa ih analiziramo. 
        */

        /* 1. Ocitavamo putanju */
        $path_info = $_SERVER['PATH_INFO'];

        /* 2. Izdvajamo parcice iz putanje */
        $url_parts = explode("/", $path_info);
        //var_dump($url_parts);

        /* 3. Odredjujemo broj delova */
        /* 
            Ako je putanja, na primer, /movies/34, prethodni poziv ce kreirati niz 
            ["", "movies", "34"] koji ce imati tri elementa. 
            Prvi element niza je prazna niska jer izdvojena putanja uvek pocinje / znakom. 
            Ovaj element bi hteli da preskocimo, pa zbog toga prilikom pristupa
            $url_parts nizu koristimo indekse pocevsi od 1, a $url_parts_counter umanjujemo
            za 1. 
        */
        $url_parts_counter = count($url_parts) - 1;
    }

    try {

        // /* Povezujemo se sa bazom. */

        /* U zavisnosti od tipa zahteva analiziramo strukturu putanje. */
        switch ($method) {
            case "GET":
                /* Proverava li je putanja oblika /movies */

                if ($url_parts_counter == 1 and $url_parts[1] == "movies") {
                    /* Ako jeste, dohvataju se podaci o svim filmovima. */
                    $response->data = MovieData::getAllMovies();

                    /* Postavlja se odgovarajuci statusni kod. */
                    $response->status = 200;
                } else {
                    /* Proverava da li je putanja oblika /movies/movie_id */
                    if ($url_parts_counter == 2 and $url_parts[1] == "movies") {

                        /* Proverava se da li je movie_id korektan broj. */
                        $id = intval($url_parts[2]);

                        /* Ako je id filma korektan broj (pozitivan ceo broj) */
                        if ($id > 0) {
                            /* citamo informacije o filmu sa zadatim identifikatorom. */
                            $movie = MovieData::GetMovie($id);
                            // echo 'ovo je film';
                            // echo $movie;
                            /* Ako film sa ovim identifikatorom ne postoji u bazi */
                            if ($movie == NULL) {
                                /* Prijavljujemo gresku. */
                                $response->status = 404;
                                $response->data = NULL;
                            } else {
                                /* U suprotnom postavljamo podatke i odgovarajuci statusni kod.  */
                                $response->data = $movie;
                                $response->status = 200;
                            }
                        } else {
                            /* Ako movie_id nije korektan broj, prijavljujemo gresku. */
                            $response->status = 400;
                            $response->data = NULL;
                        }
                    } else {
                        /* Ovaj deo se odnosi na nepoznati GET zahtev i nepodrzanu putanju. */
                        $response->status = 400;
                        $response->data = NULL;
                    }
                    if ($url_parts_counter == 2 and $url_parts[1] == "watchlist") {

                        $id = intval($url_parts[2]);
                        $response->data = WatchlistData::GetUsersWatchlist($userid);
                    } else { }
                }
                break;

            case "POST":
                /* Proveravamo da li je putanja oblika /watchlistt */
                if ($url_parts_counter == 1 and $url_parts[1] == "watchlist") {
                    /* 
                        Ako jeste, citamo podatke o filmu koji do servera stizu u JSON formatu. 
                        Ove podatke citamo sa standardnog PHP ulaza (php://input) u jednu nisku 
                        (koristimo funkciju file_get_contents), a zatim ih dekodiramo.
                         
                    */
                    $data = json_decode(file_get_contents("php://input"));

                    /* 
                        Ukoliko nedostaje neki podatak, na primer, naslov ili reditelj filma,
                        prijavljujemo gresku. 
                    */
                    if (!isset($data->title) or !isset($data->director)) {
                        $response->status = 400;
                        $response->data = NULL;
                    } else {
                        /* Ako su svi podaci tu, dodajemo novi film u bazu. */
                        $id = WatchlistData::AddMovieToWatchlist($selected);

                        /* Ako je dodavanje filma iz nekog razloga neuspesno, prijavljujemo gresku. */
                        if ($id == -1) {
                            $response->status = 400;
                            $response->data = NULL;
                        } else {
                            /* Ako je dodavanje filma uspesno, identifikator novododatog filma se postavlja kao deo odgovora. */
                            $response->data = $id;
                            $response->status = 201;
                        }
                    }
                } else {
                    /* Ovaj deo se odnosi na nepoznati POST zahtev i nepodrzanu putanju. */
                    $response->status = 400;
                    $response->data = NULL;
                }

                break;

            case "DELETE":
                if ($url_parts_counter == 1 and $url_parts[1] == "watchlist") { }

                $data = json_decode(file_get_contents("php://input"));

                if (!isset($data->$userid) or !isset($data->$movieId)) {
                    $response->status = 400;
                    $response->data = NULL;
                } else {
                    /* Ako su svi podaci tu, brisermo film iz watchliste */
                    $id = WatchlistData::DeleteMovieFromWatchlist($userid, $movieId);

                    /* Ako je brisanje filma iz nekog razloga neuspesno, prijavljujemo gresku. */
                    if ($id == -1) {
                        $response->status = 400;
                        $response->data = NULL;
                    } else {
                        /* Ako je brisanje filma uspesno, identifikator novododatog filma se postavlja kao deo odgovora. */
                        $response->data = $id;
                        $response->status = 201;
                    }
                }

                break;
        }
    } catch (PDOException $e) {
        /* Ovim delom koda se obradjuju sve gore neprepoznate greske koje se jave. */
        $response->status = 500;
        $response->data = NULL;
        $response->error = true;
    }

    /* 
        Daljim delom koda se generise odgovor koji server salje klijentu. 
        Odgovor ima svoje zaglavlje koje se generise koriscenjem funkcije header i svoje 
        telo koje predstavlja preostali sadrzaj. 
    */

    /* 
        Prva linija odgovora je statusna linija koja u skladu sa HTTP protokolom 
        mora poceti HTTP/1.1 niskom i koja dalje mora sadrzati statusni kod (npr. 200)
        i odgovarajucu statusnu poruku (npr. "OK").
    */
    $response->message = $response_messages[$response->status];
    header("HTTP/1.1 " . $response->status . " " . $response->message);

    /* 
        Posto se podaci salju u JSON formatu, postavlja se zaglavlje kojim se to klijentu 
        stavlja do znanja. 
    */
    header("Content-Type: application/json; charset=utf-8");

    /* Proverava se da li postoje podaci koje treba poslati. */
    if ($response->data != NULL) {

        /* Ako postoje, "salju se" u JSON formatu. Slanje podrazumeva ispis sadrzaja koriscenjem funkcije echo. */
        echo json_encode($response->data);
    }
}
