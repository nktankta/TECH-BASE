<?php
require ("../bases/base_start.php");
$header_menu =
    [
        "トップへ"=>"../pages/toppage.php",
        "CNN" => "../pages/CNN.php",
        "GAN"=>"../pages/GAN.php",
        "DML"=>"../pages/DML.php"
    ];
if (!isset($_COOKIE['sessionid'])){
    $header_menu["ログイン"]="../pages/login.php";
    $header_menu["新規作成"]="../pages/create.php";
}
require_once ("../bases/header_base.php");

?>
