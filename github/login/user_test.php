<?php
require("user.php");
#require ("database.php");
$user = new user("hogehoge@test.com","test");
$db = new database("user");
$db->show_all_recode();
echo "new usertest<br>";
if ($user->create_new_user("testuser","testuser@testuser.com","test"))
    echo "create passed<br>";
else
    echo "create failed<br>";
echo "chech new usertest<br>";
$db->show_all_recode();
echo "login usertest<br>";
$user2 = new user("testuser@testuser.com","test");
echo "update info usertest<br>";
if($user2->updateUserInfo("testupdate","testupdate@testuser.com")) {
    echo "update clear";
    $db->show_all_recode();
}else{
    echo "update failed";
}
if($user2->updatePassword("test","test2")){echo "update password<br>";}
new user("testuser@testuser.com","test");
new user("testuser@testuser.com","test2");
if($user2->updatePassword("test2","test")){echo "update password<br>";}
$db->show_all_recode();
echo "activate test<br>";
echo $user2->isActivate();
echo "delete test<br>";
$user2->delete();
$db->show_all_recode();

?>
