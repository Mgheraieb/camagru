<?php
include_once("header.php");
include_once("Request/utils.php");
redirectUserLog();
$id = userExistID($_SESSION['idUser'], $bdd);
if ($id == false){
    header("LOCATION:./index.php");
}


function printPictureDiv($file, $id){
    echo  '   <div class="container p-3 mb-2 bg-light text-dark">
        <div class="card mb-4 shadow-sm  p-3 mb-2 bg-light text-dark">
            <img src="'.$file.'" class=" rounded mx-auto d-block img-thumbnail" alt="Error loading Image">
            <div class="btn-group">
                <a href="./imgDetail.php?idImg='.$id.'"><button type="button" class="btn text-light bg-dark ">Detail</button></a>
                <a href="./Request/deleteImg.php?idImg='.$id.'"><button type="button" class="btn text-light bg-dark ">Supprimer</button></a>
            </div>
        </div>
    </div>';

}

function getUserPicutre($bdd){
    $id = $_SESSION['idUser'];

    $req = $bdd->query('SELECT link, id FROM picture WHERE owner_id = ' . $id . ' ORDER BY date_post DESC LIMIT 5');
    while ($res = $req->fetch()) {
        printPictureDiv($res['link'], $res['id']);
    }
    $req->closeCursor();
}
?>
<style>
    #test, #test1, #test2{
        position: absolute;

    }
</style>


<div class="d-flex flex-row bd-highlight mb-3">


    <div class="container d-flex align-items-start">
        <div class="d-flex flex-column bd-highlight mb-3">
            <h1 class="h1">Vos 5 dernieres photos</h1>
            <div class="row row-cols-1 row-cols-md-3">
                <div class="col-md-4" >
                    <?php getUserPicutre($bdd);?>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-flex align-item-center align-self-center">
        <div class="d-flex flex-column bd-highlight mb-3">
            <video autoplay="true" class="card-img-top w-100" id="videoElement">
            </video>
            <br/>
            <div class="container">
                <button type="button" id="Scam" value="0" class="btn btn-success btn-group mr-2">Activer la camera</button>
            </div>
        </div>
    </div>


    <div class="container d-flex align-items-end align-self-center">

        <div id="test">
            <img src="assets/mario.png">
        </div>
        <br/>
        <div id="test2">
            <img  src="assets/mickey.png">

        </div>
        <br/>
        <div id="test1">
            <img  src="assets/smiley.png">
        </div>


    </div>
</div>


<script type="text/javascript" src="script/camera.js"></script>

<script>

</script>
