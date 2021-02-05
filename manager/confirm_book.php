<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

$url = $_SERVER['HTTP_REFERER'];
$host = $_SERVER['HTTP_HOST'];
$diff = "http://" .$_SERVER['HTTP_HOST']. "/php_book/manager/register_book.php";
if( $diff !== $url ) {
   header('location:register_book.php');
   	exit();
}

$title = $_POST["title"];
$author = $_POST["author"];
$day = $_POST["day"];
$image = $_POST["image"];

if(isset($title)){
  $_SESSION['title'] = h($title);
}
if(isset($author)){
  $_SESSION['author'] = h($author);
}
if(isset($day)){
  $_SESSION['day'] = h($day);
}
if(isset($image)){
  $_SESSION['image'] = h($image);
}

$image_name = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], '../bookimg/' . $image_name);

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
    <p class="index">入力確認画面</p>

      <h2>こちらの内容でよろしいですか？</h2>
    <div class="confirm">
      <p>本のタイトル：<?= h($title);?></p>
      <p>著者：<?= h($author);?></p>
      <p>出版日：<?= h($day);?></p>
      <p>画像： <img src="../bookimg/<?= $image_name?>"></p>
    </div>

    <form name="form" action="complete_book.php" method="post">

       <input type="hidden" name="title" value="<?= h($title);?>">
       <input type="hidden" name="author" value="<?= h($author);?>">
       <input type="hidden" name="day" value="<?= h($day);?>">
       <input type="hidden" name="image" value="<?= h($image_name);?>">

       <div  class="submit_btn">
         <input type="submit" name="submit" value="登録する">
       </div>
       <p class="first"><a href="register_book.php">前の画面に戻る</a></p>
     </form>

  </div>

  <?php
    require("../basic/footer.php");
  ?>

</body>
</html>
