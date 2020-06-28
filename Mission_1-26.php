<?php
$file_name = "mission_1-24.txt";
if(!file_exists($file_name)){
    echo "ファイルがありません:".$file_name;
}else{
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    foreach($lines as $l){
        echo $l."<br>";
    }
}
?>