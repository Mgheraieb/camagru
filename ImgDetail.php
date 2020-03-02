<?php
include_once("header.php");
include_once("Request/utils.php");
include_once ("Request/imgLC.php");

if (!isset($_GET['idImg']) || empty($_GET['idImg'])){
    if(imageExistID($_GET['idImg'], $bdd) == false){
        header('LOCATION:./index.php');
    }
}

function getImageById($idImg, $bdd){
    $req = $bdd->prepare('SELECT link FROM picture WHERE id = ? ');
    $req->execute(array($idImg));
    $result = $req->fetch();
    echo '<img src="'.$result['link'].'" class="rounded mx-auto d-block" alt="...">';
    $req->closeCursor();
}

function getNameWithId($id, $bdd){
    $verif = userExistID($id, $bdd);
    if ($verif == false){
        return  "Erreur Utilisateur inexistant";
    }
    $req = $bdd->prepare('SELECT name from user WHERE id = ?');
    $req->execute(array($id));
    $result = $req->fetch();
    $req->closeCursor();
    return $result['name'];

}

function getCommFromPic($idImg, $bdd){
    $req = $bdd->prepare('SELECT * FROM commentaire WHERE picture_id = ? ');
    $req->execute(array($idImg));
    while ($result = $req->fetch()) {
        echo '<h5>'.getNameWithId($result['owner_id'], $bdd).' a dit : </h5>';
        echo '<li class="m8 alert alert-secondary"  >'.$result['content'].'</li >';
    }
    $req->closeCursor();

}
?>

<div class="container">

    <?php if (isset($_GET['s']) && $_GET['s'] == "1") {
        echo  '       <div class="alert alert-success" role="alert">
            Votre commentaire a été posté
        </div>';
    } ?>
    <?php getImageById($_GET['idImg'], $bdd);?>
    <div class="d-flex justify-content-center">
<?php
    echo '<button type="submit" class="btn btn-sm btn-outline-secondary" name="comment">Comment</button>';

?>
    </div>

    <div class="container">

        <ul class="list-group list-group-flush">
            <?php getCommFromPic($_GET['idImg'], $bdd); ?>
        </ul>
    </div>
    <?php echo '<form method="POST" action="Request/sendCom.php?idImg='.$_GET['idImg'].'">';?>
        <label for="validationTextarea">Commentaire</label>
        <textarea class="form-control" name="commentaire" id="validationTextarea" placeholder="Entrez votre commentaire ici" required></textarea>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>
