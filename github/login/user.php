<?php

require_once("../login/database.php");
class user
{

    private $userdb;
    private $id=0;
    private $name="";
    private $mailaddress="";
    private $password="";
    private $active=0;
    private $debug = false;
    public function __construct($mailaddress="",$password="")
    {
        $this->debug($mailaddress,$password);
        $this->userdb=new database("user");
        if($mailaddress!=""){
            $this -> login($mailaddress,$password);
        }
        $this ->debug();
    }
    public function isActivate(){
        if($this->active==1)
            return true;
        else
            return false;
    }

    public function  login($mailaddress,$password){
        $res = $this ->userdb->select(["mailaddress"=>$mailaddress]);
        if(count($res)==1){
            $arr = $res[0];
            if(password_verify($password,$arr["password"])) {
                $this->debug("clear login");
                $this->id=$arr["id"];
                $this->name = $arr["name"];
                $this->mailaddress = $arr["mailaddress"];
                $this->password = $arr["password"];
                $this->active = $arr["active"];
            }
        }
    }

    public function toArray($keys){
        $arr=[
            "id"=>$this->id,
            "name"=>$this->name,
            "mailaddress"=>$this->mailaddress,
            "password"=>$this->password,
            "active"=>$this->active
        ];
        $ret = [];
        foreach ($keys as $key){
            $ret[$key]=$arr[$key];
        }

        return $ret;
    }

    public function getUserID(){
        return $this->id;
    }
    public function getUsername(){
        return $this->name;
    }
    function updateUserInfo($name,$mailaddress){
        if($mailaddress!=$this->mailaddress & $this->_isAlreadyUse($mailaddress)) {
            return false;
        }
        $this->debug("update before");
        $this -> userdb ->update(
            ["name"=>$name,"mailaddress"=>$mailaddress],["id"=>$this->id]);
        $this->debug("update after");
        $this->name=$name;
        $this->mailaddress=$mailaddress;
        return true;
    }
    function updatePassword($currentPassword,$newPassword){
        if(password_verify($currentPassword,$this->password)){
            $passhash=password_hash($newPassword,PASSWORD_DEFAULT);
            $this -> userdb ->update(
                ["password"=>$passhash],["id"=>$this->id]);
            $this->password=$passhash;
            return true;
        }else
            return false;
    }
    function debug(...$arr){
        if($this->debug){
            if(count($arr)==0){
                print_r($this->toArray(["id","name","mailaddress","password","active"]));
            }else{
                print_r($arr);
            }
        }
        echo "<br>";
    }
    function _isAlreadyUse($mailaddress){
        if(count($this->userdb->select(["mailaddress"=>$mailaddress]))>0)
            return true;
        else
            return false;
    }
    function create_new_user($name,$mailaddress,$password){
       if($this->_isAlreadyUse($mailaddress)) {
           return false;
       }
        $arr=[
            "name"=>$name,
            "mailaddress"=>$mailaddress,
            "password"=>password_hash($password,PASSWORD_DEFAULT),
            "active"=>0
        ];
        $this -> userdb ->add($arr);
        return true;
    }
    public function delete(){
        $this->userdb->delete(["id"=>$this->id]);
    }


}

?>