<?php
require_once '../classes/connection.cls.php';
require_once '../classes/user.cls.php';
session_start();
if(isset($_COOKIE['logined'])){
    if($_COOKIE['logined']){
        if(isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            if($_GET["trip"]){
                $tripId = $_GET["trip"];
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
                header("location:../chekout.php");
                exit();
            }else{
                header("location:../index.html?trip=false");
                exit();

            }
        }else{
            header("location:../log-in.php?logined=unlogined");
                exit();
        }
    }else{
        header("location:../log-in.php?logined=unlogined");
                exit();
    }
}else{
    if(isset($_GET['trip'])){
        $tripId=$_GET['trip'];
        header("location:../log-in.php?logined=unlogined&trip=$tripId");
        exit();
    }
    header("location:../log-in.php?logined=unlogined");
    exit();
}