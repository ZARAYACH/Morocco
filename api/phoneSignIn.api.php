<?php
if(isset($_GET["what"])){
    if($_GET["what"]=="login"){
        $data = file_get_contents('php://input');
        $JSON = json_decode($data,true);
        $email = $JSON["identifier"]["email"];
        $pwd = $JSON["identifier"]["password"];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pwd =filter_var($pwd, FILTER_SANITIZE_STRING); 
    
    require_once "..\classes\admin.cls.php";
    require_once "../auth/functions.inc.php";
    require_once "..\classes\user.cls.php";
    
    
    if(empty($email) || empty($pwd)){
        $response = array("error"=>"emptyinput");
        echo(json_encode($response));
        exit();
    }
    
    if(identifiedUser($email,$pwd)==false){
        $response = array("error"=>"uncorrect");
        echo(json_encode($response));
        exit();
    }else if(identifiedUser($email,$pwd)==true){
        $sql = "select * from users where email = '$email'";
        $return = connection::selectionFromDb($sql);
        
        while($row = $return->fetch()){
             if(!$row[4]){
                $user = new user($row[0],$row[1],$row[2],$row[3],$row[4]);
                session_start();
                setcookie("logined",true, time() + (86400 * 30), "/"); 
                $_SESSION['user'] = serialize($user);
                
                $response = array("ok"=>"withSucces",
                "user"=>array("id"=>$user->getId(),
                            "username"=>$user->getUserName(),
                            "email"=>$user->getEmail(),
                            "password"=>$user->getPwd(),
                            "img"=>$row[6]
            ));
                echo(json_encode($response));
                exit();
                }
               
            }  
        }
    
    }else{
        $response = array("error"=>"someThinWentWrong");
        echo(json_encode($response));
         exit();
    }
    
               
    
            }else{
    header("location: ../index.php");
    exit();
}