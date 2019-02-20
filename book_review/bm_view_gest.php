<?php
session_start();
//isset関数は、変数に値がセットされていて、かつNULLでないときに、TRUE(真)を戻り値として返す。
//https://techacademy.jp/magazine/11410

//関数化呼び出し

//1.GETでidを取得
$id = $_GET["id"];

//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError'.$e->getMessage());
  }

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //1データのみの抽出の場合はwhileループでは取り出さない。  
  $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>読書データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_select.php">ゲストデータ一覧</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="bm_insert_view.php">読書レビュー　登録</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="bm_login.php">ログイン</a></div>
      
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>本のブックマーク　フォーム</legend>
     <label>書籍名<input type="text" name="book_name" value="<?=$row["book_name"]?>"></label><br>
     <label>URL：<input type="text" name="url" value="<?=$row["url"]?>"></label><br>
     <!-- <label>感想<textArea name="coment" rows="4" cols="40"><?=$row["coment"]?></textArea></label><br> -->
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>