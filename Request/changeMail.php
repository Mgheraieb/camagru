<?php
include_once("utils.php");
include_once("../header.php");

redirectUserLog();


if (!isset($_POST['mailChange']) || !isset($_POST['mail']) || userExistID($_SESSION['idUser'], $bdd) == false){
     echo "<script>window.close();</script>";
}
$id = $_SESSION['idUser'];
$mail = htmlspecialchars($_POST['mail']);
$regex = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
if (!preg_match($regex,$mail))
{
    echo "LALAL";
}

if (userExist($mail, $mail, $bdd)){
    echo "<script>window.close();</script>";
}else{
    $req = $bdd->prepare('UPDATE user SET mail = ? WHERE id=?');
    $req->execute(array($mail, $id));
}

echo "<script>window.close();</script>";


?>