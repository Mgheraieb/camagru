
<?php
include_once("header.php");
include_once ("Request/utils.php");
if (!isset($_POST['img']) || !isset($_SESSION['idUser']))
    echo "<script>window.close();</script>";
$pic = $_POST['img'];
print_r(var_dump($_FILES));

if (exif_imagetype($_POST['img']) != IMAGETYPE_PNG)
    echo "<script>window.close();</script>";

$file = "./Upload/img/";
if (!file_exists($file)) {
    mkdir($file, 0777, true);
    echo "here";
}

$file = $file . uniqid() . '.png';
$destination = imagecreatefrompng($pic);

if (imagepng($destination, $file) == false){
    echo "<script>window.close();</script>";
}else{
    $link = $file;
    addPicture($link, $bdd);
}


function addPicture($filename, $bdd){
    $id = (userExistID($_SESSION['idUser'], $bdd));
    if ($id == false){
        return false;
    }$id =$_SESSION['idUser'];
    try{
        $req = $bdd->prepare('INSERT INTO picture(owner_id, link) VALUES(?,?)');
        $req->execute(array($id,$filename));
    }catch (Exception $e){

    }
}

echo "<script>window.close();</script>";


?>
