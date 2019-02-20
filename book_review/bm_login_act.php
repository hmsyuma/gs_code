<?php
//他ファイルでも変数を仕様できるようにする。
session_start();


$lid = filter_input( INPUT_POST, "lid" );
$lpw = filter_input( INPUT_POST, "lpw" );

// $lid = $_POST["lid"];
// $lpw = $_POST["lpw"];
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError'.$e->getMessage());
}


//4.データ登録SQL作成
$sql = "SELECT * FROM bm_user_table WHERE lid=:lid AND life_flg=0";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid);

// $stmt->bindValue(':lpw', $lpw);
$res = $stmt->execute();

//5.SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//4. 抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法


// var_dump($val["lpw"]);
// echo $val["lpw"];
// var_dump($lpw);
// echo $lpw;


//5. 該当レコードがあればSESSIONに値を代入
// echo $lpw;
// echo $val["lpw"];
// var_dump( password_verify÷($lpw, '$2y$10$ibEkwPTK8zBPDGkXgwjKneeZ2GTQAkvubrOplaKB5xItS4i3t/l3W' ));
// var_dump( password_verify($lpw, '$2y$10$ibEkwPTK8zBPDGkXgwjKneeZ2GTQAkvubrOplaKB5xItS4i3t/l3W' ));
// exit();
if(password_verify($lpw , $val["lpw"])) {
   $_SESSION["chk_ssid"]  = session_id();
   $_SESSION["kanri_flg"] = $val['kanri_flg'];
   $_SESSION["name"]      = $val['name'];
  header("Location: bm_select.php");
}else{
  header("Location: bm_login.php");
//logout処理を経由して全画面へ
// header("Location: bm_login.php");
// var_dump($val["lpw"]);
// echo $val["lpw"];
// var_dump($lpw);
// echo $lpw;
}
exit();



//DB接続
// try {
//     $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
//   } catch (PDOException $e) {
//     exit('DbConnectError'.$e->getMessage());
//   }

// //データ登録SQL
// $sql = "SELECT * FROM gs_bm_table WHERE lid=:lid AND life_flg=0";
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':lid', $lid);
// // $stmt->bindValue(':lpw', $lpw);
// $status = $stmt->execute();

// if($status==false) {
//     //execute（SQL実行時にエラーがある場合）
//   $error = $stmt->errorInfo();
//   exit("ErrorQuery:".$error[2]);
// };

// //抽出データの取得
// $val = $stmt->fetch();//1レコードだけ取得

// //!= NULLじゃなければ。
// // if( $val["id"] !=""){
// //5. 該当レコードがあればSESSIONに値を代入
// if(password_verify($lpw, $val["lpw"]) ){
//   $_SESSION["chk_ssid"]  = session_id();
//   $_SESSION["kanri_flg"] = $val['kanri_flg'];
//   $_SESSION["name"]      = $val['name'];
//    //Login処理OKの場合us_sleectへ移動
//     header("Location: bm_select.php");
// } else {
//     header("Location: bm_login.php");
// };


?>