<?php
$width = $_POST['r-width'];
$height = $_POST['r-height'];
$file = $_FILES['file-input'];
$uploaded_image = $file['tmp_name'];
$type = $file['type'];
$ran = rand(0,1244);
if($type == "image/jpeg")
{
    $image_pixel = imagecreatefromjpeg($uploaded_image);
    $o_width = imagesx($image_pixel);
    $o_height = imagesy($image_pixel);
    $canvas = imagecreatetruecolor($width, $height);
     imagecopyresampled($canvas,$image_pixel,0,0,0,0,$width,$height,$o_height,$o_width);
    if(imagejpeg($canvas,"images/".$ran.".jpeg"))
    {
        echo $ran.".jpeg";
    }
    imagedestroy($image_pixel);
}

if($type == "image/png")
{
    $image_pixel = imagecreatefrompng($uploaded_image);
    $o_width = imagesx($image_pixel);
    $o_height = imagesy($image_pixel);
    $canvas = imagecreatetruecolor($width, $height);
     imagecopyresampled($canvas,$image_pixel,0,0,0,0,$width,$height,$o_height,$o_width);
    if(imagepng($canvas,"images/".$ran.".png"))
    {
        echo $ran.".png";
    }
    imagedestroy($image_pixel);
}

if($type == "image/gif")
{
    $image_pixel = imagecreatefromgif($uploaded_image);
    $o_width = imagesx($image_pixel);
    $o_height = imagesy($image_pixel);
    $canvas = imagecreatetruecolor($width, $height);
     imagecopyresampled($canvas,$image_pixel,0,0,0,0,$width,$height,$o_height,$o_width);
    if(imagegif($canvas,"images/".$ran.".gif"))
    {
        echo $ran.".gif";
    }
    imagedestroy($image_pixel);
}


?>