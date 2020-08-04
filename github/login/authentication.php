<?php
require("database.php");
$db = new database("activation");
$seed = $_GET["seed"];
$arr=$db->select(["seed"=>$seed])[0];
$mailaddress = $arr["mailaddress"];
$userdb = new database("user");
$userdb->update(["active"=>1],["mailaddress"=>$mailaddress]);
$db->delete(["seed"=>$seed]) ;
header('Location: ../pages/login.php');
exit;
?>
