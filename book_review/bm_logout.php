<?php
session_start();

//SESSIONの中の変数をすべからっぽにする。
$_SESSION = array();

if(isset($_COOKIE[session_name()])){
 setcookie(session_name(), '', time()-4200, '/');
}

session_destroy();

header("Location: bm_login.php");
exit();

?>