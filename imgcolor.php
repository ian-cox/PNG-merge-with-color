<?php
$imagepath = "images/logo.png";
$imagewidth = 402;
$imageheight = 29;

// RGB Background Color
$r = 30;
$g = 90;
$b = 222;

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
    $cut = imagecreatetruecolor($src_w, $src_h);
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
}

// $im = imagecreatefrompng('images/background.png'); //150 x 150
$im = imagecreatetruecolor($imagewidth, $imageheight);
// sets background to color
$color = imagecolorallocate($im, $r, $g, $b);
		 imagefill($im, 0, 0, $color);
$image = imagecreatefrompng($imagepath); //300 x 300

$merged_image = imagecreatetruecolor($imagewidth, $imageheight);
imagealphablending($merged_image, false);
imagesavealpha($merged_image, true);

imagecopy($merged_image, $im, 0, 0, 0, 0, $imagewidth, $imageheight);
imagecopymerge_alpha($merged_image, $image, 0, 0, 0, 0, $imagewidth, $imageheight, 100);

header('Content-Type: image/png');
imagepng($merged_image);
?>