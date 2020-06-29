<?php //使い方:debug("表示名",$変数名) -> 表示名:変数の内容
$debug_mode=True;
if($debug_mode){
    function debug($name,$variable){echo $name.":".$variable;}
}else{
    function debug($name,$variable){}}?>


<!-- 
使い方

1. 1~6行目(＜?php ~ ?＞)をコピー
2. 追加したいプログラムのファイルの1行目に追加(先頭)
3. 表示したい部分にdebug("表示名",$変数名)を追加
4. 表示したいときはdebug=Trueに、非表示の時はdebug=Falseに

カスタマイズしたい場合はecho文が書いてあるところを変更することで
表記を変えることができます。
!-->

<?php
$test = "test";
debug("test",$test);
?>