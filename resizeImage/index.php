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
// image=http://gems.github.com/octocat.png
$image = (!empty($_GET['image'])) ? htmlspecialchars($_GET['image'] , ENT_QUOTES) : 'img/test.jpg';

$imageInfo = $ResizeImage->getImageInfo($image);
//$imageInfo['type'] = 'jpg';
$cpFilePath = "img/copy.{$imageInfo['type']}";
$copyUrl = __DIR__ . "/{$cpFilePath}";
copy($image , $copyUrl);

$ResizeImage->resize($copyUrl , $width , $height , $quality , $type);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Resize Image</title>
		<style type="text/css">
		body {
			font-size: 12px;
			line-height: 16px;
		}
		img {
			box-shadow: 0 0 2px 0 rgba(0,0,0,0.3);
		}
		</style>
	</head>
	
	<body>	
		<h1>Resize Image</h1>
		<p>
			img/ is must be 0777(chmod).<br>
			if this is not working, please make sure img/ permission
		</p>
		<h2>How to use</h2>
		<p>
			add GET paramater like this.<br>
			ex) ?image=http://gems.github.com/octocat.png&w=100&h=100&q=90&t=absolute
		</p>
		<dl>
			<dt>image</dt>
			<dd>URL of image (default is img/test.jpg)</dd>
			<dt>w</dt>
			<dd>width (default is 100)</dd>
			<dt>h</dt>
			<dd>height (default is 100)</dd>
			<dt>q</dt>
			<dd>quality of image (default is 90)</dd>
			<dt>t</dt>
			<dd>absolute let image keep to a width and height in the GET paramater. (default is null)</dd>
		</dl>
		<h2>Copy Image</h2>
		<img src="<?php echo $cpFilePath;?>">
		<hr>
		<h2>Original Image</h2>
		<img src="<?php echo $image;?>"><br>
	</body>
</html>