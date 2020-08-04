<link href="../bases/footer.css" rel ="stylesheet" type="text/css">
<footer>
    <ul class="list">

        <?php
        foreach ($footer as $key => $value){
            echo '<li><a href='.$value.'>'.$key.'</a></li>';
        }
        ?>
    </ul>
</footer>
