<?php


class page
{
 function __construct($title,$filename,$isArticle=False)
 {
    require ("../bases/header.php");
    require ("../articles/".$filename.".php");
    if ($isArticle){
        echo "<br><br><hr>記事に問題がある場合は nakataatsuya@gmail.com までお知らせください。";
    }
    require ("../bases/footer.php");


 }
}