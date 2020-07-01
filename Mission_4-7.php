<?php
require("./access_keys.php");
$id = 1;

$sql = 'SELECT * FROM test WHERE id=:id ';
$stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
$stmt->execute();                             // ←SQLを実行する。
$results = $stmt->fetchAll(); 
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
	
$name = "tarou dash";
$comment = "watashi ha tarou dash da!"; //変更したい名前、変更したいコメントは自分で決めること
$sql = 'UPDATE test SET name=:name,comment=:comment WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();


	//続けて、4-6の SELECTで表示させる機能 も記述し、表示もさせる。
	//※ データベース接続は上記で行っている状態なので、その部分は不要
	
	
	
$sql = 'SELECT * FROM test WHERE id=:id ';
$stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
$stmt->execute();                             // ←SQLを実行する。
$results = $stmt->fetchAll(); 
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
?>