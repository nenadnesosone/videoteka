<?php
require_once './config/config.php';
require_once './data/userdata.php';

$userId = '';
$em = "";
$fname = "";
$newfname = "";
$lname = "";
$newlname = "";
$password = "";
$newpassword = "";
$newpassword2 = "";
$error_array = array();
$userimage = "";
$uploadOK = 1;

if ((isset($_POST['update_button'])) or (isset($_POST['delete_button']))) {
    
    $em =  filter_var(UserData::sanit($_POST['profile_email'], FILTER_SANITIZE_EMAIL)); 
       
    $password = md5(UserData::sanit($_POST['profile_password']));   

    if (!Userdata::CheckUser($em, $password)) {
        array_push($error_array,"Email or password was incorrect!<br>");
        
    }else{
        $row = UserData::GetUserRow($em, $password);
        $userId = $row['UserId'];
        $fname = $row['FirstName'];
        $lname = $row['LastName'];
        $username = $row['UserName'];
        $password = $row['Password'];
        $userimage = $row['ProfilePicture'];
        if(isset($_POST['delete_button'])){
            session_destroy();
            Userdata::DeleteOneUser($userId);
        } else {
            if(!empty($_POST['update_fname'])){

                $newfname = ucfirst(strtolower(UserData::sanit($_POST['update_fname']))); 
                
                if (strlen($newfname)>25 || strlen($newfname)<2) {
                    array_push($error_array,  "Your first name must be between 2 and 25 characters");
                } else {

                    $fname = $newfname;
                    $username = strtolower($newfname . "_" . $lname);

                    $username = strtolower($newfname . "_" . $lname);
                    UserData::CheckUserName($username);
                    $i = 0;
                    while (mysqli_num_rows(UserData::CheckUserName($username)) !=0) {
                        $i++;
                        $username = $username . "_" . $i;
                        UserData::CheckUserName($username);
                    }
                    $_SESSION['username'] = $username;
                   
                    UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    array_push($error_array, "You have updated your First Name!");
                }
            }
            if(!empty($_POST['update_lname'])){

               
                $newlname = ucfirst(strtolower(UserData::sanit($_POST['update_lname']))); 

                if (strlen($newlname)>25 || strlen($newlname)<2) {
                    array_push($error_array, "Your last name must be between 2 and 25 characters"); 
                } else {

                    $lname = $newlname;
                    $username = strtolower($fname . "_" . $lname);

                    $username = strtolower($fname . "_" . $lname);
                    UserData::CheckUserName($username);
                    $i = 0;
                    while (mysqli_num_rows(UserData::CheckUserName($username)) !=0) {
                        $i++;
                        $username = $username . "_" . $i;
                        UserData::CheckUserName($username);
                    }
                    $_SESSION['username'] = $username;
                    
                    UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    array_push($error_array, "You have updated your Last Name!");
                }
                
            }
            if((!empty($_POST['new_password'])) and (!empty($_POST['new_password2']))){

                
                $newpassword = UserData::sanit($_POST['new_password']); 
                $newpassword2 = UserData::sanit($_POST['new_password2']); 

                if ($newpassword != $newpassword2) {
                    array_push($error_array, "Your passwords do not match");
                }else if (preg_match('/[^A-Za-z0-9]/', $newpassword)) {
                    
                    array_push($error_array,  "Your password can only contain english characters and numbers");
                }else if(strlen($newpassword) >30 || strlen($newpassword) < 5) {
                    
                    array_push($error_array, "Your password must be between 5 and 30 characters"); 
                } else {
                    $newpassword = md5($newpassword);
                    
                    $password = $newpassword;

                    
                    UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    array_push($error_array, "You have updated your Password!");
                }
            } 
            if (isset($_FILES['new_image'])){

                $file_name = $_FILES['new_image']['name'];
                $file_size = $_FILES['new_image']['size'];
                $file_tmp = $_FILES['new_image']['tmp_name'];
                $file_type =  $_FILES['new_image']['type'];
                $splitParts = explode('.',  $_FILES['new_image']['name']);
                $file_ext = strtolower(end($splitParts));
                $exts = array("jpg", "jpeg", "png");
                $userphoto = $username. '.'.$file_ext;
                $image_location = "images/profile_pictures/" .$userphoto;
                
        
                
                if($file_size == 0) {
                    $uploadOK = 0;
                
                }else if($file_size > 10240){
                    array_push($error_array,"Your image is too large!");
                    $uploadOK = 0;
                
                }else if(in_array($file_ext, $exts) === false){
                    array_push($error_array,"Extention must be JPEG, PNG or JPG!");
                    $uploadOK = 0;
                } else if($uploadOK !== 0){
                    if(file_exists($image_location)){ 
                        
                        unlink($image_location);
                    }
                    
                    move_uploaded_file($file_tmp, $image_location);
                    $userimage = $image_location;
                    
                    UserData::UpdateUser($userId, $fname, $lname, $username, $password, $userimage);
                    $_SESSION['userimage'] = $userimage;
                    array_push($error_array,"You have updated your profile picture!");
    
                }
        
            }
          
        }

    } 
}

?>