<?php
require_once("../config/config.php");
require_once("../model/User.php");

session_start();

$url = $_SERVER['HTTP_REFERER'];
$host = $_SERVER['HTTP_HOST'];
$diff = "http://" .$_SERVER['HTTP_HOST']. "/php_book/manager/confirm_book.php";
if( $diff !== $url ) {
   header('location:register_book.php');
   	exit();
}

$img = $_POST['image'];


//データベースに接続
try {
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  if($_POST) {
    $user->append($_POST, $img);
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
  <link rel="stylesheet" type="text/css" href="../css/newbook.css">
  <link rel="stylesheet" type="text/css" href="../css/common1.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>

  <?php
    require("../basic/header.php")
  ?>

  <div id="wrapper">
    <div class="front">
      <p class="mgt">管理者ページ</p>
      <div class="search">
        <input type="test" name="title">
        <input type="submit" name="submit" value="検索" class="submit_btn">
      </div>
    </div>
    <p class="complete">登録が完了しました!</p>
    <p class="mem"><a href="book_list.php">登録本一覧画面に戻る</a></p>

  </div>

</body>
</html>
