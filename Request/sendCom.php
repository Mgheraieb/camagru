<?php
include_once("utils.php");
include_once("../header.php");
print_r(var_dump($_POST));

if (!isset($_POST['commentaire']) || empty($_POST['commentaire']) || !isset($_SESSION['idUser']))
{
    if (userExistID($_SESSION['idUser'], $bdd) == false){
        redirectUserLog();
    }
}

if (isset($_GET['idImg']) && !empty($_GET['idImg']) ) {
    if (imageExistID($_GET['idImg'] , $bdd) == false) {
        echo "ERROR";
        return;
    }
}

$commentaire = htmlspecialchars($_POST['commentaire']);
$idimg = htmlspecialchars($_GET['idImg']);

addCommentaire($idimg, $commentaire, $bdd);

function addCommentaire($idImg, $content,$bdd){
    try {
        $id = htmlspecialchars($_SESSION['idUser']);
        $req = $bdd->prepare('INSERT INTO commentaire (owner_id, content, picture_id) VALUES(?, ?, ?)');
        $req->execute(array($id, $content, $idImg));
        header("LOCATION:../imgDetail.php?idImg=".$idImg."&s=1");
    }catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
        header("LOCATION:../imgDetail.php?idImg".$idImg."&s=0");
    }
}


?>
