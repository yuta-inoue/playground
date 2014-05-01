<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Asia/Tokyo');

include 'ResizeImage.php';
$ResizeImage = new ResizeImage();

$width = (!empty($_GET['w'])) ? intval($_GET['w']) : null;
$height = (!empty($_GET['h'])) ? intval($_GET['h']) : null;
$quality = (!empty($_GET['q'])) ? intval($_GET['q']) : null;
$type = (!empty($_GET['t'])) ? htmlspecialchars($_GET['t'] , ENT_QUOTES) : null;
$image = (!empty($_GET['image'])) ? htmlspecialchars($_GET['image'] , ENT_QUOTES) : 'img/test.jpg';

$imageInfo = $ResizeImage->getImageInfo($image);

$cpFilePath = "img/copy.{$imageInfo['extension']}";
$copyUrl = __DIR__ . "/{$cpFilePath}";
copy($image , $copyUrl);
$ResizeImage->resize($copyUrl , $width , $height , $quality , $type);
if(file_exists($copyUrl)){
	header("Content-type: {$imageInfo['mime']}");
	readfile($copyUrl);
}