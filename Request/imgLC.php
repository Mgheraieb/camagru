<?php
include_once("header.php");
include_once("utils.php");


if (isset($_POST['like']))
{
    $idImg = htmlspecialchars($_POST['like']);
    $res = addLikeForImg($idImg, $bdd);
    print_r(var_dump($res));
}

if (isset($_POST['unlike'])){
    $idImg = htmlspecialchars($_POST['unlike']);
    $res = unlikeImg($idImg, $bdd);
}

function canLikeImg($idImg, $bdd){
    if (imageExistID($idImg, $bdd) == false)
        return false;
    if (userExistID($_SESSION['idUser'], $bdd) == false)
        return false;
    if (getImageOwnerID($idImg, $bdd) == $_SESSION['idUser'])
        return false;
    return true;
}

function imageAlreadyLiked($idImg, $bdd){
    try {
        $idUser = false;
        if (isset($_SESSION['idUser'])) {
            if(userExistID($_SESSION['idUser'], $bdd) == false)
                return false;
            $idUser = $_SESSION['idUser'];
        }
        if ($idUser != false){
            $req = $bdd->prepare('SELECT * FROM like_picture WHERE picture_id = ? AND owner_id = ?');
            $req->execute(array($idImg, $_SESSION['idUser']));
            $res = $req->fetch();
            $req->closeCursor();
            return ($res != false);
        }
    }catch (Exception $e){
        echo '<h1>ERROR</h1>';

    }
}

function countImageLike($idImg, $bdd){
    try{
        $count = 0;
        $req = $bdd->prepare('SELECT * FROM like_picture WHERE picture_id = ?');
        $req->execute(array($idImg));
        while ($res = $req->fetch()){
            $count++;
        }
    }catch (Exception $e){
    }
    return $count;
}

function unlikeImg($idImg, $bdd)
{
    try {
        $idImg = htmlspecialchars($idImg);
        $idUser = false;
        if (isset($_SESSION['idUser'])) {
            if (userExistID($_SESSION['idUser'], $bdd) == false)
                return false;
            $idUser = $_SESSION['idUser'];
        }
        if ($idUser != false) {
            $req = $bdd->prepare('DELETE FROM like_picture WHERE owner_id = ?  AND picture_id = ?');
            $req->execute(array($idUser, $idImg));
            $req->closeCursor();
        }
    } catch (Exception $e) {

    }
}


function addLikeForImg($idImg, $bdd){
    if (canLikeImg($idImg, $bdd) == false)
        return false;
    if (imageAlreadyLiked($idImg, $bdd) == true)
        return false;
    try {
        $idImg = htmlspecialchars($idImg);
        $idUser = false;
        if (isset($_SESSION['idUser'])) {
            if(userExistID($_SESSION['idUser'], $bdd) == false)
                return false;
            $idUser = $_SESSION['idUser'];
        }
        if ($idUser != false) {
            $req = $bdd->prepare('INSERT INTO like_picture (owner_id, picture_id) VALUES(?, ?)');
            $req->execute(array($idUser, $idImg));
            $req->closeCursor();
        }
    }catch (Exception $e){
        echo $e;
    }
}

?>
