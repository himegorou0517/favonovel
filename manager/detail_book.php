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

  //本の詳細表示
  if(isset($_GET['id'])) {
    $result['Book'] = $user->show($_GET['id']);
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

    <div class="detail">
      <div class="left">
        <img src="../bookimg/<?php if(isset($_SESSION['image'])){ echo $_SESSION['image'];}else echo $result['Book']['image'];?>">
      </div>
      <div class="more">
          <p>本のタイトル：<?php if(isset($_SESSION['title'])){ echo $_SESSION['title'];}else echo $result['Book']['title'];?></p>
          <p>著者：<?php if(isset($_SESSION['author'])){ echo $_SESSION['author'];}else echo $result['Book']['author'];?></p>
          <p>出版日：<?php if(isset($_SESSION['day'])){ echo $_SESSION['day'];}else echo $result['Book']['day'];?></p>

          <a href="edit_book.php?edit=<?= $result['Book']['id'];?>" class="edit">編集</a>
      </div>
    </div>

</body>
</html>
