<?php 
    session_start();

    session_unset($_SESSION["timer"]);
    session_unset($_SESSION["permission"]);

    session_destroy();   

    header("location: https://www.shanewalders.com");
    die();
?>