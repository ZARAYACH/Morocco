<?php
require_once '../classes/connection.cls.php';
require_once '../classes/admin.cls.php';
require_once '../classes/user.cls.php';
require_once 'functions.inc.php';
$arr = '' ;

if(isset($_POST['what'])){
    if($_POST['what'] == "login"){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $pwd =filter_var($_POST['pass'], FILTER_SANITIZE_STRING); 
    if(empty($email) || empty($pwd)){
       echo("emptyInput");
    }else if(identifiedUser($email,$pwd)==false){
        echo("incorrect");
    }else if(identifiedUser($email,$pwd)==true){$sql = "select * from users where email = '$email'";
        $return = connection::selectionFromDb($sql);
        while($row = $return->fetch()){
             if(!$row[4]){
                $user = new user($row[0],$row[1],$row[2],$row[3],$row[4]);
                session_start();
                setcookie("logined",true, time() + (86400 * 30), "/"); 
                $_SESSION['user'] = serialize($user);
                if(isset($_GET['trip'])){
                    $tripId = $_GET['trip'];
                    $userId = $user->getId();
                    $sql = "insert into cart(trip_id,user_id) values ($tripId,$userId)";
                    $return = connection::actionOnDB($sql);
                    if($return){
                        $arr = "succes"."§"."./chekout.php?trip=$tripId";
                    echo($arr);
                        exit();
                    }else{
                        $arr = "succes"."§"."./user-home.php?error=somethingwentwrong";
                    echo($arr);
                        
                        exit();
                    }
                }else{
                    $arr = "succes"."§"."./user-home.php?ok=home";
                    echo($arr);
                    exit();
                }
               
            }
            else if($row[4]){
                $admin = new admin($row[0],$row[1],$row[2],$row[3],$row[4]);
                session_start();
                $_SESSION['admin'] = serialize($admin);
                $arr = "succes"."§"."./admin-home.php";
                echo($arr);
                exit();
            }   
            
        }
    
    }else{
        echo("somethingwentWrong");
    }
    

    }else if($_POST['what'] == "signup"){
        if (isset($_POST['username']))
{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email =filter_var( $_POST['email'], FILTER_SANITIZE_STRING);
    $pwd =filter_var($_POST['pass'],FILTER_SANITIZE_STRING ) ;
    $pwd_repeat =filter_var($_POST['pass-repeat'],FILTER_SANITIZE_STRING ); 
}
else
{
    $err = "errorWithHeader"."§".".\sign-up.php?error=wrongway";
    echo($err);
    exit();
}


if(EmptyInput($username,$email,$pwd,$pwd_repeat)===true)
{
    $err = "error"."§"."imptyInput";
    echo($err);
    exit();
}
// we will validate the email later
if(ValidateEmail($email)===false)
{
    $err = "error"."§"."wrongEmail";
    echo($err);
    exit();
}

if(ValidateExstingEmail($email)===false)
{
    $err = "error"."§"."emailExist";
    echo($err);
    exit();
}

if(ValidatePwd($pwd,$pwd_repeat)===false)
{
    $err = "error"."§"."unmachedPassword";
    echo($err);
    exit();

}
if(ValidateUserName($username)===false)
{
    $err = "error"."§"."usernameExists";
    echo($err);
    exit();
}
$id= null;
$admin = null;
$user = new user($id,$username,$email,$pwd,$admin);
if($user->addToDb($user->getUsername(),$user->getEmail(),$user->getPwd(),$user->getadmin())){
    $err = "indice"."§"."succes";
    echo($err);
    exit();
}else{
    $err = "error"."§"."somethingWentWrong";
    echo($err);
    exit();
}
    }



    }

