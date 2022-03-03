<?php
require_once '../classes/connection.cls.php';
require_once '../classes/trips.cls.php';
require_once '../classes/admin.cls.php';
require_once '../auth/functions.inc.php';
session_start();
if(isset($_SESSION["user"])){
    $user = unserialize($_SESSION["user"]);
}else if(isset($_SESSION["admin"])){
    $admin = unserialize($_SESSION["admin"]);
}else{
    header("location:../log-in.php?unlogined");
    exit();
}
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

    }else if($_POST["what"]=="editContact"){
       $phoneNbr =$_POST["phoneNbr"];
        if(isset($_POST["email"])){
            $email = $_POST["email"];
            if(empty($phoneNbr)||empty($email)){
                echo 'empty input';
            }else{
               if(ValidateEmail($email)){
                   if(ValidateExstingEmail($email)){
                       if(user::editContact($phoneNbr,$email,$user->getId())){
                           echo 'editContactSucces';
                       }else{
                           echo 'editContactFailed';
                       }
                       }else{
                           echo('emailExists');
                       }
                   }else{
                       echo("invalid email");
                   }
               }
        }else{
            $userId =$user->getId();
            $sql ="update additional_info set phoneNbr = '$phoneNbr' where user_id = '$userId'";
            $return = connection::actionOnDB($sql);
            if($return){
                echo'phoneNbrChanged';
            }else{
                echo 'phonefailed';
            }
        }
    }else if($_POST["what"] == "editAdditional"){    
            $firstName = $_POST["firstName"];
            $lastName= $_POST['lastName'];
            $address1 =$_POST['address1'];
            if(isset($_POST["address2"])){
                $address2 = $_POST["address2"];
            }else{
                $address2 = "";
            }
            $postal = $_POST["postal"];
            $city = $_POST['city'];
            $country =$_POST["country"];
            $return = $user->editAdditional($firstName,$lastName,$address1,$address2,$postal,$city,$country,$user->getId());
            if($return){
                echo("withSucces");
            }else{
                echo("editFailed");
            }
    
    }else if($_POST["what"] == "editAdditionalAdmin"){    
        $firstName = $_POST["firstName"];
        $lastName= $_POST['lastName'];
        $address1 =$_POST['address1'];
        if(isset($_POST["address2"])){
            $address2 = $_POST["address2"];
        }else{
            $address2 = "";
        }
        $postal = $_POST["postal"];
        $city = $_POST['city'];
        $country =$_POST["country"];
        $return = $admin->editAdditional($firstName,$lastName,$address1,$address2,$postal,$city,$country,$admin->getId());
        if($return){
            echo("withSucces");
        }else{
            echo("editFailed");
        }

}else if($_POST["what"]=="editContactAdmin"){
    $phoneNbr =$_POST["phoneNbr"];
     if(isset($_POST["email"])){
         $email = $_POST["email"];
         if(empty($phoneNbr)||empty($email)){
             echo 'empty input';
         }else{
            if(ValidateEmail($email)){
                if(ValidateExstingEmail($email)){
                    if(admin::editContact($phoneNbr,$email,$admin->getId())){
                        echo 'editContactSucces';
                    }else{
                        echo 'editContactFailed';
                    }
                    }else{
                        echo('emailExists');
                    }
                }else{
                    echo("invalid email");
                }
            }
     }else{
         $userId =$admin->getId();
         $sql ="update additional_info set phoneNbr = '$phoneNbr' where user_id = '$userId'";
         $return = connection::actionOnDB($sql);
         if($return){
             echo'phoneNbrChanged';
         }else{
             echo 'phonefailed';
         }
     }
 }else if($_POST["what"] == "changeImgAdmin"){
    $file = $_FILES["img"]; 
    $destination = "../uplaodedImg/".$file["name"];
    $to = "uplaodedImg/".$file["name"];
    $temp = $file['tmp_name'];
    if(move_uploaded_file($temp,$destination)){
        $sql = "update users set img = '$to'";
        $return = connection::actionOnDB($sql);
        if($return){
            echo("donesuccesfuly");
        }else{
            echo("somethingwentwrong");
        }
    }else{
        echo("somethingwentwrongse");

    }
 }
}
        