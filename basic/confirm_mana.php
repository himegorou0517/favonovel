<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

$url = $_SERVER['HTTP_REFERER'];
$host = $_SERVER['HTTP_HOST'];
$diff = "http://" .$_SERVER['HTTP_HOST']. "/php_book/basic/manager.php";
if( $diff !== $url ) {
   header('location:manager.php');
   	exit();
}

$username = $_POST["username"];
$mail = $_POST["mail"];
$password = $_POST["password"];

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
    <p class="index">管理者登録画面</p>

      <h2>こちらの内容でよろしいですか？</h2>
    <div class="confirm">
      <p>ユーザネーム <?= h($username); ?></p>
      <p>メールアドレス <?= h($mail); ?></p>
      <p>パスワード <?= h($password); ?></p>
    </div>

    <form name="form" action="complete_mana.php" method="post">

       <input type="hidden" name="username" value="<?= h($username);?>">
       <input type="hidden" name="mail" value="<?= h($mail);?>">
       <input type="hidden" name="password" value="<?= h($password);?>">

       <div  class="submit_btn">
         <input type="submit" name="submit" value="登録する">
       </div>
       <p class="first"><a href="manager.php">前の画面に戻る</a></p>
     </form>
  </div>

  <?php
      require("../basic/footer.php");
    ?>

</body>
</html>
