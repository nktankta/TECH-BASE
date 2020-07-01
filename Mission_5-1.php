<?php //debug用の関数
$debug_mode=false;
require("debug_template.php");
require("database_class_for5-1.php");
$db = new database("keijiban");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mission_5-1</title>
</head>

<body>
<form action="https://portal.tech-base.net/storage/userfile/u43767/Mission_5-1.php"
    method="POST">
    <?php 
    
    $edit_num = $_POST["edit_num"];
    $password_edit = $_POST["password_edit"];
    debug("edit_num",$edit_num);
    debug("pass edit",$password_edit);
    
    $name = "名前";
    $comment = "コメント";
    
    if($edit_num!=0){
        $res = $db->get_row($edit_num);
        $password_before = $res[0]["password"];
        debug("pass before",$password_before);
        debug("pass edit",$password_edit);
        
        if($password_before==$password_edit){//passwordが正しければ
            $name = $res[0]["name"];
            $comment = $res[0]["comment"];
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

$date = date("Y-m-d H:i:s");
debug("date",$date);
//editされているならば
if($edited!=""){
    $db->update($edited,$name,$comment."(編集済み)",$date,$password);
//$delete_num!=0つまり削除対象の行が指定されたならば削除
}else if($delete_num!=0){
    $res = $db->get_row($delete_num);
    $password_before = $res[0]["password"];
    debug("pass before",$password_before);
    debug("pass delete",$password_delete);
    if($password_before==$password_delete){
        $db->delete($delete_num);
    }
//空白またはデフォルト以外ならば投稿を受け付ける
}else if($comment!="" & $comment!="コメント"){
    $db->add($name,$comment,$date,$password);
    echo $comment."を受け付けました";
}


echo "<br>";
echo "&lt;コメント&gt;";
echo "<br>";
//コメントの呼び出し
foreach($db->get_row(0) as $l){
    $s = "";
    $s = $s . $l["id"] ."<>";
    $s = $s . $l["name"]."<>";
    $s = $s . $l["comment"]."<>";
    $s = $s . $l["date"]."<br>";
    echo $s;
}

?>
</body>
</html>