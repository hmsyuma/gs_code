<?php
// 受け取って更新するのみのものになります。
//1.POSTでParamを取得
$id          = $_POST["id"];
$name        = $_POST["name"];
$lid         = $_POST["lid"];
$lpw         = $_POST["lpw"];

//サーバー接続
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError'.$e->getMessage());
  }

//３．データ登録SQL作成
$sql = "UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw WHERE id=:id;";
$stmt = $pdo->prepare($sql);


$stmt->bindValue(':name', $name,  PDO::PARAM_STR); 
$stmt->bindValue(':lid',  $lid,   PDO::PARAM_STR); 
$stmt->bindValue(':lpw',  $lpw,   PDO::PARAM_STR);
$stmt->bindValue(':id',   $id,    PDO::PARAM_INT); 
$status = $stmt->execute();


//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: us_select.php");
    exit;
    // 必ず半角スペース
}

//2.DB接続など
//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。




?>