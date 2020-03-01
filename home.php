<?php
include_once("header.php");
include_once ("Request/imgLC.php");
redirectUserLog();
function displayPicture($idImg, $link , $owner, $bdd){
    $nbLike = countImageLike($idImg, $bdd);
    $like = (imageAlreadyLiked($idImg, $bdd) == true) ? "unlike" : "like";
    echo '
    <div class="col-md-4" name="'.$idImg.'" id ="'.$idImg.'">
        <div class="card mb-4 shadow-sm">
        <form method="POST" action="#'.$idImg.'">
            <img src="'.$link.'" class="card-img-top" alt="Error loading Image">
            <div class="card-body">
                <h5 class="card-title">Dernier commentaire</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et lobortis odio. Donec porttitor turpis id tortor semper sed.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group"> 
                    ';

        if (canLikeImg($idImg, $bdd) == true && getImageOwnerId($owner,$bdd) != $_SESSION['idUser'])
                      echo  '<button type="submit" id="img'.$idImg.'" onclick="likeImage(this)" value="'.$idImg.'"name="'.$like.'" class="btn btn-sm btn-outline-secondary">'.$like.'</button>';

echo '<button type="submit" class="btn btn-sm btn-outline-secondary" name="comment">Comment</button>
                    </div>
                    <div>
                    <small class="text-muted">'.$nbLike.' like</small>
                    <small class="text-muted">de :'.$owner.'</small>
                    </div>
                </div>
            </div>
         </form>
        </div>
    </div>';

}


function getImageOwner($idOwner, $bdd){
    $req = $bdd->prepare('SELECT name FROM user WHERE id = ?');
    $req->execute(array($idOwner));
    $result = $req->fetch();
    $req->closeCursor();
    return $result['name'];
}

function loadImage($bdd){
    $req = $bdd->query('SELECT * FROM picture');
    while ($result = $req->fetch()){
        $ownerName = getImageOwner($result['owner_id'], $bdd);
        displayPicture($result['id'], $result['link'], $ownerName, $bdd);
    }
    $req->closeCursor();
}


?>

<section class="jumbotron text-center">
    <div class="container">
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3">
            <?PHP
            loadImage($bdd);
            ?>
        </div>

    </div>
</section>


