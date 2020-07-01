<?php
require("./access_keys.php");
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = "SHOW TABLES";
$res = $pdo->query($sql);
foreach($res as $l){
    echo $l[0];
}
?>