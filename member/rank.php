<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

//ログイン画面を経由しているか
if(!isset($_SESSION['User'])) {
  header('Location: /php_book/basic/login.php');
  exit;
}


try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  $result= $user->findById($_GET['id']);
  if(isset($_GET['id'])){
    $displayone = $user->displayone($result['id']);
    $displaytwo = $user->displaytwo($result['id']);
    $displaythree = $user->displaythree($result['id']);
    $displayfour = $user->displayfour($result['id']);
    $displayfive = $user->displayfive($result['id']);
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
  <link rel="stylesheet" type="text/css" href="../css/mypage.css">
  <link rel="stylesheet" type="text/css" href="../css/common2.css">
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
        <form method="get" action="search.php">
          <input type="text" name="title_search">
          <input type="submit" name="submit" value="検索" class="submit_btn">
        </form>
      </div>
    </div>
    <p class="index"><span><?= ($result['username']);?>さん</span>のブックランキング</p>

    <div class="rank">
      <table>
        <tr>
          <td>1位</td>
          <td>2位</td>
          <td>3位</td>
          <td>4位</td>
          <td>5位</td>
        </tr>
        <tr>
          <?php if(!empty($displayone['id'])): ?>
          <td><a href="search.php?detail=<?= ($displayone['id']);?>"><img src="../bookimg/<?php echo $displayone['image'];?>"></a></td>
          <?php endif ?>
          <?php if(!empty($displaytwo['id'])): ?>
          <td><a href="search.php?detail=<?= ($displaytwo['id']);?>"><img src="../bookimg/<?php echo $displaytwo['image'];?>"></a></td>
          <?php endif ?>
          <?php if(!empty($displaythree['id'])): ?>
          <td><a href="search.php?detail=<?= ($displaythree['id']);?>"><img src="../bookimg/<?php echo $displaythree['image'];?>"></a></td>
          <?php endif ?>
          <?php if(!empty($displayfour['id'])): ?>
          <td><a href="search.php?detail=<?= ($displayfour['id']);?>"><img src="../bookimg/<?php echo $displayfour['image'];?>"></a></td>
          <?php endif ?>
          <?php if(!empty($displayfive['id'])): ?>
          <td><a href="search.php?detail=<?= ($displayfive['id']);?>"><img src="../bookimg/<?php echo $displayfive['image'];?>"></a></td>
          <?php endif ?>
        </tr>
        <tr>
          <td><?php if(isset($result['best1']))echo $result['best1'];?></td>
          <td><?php if(isset($result['best2']))echo $result['best2'];?></td>
          <td><?php if(isset($result['best3']))echo $result['best3'];?></td>
          <td><?php if(isset($result['best4']))echo $result['best4'];?></td>
          <td><?php if(isset($result['best5']))echo $result['best5'];?></td>
        </tr>
        <tr>
          <td><?php if(!empty($result['best1']))echo $displayone['author'];?></td>
          <td><?php if(!empty($result['best2']))echo $displaytwo['author'];?></td>
          <td><?php if(!empty($result['best3']))echo $displaythree['author'];?></td>
          <td><?php if(!empty($result['best4']))echo $displayfour['author'];?></td>
          <td><?php if(!empty($result['best5']))echo $displayfive['author'];?></td>
        </tr>
        <tr>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($result['review1']))echo $result['review1'];?></font></td>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($result['review2']))echo $result['review2'];?></font></td>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($result['review3']))echo $result['review3'];?></font></td>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($result['review4']))echo $result['review4'];?></font></td>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($result['review5']))echo $result['review5'];?></font></td>
        </tr>
      </table>
    </div>
  </div>

  <!-- <?php
    require("../basic/footer.php");
  ?> -->

</body>
</html>
