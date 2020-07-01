<?php
require("./access_keys.php");

$sql = $pdo -> prepare("INSERT INTO test (name, comment) VALUES (:name, :comment)");
$sql -> bindParam(':name', $name, PDO::PARAM_STR);
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
$name = 'taro3';
$comment = 'I am taro!3'; 
$sql -> execute();
?>