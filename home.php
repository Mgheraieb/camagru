<?php
include("header.php");

function displayPicture($link , $owner){
    echo ' 
            <div class="col mb-4">
                <div class="card">
                    <img src="'.$link.'" class="card-img-top" alt="Error loading Image">
                    <div class="card-body">
                        <h5 class="card-title">Dernier commentaire</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et lobortis odio. Donec porttitor turpis id tortor semper sed.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">♥Like</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Comment</button>
                            </div>
                                               <small class="text-muted">de :'.$owner.'</small>
                        </div>
                    </div>
                </div>
            </div>
   ';
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
        displayPicture($result['link'], $ownerName);
    }
    $req->closeCursor();
}

?>

<section class="jumbotron text-center">
    <div class="container">
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            <?PHP
            loadImage($bdd);
            ?>
        </div>

    </div>
</section>
