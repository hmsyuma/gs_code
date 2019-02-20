<?php
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
if(!isset($_SESSION["chk_ssid"]) || 
$_SESSION["chk_ssid"]!=session_id()){
exit("Error");
}else{
session_regenerate_id(true);
$_SESSION["chk_ssid"]=session_id();
}

//1. DB接続します
try{$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//2．データ登録SQL作成
$sql = "DELETE FROM bm_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//3．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    header("Location: user_select.php");
    exit;
}









?>