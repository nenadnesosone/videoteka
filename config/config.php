<?php
ob_start();
session_start();

// obrisati?
$timezone = date_default_timezone_set("Europe/Belgrade");
    //konekcija sa bazom
    $con = mysqli_connect("localhost", "root", "", "cinema");
    if (mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

class Database {
    private $con;
    private static $instance;
    
	private $host = "localhost";
	private $username = "root";
	private $password = "";
    private $database = "cinema";

    

    public static function getInstance()
    {
        if (! self::$instance)
        {
			self::$instance = new self();
        }
        
		return self::$instance;
    }

	private function __construct() {
		$this->con = new mysqli($this->host, $this->username, 
            $this->password, $this->database);
	
        if (mysqli_connect_error())
        {
			trigger_error("Failed to connect: " . mysqli_connect_error(), E_USER_ERROR);
		}
    }

    private function __clone()
    {

    }

	public function getConnection() {
		return $this->con;
	}
}

?>