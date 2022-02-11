<?php


require_once '../classes/connection.cls.php';

function EmptyInput($username,$email,$pwd,$pwd_repeat){
    $result = false;
    if(empty($username) || empty($email)|| empty($pwd) || empty($pwd_repeat)){
        $result = true;
    }
    return $result; 
}
function ValidateEmail($email){
    $result = false;
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true ;
    }  
    return $result;
}
function ValidateExstingEmail($email){
    $result = false;
    $sql = "select id from users where email = '$email'";
    $return = connection::selectionFromDb($sql);
    if($return != false){
        $nbr = $return->rowCount();
        if ($nbr == 0){
            $result = true;
        }

    }
    return $result;
}

function ValidatePwd($pwd,$pwd_repeat){
    $result = false;
    if($pwd == $pwd_repeat ){
        $result = true ;
    }  
    return $result;
}
function ValidateUserName($username){
    $result = false;
    $sql = "select username from users where username = '$username'";
    $return = connection::selectionFromDb($sql);
    if($return != false){
        $nbr = $return->rowCount();
        if ($nbr == 0){
            $result = true;
        }
    }
    return $result;  
}
function ValidateFirstName($firstname){
    $result = true;
    if (!preg_match('/[^A-Za-z0-9]/', $firstname)){
        $result = false ;
    }  
    return $result;
}
function ValidateLastName($lastname){
    $result = true;
    if (!preg_match('/[^A-Za-z0-9]/', $lastname)){
        $result = false ;
    }  
    return $result;
}

function identifiedUser($email,$pwd){
    $result = false;
    $sql = "select id,email from users where email = '$email'";
    $return = connection::selectionFromDb($sql);
    if($return->rowCount() != 0){
        while($row = $return->fetch()){
            if($email == $row[1]){
                $id = $row[0];
                $back = checkThePwd($pwd,$id);
                if($back == true){     
                    $result = $back;
                }

            }
        }  
        
        $return->closeCursor();
    }
 
    return $result;
    
}
function checkThePwd($pwd,$id){
    $sql = "select pwd from users where id='$id' ";
    $return = connection::selectionFromDb($sql);
    while($row = $return->fetch()){
        $back=password_verify($pwd,"$row[0]");
        if($back)
        {
            return true ;
        }else{
            return  false;
        }
    }
}