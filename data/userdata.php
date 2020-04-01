<?php

class UserData{

    public $userId;
    public $fname;
    public $lname;
    public $username;
    public $em;
    public $password;
    public $date;

    public function __construct($userId, $fname, $lname, $userName, $em, $password, $date, $profile_picture)
    {
        $this->userId = $userId; 
        $this->fname = $fname;
        $this->$lname = $$lname;
        $this->userName = $userName;
        $this->em = $em;
        $this->password = $password;
        $this->$date = $date;
        $this->profile_picture = $profile_picture;

    }

    public static function GetAllUsers()
    {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM users_data";

        $result = mysqli_query($db, $query);
        if ($result) {
            $userData = [];
            while ($row = mysqli_fetch_assoc($result))
            {
                $userData [] = $row;
            }
            return $userData;
        } else {
            return [];
        }
    }

    public static function GetSomeUsers($userId)
    {
        $db = Database::getInstance()->getConnection();

        $query = "SELECT * FROM users_data WHERE userId='$userId'";

        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }



    public static function CreateUser($fname, $lname, $username, $em, $password, $date, $profile_picture)
    {
        $db = Database::getInstance()->getConnection();

        $query = "INSERT INTO users_data (`UserId`,`FirstName`,`LastName`,`UserName`,`Email`,`Password`,`RegistrationDate`,`ProfilePicture`) 
        VALUES (DEFAULT, '$fname', '$lname','$username','$em','$password','$date','$profile_picture')";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function DeleteOneUser($userId)
    {
        $db = Database::getInstance()->getConnection();
	 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM users_data WHERE UserId='$userId'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function UpdateUser($userId, $fname, $lname, $username, $password, $userimage)
    {
        $db = Database::getInstance()->getConnection();
	 	 	 	 	 	 	 	 	
        $query = "UPDATE users_data SET FirstName='$fname', LastName='$lname', UserName='$username',  Password='$password', ProfilePicture='$userimage' WHERE UserId='$userId'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function CheckEmail($em)
    {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT Email FROM users_data WHERE Email ='$em'";

        $e_check = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($e_check);
        if ($num_rows>0) {
            return true;
        } else{
            return false;
        }
    
    }

    public static function CheckUser($em, $password)
    {
        $db = Database::getInstance()->getConnection();

        $query = "SELECT Email FROM users_data WHERE Email ='$em' AND Password='$password'";

        $e_check = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($e_check);
        if ($num_rows>0) {
            return true;
        } else{
            return false;
        }
    
    }

    public static function GetUserRow($em, $password)
    {
        $db = Database::getInstance()->getConnection();

        $query = "SELECT * FROM users_data WHERE Email ='$em' AND Password='$password'";

        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }

    public static function CheckUserName($username)
    {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT UserName FROM users_data WHERE UserName = '$username'";

        $check_username_query = mysqli_query($db, $query);
        return $check_username_query;
    }

    public static function sanit($x){

        $y = htmlspecialchars(strip_tags($x));
        $y = str_replace(' ', '', $y); 
        return $y;

    }
	
}



?>