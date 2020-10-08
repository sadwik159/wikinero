<?php

    session_start(); 
    $user = $_SESSION['username']; 
    $table = "notification_" . $user; 
     

    /* db connection  */
    require "dbc.php"; 
    $sql = "SELECT * FROM `notification_user1` WHERE senn = 0 "; 
    /* i will use this at the end :)  */

?>