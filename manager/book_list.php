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

  //一覧表示
  $result = $user->all();

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
  <link rel="stylesheet" type="text/css" href="../css/newbook.css">
  <link rel="stylesheet" type="text/css" href="../css/common1.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>

  <?php
      require("../basic/header.php");
    ?>

  <div id="wrapper">
    <div class="front">
      <p class="mgt">管理者ページ</p>
      <div class="search">
        <form method="get" action="search_book.php">
          <input type="text" name="title_search">
          <input type="submit" name="submit" value="検索" class="submit_btn">
        </form>
      </div>
    </div>

    <p class="index">登録本一覧</p>

    <div class="booklist">
      <?php foreach($result as $row):?>
          <div class="list">
            <a href="detail_book.php?id=<?= h($row['id']);?>"><img src="../bookimg/<?= h($row['image']);?>" class="bookimg"></a>
            <p><a href="detail_book.php?id=<?= h($row['id']);?>"><?php echo h($row['title']);?></a></p>
            <p><?php echo h($row['author']);?></p>
            <p><?php echo h($row['day']);?></p>
            <a href="edit_book.php?edit=<?= h($row['id']);?>" class="edit">編集</a>
          </div>
        <?php endforeach;?>
    </div>


    <div class="register">
      <a href="register_book.php"><img src="../image/plus.png"  alt="本の登録ロゴ"></a>
    </div>

  </div>

</body>
</html>
