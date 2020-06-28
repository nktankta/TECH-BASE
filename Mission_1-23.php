<?php
$stuff=array("Ken","Alice","Judy","BOSS","Bob");
foreach($stuff as $stf){
    if($stf=="BOSS"){
        echo "Good moring ".$stf."!";
    }else{
        echo "Hi! ".$stf;
    }
    echo "<br>";
}
?>