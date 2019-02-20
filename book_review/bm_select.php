<?php
session_start();
//isset関数は、変数に値がセットされていて、かつNULLでないときに、TRUE(真)を戻り値として返す。
//https://techacademy.jp/magazine/11410

//関数化呼び出し

  if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
    header("Location: bm_select_gestview.php");
    exit;
  }else{
      session_regenerate_id(true);
      //新しいIDを付与して格納
      $_SESSION["chk_ssid"] = session_id();
      //echo  $_SESSION["chk_ssid"];
      //ログインできれはelse実行
  } ;


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
    $view .= '<img width="100" src="'.$result["filename"].'">';
    
    $view .= '<a href="bm_u_view.php?id='.$result["id"].'">';
    $view .= $result["date"].":".$result["book_name"];
    $view .= '</a>';
    $view .= '　';
    $view .= '<a href="bm_delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
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
<?php echo $_SESSION["name"]; ?>さん　
    <?php include("menu.php"); ?>
  <!-- <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_insert_view.php">利用者登録</a>
      <a class="navbar-brand" href="bm_logout.php">ログアウト</a> -->
       <!-- </div>
      </div>
    </div>
  </nav> -->
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
