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

  if(isset($_GET['title_search'])){
    $title_search = $_GET['title_search'];
    $result = $user->lookfor($title_search);
  }


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
    require("../basic/header2.php")
  ?>

  <div id="wrapper">
    <div class="front">
      <p class="mgt"></p>
      <div class="search">
        <form method="get" action="book_search.php">
          <input type="text" name="title_search">
          <input type="submit" name="submit" value="検索" class="submit_btn">
        </form>
      </div>
    </div>
    <p class="index">検索結果</p>

    <div class="detail">
      <?php foreach($result as $value):?>
      <div class="left">
        <a href="detail_book.php?id=<?= h($value['id']);?>"><img src="../bookimg/<?php echo $value['image'];?>"></a>
      </div>
      <div class="more">
          <p>本のタイトル：<?php echo $value['title'];?></p>
          <p>著者：<?php echo $value['author'];?></p>
          <p>出版日：<?php echo $value['day'];?></p>
      </div>
      <?php endforeach;?>
    </div>
  </div>

  <?php
    // require("../basic/footer.php")
  ?>

</body>
</html>
