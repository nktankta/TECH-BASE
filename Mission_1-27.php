<body>
<form action="https://***/Mission_1-27.php" method="POST">
        <input type="text" name="num">
        <input type="submit">
</form>
<?php
$file_name="mission_1-27.txt";
$num = $_POST["num"];
if(!$num==""){
    if($num%15==0){
        $s = "FizzBuzz";
    }else if($num%5==0){
        $s = "Buzz";
    }else if($num%3==0){
        $s = "Fizz";
    }else{
        $s = $num;
    }
    $s = $s."¥n";
    $f = fopen($file_name,"a");
    fwrite($f,$s);
    fclose($f);
}
if(!file_exists($file_name)){
    echo "ファイルがありません:".$file_name;
}else{
    $lines = file($file_name,FILE_IGNORE_NEW_LINES);
    foreach($lines as $l){
        echo $l;
        echo "<br>";
    }
}
?>
</body>
