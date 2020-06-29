<?php //debug用の関数
$debug_mode=False;
if($debug_mode){
    function debug($name,$variable){echo $name.":".$variable."<br>";}
}else{
    function debug($name,$variable){}}?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mission_3-5</title>
</head>

<body>
<form action="https://portal.tech-base.net/storage/userfile/u43767/Mission_3-5.php"
    method="POST">
    <?php 
    
    $edit_num = $_POST["edit_num"];
    $file_name="mission_3-5.txt";
    $password_edit = $_POST["password_edit"];
    debug("edit_num",$edit_num);
    debug("file_name",$file_name);
    debug("pass edit",$password_edit);
    
    $name = "名前";
    $comment = "コメント";
    
    if($edit_num!=0){
        $l = file($file_name,FILE_IGNORE_NEW_LINES)[$edit_num-1];
        $arr = explode("<>",$l);
        
        debug("l",$l);
        foreach($arr as $a){debug("arr each",$a);}
        $password_before = $arr[4];
        
        debug("pass before",$password_before);
        debug("pass edit",$password_edit);
        
        if($password_before==$password_edit){//passwordが正しければ
            $name = $arr[1];
            $comment = $arr[2];
            echo "<input type='hidden' name='edited' value=".$edit_num.">";
        }
    }
    
        debug("name",$name);
        debug("comment",$comment);
        echo "<input type='text' name='name' value=".$name."><br>";
        echo "パスワード:<input type='password' name='password'><br>";
        echo "<input type='text' name='comment' value=".$comment."><br>";
     ?>  
        
        <input type="submit">
        
        <br><br>
    
        削除番号:<input type="text" name="delete_num" value="0"><br>
        パスワード:<input type='password' name='password_delete'><br>
        <input type="submit" value="削除"><br>
        
        <br><br>
    
        編集番号:<input type="text" name="edit_num" value="0"><br>
        パスワード:<input type='password' name='password_edit'><br>
        <input type="submit" value="編集"><br>
</form>

<?php
$name = $_POST["name"];
$comment = $_POST["comment"];
$delete_num = $_POST["delete_num"];
$edited = $_POST["edited"];
$password = $_POST["password"];
$password_delete = $_POST["password_delete"];
$num=1;

debug("password",$password);
debug("name",$name);
debug("comment",$comment);
debug("delete_num",$delete_num);
debug("edited",$edited);
debug("num",$num);

//ファイルの行数=投稿数なのでそれを利用して投稿番号を計算
if(file_exists($file_name)){
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    $num = count($lines)+1;//arrayの長さを返す関数
    foreach($lines as $l){debug("lines each",$l);}
    debug("num",$num);
}
$date = date("Y/m/d H:i:s");
debug("date",$date);
//editされているならば
if($edited!=""){
    if(file_exists($file_name)){
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    $s="";
    for($i=0;$i<$num-1;$i++){
        if($i!=$edited-1){
            $s = $s.$lines[$i]."\n";
        }else{
            foreach(array($edited,$name,$comment."(編集済み)",$date) as $j){
                $s = $s.$j."<>";
            }
            $s = $s.$password;
            $s = $s."\n";
        }
    }
    $f = fopen($file_name,"w");
    fwrite($f,$s);
    fclose($f);
    }
//$delete_num!=0つまり削除対象の行が指定されたならば削除
}else if($delete_num!=0){
    $l = file($file_name,FILE_IGNORE_NEW_LINES)[$delete_num-1];
    $password_before = explode("<>",$l)[4];
    debug("pass before",$password_before);
    debug("pass delete",$password_delete);
    if(file_exists($file_name) & $password_before==$password_delete){
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
//空白またはデフォルト以外ならば投稿を受け付ける
}else if($comment!="" & $comment!="コメント"){
    echo $comment."を受け付けました";
    //情報を追加しやすいようにfor文で回す
    $s = "";
    foreach(array($num,$name,$comment,$date) as $i){
        $s = $s.$i;
        $s = $s."<>";
    }
    $s = $s.$password;
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
        $s = "";
        debug("l",$l);
        $arr = explode("<>",$l);
        for($i=0;$i<count($arr)-1;$i++){
            debug("arr each",$arr[$i]);
            $s=$s.$arr[$i];
            if($i!=count($arr)-2)
             $s = $s."<>";
        }
        if($s!="")
            echo $s."<br>";
    }
}

?>
</body>
</html>