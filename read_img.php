<?php

$file = "img/42.png";
$type = "image/png";
header("Content-Type:".$type);
header("Content-Length:".filesize($file));
$img = file_get_contents($file);
echo($img);

?>
