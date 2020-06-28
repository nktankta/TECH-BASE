<?php
$file_name = "mission_1-24.txt";
$str = "こんにちは".PHP_EOL;
$f = fopen($file_name,"a");
fwrite($f,$str);
fclose($f);
?>