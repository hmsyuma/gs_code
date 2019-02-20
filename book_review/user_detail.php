<?php
session_start();

if(!isset($_SESSION["chk_ssid"]) || 
$_SESSION["chk_ssid"]!=session_id()){
exit("Error");
}else{
session_regenerate_id(true);
$_SESSION["chk_ssid"]=session_id();
}

$id = filter_input( INPUT_GET, "id" );

//1. DB接続
try{$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//2.データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM bm_user_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//3.データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    $row = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["name"]; ?>さん　
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
  <div class="jumbotron">
  
    <fieldset>
    <legend>ユーザー更新</legend>
     <label>名前：<input type="text" name="name" value="<?php echo $row["name"]; ?>"></label><br>
     <label>Login ID：<input type="text" name="lid" value="<?php echo $row["lid"]; ?>"></label><br>
     <label>Login PW<input type="text" name="lpw" placeholder="変更あるときだけ入力"></label><br>
     <label>管理FLG：
          <?php if($row["kanri_flg"]=="0"){ ?>
              一般<input type="radio" name="kanri_flg" value="0" checked="checked">　
              管理者<input type="radio" name="kanri_flg" value="1">
          <?php }else{ ?>
              一般<input type="radio" name="kanri_flg" value="0">　
              管理者<input type="radio" name="kanri_flg" value="1" checked="checked">
          <?php } ?>
    </label>
    <br>
     <label>退会FLG：
     <?php if($row["life_flg"]=="0"){ ?>
              利用中<input type="radio" name="life_flg" value="0" checked="checked">　
              退会<input type="radio" name="life_flg" value="1">
          <?php }else{ ?>
              利用中<input type="radio" name="life_flg" value="0">　
              退会<input type="radio" name="life_flg" value="1" checked="checked">
          <?php } ?>
     </label><br>
     <input type="submit" value="更新">
     <input type="hidden" name="id" value="<?php echo $id; ?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
