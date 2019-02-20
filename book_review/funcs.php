<?php

function h($val){
    return htmlspecialchars($val,ENT_QUOTES);
}

//LOGIN認証チェック関数
function loginCheck(){
    if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
    echo "LOGIN Error!";
    exit();
    }else{
        session_regenerate_id(true);
        //新しいIDを付与して格納
        $_SESSION["chk_ssid"] = session_id();
        //echo  $_SESSION["chk_ssid"];
        //ログインできれはelse実行
    } 
   };

   function db_connect(){
    try {
        $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
        exit('DbConnectError'.$e->getMessage());
    }
    return $pdo;
    //変数を外に出さないと関数が消えてしまいます。retunで返す。
}

?>