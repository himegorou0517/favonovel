<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  if($_POST) {
  // print_r($_POST);
    $result = $user->send($_POST['mail']);
    if(empty($result)) {
      print_r("正しいメールアドレスを入力してください");
    } else {
      $token = bin2hex(random_bytes(50));
      $user->pass($_POST['mail'],$token);
      $to = $_POST['mail'];
      $subject = "パスワードリセット";
      $msg = "http://localhost/php_book/basic/reset2.php?token=".$token;
      $msg = wordwrap($msg,70);
      $headers = "From: nanaba7hime1204@gmail.com";
      mail($to, $subject, $msg, $headers);
    }
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
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
  <header>
    <h1></h1>
  </header>
  <div id="wrapper">
    <p class="index">パスワード再設定</p>
    <form name="form" action="reset.php" method="post">
      <table>
        <tr>
          <th>メールアドレス<span>*</span></th>
          <td><input type="test" name="mail"></td>
        </tr>
      </table>
      <input type="submit" name="submit" value="送信する" class="submit_btn">
      <p class="first"><a href="login.php">ログイン画面に戻る</a></p>
    </form>
  </div>

</body>
</html>
