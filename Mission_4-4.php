<?php
require("./access_keys.php");
$sql = "SHOW CREATE TABLE test;";
$res = $pdo->query($sql);
foreach($res as $l){
    echo $l[1];
}
?>