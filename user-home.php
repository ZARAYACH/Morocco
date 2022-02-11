<?php
session_start();
$user  = unserialize($_SESSION['user']);
var_dump($user);