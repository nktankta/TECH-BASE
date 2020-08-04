<?php
$cookie = $_COOKIE["sessionid"];
require_once ("database.php");
$db = new database("session");
$res = $db -> select(["id"=>$cookie]);
if(count($res)>0){
    $username = $res[0]["username"];
}else{
    $username = "";
}
?>