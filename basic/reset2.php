<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

$url = $_SERVER['HTTP_REFERER'];
$host = $_SERVER['HTTP_HOST'];
$diff = "http://" .$_SERVER['HTTP_HOST']. "/php_book/reset.php";
if( $diff !== $url ) {
   header('location:reset.php');
   	exit();
}

try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

if(isset($_GET['token'])) {
 $_SESSION['token'] = $_GET['token'];
 $result = $user->mailfind($_SESSION['token']);
 // print_r($result);
 if(isset($result) && $_SESSION['token'] == $result['token']) {
 $reset = $user->passfind($result['mail'],$_SESSION['token']);
 // print_r($reset);
 $_SESSION['reset'] = $reset;
 }
}

if($_POST) {
  // print_r($_POST);
  $user->passedit($_POST['password'],$_SESSION['reset']['id']);
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
    <form name="form" action="reset2.php" method="post">
      <table>
        <tr>
          <th>新しいパスワード<span>*</span></th>
          <td><input type="test" name="password"></td>
        </tr>
      </table>
      <input type="submit" name="submit" value="登録する" class="submit_btn">
      <p class="first"><a href="login.php">ログイン画面に戻る</a></p>
    </form>
  </div>

</body>
</html>
