<?php
$width = $_POST['width'];
$height = $_POST['height'];
$r = $_POST['red'];
$g = $_POST['green'];
$b = $_POST['blue'];
$format = $_POST['format'];
$raw_image = imagecreate($width,$height);
imagecolorallocate($raw_image,$r,$g,$b);
$ran = rand(1,3000);
echo $ran;
if($format == "jpeg")
{
    if(imagejpeg($raw_image,"images/".$ran.".jpeg"))
    {
        echo $ran.".jpeg";
    }
    imagedestroy($raw_image);
}
if($format == "png")
{
    if(imagepng($raw_image,"image/".$ran.".png"))
    {
        echo $ran.".png"; 
    }
    imagedestroy($raw_image);
}
if($format == "gif")
{
    if(imagegif($raw_image,"image/".$ran.".gif"))
    {
        echo $ran.".gif";
    }
    imagedestroy($raw_image);
}

?>