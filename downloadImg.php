
<?php
if (!isset($_POST['img']))
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
imagepng($destination, $file);
    echo "<script>window.close();</script>";
?>
