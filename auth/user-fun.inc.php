<?php
require_once '../classes/connection.cls.php';
require_once '../classes/trips.cls.php';
require_once '../classes/admin.cls.php';
session_start();
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
        $selled = [];
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
                    $sql = "select id from booked order by id desc limit 1 ";
                    $return = connection::selectionFromDb($sql);
                    if($return){
                        
                        while($row =$return->fetch()){
                            array_push($selled,$row[0]);
                        }
                    } 
                 $sql = "delete from cart where id = '$tripId'";
                 $return = connection::actionOnDB($sql);
                 if($return){
                     $result = "done";
                 }else{
                     $result = "wrong";
                 }
                }
             }
             $_SESSION["selled"] = serialize($selled);
             echo $result; 
            
           }
            
            
        }else if($_POST["what"]=="search"){
            if(isset($_POST["value"])){
                $to = $_POST["value"];
                if(isset($_POST["date"])){
                    $date = $_POST["date"];
                    echo(trips::displaySearchWithDestinationAndTime($to,$date));
                }else{
                    echo(trips::displaySearchWithDestination($to));

                }
            }else{
                if(isset($_POST["date"])){
                    $date = $_POST["date"];
                    echo(trips::displaySearchWithTime($date));
                }else{
                    // echo(trips::displaySearchWithDestination($to));

                }
            }
        }else if($_POST["what"]=="displayAll"){
            echo(trips::displayAllTripsDashbaord());
        }else if($_POST["what"] == "deleteTrip"){
            if($_POST["tripId"]){
                $tripId = $_POST["tripId"]; 
                 $return = admin::deleteTrip($tripId);
                if($return){
                    echo trips::displayAllTripsDashbaordd();
                }else{
                    echo(false);
                }
                
        }

    }

}