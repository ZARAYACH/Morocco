<?php
if (isset($_POST['username']))
{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email =filter_var( $_POST['email'], FILTER_SANITIZE_STRING);
    $pwd =filter_var($_POST['password'],FILTER_SANITIZE_STRING ) ;
    $pwd_repeat =filter_var($_POST['password-repeat'],FILTER_SANITIZE_STRING ); 
}
else
{
    header ("location:..\sign-up.php?error=wrongway");
    exit();
}
require_once '../auth/functions.inc.php';
require_once '../classes/user.cls.php';

if(EmptyInput($username,$email,$pwd,$pwd_repeat)===true)
{
    header ("location:..\sign-up.php?error=imptyinput");
    exit();
}
// we will validate the email later
if(ValidateEmail($email)===false)
{
    header ("location:..\sign-up.php?error=Wrongemail");
    exit();
}

if(ValidateExstingEmail($email)===false)
{
    header ("location:..\sign-up.php?error=emailExists");
    exit();
}

if(ValidatePwd($pwd,$pwd_repeat)===false)
{
    header ("location:..\sign-up.php?error=Unmatchedpassword");
    exit();

}
if(ValidateUserName($username)===false)
{
    header ("location:..\sign-up.php?error=userexists");
    exit();
}
$firstname = null;
$lastname = null;
$user = new user($id,$username,$firstname,$lastname,$email,$pwd,$admin);
if($user->addToDb($user->getUsername(),$user->getFirstName(),$user->getLastName(),$user->getEmail(),$user->getPwd(),$user->getadmin())){

    header ("location:..\sign-up.php?indice=signupWithSucces");
    exit();
}else{
    header ("location:..\sign-up.php?error=someThingWentWrong");
    exit();
}



