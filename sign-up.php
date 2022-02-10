<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\signup.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://kit.fontawesome.com/8b4d616e93.js" crossorigin="anonymous"></script>
          <title>sign up</title>
</head>
<body>
    <div class="container">
        
        <div class="left">
            <div class="title_left">
                Welcome Back !
            </div>
            <div class="desc">
                to keep connected with us pleasr login with your personal info 
            </div>
            <div class="button">
            <a href="#">Sign In</a>
        </div>
        </div>
        
        <div class="right">
            <div class="title">
                Create account
            </div>
            <div class="social">
                <div class="logo"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                <div class="logo"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                <div class="logo"><i class="fa fa-twitter" aria-hidden="true"></i></div>
            </div>
            <div class="comment">sign up now and live the full experience</div>
            
            <div class="form">
                <form action="./auth/signup.inc.php" method="post">
                   <div class="input">
                   <i class="material-icons">person_outline</i>
                   <input type="text" name="username" placeholder="UserName">
                </div>
                <div class="input">

                <i class="material-icons">mail_outline</i>
               <input type="text" name="email" placeholder="Email">
                </div>
                <div class="input">
                   <i class="material-icons">lock_outline</i>
                   <input type="password" name="password" placeholder="password">
                </div>
                <div class="input">
                <i class="material-icons">lock_outline</i>
                   <input type="password" name="password-repeat" placeholder="repeat password">
                </div>
                <input type="submit" name="submit" value="sign up">
                </form>
            </div>
        </div>
    </div>

<script src=".\JS\jquery-3.1.1.min.js" ></script>
</body>

</html>