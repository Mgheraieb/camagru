<?php
include("header.php");

if ((isset($_SESSION['logged']) && $_SESSION['logged'] == FALSE) || session_status() == PHP_SESSION_NONE || session_status() == PHP_SESSION_DISABLED || !isset($_SESSION['logged']) ){
    header('LOCATION:./signin.php');
}else{
    include("home.php");
    //HOME SNAP USER=> SETTING
    //
    // DELOG
}
?>