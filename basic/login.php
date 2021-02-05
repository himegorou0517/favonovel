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

    $result = $user->login($_POST);

    if(!empty($result)) {
      $_SESSION['User'] = $result;
      if ($_SESSION['User']['role'] == 0) {
        header('Location: /php_book/member/mypage.php');
        exit;
      } elseif ($_SESSION['User']['role'] == 1) {
        header('Location: /php_book/manager/user_list.php');
        exit;
      }
    } else {
      $message = "ログインできませんでした";
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
  </header>
  <div id="wrapper">
    <div class="login">
      <div class="left">
        <video src="../image/login3.mp4" loop autoplay muted></video>
      </div>
      <div class="right">
        <p class="index">ログイン</p>
        <form name="form" action="" method="post">
          <table>
            <tr>
              <th>メールアドレス<span>*</span></th>
              <td><input type="text" name="mail"></td>
            </tr>
            <tr>
              <th>パスワード<span>*</span></th>
              <td><input type="password" name="password"></td>
            </tr>
          </table>
          <p class="forget">パスワードを忘れた方は<a href="reset.php" class="res">こちら</a></p>
          <input type="submit" name="login" value="送 信" class="submit_btn">
          <p class="first"><a href="member.php">新規会員登録</a></p>
          <!-- <p class="first"><a href="manager.php">管理者登録</a></p> -->
        </form>
      </div>
    </div>



  </div>
</body>
</html>
