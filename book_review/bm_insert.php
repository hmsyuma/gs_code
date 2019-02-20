<?php
//入力内容の確認
if(
    !isset($_POST["book_name"]) || $_POST["book_name"]=="" ||
    !isset($_POST["url"]) || $_POST["url"]=="" ||
    !isset($_POST["coment"]) || $_POST["coment"]=="" 
){
 exit('ParamError');
}

//1.POSTデータの取得
$book_name = $_POST["book_name"];
$url = $_POST["url"];
$coment = $_POST["coment"];
// $lid = $_POST["lid"];
// $lpw   = filter_input( INPUT_POST, "lpw" );
// $lpw = password_hash($lpw, PASSWORD_DEFAULT); 


//Fileが送信されてきているのか？チェック！.//定型
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
  $file_name = $_FILES["upfile"]["name"]; //"1.jpg"ファイル名取得
  $tmp_path = $_FILES["upfile"]["tmp_name"]; //www/tmp/1.jpg:TempフォルダPath取得 } else {
  
  $extension = pathinfo($file_name, PATHINFO_EXTENSION); 
  $file_name = date("YmdHis").md5(session_id()) . "." . $extension;
  
  $upload = "upload/";
  $file_name = $upload.$file_name;
  
  // FileUpload [--Start--]
  $img="";
  if(is_uploaded_file($tmp_path)){
      if(move_uploaded_file($tmp_path,$file_name)){
          chmod($file_name, 0644);
          // $img = $file_name;//確認用
      }
  }
  
  // FileUpload [--End--]
}else{
  //  $img = "画像が送信されていません";
}


//2.DB接続
try{$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//3.データ登録SQLの作成
$sql = "INSERT INTO gs_bm_table(id, book_name, url, coment, date, filename)
VALUES(NULL, :a1, :a2, :a3, sysdate(), :filename)";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':a1', $book_name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);
$stmt->bindValue(':a3', $coment, PDO::PARAM_STR);
$stmt->bindValue(':filename', $file_name ); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//4.データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:" .$error[2]);

}else{
 header("Location: bm_insert_view.php");
 exit;
}

?>

