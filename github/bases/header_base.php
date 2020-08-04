<p id="header_img"><img src="../imgs/title.png"></p>
<header>
<link href="../bases/header.css" rel ="stylesheet" type="text/css">
<ul class="list">

    <?php

    foreach ($header_menu as $key => $value){
        echo '<li><a href='.$value.'>'.$key.'</a></li>';
    }
    if (isset($_COOKIE['sessionid'])){
        require_once("../login/username.php");
        echo '<li><a style="width: 100%;">ようこそ'.$username.'さん</a></li>';
    }
    ?>
</ul>
</header>
