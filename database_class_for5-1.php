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
Mission4で作成したプログラムをほぼそのまま移植しています。
なのでMission4の内容を容易に再現できます。
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
        require("./access_keys.php");
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
    public function add($name,$comment,$date,$password){
        $sql = $this->pdo -> prepare(
            "INSERT INTO ".$this->name." (name, comment,date,password) 
            VALUES (:name, :comment,:date,:password)");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql -> bindParam(':date', $date, PDO::PARAM_STR);
        $sql -> bindParam(':password', $password, PDO::PARAM_STR);
        $sql -> execute();
    }
    public function get_row($id){
        if($id>0){
            $sql = 'SELECT * FROM '.$this->name.' WHERE id=:id ';
            $stmt = $this->pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        }else{
            $sql = 'SELECT * FROM '.$this->name;
            $stmt = $this->pdo->prepare($sql);  
        }// ←その差し替えるパラメータの値を指定してから、
        $stmt->execute();                             // ←SQLを実行する。
        $results = $stmt->fetchAll(); 
    	return $results;
    }
    public function update($id,$name,$comment,$date,$password){
        $sql = 'UPDATE '.$this->name
        .' SET name=:name,comment=:comment,password=:password,date=:date '
        .'WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function delete($id){
        $sql = 'delete from '.$this->name.' where id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function print_all(){
        $res = $this->get_row(0);
        //print_r($res);
        print_r($res);
    }
}
?>