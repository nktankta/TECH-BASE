<?php
$mailaddress = $_POST["mailaddress"];
$name =  $_POST["user"];
$password = $_POST["password"];
require_once ("../login/user.php");
$user = new user();
$isCreate=$user->create_new_user($name,$mailaddress,$password);
if($isCreate){
    require ("../login/mailauth.php");
    activate($mailaddress);
    echo "<h2>ユーザの作成完了</h2>";
    $s= "仮登録が完了しました。<br>メールアドレスに確認用URLを送信しました。<br>メールのURLをクリックすると本登録が完了します。";
}else{
    echo "<h2>ユーザの作成失敗</h2>";
    $s="登録できませんでした。<br>登録済みメールアドレスです。";
}
echo $s;
?>