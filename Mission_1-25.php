<?php
$file_name = "mission_1-24.txt";
$str = "wモード書き込みテスト".PHP_EOL;
$f = fopen($file_name,"w");
fwrite($f,$str);
fclose($f);
?>