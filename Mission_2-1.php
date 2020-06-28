<body>
<form action="https://portal.tech-base.net/storage/userfile/u43767/Mission_2-1.php"
    method="POST">
        <input type="text" name="comment" value="コメント">
        <input type="submit">
</form>
<?php
$file_name="mission_1-27.txt";
$comment = $_POST["comment"];
if($comment!="")
    echo $comment."を受け付けました";
?>
</body>