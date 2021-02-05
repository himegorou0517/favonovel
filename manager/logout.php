<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

if(isset($_GET['logout'])) {
  //セッション情報を破棄する
  $_SESSION = array();
  session_destroy();
}

//ログイン画面を経由しているか
if(!isset($_SESSION['User'])) {
  header('Location: /php_book/basic/login.php');
  exit;
}


try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();



} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <title>本と出会う-webサービス</title>
  <link rel="stylesheet" type="text/css" href="../css/newbook.css">
  <link rel="stylesheet" type="text/css" href="../css/common1.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>

  <?php
    require("../basic/header.php");
  ?>

  <div id="wrapper">
    <p class="mem">ログアウト画面</p>
    <p class="mem"><a href="?logout=1">ログアウトする</a></p>
  </div>

  <?php
    session_destroy();
  ?>

</body>
</html>
