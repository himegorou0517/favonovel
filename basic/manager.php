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

  // if($_SESSION){
  //   $message = $user->validate_m($_SESSION);
  // }


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
  <link rel="stylesheet" type="text/css" href="../css/manager.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/validate.js"></script>

</head>
<body>
  <header>
    <h1></h1>
  </header>
  <div id="wrapper">
    <p class="index">管理者登録画面</p>
    <form name="form" action="confirm_mana.php" method="post">

      <table>
        <tr>
          <th>ユーザーネーム<span>*</span></th>
          <td><input type="text" name="username"></td>
        </tr>
        <tr>
          <th>メールアドレス<span>*</span></th>
          <td><input type="text" name="mail"></td>
        </tr>
        </tr>
        <tr>
          <th>パスワード<span>*</span></th>
          <th>※8文字以上15文字以内の半角英数字</th>
          <td><input type="text" name="password"></td>
        </tr>
      </table>
      <p class="mem"><a href="login.php">前のページに戻る</a></p>
      <input type="submit" name="submit" value="確認する" class="submit_btn">
    </form>
  </div>
</body>
</html>
