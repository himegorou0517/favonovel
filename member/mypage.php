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

  $post = $user->findById($_SESSION['User']['id']);

  if($_SESSION['User']['role'] == 0) {
      $result['User'] = $post;
  }

  if(isset($_SESSION['User'])) {
    $displayone = $user->displayone($result['User']['id']);
    $displaytwo = $user->displaytwo($result['User']['id']);
    $displaythree = $user->displaythree($result['User']['id']);
    $displayfour = $user->displayfour($result['User']['id']);
    $displayfive = $user->displayfive($result['User']['id']);
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
  <link rel="stylesheet" type="text/css" href="../css/mypage.css">
  <link rel="stylesheet" type="text/css" href="../css/common2.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>

  <?php
    require("../basic/header2.php");
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
    <p class="index">あなたのブックランキング</p>

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
          <td><a href="search.php?detail=<?= ($displayone['id']);?>"><img src="../bookimg/<?php echo $displayone['image'];?>" class="css"></a></td>
          <?php endif ?>
          <?php if(!empty($displaytwo['id'])): ?>
          <td><a href="search.php?detail=<?= ($displaytwo['id']);?>"><img src="../bookimg/<?php echo $displaytwo['image'];?>" class="css"></a></td>
          <?php endif ?>
          <?php if(!empty($displaythree['id'])): ?>
          <td><a href="search.php?detail=<?= ($displaythree['id']);?>"><img src="../bookimg/<?php echo $displaythree['image'];?>" class="css"></a></td>
          <?php endif ?>
          <?php if(!empty($displayfour['id'])): ?>
          <td><a href="search.php?detail=<?= ($displayfour['id']);?>"><img src="../bookimg/<?php echo $displayfour['image'];?>" class="css"></a></td>
          <?php endif ?>
          <?php if(!empty($displayfive['id'])): ?>
          <td><a href="search.php?detail=<?= ($displayfive['id']);?>"><img src="../bookimg/<?php echo $displayfive['image'];?>" class="css"></a></td>
          <?php endif ?>
        </tr>
        <tr>
          <td class="moji"><?php if(isset($_SESSION['best1'])){ echo $_SESSION['best1'];}else echo $result['User']['best1'];?></td>
          <td class="moji"><?php if(isset($_SESSION['best2'])){ echo $_SESSION['best2'];}else echo $result['User']['best2'];?></td>
          <td class="moji"><?php if(isset($_SESSION['best3'])){ echo $_SESSION['best3'];}else echo $result['User']['best3'];?></td>
          <td class="moji"><?php if(isset($_SESSION['best4'])){ echo $_SESSION['best4'];}else echo $result['User']['best4'];?></td>
          <td class="moji"><?php if(isset($_SESSION['best5'])){ echo $_SESSION['best5'];}else echo $result['User']['best5'];?></td>
        </tr>
        <tr>
          <td><?php if(!empty($_SESSION['User']['best1']))echo $displayone['author'];?></td>
          <td><?php if(!empty($_SESSION['User']['best2']))echo $displaytwo['author'];?></td>
          <td><?php if(!empty($_SESSION['User']['best3']))echo $displaythree['author'];?></td>
          <td><?php if(!empty($_SESSION['User']['best4']))echo $displayfour['author'];?></td>
          <td><?php if(!empty($_SESSION['User']['best5']))echo $displayfive['author'];?></td>
        </tr>
        <tr>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($_SESSION['review1'])){ echo $_SESSION['review1'];}else echo $result['User']['review1'];?></font></td>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($_SESSION['review2'])){ echo $_SESSION['review2'];}else echo $result['User']['review2'];?></font></td>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($_SESSION['review3'])){ echo $_SESSION['review3'];}else echo $result['User']['review3'];?></font></td>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($_SESSION['review4'])){ echo $_SESSION['review4'];}else echo $result['User']['review4'];?></font></td>
          <td class="white" align="center" valign="top"><font size="3"><?php if(isset($_SESSION['review5'])){ echo $_SESSION['review5'];}else echo $result['User']['review5'];?></font></td>
        </tr>
      </table>
    </div>
  </div>

  <!-- <?php
    require("../basic/footer.php");
  ?> -->

</body>
</html>
