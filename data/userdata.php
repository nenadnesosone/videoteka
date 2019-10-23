<?php
require_once 'config\config.php';

// klasa uz ciju pomoc cemo pristupati korisnickim podacima
class UserData{

    // za jwt
    private $con;
    private $table_name = "users_data"; // u cinema.sql je ovako u videoteka.sql je users

    // svojstva objekta
    public $userId;
    public $fname;
    public $lname;
    public $username;
    public $em;
    public $password;
    public $date;
    public $profile_picture;


    // funkcija konstruktor
    // public function __construct($userId, $fname, $lname, $userName, $em, $password, $date, $profile_picture)
    // {
    //     $this->userId = $userId; 
    //     $this->fname = $fname;
    //     $this->$lname = $$lname;
    //     $this->userName = $userName;
    //     $this->em = $em;
    //     $this->password = $password;
    //     $this->$date = $date;
    //     $this->profile_picture = $profile_picture;

    // }

    //za jwt
    public function __construct($db){
        $this->con = $db;
    }


    // funcija koja ce prikupljati podatke o svim korisnicima iz baze
    public static function GetAllUsers()
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();
        ///odaberemo sve
        $query = "SELECT * FROM users_data";
        //$query = "SELECT * FROM users"; // za videoteka.sql

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

    // funcija koja ce prikupljati podatke o korisnicima iz baze
    public static function GetSomeUsers($userId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users_data WHERE userId='$userId'";
        //$query = "SELECT * FROM users WHERE userId='$userId'";// za videoteka.sql

        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return [];
        }
    }


    // funkcija za ubacivanje korisnika u bazu
    public static function CreateUser($fname, $lname, $username, $em, $password, $date, $profile_picture)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        $query = "INSERT INTO users_data (`UserId`,`FirstName`,`LastName`,`UserName`,`Email`,`Password`,`RegistrationDate`,`ProfilePicture`) 
        VALUES (DEFAULT, '$fname', '$lname','$username','$em','$password','$date','$profile_picture')";

        /*$query = "INSERT INTO users (`UserId`,`FirstName`,`LastName`,`UserName`,`Email`,`Password`,`RegistrationDate`,`ProfilePicture`) 
        VALUES (DEFAULT, '$fname', '$lname','$username','$em','$password','$date','$profile_picture')";*/ // za videoteka sql

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za brisanje korisnika iz baze
    public static function DeleteOneUser($userId)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // brisanje filmova iz baze 	 	 	 	 	 	 	 	 	 	 	
        $query = "DELETE FROM users_data WHERE UserId='$userId'";

        //$query = "DELETE FROM users WHERE UserId='$userId'";// za videoteka.sql

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // funkcija za update korisnika iz bazu
    public static function UpdateUser($userId, $fname, $lname, $username, $password, $userimage)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        //  update emaila u bazi	 	 	 	 	 	 	 	 	 	
        $query = "UPDATE users_data SET FirstName='$fname', LastName='$lname', UserName='$username',  Password='$password', ProfilePicture='$userimage' WHERE UserId='$userId'";

        // za videoteka.sql
        //$query = "UPDATE users SET FirstName='$fname', LastName='$lname', UserName='$username',  Password='$password', ProfilePicture='$userimage' WHERE UserId='$userId'";

        $result = mysqli_query($db, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //provera da li email vec postoji u bazi
    public static function CheckEmail($em)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda je osetljiv na SQL Injection napade posto korisnik moze da ukuca email, ali smo ga prethodno ocistili

        // odaberemo konkretan email
        $query = "SELECT Email FROM users_data WHERE Email ='$em'";

        //$query = "SELECT Email FROM users WHERE Email ='$em'";// za videoteka.sql

        $e_check = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($e_check);
        //ako ima vise redova od 0 postoji u bazi
        if ($num_rows>0) {
            return true;
        } else{
            return false;
        }
    
    }

    // proverava da li postoji korisnik u bazi
    public static function CheckUser($em, $password)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // odaberemo konkretan email
        $query = "SELECT Email FROM users_data WHERE Email ='$em' AND Password='$password'";

        //$query = "SELECT Email FROM users WHERE Email ='$em' AND Password='$password'"; // za videoteka.sql

        $e_check = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($e_check);
        //ako ima vise redova od 0 postoji u bazi
        if ($num_rows>0) {
            return true;
        } else{
            return false;
        }
    
    }

    // funcija koja ce prikupljati podatke o korisnicima iz baze koje cemo koristiti
    public static function GetUserRow($em, $password)
    {
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca userId

        // odaberemo konkretnog korisnika
        $query = "SELECT * FROM users_data WHERE Email ='$em' AND Password='$password'";

        //$query = "SELECT * FROM users WHERE Email ='$em' AND Password='$password'";// za videoteka.sql

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
        //povezujemo se s bazom
        $db = Database::getInstance()->getConnection();

        // ovaj deo koda bi bio osetljiv na SQL Injection napade da korisnik moze da ukuca $username

        // odaberemo konkretnog korisnika
        $query = "SELECT UserName FROM users_data WHERE UserName = '$username'";

        //$query = "SELECT UserName FROM users WHERE UserName = '$username'";// za videoteka.sql
        $check_username_query = mysqli_query($db, $query);
        return $check_username_query;
    }
	
}

  
    // da li postoji email u bazi
    function JWTCheckEmail(){
    
    
        // query da proveri da li email postoji u bazi
        $query = "SELECT *
                FROM " . $this->table_name . "
                WHERE Email = ? 
                LIMIT 0,1";// koliko prvih redova treba da se odbaci, broj redova za ispisivanje
        //? iznad cemo promeniti
        // pripremamo query
        $stmt = $this->con->prepare($query);
    
        // cistimo email
        $em = $user->email;
        $em = htmlspecialchars(strip_tags($em)); //uklanja HTML elemente
        $em = str_replace(' ', '', $em); //uklanja razmake
        $em = filter_var($em, FILTER_SANITIZE_EMAIL);
    
        // vezemo vrednost
        $stmt->bindParam(1, $em);// umesto ? pisemo 1
    
        // izvrsavamo query
        $stmt->execute();
    
        // dobijamo broj redova iz zadnje mysqli query
        $num = $stmt->rowCount();
    
        // ako postoji dodeli vrednosti objektu za upotrebu
        if($num>0){
    
            // povlacimo podatke
            $row = $stmt->fetch(mysqli::FETCH_ASSOC);
    
            // dodeljivanje vrednosti objektu
            $userId = $row['UserId'];
            $fname = $row['FirstName'];
            $lname = $row['LastName'];
            $username = $row['UserName'];
            $em = $row['Email'];
            $password = $row['Password'];
            $userimage = $row['ProfilePicture'];


            // vratiti tacno jer postoji u bazi
            return true;
        }
    
        // vratiti netacno ako nepostoji
        return false;
    }

  // ako nerade funkcije gore kod JWT probajte sledece
