<?php
require_once '../classes/connection.cls.php';
if(isset($_POST['what'])){
    if($_POST['what'] == 'del'){
        $result = false;
        $tripId=$_POST['tripId'];
        $sql = "delete from cart where id='$tripId'";
        $return = connection::actionOnDB($sql);
        echo $return;
    }else if($_POST['what']=="booking"){
        $userId = $_POST['userId'];
        $holderName =  $_POST['holderName'];
        $cardNumber = $_POST['cardNumber'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $cvv = $_POST['cvv'];
        if(!isset($_POST["tripId"])){
            echo("impty cards");
        }else if(empty($userId) || empty($holderName) || empty($cardNumber) || empty($month) || empty($year) || empty($cvv) ){
            echo("impty input");
        }else if(strlen($cardNumber)!=24 || !is_numeric($cardNumber)){
            echo("card number incorect");
        }else if(strlen($cvv)!=3 || !is_numeric($cvv)){
            echo('incorect cvv');
        }else if($month<0 && $month>13 || $year<date('y') || $year>date('y')+15){
            echo('incorrect expiration date');     
        }else{
            
        }

    }
}
