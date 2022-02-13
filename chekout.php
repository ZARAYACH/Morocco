<?php
if(isset($_COOKIE['logined'])){
    if($_COOKIE['logined']){
        echo 'yeah';
    }else{
        echo 'IT FALSE';
    }
}else{
    echo 'NO';
}