/*
    function JWTCreateUser(){
    
        // insert query /// levo nazivi kolona a desno parametar ima dvodatcku ispred (moramo prvo da ga pripremimo)
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    FirstName = :fname,
                    LastName = :lname,
                    UserName = :username,
                    Email = :em,
                    Password = :password,
                    Date = :date,
                    ProfilePicture = :userimage";
    
        // deklarisanje promenljivih da nekucamo nonstop $this
        $fname = $this->fname; // $fname = $user->fname
        $lname = $this->lname; // $lname = $user->lname
        $em = $this->em; // $em = $user->em
        $em2 = $this->em2; // $em2 = $user->em2
        $password = $this->password; // $password = $user->password
        $password2 = $this->password2; // $password2 = $user->password2
        $date = "";
        $error_array = array();

        //Ime
        $fname = htmlspecialchars(strip_tags($fname));//uklanja HTML elemente
        $fname = str_replace(' ', '', $fname); //uklanja razmake
        $fname = ucfirst(strtolower($fname)); //ostavlja samo prvo slovo veliko
        $_SESSION['reg_fname'] = $fname; //cuva se u sesiji ime

        //Prezime
        $lname = htmlspecialchars(strip_tags($lname));//uklanja HTML elemente
        $lname = str_replace(' ', '', $lname); //uklanja razmake
        $lname = ucfirst(strtolower($lname)); //ostavlja samo prvo slovo veliko
        $_SESSION['reg_lname'] = $lname; //cuva se u sesiji prezime

        //Email 
        $em = htmlspecialchars(strip_tags($em));//uklanja HTML elemente
        $em = str_replace(' ', '', $em); //uklanja razmake
        $_SESSION['reg_email'] = $em; //cuva se u sesiji email

        $em2 = htmlspecialchars(strip_tags($em2));//uklanja HTML elemente
        $em2 = str_replace(' ', '', $em2); //uklanja razmake
        $_SESSION['reg_email2'] = $em2; //cuva se u sesiji email

        //Lozinka
        $password = htmlspecialchars(strip_tags($password));//uklanja HTML elemente
        $password = str_replace(' ', '', $password); //uklanja razmake
        
        $password2 = htmlspecialchars(strip_tags($password2));//uklanja HTML elemente
        $password2 = str_replace(' ', '', $password2); //uklanja razmake

        $date = date("Y-m-d"); //uzima trenutni datum

        if ($em == $em2) {
            if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
                $em = filter_var($em, FILTER_VALIDATE_EMAIL);

                //provera da li je vec koriscen taj email
                if (UserData::CheckEmail($em)) {
                    array_push($error_array, "Email already in use");
                }

            }else {
                array_push($error_array, "Invalid email format"); 
            }   
        }else{
            array_push($error_array, "Emails don't match"); 
        }

        //provera duzine imena
        if (strlen($fname)>25 || strlen($fname)<2) {
            array_push($error_array,  "Your first name must be between 2 and 25 characters");
        }
        //provera duzine prezimena
        if (strlen($lname)>25 || strlen($lname)<2) {
            array_push($error_array, "Your last name must be between 2 and 25 characters"); 
        }
        //password i password2 moraju da budu isti
        if ($password != $password2) {
            array_push($error_array, "Your passwords do not match");
        }else {
            //lozinka moze da sadrzi samo slova i brojeve
            if (preg_match('/[^A-Za-z0-9]/', $password)) {
                array_push($error_array,  "Your password can only contain english characters and numbers");
            }
        }
        //odgovarajuca duzina lozinke
        if (strlen($password) >30 || strlen($password) < 5) {
            array_push($error_array, "Your password must be between 5 and 30 characters"); 
        }

        if (empty($error_array)) {
            $password = md5($password); //enkripcija lozinke

            //povezivanje imena i prezimena u username
            $username = strtolower($fname . "_" . $lname);
            // Ako postoji u bazi username, dodati mu broj
            UserData::CheckUsername($username);
        
            $i = 0;

            while (mysqli_num_rows(UserData::CheckUsername($username)) !=0) {
                $i++;
                $username = $username . "_" . $i;
                UserData::CheckUsername($username);
            }

            //dodeljujemo korisniku random profilnu sliku 
            $rand = rand(1, 7);
            if ($rand == 1) {
                $profile_picture = "images/profile_pictures/head_alizarin.png";   
            }else if($rand == 2){
                $profile_picture = "images/profile_pictures/head_belize_hole.png";
            }else if($rand == 3){
                $profile_picture = "images/profile_pictures/woman_128.png";
            }else if($rand == 4){
                $profile_picture = "images/profile_pictures/avatar_128.png";
            }else if($rand == 5){
                $profile_picture = "images/profile_pictures/avatar (1)_128.png";
            }else if($rand == 6){
                $profile_picture = "images/profile_pictures/avatar (2)_128.png";
            }else if($rand == 7){
                $profile_picture = "images/profile_pictures/avatar (3)_128.png";
            }


        // pripremamo query
        $stmt = $this->con->prepare($query);
    
        // vezemo vrednosti
        $stmt->bindParam(':fname', $fname);///parametar zamenjujemo konkretnom vrednoscu
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':lname', $username );
        $stmt->bindParam(':em', $em);
        $stmt->bindParam(':password', $password);//hashovana
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':userimage', $profile_picture);
    
    
        // izvrsavamo query i proveravamo da li je izvrsen
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    function JWTDeleteUser(){

        $userId = $this->userId;//$userId = $user->userId;

        // delete query /// levo nazivi kolona a desno parametar ima dvodatcku ispred (moramo prvo da ga pripremimo)
        $query = "DELETE " . $this->table_name . "
        WHERE
            UserId = :userId";

        // pripremamo query
        $stmt = $this->con->prepare($query);

        // vezemo vrednost
        $stmt->bindParam(':iserId', $userId);

        // izvrsavamo query i proveravamo da li je izvrsen
        if($stmt->execute()){
            return true;
        }
        
        return false;
    }


    // ako neradi kod gore kod JWT

    function JWTUpdateUser(){
    
        // deklarisanje promenljivih da nekucamo nonstop $this
        $em = $this->em; // $em = $user->em;
        $fname = $this->fname; // $fname = $user->fname;
        $lname = $this->lname; // $lname = $user->lname;
        $password = $this->password; //$password = $user->password;
        $newfname = $this->newfname; // $fname = $user->fname;
        $newlname = $this->newlname; // $lname = $user->lname;
        $newpassword = $this->newpassword; // $password = $user->password;
        $newpassword2 = $this->newpassword2; // $password2 = $user->password2;
        $newuserimage = $this->newuserimage; // $newpassword = $user-newuserimage;
        $userId = $this->userId; //$userId = $user->userId;
        $error_array = array();
        $uploadOK = 1;

        // ako treba dase promeni ...
        $newfname_set = (!empty($newfname) && (strlen($newfname)<25 || strlen($newfname)>2)) ? ", FirstName = :fname" : "";
        $newlname_set = (!empty($newlname) && (strlen($newlname)<25 || strlen($newlname)>2)) ? ", FirstName = :fname" : "";
        $username_set = ((!empty($newfname) && (strlen($newfname)<25 || strlen($newfname)>2)) or (!empty($newlname) and (strlen($newlname)<25 || strlen($newlname)>2))) ? ", UserName = :username" : "";
        $password_set = ((!empty($newpassword) && !empty($newpassword2)) && ($newpassword === $newpassword2) && (!preg_match('/[^A-Za-z0-9]/', $newpassword)) && (strlen($newpassword) < 30 || strlen($newpassword) > 5)) ? ", Password = :password" : "";
        $newuserimage_set = ((!isset($newuserimage)) && ($file_size != 0) && ($file_size < 10240) && (in_array($file_ext, $exts) === true) && ($uploadOK !== 0)) ? ", ProfilePicture = :userimage" : "";
    
        
        // jedini razlog zasto u query stoji Email = :em  jeste zbog zareza recimo {$newfname_set} ima zarez na pocetku koji mozemo obrisati, ali sta ako korisnik neukuca fname onda ce zarez kod lname da bude visak i ispaljivace gresku
        $query = "UPDATE" . $this->table_name . "
            SET
                Email = :em 
                {$newfname_set}
                {$newlname_set}
                {$username_set}
                {$password_set}
                {$newuserimage_set}
            WHERE
                UserId = :userid";

        // insert query /// levo nazivi kolona a desno parametar ima dvodatcku ispred (moramo prvo da ga pripremimo)
        // ovaj query bi koristili kada bismo sve menjali ako je doslo do promene jednog podatka makar ponovo upisivali u bazu iste sve druge podatke 
        // naravno tom slucaju bismo definisali sve podatke
        // $query = "UPDATE" . $this->table_name . "
        //         SET
        //             FirstName = :fname,
        //             LastName = :lname,
        //             UserName = :username,
        //             Password = :password,
        //             ProfilePicture = :userimage
        //         WHERE
        //             UserId = :userid";


        //provera da li postoji korisnik // vec smo proverili preko jwt da postoji korisnik
       if (!Userdata::CheckUser($em, $password)) {
            array_push($error_array,"Email or password was incorrect!<br>");
        } 

            if(!empty($newfname)){

                $newfname = htmlspecialchars(strip_tags($newfname)); //uklanja HTML elemente
                $newfname = str_replace(' ', '', $newfname); //uklanja razmake
                $newfname = ucfirst(strtolower($newfname)); //ostavlja samo prvo slovo veliko

                //provera duzine imena
                if (strlen($newfname)>25 || strlen($newfname)<2) {
                    array_push($error_array,  "Your first name must be between 2 and 25 characters");
                } else {

                    $fname = $newfname;
                    $username = strtolower($newfname . "_" . $lname);// username ce biti napisan malim slovima

                    //povezivanje imena i prezimena u username
                    $username = strtolower($newfname . "_" . $lname);
                    UserData::CheckUserName($username);
                    $i = 0;
                    // Ako postoji u bazi username, dodati mu broj
                    while (mysqli_num_rows(UserData::CheckUserName($username)) !=0) {
                        $i++;
                        $username = $username . "_" . $i;
                        UserData::CheckUserName($username);
                    }
                    // menjamo podatke u sesiji
                    $_SESSION['username'] = $username;
                    // menjamo podatke u bazi
                    
                    //UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    array_push($error_array, "You have updated your First Name!");
                }

            }
            if(!empty($newlname)){

                $newlname = htmlspecialchars(strip_tags($newlname)); //uklanja HTML elemente
                $newlname = str_replace(' ', '', $newlname); //uklanja razmake
                $newlname = ucfirst(strtolower($newlname)); //ostavlja samo prvo slovo veliko

                //provera duzine prezimena
                if (strlen($newlname)>25 || strlen($newlname)<2) {
                    array_push($error_array, "Your last name must be between 2 and 25 characters"); 
                } else {

                    $lname = $newlname;
                    $username = strtolower($fname . "_" . $lname);// username ce biti napisan malim slovima

                    //povezivanje imena i prezimena u username
                    $username = strtolower($fname . "_" . $lname);
                    UserData::CheckUserName($username);
                    $i = 0;
                    // Ako postoji u bazi username, dodati mu broj
                    while (mysqli_num_rows(UserData::CheckUserName($username)) !=0) {
                        $i++;
                        $username = $username . "_" . $i;
                        UserData::CheckUserName($username);
                    }
                    // menjamo podatke u sesiji
                    $_SESSION['username'] = $username;
                    // menjamo podatke u bazi
                    //UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    array_push($error_array, "You have updated your Last Name!");
                }
                
            }
            if((!empty($newpassword)) && (!empty($newpassword2))){

                //Lozinka
                $newpassword = htmlspecialchars(strip_tags($newpassword)); //uklanja HTML elemente
                $newpassword2 = htmlspecialchars(strip_tags($newpassword2)); //uklanja HTML elemente

                if ($newpassword !== $newpassword2) {
                    array_push($error_array, "Your passwords do not match");
                }else if (preg_match('/[^A-Za-z0-9]/', $newpassword)) {
                    //lozinka moze da sadrzi samo slova i brojeve
                    array_push($error_array,  "Your password can only contain english characters and numbers");
                }else if(strlen($newpassword) >30 || strlen($newpassword) < 5) {
                    //neodgovarajuca duzina lozinke
                    array_push($error_array, "Your password must be between 5 and 30 characters"); 
                } else {
                    $newpassword = md5($newpassword);    //enkripcija lozinke
                    
                    $password = $newpassword;// tek kad smo sve proverili menjamo lozinku

                    // menjamo podatke u bazi
                    //UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    array_push($error_array, "You have updated your Password!");
                }
            }

            if (isset($newuserimage)){

                $file_name = $newuserimage['name'];
                $file_size = $newuserimage['size'];
                $file_tmp = $newuserimage['tmp_name'];
                $file_type =  $newuserimage['type'];
                $splitParts = explode('.',  $newuserimage['name']);
                $file_ext = strtolower(end($splitParts));
                $exts = array("jpg", "jpeg", "png");
                $userphoto = $username. '.'.$file_ext;
                $image_location = "images/profile_pictures/" .$userphoto;// gde cemo staviti sliku kad je ucitamo
        
                //proveravamo da li je fajl prazan
                if($file_size == 0) {
                    $uploadOK = 0;
                // proveravamo da li je slika odgovarajuce velicine
                }else if($file_size > 10240){
                    array_push($error_array,"Your image is too large!");
                    $uploadOK = 0;
                // proveravamo da li je extenzija dobra
                }else if(in_array($file_ext, $exts) === false){
                    array_push($error_array,"Extention must be JPEG, PNG or JPG!");
                    $uploadOK = 0;
                } else if($uploadOK !== 0){
                    if(file_exists($image_location)){ 
                        // brisemo predhodnu sluku ako je bilo takve slike s istim korisnickim imenom
                        unlink($image_location);
                    }
                    // vrsi se upload u odredjeni folder
                    move_uploaded_file($file_tmp, $image_location);
                    $userimage = $image_location;
                    // menjamo podatke u bazi
                    //UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    $_SESSION['userimage'] = $userimage;
                    array_push($error_array,"You have updated your profile picture!");

                    }
            }


        // pripremamo query
        $stmt = $this->con->prepare($query);
    
        // vezemo vrednosti
        $stmt->bindParam(':userid', $userId);///parametar zamenjujemo konkretnom vrednoscu
        $stmt->bindParam(':em', $em);///parametar zamenjujemo konkretnom vrednoscu
        $stmt->bindParam(':fname', $fname);///parametar zamenjujemo konkretnom vrednoscu
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':lname', $username );
        $stmt->bindParam(':password', $password);//hashovana
        $stmt->bindParam(':userimage', $userimage);
    
    
        // izvrsavamo query i proveravamo da li je izvrsen
        if($stmt->execute()){

            // vracamo dogovore korisniku
            if (!Userdata::CheckUser($em, $password)) {
                array_push($error_array,"Email or password was incorrect!<br>");/// ovaj deo se cini visak jer ako nije prosao proveru jwt nije ni dosao dovde
            }
            if (!empty($newfname) && (strlen($newfname)<25 || strlen($newfname)>2)){
                array_push($error_array, "You have updated your First Name!");
            }
            if (!empty($newlname) && (strlen($newlname)<25 || strlen($newlname)>2)) {
                array_push($error_array, "You have updated your Last Name!");
            }
           if ((!empty($newpassword) && !empty($newpassword2)) && ($newpassword === $newpassword2) && (!preg_match('/[^A-Za-z0-9]/', $newpassword)) && (strlen($newpassword) < 30 || strlen($newpassword) > 5)) {
            array_push($error_array, "You have updated your Password!");
           }
           if ((!isset($newuserimage)) && ($file_size != 0) && ($file_size < 10240) && (in_array($file_ext, $exts) === true) && ($uploadOK !== 0)) {
            array_push($error_array,"You have updated your image!");
           }
            return true;
        }
    
        // vracamo odgovore korisniku

        if ((!empty($newfname)) && (strlen($newfname)>25 || strlen($newfname)<2)) {
            array_push($error_array,  "Your first name must be between 2 and 25 characters");
        } 
        if ((!empty($newlname)) && (strlen($newlname)>25 || strlen($newlname)<2)) {
            array_push($error_array, "Your last name must be between 2 and 25 characters"); 
        }
        if (((!empty($newpassword)) && (!empty($newpassword2))) && ($newpassword !== $newpassword2)) {
            array_push($error_array, "Your passwords do not match");
        } else if (preg_match('/[^A-Za-z0-9]/', $newpassword)) {
            //lozinka moze da sadrzi samo slova i brojeve
            array_push($error_array,  "Your password can only contain english characters and numbers");
        } else if(strlen($newpassword) >30 || strlen($newpassword) < 5) {
            //neodgovarajuca duzina lozinke
            array_push($error_array, "Your password must be between 5 and 30 characters"); 
        }
        if((isset($newuserimage)) && ($file_size != 0) && ($file_size > 10240)){
            array_push($error_array,"Your image is too large!");
        } else if(in_array($file_ext, $exts) === false){
            array_push($error_array,"Extention must be JPEG, PNG or JPG!");
        }

        return false;
    }

}


*/
?>