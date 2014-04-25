
<?php
$data = file_get_contents("php://input");
$posts = (!empty($data)) ? json_decode($data , true) : null;
echo "--- JSON ---\n";
var_dump($data);
echo "\n--- POST ---\n";
var_dump($posts);