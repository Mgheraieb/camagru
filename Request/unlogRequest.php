<?php
include_once("../header.php");
include_once('./utils.php');
if (isset($_SESSION['logged']) && $_SESSION['logged'] == TRUE) {
    $_SESSION = array();
    session_destroy();
    redirectError("../index.php", 0);
}

?>