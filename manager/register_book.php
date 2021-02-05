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



}catch(PDOException $e){
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
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/validate2.js"></script>
</head>
<body>

  <?php
    require("../basic/header.php");
  ?>

  <div id="wrapper">
    <div class="front">
      <p class="mgt">管理者ページ</p>
    </div>

    <p class="index">新規本登録</p>

    <form name="form" action="confirm_book.php" method="POST" enctype="multipart/form-data">

      <table>
        <tr>
          <th>本のタイトル<span>*</span></th>
          <td><input type="text" name="title" value="<?php if(isset($_SESSION['title'])){echo h($_SESSION['title']);}?>"></td>
        </tr>
        <tr>
          <th>著者<span>*</span></th>
          <td><input type="text" name="author" value="<?php if(isset($_SESSION['author'])){echo h($_SESSION['author']);}?>"></td>
        </tr>
        <tr>
          <th>出版日<span>*</span></th>
          <td><input type="text" name="day" value="<?php if(isset($_SESSION['day'])){echo h($_SESSION['day']);}?>"></td>
        </tr>
        <tr>
          <th>本の画像ファイル<span>*</span></th>
          <td>
            <form action="#">
	　　　　　　　　　<p id="file">アップロードするファイルを選択して下さい。</p>
                 <p><input type="file" name="image" accept = "image/*" value="<?php if(isset($_SESSION['image'])){echo h($_SESSION['image']);}?>"></p>
                 <input type = "hidden" name = "image">
            </form>
          </td>
        </tr>
      </table>
      <div  class="submit_btn">
        <input type="submit" name="submit" value="確認する" class="submit_btn">
      </div>
      <p class="re"><a href="book_list.php">前のページに戻る</a></p>
    </form>
  </div>

  <?php
      // session_destroy();
    ?>

</body>
</html>
