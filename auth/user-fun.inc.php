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
        }else if(strlen($cardNumber)!=16 || !is_numeric($cardNumber)){
            echo("card number incorect");
        }else if(strlen($cvv)!=3 || !is_numeric($cvv)){
            echo('incorect cvv');
        }else if($month<0 && $month>13 || $year<date('y') || $year>date('y')+15){
            echo('incorrect expiration date');     
        }else{
            $tripIdsAndQte = $_POST["tripId"] ;
            $sql = "select * from cards where card_number = '$cardNumber' ";
            $return = connection::selectionFromDb($sql);
           if($return->rowCount()===0){
            $sql = "insert into cards(holder_name,card_number,expiration_date,cvv,id_user) values ('$holderName','$cardNumber','$month/$year','$cvv','$userId')";
            $return = connection::actionOnDB($sql);
            if($return){
                //logs
            }
        }else{
            //logs
        }

            for ($i=0; $i < count($tripIdsAndQte) ; $i++) {
                $result = false; 
                $exploded = explode(',',$tripIdsAndQte[$i]);
                $tripId = $exploded[0];
                $qte = $exploded[1];
                $prixForOne = $exploded[2];
                $total = $prixForOne * $qte+10;
                $sql = "insert INTO booked(id_trip,id_user,qte,prixForOne,tatalPaid) VALUES ((select trip_id from cart where id = '$tripId'),'$userId','$qte','$prixForOne','$total')";
                $return = connection::actionOnDB($sql);
                if($return){
                    $result = "done";
                 $sql = "delete from cart where id = '$tripId'";
                 $return = connection::actionOnDB($sql);
                 if($return){
                     $result = "done";
                 }else{
                     $result = "wrong";
                 }
                }
             }
             echo $result; 
           }
            
            
        }

    }

