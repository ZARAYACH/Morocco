<?php
session_start();
$user  = unserialize($_SESSION['user']);
var_dump($user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="./auth/logout.inc.php">LOGOUT</a>
    
</body>
</html>