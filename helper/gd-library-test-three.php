<?php

// Set the content-type
header('Content-Type: image/png');

// Create the image
$im = imagecreatetruecolor(400, 400);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);

imagefilledrectangle($im, 0, 0, 400, 400, $white);

$textOne = 'Learn stuff';
$textOneFont = '../assets/fonts/from-cartoon-blocks/From-Cartoon-Blocks.ttf';

$textTwo = 'Well and Good';
$textTwoFont = '../assets/fonts/la-tequila/La-Tequila.ttf';

// Add the text
imagettftext($im, 50, 0, 5, 250, $grey, $textOneFont, $textOne);

// Add the text
imagettftext($im, 20, 0, 5, 350, $black, $textTwoFont, $textTwo);

// display image
imagepng($im);
// destroy image to free memory
imagedestroy($im);

?>