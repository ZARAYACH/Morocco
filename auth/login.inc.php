<?php

if($_POST){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $pwd =filter_var($_POST['password'], FILTER_SANITIZE_STRING); 

}else{
    header ("location:..\log-in.php?error=wrongway");
    exit();
}
// require_once '..\classes\admin.cls.php';
require_once '..\auth\functions.inc.php';
require_once '..\classes\user.cls.php';

if(empty($email) || empty($pwd)){
    header ("location:..\log-in.php?error=emptyinput");
    exit();
}

if(identifiedUser($email,$pwd)==false){
    header ("location:..\log-in.php?error=uncorrect");
    exit();
}else if(identifiedUser($email,$pwd)==true){
    $sql = "select * from users where email = '$email'";
    $return = connection::selectionFromDb($sql);
    while($row = $return->fetch()){
         if(!$row[6]){
            $user = new user($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6]);
            session_start();
            setcookie("logined",true, time() + (86400 * 30), "/"); 
            $_SESSION['user'] = serialize($user);
            if(isset($_GET['trip'])){
                $tripId = $_GET['trip'];
                $userId = $user->getId();
                $sql = "insert into cart(trip_id,user_id) values ($tripId,$userId)";
                $return = connection::actionOnDB($sql);
                if($return){
                    header ("location:../chekout.php?trip=$tripId");
                    exit();
                }else{
                    header ("location:../user-home.php?error=somethingwentwrong");
                    exit();
                }
            }else{
                header ("location:../user-home.php?ok=home");
                exit();
            }
           
        }
        // else if($row[6]){
        //     $admin = new admin($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6]);
        //     session_start();
        //     $_SESSION['admin'] = serialize($admin);
        //     header ("location:..\pages\admin-home.php?ok=loginsucced");
        //     exit();
        // }   
        
    }

}else{
    header ("location:..\log-in.php?error=someThingWentWrong");
     exit();
}
