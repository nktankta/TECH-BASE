<?php
require("./access_keys.php");
$sql = "CREATE TABLE IF NOT EXISTS testdb("//テーブルがなければ作ってね
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"//32文字のname
	. "comment TEXT);";
	$stmt = $pdo->query($sql);

?>