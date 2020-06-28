<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mission_3-3</title>
</head>

<body>
<form action="https://portal.tech-base.net/storage/userfile/u43767/Mission_3-3.php"
    method="POST">
        <input type="text" name="name" value="名前"><br>
        <input type="text" name="comment" value="コメント"><br>
        <input type="submit">
        
        <br><br>
    
        <input type="text" name="delete_num" value="0"><br>
        <input type="submit" value="削除"><br>
</form>
<?php
$file_name="mission_3-3.txt";

$name = $_POST["name"];
$comment = $_POST["comment"];
$delete_num = $_POST["delete_num"];
$num=1;

//ファイルの行数=投稿数なのでそれを利用して投稿番号を計算
if(file_exists($file_name)){
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    $num = count($lines)+1;//arrayの長さを返す関数
}
$date = date("Y/m/d H:i:s");

//$delete_num!=0つまり削除対象の行が指定されたならば削除
if($delete_num!=0){
    if(file_exists($file_name)){
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    $s="";
    for($i=0;$i<$num-1;$i++){
        if($i!=$delete_num-1){
            $s = $s.$lines[$i]."\n";
        }else{
            $s = $s."削除されました"."\n";
        }
    }
    $f = fopen($file_name,"w");
    fwrite($f,$s);
    fclose($f);
    }
//debugならば各種情報を表示する
}else if($comment=="debug"){
    echo "file name:".$file_name."<br>";
    echo "name:".$name."<br>";
    echo "comment:".$comment."<br>";
    echo "num:".$num."<br>";
    echo "date:".$date."<br>";
//空白やそのまま送信した場合以外を保存
}else if($comment!="" & $comment!="コメント"){
    echo $comment."を受け付けました";
    //情報を追加しやすいようにfor文で回す
    $s = "";
    foreach(array($num,$name,$comment,$date) as $i){
        $s = $s.$i;
        if($i != $date){//$dateだけfor文の外に出してもOK
            $s = $s."<>";
        }
    }
    $s = $s."\n";
    $f = fopen($file_name,"a");
    fwrite($f,$s);
    fclose($f);
}


echo "<br>";
echo "&lt;コメント&gt;";
echo "<br>";
//コメントの呼び出し
if(file_exists($file_name)){
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    foreach($lines as $l){
        echo $l;
        echo "<br>";
    }
}

?>
</body>
</html>