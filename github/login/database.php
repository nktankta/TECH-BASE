<?php
/*
準備
1.下のコードをまるまるdatabase_class.php(新規作成)にコピペ
またはダウンロードしてアップロードする
2.読み込みたいプログラムの先頭部分に
　require("./database_class.php")を記述する
　例:
　<?php
　  require("./database_class.php")
　  ~
　?>
3.アクセスに必要な情報(Mission4-1で作成したphp)を
"access_keys.php"という名前で別名保存する

使い方
1.$db = new database("テーブル名");と書く(変数名はなんでもいいです)
2.$db->関数(引数)とすることで特定の関数を実行できます。

例:
$db = new database("test");
$db->show_tables();

とするとMission4-3と同等の内容が出力されます

カスタマイズ
関数を追加する方法です。
といってもサンプルとしてMission4の内容があるのでそれほど難しくはないと思います。
1.やりたい動作を関数にする。
イメージ
function func($a,$b){
    nanikasuru($a,$b);
    $pdo->request($**);
    return $nanikakaesu;
}
2.$pdoを$this->pdoに変更する。
3.functionの前にpublic を追加する。
これだけです。もしテーブル名を設定できるようにしたいのであれば
'SELECT * FROM testdb WHERE id=:id '
を
'SELECT * FROM '.$this->name.' WHERE id=:id '
のように書き換えるだけです。
*/
class database{
    private $pdo;
    public $name;
    function __construct($name)
    {
        require("../login/access_keys.php");
        $this->pdo = $pdo;
        $this->name = $name;
    }
    public function show_tables(){
        $sql = "SHOW TABLES";
        $res = $this->pdo->query($sql);
        foreach($res as $l){
            echo $l[0];
        }
    }
    public function get_pdo(){
        return $this->pdo;
    }
    /*
    $array
        key:列名
        value:型
    */
    public function create($arr,$primary_key){
        $sql = "CREATE TABLE IF NOT EXISTS ".$this->name."(";
        $keys=array_keys($arr);
        for($i=0;$i<count($keys);$i++){
            $key=$keys[$i];
            if($key!=$primary_key){
                $sql=$sql.$key." ".$arr[$key];
            }else{
                $sql=$sql.$key." ".$arr[$key]." PRIMARY KEY";
            }
            if($i!=count($keys)-1){
                $sql=$sql.",";
            }
        }
        $sql = $sql.");";
        $this->pdo->query($sql);
        $f = fopen($this->name.".json","w");
        fwrite($f,json_encode($arr));
        fclose($f);
    }
    public function add($arr){
        $keys = array_keys($arr);
        $stmt = $this->pdo -> prepare(
        "INSERT INTO ".$this->name
        ."(".implode(",",$keys).")"
        ." Values (:"
        .implode(", :",$keys).")");
        $this->bind_param($stmt,$arr);
        $stmt -> execute();
    }
    public function create_where($arr){
        $keys = array_keys($arr);
        $where=" WHERE ";
        for($i=0;$i<count($keys);$i++){
            $key=$keys[$i];
            $where=$where.$key."=:".$key;
            if($i!=count($keys)-1){
                $where=$where." AND ";
            }
        }
        return $where;
    }
    public function bind_param($stmt,$arr){
        $keys = array_keys($arr); 
        foreach($keys as $key){
            if(is_int($arr[$key])){
                $stmt->bindParam(':'.$key, $arr[$key], PDO::PARAM_INT);
            }else{
                $stmt->bindParam(':'.$key, $arr[$key], PDO::PARAM_STR);
            }
        } 
    }
    public function select($arr){
        if(count($arr)>0){
            $where = $this->create_where($arr);
            $sql = 'SELECT * FROM '.$this->name.$where;
            $stmt = $this->pdo->prepare($sql);// ←差し替えるパラメータを含めて記述したSQLを準備し、
            $this->bind_param($stmt,$arr);
        }else{
            $sql = 'SELECT * FROM '.$this->name;
            $stmt = $this->pdo->prepare($sql);  
        }// ←その差し替えるパラメータの値を指定してから、
        $stmt->execute();                             // ←SQLを実行する。
        $results = $stmt->fetchAll(); 
    	return $results;
    }
    public function update($arr,$where_arr){
        $keys = array_keys($arr);
        $set=" SET ";
        for($i=0;$i<count($keys);$i++){
            $key=$keys[$i];
            $set=$set.$key."=:".$key;
            if($i!=count($keys)-1){
                $set=$set.",";
            }
        }
        $where = $this->create_where($where_arr);
        $sql = 'UPDATE '.$this->name.$set.$where;
        $stmt = $this->pdo->prepare($sql);// ←差し替えるパラメータを含めて記述したSQLを準備し、
        $this->bind_param($stmt,$arr);
        $this->bind_param($stmt,$where_arr);
        $stmt->execute();
    }
    public function delete($arr){
        $sql = 'delete from '.$this->name.$this->create_where($arr);
        $stmt = $this->pdo->prepare($sql);
        $this->bind_param($stmt,$arr);
        $stmt->execute();
    }
    public function show_all_recode(){
        $res = $this->select([]);
        foreach($res as $l){
            $keys = array_keys($l);
            foreach($keys as $key){
                echo $key.":".$l[$key]."<br>";
            }
            echo "<hr>";
        }
    }
    public function drop(){
        $sql = 'DROP TABLE '.$this->name;
        $this->pdo->query($sql);
    }
    
}
?>