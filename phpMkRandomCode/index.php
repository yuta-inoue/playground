<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Asia/Tokyo');
$len = (!empty($_GET['len'])) ? intval($_GET['len']) : null;
$len2 = (!empty($_GET['len2'])) ? intval($_GET['len2']) : null;
$type = (!empty($_GET['t'])) ? htmlspecialchars($_GET['t'] , ENT_QUOTES) : null;
include 'MkRandomCode.php';
$MkRandomCode = new MkRandomCode($type);
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
		<h2>Get</h2>
		<a href="get.php?len=10&len2=30&t=all" target="_blank">get.php &gt;&gt;</a>
		<h2>How to use</h2>
		<p>
			add GET paramater like this.<br>
			ex) ?len=10&len2=30&t=all
		</p>
		<h2>Parameter</h2>
		<dl>
			<dt>len &amp; len2</dt>
			<dd>integer</dd>
			<dt>t</dt>
			<dd>
				<?php foreach ($MkRandomCode->getRandomTypeList() as $key => $val) {?>
					<ul>
						<li><strong><?php echo $key; ?></strong> (<?php echo $val;?>)</li>
					</ul>
				<?php }?>
			</dd>
		</dl>
		<h2>Result</h2>
		<?php var_dump($MkRandomCode->getResult($len , $len2));?><br>
		<?php echo $MkRandomCode->get($len , $len2);?><br>
		<?php var_dump($MkRandomCode->getResult($len , $len2));?>
	</body>
</html>