<?php
include_once("utils.php");
include_once("../header.php");

redirectUserLog();


if (!isset($_POST['passChange']) || !isset($_POST['pass'])  || !isset($_POST['confirmation'])|| userExistID($_SESSION['idUser'], $bdd) == false){
    echo "<script>window.close();</script>";
}
$id = $_SESSION['idUser'];
$pass = htmlspecialchars($_POST['pass']);
$confirmation = htmlspecialchars($_POST['confirmation']);

if(empty($pass) || empty($confirmation) || $pass != $confirmation) {
    echo "<script>window.close();</script>";
}

$pass = password_hash($pass, PASSWORD_DEFAULT);
$req = $bdd->prepare('UPDATE user SET passwd = ? WHERE id=?');
$req->execute(array($pass, $id));


echo "<script>window.close();</script>";

?>