<?php
include_once("../header.php");
include_once("utils.php");

redirectUserLog();
$id = $_SESSION['idUser'];
if (!isset($_GET['idImg']) || empty($_GET['idImg'])){
    header("LOCATION:../camera.php");
    return;
}
$idImg = $_GET['idImg'];
$owner = getImageOwnerId($idImg, $bdd);
if ($owner == false){
    header("LOCATION:../camera.php");
    return;
}

if ($owner != $_SESSION['idUser']){
    header("LOCATION:../camera.php");
    return;
}

$req = $bdd->prepare('DELETE FROM picture WHERE id = ? AND owner_id = ?');
$req->execute(array($idImg, $owner));




?>
