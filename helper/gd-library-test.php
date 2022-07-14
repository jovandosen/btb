<?php

$x = 480;
$y = 320;

$degrees = 180;

$image = imagecreate($x, $y);

$whiteBackground = imagecolorallocate($image, 255, 255, 255);

header('Content-Type: image/jpeg');

imagejpeg($image);

imagedestroy($image);