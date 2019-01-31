<?php
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError'.$e->getMessage());
  }

//データ取得SQL
$sql = "SELECT * FROM gs_user_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//3.データの表示
$view=""; //グローバルの定義

if($status==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" .$eror[2]);
}else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<a href="us_up_view.php?id='.$result["id"].'">';
    $view .= "id:".$result["lid"]." 氏名:".$result["name"];
    $view .= '</a>';
    $view .= '　';
    $view .= '<a href="us_delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '</p>';  
    }

}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>顧客一覧</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="us_select.php">ユーザ一覧</a></div>
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