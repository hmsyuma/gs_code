<?php
//$_SESSION使うよ！
session_start();

if(!isset($_SESSION["chk_ssid"]) || 
        $_SESSION["chk_ssid"]!=session_id()){
        exit("Error");
    }else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"]=session_id();
    }

//1. POSTデータ取得
$name      = filter_input( INPUT_POST, "name" );
$lid       = filter_input( INPUT_POST, "lid" );
$lpw       = filter_input( INPUT_POST, "lpw" );
$kanri_flg = filter_input( INPUT_POST, "kanri_flg" );
$lpw       = password_hash($lpw, PASSWORD_DEFAULT);

//2. DB接続します
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError'.$e->getMessage());
  }

//３．データ登録SQL作成
$sql = "INSERT INTO bm_user_table(name,lid,lpw,kanri_flg,life_flg)VALUES(:name,:lid,:lpw,:kanri_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sqlError($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: user.php");
    exit;
}
