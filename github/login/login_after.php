<?php
$mailaddress = $_POST["mailaddress"];
$password = $_POST["password"];
require_once("../login/user.php");
$user = new user($mailaddress,$password);
if($user->isActivate()){
    $rnd = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 30);
    $db = new database("session");
    $userid = $user->getUserID();
    $db->add(["id"=>$rnd,"username"=>$user->getUsername(),"userid"=>$userid,"time"=>time()]);
    setcookie("sessionid",$rnd,time()+3600,"/");
    print_r($_COOKIE);
    header('Location: ../pages/toppage.php');
    exit;
}else{
    header('Location: ../pages/login.php?error=error');
    exit;
}
?>
