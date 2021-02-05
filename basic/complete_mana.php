<?php
require_once("../config/config.php");
require_once("../model/User.php");

session_start();

$url = $_SERVER['HTTP_REFERER'];
$host = $_SERVER['HTTP_HOST'];
$diff = "http://" .$_SERVER['HTTP_HOST']. "/php_book/basic/confirm_mana.php";
if( $diff !== $url ) {
   header('location:manager.php');
   	exit();
}


//データベースに接続
try {
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  if($_POST) {
    $user->plus($_POST);
  }
} catch(PDOException $e) {
  echo '接続エラー:' . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>本と出会う-webサービス</title>
  <link rel="stylesheet" type="text/css" href="../css/manager.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
  <header>
    <h1></h1>
  </header>
  <div id="wrapper">
    <p class="mem">会員登録が完了しました!</p>
    <p class="mem"><a href="login.php">ログイン画面に戻る</a></p>
    <!-- <p class="mem"><a href="#">マイページに進む</a></p> -->
  </div>

</body>
</html>
