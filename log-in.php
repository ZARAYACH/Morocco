<?php
if(isset($_GET['trip'])){
    $tripId = $_GET['trip'];
    $action = "./auth/login.inc.php?trip=$tripId";
}else{
    $action = "./auth/login.inc.php";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\login.css">
    <link rel="stylesheet" href="CSS/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>log in</title>
</head>
<body>
    <div class="container">
        
        <div class="right">
            <div class="title">
                Log in To enjoy
        </div>
            <div class="social">
                <div class="logo"><i class="fa-brands fa-facebook-f"></i></div>
                <div class="logo"><i class="fa-brands fa-instagram"></i></div>
                <div class="logo"><i class="fa-brands fa-twitter"></i></div>
            </div>
            <div class="comment">log in now and explore Morocco With Us </div>
            
            <div class="form">
                 <form >
                <div class="input">
                <i class="material-icons">mail_outline</i>
               <input type="text" id='email' name="email" placeholder="Email">
                </div>
                <div class="input">
                   <i class="material-icons">lock_outline</i>
                   <input type="password" id='pass' name="password" placeholder="password">
                </div>
                <input type="button"  id="submit" name="submit" value="Log In">
                </form>
            </div>
        </div>
        <div class="left">
            <div class="title_left">
                Hello, Friend!
            </div>
            <div class="desc">
                Entre your personel details and start journey with us!
            </div>
            <div class="button">
            <a href="./sign-up.php">Sign Up</a>
        </div>
        </div>
    
    </div>
          
<script src=".\JS\jquery-3.1.1.min.js" ></script>
<script src="./JS/login.js"></script>

</body>

</html>