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

</style>
<div class="container">


</div>

<div class="container align-middle">
    <video autoplay="true" class="card-img-top w-50 p-3" id="videoElement">
    </video>
    <br/>
    <div id="container">
        <button type="button" id="Scam" value="0" class="btn btn-success btn-group mr-2">Activer la camera</button>
    </div>
</div>


<div class="container">
    <h1 class="h1 text-center">Vos 5 dernieres photos</h1>
    <div class="row row-cols-1 row-cols-md-3">
        <div class="col-md-4" >
            <?php getUserPicutre($bdd);?>
        </div>
    </div>
</div>



</div>


<script type="text/javascript" src="script/camera.js"></script>

<script>

</script>
