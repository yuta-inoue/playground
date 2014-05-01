<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Asia/Tokyo');
$len = (!empty($_GET['len'])) ? intval($_GET['len']) : null;
$len2 = (!empty($_GET['len2'])) ? intval($_GET['len2']) : null;
$type = (!empty($_GET['t'])) ? htmlspecialchars($_GET['t'] , ENT_QUOTES) : null;
include 'MkRandomCode.php';
$MkRandomCode = new MkRandomCode($type);
echo $MkRandomCode->get($len , $len2);