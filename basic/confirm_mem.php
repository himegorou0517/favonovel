<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

$url = $_SERVER['HTTP_REFERER'];
$host = $_SERVER['HTTP_HOST'];
$diff = "http://" .$_SERVER['HTTP_HOST']. "/php_book/basic/member.php";
if( $diff !== $url ) {
   header('location:member.php');
   	exit();
}

$username = $_POST["username"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$best1 = $_POST["best1"];
$best2 = $_POST["best2"];
$best3 = $_POST["best3"];
$best4 = $_POST["best4"];
$best5 = $_POST["best5"];
$review1 = $_POST["review1"];
$review2 = $_POST["review2"];
$review3 = $_POST["review3"];
$review4 = $_POST["review4"];
$review5 = $_POST["review5"];


if(isset($username)){
  $_SESSION['username'] = h($username);
}
if(isset($mail)){
  $_SESSION['mail'] = h($mail);
}
if(isset($password)){
  $_SESSION['password'] = h($password);
}
if(isset($best1)){
  $_SESSION['best1'] = h($best1);
}
if(isset($best2)){
  $_SESSION['best2'] = h($best2);
}
if(isset($best3)){
  $_SESSION['best3'] = h($best3);
}
if(isset($best4)){
  $_SESSION['best4'] = h($best4);
}
if(isset($best5)){
  $_SESSION['best5'] = h($best5);
}
if(isset($review1)){
  $_SESSION['review1'] = h($review1);
}
if(isset($review2)){
  $_SESSION['review2'] = h($review2);
}
if(isset($review3)){
  $_SESSION['review3'] = h($review3);
}
if(isset($review4)){
  $_SESSION['review4'] = h($review4);
}
if(isset($review5)){
  $_SESSION['review5'] = h($review5);
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
  <title>本と出会う-webサービス</title>
  <link rel="stylesheet" type="text/css" href="../css/member.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
  <header>
    <h1></h1>
  </header>
  <div id="wrapper">
    <p class="index">新規会員登録画面</p>

      <h2>こちらの内容でよろしいですか？</h2>
    <div class="confirm">
      <table>
        <tr>
          <th>ユーザーネーム</th>
          <td><?= h($username);?></td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td><?= h($mail);?></td>
        </tr>
        <tr>
          <th>パスワード</th>
          <td><?= h($password);?></td>
        </tr>
        <tr>
          <th>好きな本のタイトル</th>
          <td>①<?= h($best1);?></td>
          <td>②<?= h($best2);?></td>
          <td>③<?= h($best3);?></td>
          <td>④<?= h($best4);?></td>
          <td>⑤<?= h($best5);?></td>
        </tr>
        <tr>
          <th>レビュー</th>
          <td><?= h($review1);?></td>
          <td><?= h($review2);?></td>
          <td><?= h($review3);?></td>
          <td><?= h($review4);?></td>
          <td><?= h($review5);?></td>
        </tr>
      </table>

    </div>

    <form name="form" action="complete_mem.php" method="post">

       <input type="hidden" name="username" value="<?= h($username);?>">
       <input type="hidden" name="mail" value="<?= h($mail);?>">
       <input type="hidden" name="password" value="<?= h($password);?>">
       <input type="hidden" name="best1" value="<?= h($best1);?>">
       <input type="hidden" name="best2" value="<?= h($best2);?>">
       <input type="hidden" name="best3" value="<?= h($best3);?>">
       <input type="hidden" name="best4" value="<?= h($best4);?>">
       <input type="hidden" name="best5" value="<?= h($best5);?>">
       <input type="hidden" name="review1" value="<?= h($review1);?>">
       <input type="hidden" name="review2" value="<?= h($review2);?>">
       <input type="hidden" name="review3" value="<?= h($review3);?>">
       <input type="hidden" name="review4" value="<?= h($review4);?>">
       <input type="hidden" name="review5" value="<?= h($review5);?>">

       <div  class="submit_b">
         <input type="submit" name="submit" class="submit_btn" value="登録する">
         <p class="first"><a href="member.php">前の画面に戻る</a></p>
       </div>
     </form>

  </div>

</body>
</html>
