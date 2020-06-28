<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mission_3-4</title>
</head>

<body>
<form action="https://portal.tech-base.net/storage/userfile/u43767/Mission_3-4.php"
    method="POST">
    <?php 
    $edit_num = $_POST["edit_num"];
    $file_name="mission_3-4.txt";

    if($edit_num==0){
        $name = "名前";
        $comment = "コメント";
    }else{
        $l = file($file_name,FILE_IGNORE_NEW_LINES)[$edit_num-1];
        $arr = explode("<>",$l);
        $name = $arr[1];
        $comment = $arr[2];
        echo "<input type='hidden' name='edited' value=".$edit_num.">";
    }
        echo "<input type='text' name='name' value=".$name."><br>";
        echo "<input type='text' name='comment' value=".$comment."><br>";
     ?>  
        
        <input type="submit">
        
        <br><br>
    
        削除番号:<input type="text" name="delete_num" value="0"><br>
        <input type="submit" value="削除"><br>
        
        <br><br>
    
        編集番号:<input type="text" name="edit_num" value="0"><br>
        <input type="submit" value="編集"><br>
</form>
<?php
$file_name="mission_3-4.txt";

$name = $_POST["name"];
$comment = $_POST["comment"];
$delete_num = $_POST["delete_num"];
$edited = $_POST["edited"];
$num=1;

//ファイルの行数=投稿数なのでそれを利用して投稿番号を計算
if(file_exists($file_name)){
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    $num = count($lines)+1;//arrayの長さを返す関数
}
$date = date("Y/m/d H:i:s");

//editされているならば
if($edited!=""){
    if(file_exists($file_name)){
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    $s="";
    for($i=0;$i<$num-1;$i++){
        if($i!=$edited-1){
            $s = $s.$lines[$i]."\n";
        }else{
            foreach(array($edited,$name,$comment,$date) as $j){
                $s = $s.$j;
                if($j != $date){//$dateだけfor文の外に出してもOK
                    $s = $s."<>";
                }
            }
            $s = $s."(編集済み)\n";
        }
    }
    $f = fopen($file_name,"w");
    fwrite($f,$s);
    fclose($f);
    }
//$delete_num!=0つまり削除対象の行が指定されたならば削除
}else if($delete_num!=0){
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