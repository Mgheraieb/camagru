<?php
$in = imagecreatefromjpeg('https://picsum.photos/id/1084/536/354?grayscale');
$reflection_strength = 120;        //    starting transparency (0-127, 0 being opaque)
$reflection_height = 40;        //     height of reflection in pixels
$gap = 0;                        //    gap between image and reflection

$orig_height = imagesy($in);                                //    store height of original image
$orig_width = imagesx($in);                                    //    store height of original image
$output_height = $orig_height + $reflection_height + $gap;    //    calculate height of output image

// create new image to use for output. fill with BLACK.
$out = imagecreatetruecolor($orig_width, $output_height);
//imagealphablending($out, false);
//$bg = imagecolortransparent($out, imagecolorallocatealpha($out, 255, 255, 255, 127));
$bg = imagecolorallocatealpha($out, 0,0,0,0);
imagefill($out, 0, 0, $bg);
imagefilledrectangle($out, 0, 0, imagesx($in), imagesy($in), $bg);

// copy original image onto new one, leaving space underneath for reflection and 'gap'
imagecopyresampled ( $out , $in , 0, 0, 0, 0, imagesx($in), imagesy($in), imagesx($in), imagesy($in));

// create new single-line image to act as buffer while applying transparency
$reflection_section = imagecreatetruecolor(imagesx($in), 1);
imagealphablending($reflection_section, false);
$bg1 = imagecolortransparent($reflection_section, imagecolorallocatealpha($reflection_section, 255, 255, 255, 127));
imagefill($reflection_section, 0, 0, $bg1);

// 1. copy each line individually, starting at the 'bottom' of the image, working upwards.
// 2. set transparency to vary between reflection_strength and 127
// 3. copy line back to mirrored position in original
for ($y = 0; $y<$reflection_height;$y++)
{
    $t = ((127-$reflection_strength) + ($reflection_strength*($y/$reflection_height)));
    imagecopy($reflection_section, $out, 0, 0, 0, imagesy($in)  - $y, imagesx($in), 1);
    imagefilter($reflection_section, IMG_FILTER_COLORIZE, 0, 0, 0, $t);
    imagecopyresized($out, $reflection_section, 0, imagesy($in) + $y + $gap, 0, 0, imagesx($in) - 0, 1, imagesx($in), 1);
}

// output image to view
header('Content-type: image/png');
imagesavealpha($out,true);
imagepng($out);
?>
