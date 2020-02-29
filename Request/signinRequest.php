<?php
include_once ('../header.php');
include_once("./utils.php");

$email = "";
$passwd = "";

if (!isset($_POST['email']) || !isset($_POST['passwd'])) {
    redirectError("../signin.php", 3);

}else{
    $email = htmlspecialchars($_POST["email"]);
$passwd = htmlspecialchars($_POST["passwd"]);
}


$login = logUser($email, $email, $passwd, $bdd);

if ($login == false){
    echo "ERROR LOGIN";
}
?>