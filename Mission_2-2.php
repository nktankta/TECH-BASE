<body>
<form action="https://portal.tech-base.net/storage/userfile/u43767/Mission_2-2.php"
    method="POST">
        <input type="text" name="comment" value="コメント">
        <input type="submit">
</form>
<?php
$file_name="mission_2-2.txt";
$comment = $_POST["comment"];
if($comment!=""){
    echo $comment."を受け付けました";
    $s = $comment."\n";
    $f = fopen($file_name,"a");
    fwrite($f,$s);
    fclose($f);
}
echo "<br>";
echo "<br>";
echo "コメント";
echo "<br>";
echo "<br>";
if(file_exists($file_name)){
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    foreach($lines as $l){
        echo $l;
        echo "<br>";
    }
}
if($comment=="debug"){
    echo $file_name;
    echo $s;
}
?>
</body>