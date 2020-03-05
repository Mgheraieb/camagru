
<?php
include_once("header.php");
include_once ("Request/utils.php");
if (!isset($_POST['img']) || !isset($_SESSION['idUser']))
    echo "";
  ///  echo "<script>window.close();</script>";
$pic = $_POST['img'];

if (exif_imagetype($_POST['img']) != IMAGETYPE_PNG)
    echo"";
//    echo "<script>window.close();</script>";

$file = "./Upload/img/";
if (!file_exists($file)) {
    mkdir($file, 0777, true);
    echo "here";
}

$file = $file . uniqid() . '.png';
$destination = imagecreatefrompng($pic);


$f1 = "assets/mario.png";
$f2 = "assets/mickey.png";
$f3 = "assets/smiley.png";

$f1Pic = imagecreatefrompng($f1);
$f2Pic = imagecreatefrompng($f2);
$f3Pic = imagecreatefrompng($f3);


if (!isset($_GET['x1']) || !isset($_GET['x2']) ||!isset($_GET['x3']) ||
   !isset($_GET['y1']) || !isset($_GET['y2']) ||  !isset($_GET['y2'])){
   echo "error";
}


$x1 = (int)$_GET['x1'];
$x2 = (int)$_GET['x2'];
$x3 = (int)$_GET['x3'];

$y1 = (int)$_GET['y1'];
$y2 = (int)$_GET['y2'];
$y3 = (int)$_GET['y3'];

echo $x1;
echo $x2;


if ($x1 != -1 && $y1 -1) {
    addImageToDest($destination, $f1Pic, $x1, $y1);
}

if ($x2 != -1 && $y2 -1)
    addImageToDest($destination, $f2Pic, $x2, $y1);

if ($x3 != -1 && $y3 -1)
    addImageToDest($destination, $f3Pic, $x3, $y3);


function addImageToDest($dest, $src, $srcX, $srcY)
{
    echo "hERE";
 $res =     imagecopymerge($dest, $src, 0, 0, $srcX, $srcY, 180, 180, 100);
}


if (imagepng($destination, $file) == false){
    echo "SORR";
//    echo "<script>window.close();</script>";
}else {
    echo "good";
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

//echo "<script>window.close();</script>";


?>
