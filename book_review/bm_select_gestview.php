<?php

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$sql = "SELECT * FROM gs_bm_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  //配列と配列で文字列を作成。
  //view=""に入っていく　.=は上書きの意味
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    // $view .= "<p>".$result["date"]."-".$result["book_name"]."-".$result["url"]."</p>";
    $view .= '<p>';
    $view .= '<a href="bm_view_gest.php?id='.$result["id"].'">';
    $view .= $result["book_name"]."【内容】:".$result["coment"];
    $view .= '</a>';
    $view .= '</p>';  
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>bookreview</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <div class="navbar-header"><a class="navbar-brand" href="bm_insert_view.php">ユーザ登録</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="bm_login.php">ログイン</a></div>
      
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
