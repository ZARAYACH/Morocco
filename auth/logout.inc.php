<?php

session_start();
setcookie("logined",true, time() - (86400 * 30), "/"); 
session_unset();
session_destroy();

header("location:../index.php");