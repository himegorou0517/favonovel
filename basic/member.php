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

  // if(isset($_SESSION['ellor'])) {
  //   $message = "このメールアドレスはすでに登録済みです";
  // }


} catch(PDOException $e){
  echo 'エラー'.$e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>本と出会う-webサービス</title>
  <link rel="stylesheet" type="text/css" href="../css/member.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/validate.js"></script>
</head>
<body>
  <header>
    <h1></h1>
  </header>
  <div id="wrapper">
    <p class="index">新規会員登録画面</p>
    <form name="form" action="confirm_mem.php" method="POST">
      <table>
        <tr>
          <th>ユーザーネーム<span>*</span></th>
          <td><input type="text" name="username" value="<?php if(isset($_SESSION['username'])){echo h($_SESSION['username']);}?>"></td>
        </tr>
        <tr>
          <th>メールアドレス<span>*</span></th>
          <td><input type="text" name="mail" value="<?php if(isset($_SESSION['mail'])){echo h($_SESSION['mail']);}?>"></td>
        </tr>
        <tr>
          <th>パスワード<span>*</span></th>
          <th><font size="2">※8文字以上15文字以内の半角英数字</font></th>
          <td><input type="text" name="password"></td>
        </tr>
        <tr>
          <th>好きな本のタイトル</th>
          <td>1位<input type="text" name="best1" value="<?php if(isset($_SESSION['best1'])){echo h($_SESSION['best1']);}?>"></td>
          <td>2位<input type="text" name="best2" value="<?php if(isset($_SESSION['best2'])){echo h($_SESSION['best2']);}?>"></td>
          <td>3位<input type="text" name="best3" value="<?php if(isset($_SESSION['best3'])){echo h($_SESSION['best3']);}?>"></td>
          <td>4位<input type="text" name="best4" value="<?php if(isset($_SESSION['best4'])){echo h($_SESSION['best4']);}?>"></td>
          <td>5位<input type="text" name="best5" value="<?php if(isset($_SESSION['best5'])){echo h($_SESSION['best5']);}?>"></td>
        </tr>
        <tr>
          <th>レビュー</th>
          <td><textarea type="text" name="review1"><?php if(isset($_SESSION['review1'])){echo h($_SESSION['review1']);}?></textarea></td>
          <td><textarea type="text" name="review2"><?php if(isset($_SESSION['review2'])){echo h($_SESSION['review2']);}?></textarea></td>
          <td><textarea type="text" name="review3"><?php if(isset($_SESSION['review3'])){echo h($_SESSION['review3']);}?></textarea></td>
          <td><textarea type="text" name="review4"><?php if(isset($_SESSION['review4'])){echo h($_SESSION['review4']);}?></textarea></td>
          <td><textarea type="text" name="review5"><?php if(isset($_SESSION['review5'])){echo h($_SESSION['review5']);}?></textarea></td>
        </tr>
      </table>
      <input type="submit" name="submit" value="確認する" class="submit_btn">
      <p class="mem"><a href="login.php">前のページに戻る</a></p>
    </form>
  </div>

  <?php
    session_destroy();
  ?>

</body>
</html>
