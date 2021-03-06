<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\signup.css">
    <link rel="stylesheet" href="CSS/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  
          <title>sign up</title>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="title_left">
                Welcome Back !
            </div>
            <div class="desc">
                to keep connected with us please login with your personal info 
            </div>
            <div class="button">
            <a href="./log-in.php">Log In</a>
        </div>
        </div>
        
        <div class="right">
            <div class="title">
                Create account
            </div>
            <div class="social">
            <div class="logo"><i class="fa-brands fa-facebook-f"></i></div>
                <div class="logo"><i class="fa-brands fa-instagram"></i></div>
                <div class="logo"><i class="fa-brands fa-twitter"></i></div>
            </div>
            <div class="comment">sign up now and live the full experience</div>
            
            <div class="form">
                <form method="post">
                   <div class="input">
                   <i class="material-icons">person_outline</i>
                   <input type="text" id='username' name="username" placeholder="UserName">
                </div>
                <div class="input">

                <i class="material-icons">mail_outline</i>
               <input type="text" name="email" id="email" placeholder="Email">
                </div>
                <div class="input">
                   <i class="material-icons">lock_outline</i>
                   <input id="pass" type="password" name="password" placeholder="password">
                </div>
                <div class="input">
                <i class="material-icons">lock_outline</i>
                   <input type="password" id="pass-repeat" name="password-repeat" placeholder="repeat password">
                </div>
                <input type="button" id="submit" name="submit" value="sign up">
                </form>
            </div>
        </div>
    </div>
<script src=".\JS\jquery-3.1.1.min.js" ></script>
<script src="./JS/signup.js"></script>
</body>

</html>