<?php
ob_start();
session_start();
$timezone = date_default_timezone_set("Europe/Belgrade");
    //konekcija sa bazom
    /*$con = mysqli_connect("localhost", "root", "", "cinema");
    if (mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }*/

class Database {
    // Ova promenljiva ce drzati konekciju ka bazi podataka.
    private $con;
    
    // Staticka promenljiva za koju je dozvoljeno imati najvise 1 instanciran objekat.
    private static $instance;
    
    // Parametri za konfiguraciju baze podataka
	private $host = "localhost";
	private $username = "root";
	private $password = "";
    private $database = "cinema";

    
    //Ovo je funkcija koja ce se koristiti da se dobija instanca ove klase.

    public static function getInstance()
    {

        if (! self::$instance)
        {
            // self oznacava TEKUCU KLASU -> Odnosno klasu Database.

			self::$instance = new self();
        }
        
        // Vracamo korisniku instancu ove klase.
		return self::$instance;
    }

	// Konstruktor nase klase
	private function __construct() {
        // Pri konstrukciji objekta ove klase, otvaramo konekciju ka bazi.
		$this->con = new mysqli($this->host, $this->username, 
			$this->password, $this->database);
	
        // Ukoliko dodje do greske
        if (mysqli_connect_error())
        {
			trigger_error("Failed to connect: " . mysql_connect_error(), E_USER_ERROR);
		}
    }

    //  __clone kako bi zabraniili kloniranje objekta klase Database.
    private function __clone()
    {

    }

	// Daje nam konekciju ka bazi podataka.
	public function getConnection() {
		return $this->con;
	}
}

?>