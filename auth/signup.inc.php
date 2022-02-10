<?php
if (isset($_POST['username']))
{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $firstname = filter_var( $_POST['First-name'], FILTER_SANITIZE_STRING);
    $lastname =filter_var($_POST['Last-name'], FILTER_SANITIZE_STRING); 
    $email =filter_var( $_POST['email'], FILTER_SANITIZE_STRING);
    $pwd = $_POST['password'] ;
    $pwd_repeat =$_POST['password-repeat']; 
}
else
{
    header ("location:..\pages\signup.php?error=wrongway");
    exit();
}
require_once '../auth/functions.inc.php';
require_once '../classes/user.cls.php';

if(EmptyInput($username,$firstname,$lastname,$email,$pwd,$pwd_repeat)===true)
{
    header ("location:..\pages\signup.php?error=imptyinput");
    exit();
}
// we will validate the email later
if(ValidateEmail($email)===false)
{
    header ("location:..\pages\signup.php?error=Wrongemail");
    exit();
}

if(ValidateExstingEmail($email)===false)
{
    header ("location:..\pages\signup.php?error=emailExists");
    exit();
}

if(ValidatePwd($pwd,$pwd_repeat)===false)
{
    header ("location:..\pages\signup.php?error=Unmatchedpassword");
    exit();

}
if(ValidateUserName($username)===false)
{
    header ("location:..\pages\signup.php?error=userexists");
    exit();
}

$user = new user($id,$username,$firstname,$lastname,$email,$pwd,$admin);
if($user->addToDb($user->getUsername(),$user->getFirstName(),$user->getLastName(),$user->getEmail(),$user->getPwd(),$user->getadmin())){

    header ("location:..\pages\signup.php?indice=signupWithSucces");
    exit();
}else{
    header ("location:..\pages\signup.php?error=someThingWentWrong");
    exit();
}



