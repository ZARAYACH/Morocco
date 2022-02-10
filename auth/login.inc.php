<?php

if($_POST){
    $username = filter_var($_POST['user-name'], FILTER_SANITIZE_STRING);
    $pwd =$_POST['password']; 

}else{
    header ("location:..\pages\login.php?error=wrongway");
    exit();
}
require_once '..\classes\admin.cls.php';
require_once '..\auth\functions.inc.php';
require_once '..\classes\user.cls.php';

if(empty($username) || empty($pwd)){
    header ("location:..\pages\login.php?error=emptyinput");
    exit();
}

if(identifiedUser($username,$pwd)==false){
    header ("location:..\pages\login.php?error=uncorrect");
    exit();
}else if(identifiedUser($username,$pwd)==true){
    $sql = "select * from users where username = '$username'";
    $return = connection::selectionFromDb($sql);
    while($row = $return->fetch()){
         if(!$row[6]){
            $user = new user($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6]);
            session_start();
            $_SESSION['user'] = serialize($user);
            header ("location:..\pages\user-home.php?ok=loginsucced");
            exit();
        }else if($row[6]){
            $admin = new admin($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6]);
            session_start();
            $_SESSION['admin'] = serialize($admin);
            header ("location:..\pages\admin-home.php?ok=loginsucced");
            exit();
        }   
        
    }

}else{
    header ("location:..\pages\user-home.php?error=someThingWentWrong");
     exit();
}
