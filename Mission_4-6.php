<?php
require("./access_keys.php");
$id = 6;

$sql = 'SELECT * FROM test';
$stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
$stmt->execute();                             // ←SQLを実行する。
$results = $stmt->fetchAll(); 
    echo $results;
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
?>