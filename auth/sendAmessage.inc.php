<?php
require_once '../classes/connection.cls.php';

if(isset($_POST["submit"])){
    if(!empty($_POST["name"])){
        $name = $_POST["name"];    
    }else{
        header("location: ../index.php?error=emptyinput");
        exit();
    }
    if(!empty($_POST["email"])){
        $email = $_POST["email"];
    }else{
        header("location: ../index.php?error=emptyinput");
        exit();
    }
    if(!empty($_POST["type"])){
        $type = $_POST["type"];
    }else{
        header("location: ../index.php?error=emptyinput");
        exit();
    }
    if(!empty($_POST["subject"])){
        $subject = $_POST["subject"];
    }else{
        header("location: ../index.php?error=emptyinput");
        exit();
    }
    if(!empty($_POST["message"])){
        $message = $_POST["message"];
    }else{
        header("location: ../index.php?error=emptyinput");
        exit();
    }
    
    
}else{
    header("location: ../index.php?error=wrongway");
    exit();
}
$sql = "insert into contact(name,email,type,subject,message) values ('$name','$email','$type','$subject','$message') ";
$return = connection::actionOnDB($sql);
if($return){
    header("location: ../index.php?ok=bysucces");
    exit();
}else{
    header("location: ../index.php?error=repeatlater");
    exit();
}


