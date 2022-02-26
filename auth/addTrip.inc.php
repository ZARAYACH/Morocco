<?php 
require_once '../classes/connection.cls.php';
    if(isset($_POST["to"])){
        $to = $_POST["to"];
        $desc = $_POST["desc"];
        $price = $_POST["price"];
        $max = $_POST["max"];
        $date = $_POST["depart"];
        $fileTmp = $_FILES["img"]["tmp_name"];
        $fileName = $_FILES["img"]["name"];
        $destination = '../IMG/'. $fileName;
        if(move_uploaded_file($fileTmp,$destination)){
            $destination = 'IMG/'. $fileName;
            $sql = "insert into trips(destination,description,price,max_persone,img,time_depart) values ('$to','$desc','$price','$max','$destination','$date') ";
            $return = connection::actionOnDB($sql);
            if($return){
                header("location:../admin-home?ok=controle&news=added");
                exit();
            }else{
                header("location:../admin-home?ok=controle&news=Notadded");
                exit();
            }
        }else{
            header("location:../admin-home?ok=controle&news=Notaddedp");
            exit();
        }

    }else{
        echo("fuck me");
    }

?>