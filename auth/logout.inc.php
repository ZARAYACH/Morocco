<?php

session_start();
setcookie('logined',"True",time()-3600,'/');
session_unset();
session_destroy();

header("location:../index.php");