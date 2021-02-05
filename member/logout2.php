<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}


//ログイン画面を経由しているか
if(!isset($_SESSION['User'])) {
  header('Location: /php_book/basic/login.php');
  exit;
}


try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  if(isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
  } 


} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>本と出会う-webサービス</title>
  <link rel="stylesheet" type="text/css" href="../css/mypage.css">
  <link rel="stylesheet" type="text/css" href="../css/common2.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>

  <?php
    require("../basic/header2.php");
  ?>

  <div id="wrapper">
    <p class="index">ログアウト画面</p>
    <div class="finish">
      <p><a href="?logout=1">ログアウトする</a></p>
    </div>
    <div class="fin">
      <p>
        <a href="complete_del.php?id=<?= ($_SESSION['User']['id']);?> " onClick="if(!confirm('アカウントを削除しても本当によろしいですか？')) return false;">アカウントを削除する</a>
      </p>
    </div>

  </div>
</body>
</html>
