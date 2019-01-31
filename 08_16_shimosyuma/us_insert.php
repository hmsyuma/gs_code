<?php
//入力内容の確認
    if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["lid"]) || $_POST["lid"]=="" ||
    !isset($_POST["lpw"]) || $_POST["lpw"]==""
    ){
        exit('エラーでてますよ');
    }

//POSTデータの取得
$name = $_POST["name"];
$lid  = $_POST["lid"];
$lpw  = $_POST["lpw"];

//DB接続
try{
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
   } catch (PDOException $e) {
     exit('DbConnectError:'.$e->getMessage());
   }

//データ登録SQLの作成
   $sql = "INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg)
   VALUES(NULL, :a1, :a2, :a3, NULL, NULL)";

   $stmt = $pdo->prepare($sql);

   $stmt->bindValue(':a1', $name, PDO::PARAM_STR);
   $stmt->bindValue(':a2', $lid,  PDO::PARAM_STR);
   $stmt->bindValue(':a3', $lpw,  PDO::PARAM_STR);
   $status = $stmt->execute();

//データ登録後の処理　 
if($status==false){
    $error = $stmt->errorInfo();
    exit("QueryError:" .$error[2]);

} else {
    header("Location: us_insert_view.php");
    exit;
 };















?>