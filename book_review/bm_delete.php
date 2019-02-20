<?php
$id = $_GET["id"];


try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError'.$e->getMessage());
  };


//データ取得SQL
$sql = 'DELETE FROM gs_bm_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 
$status = $stmt->execute();


//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: bm_select.php");
    exit;
    // 必ず半角スペース
}



?>