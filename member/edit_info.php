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

  if($_SESSION['User']){
    // print_r($result['User']);
      if(isset($_GET['edit'])) {
        if($_POST) {
          if(empty($_POST['password'])) {
           $_POST['password'] = $result['User']['password'];
          }
          $result = $user->editing($_POST);
          header('Location:info.php');
        }
      }
          $displayone = $user->displayone($_GET['edit']);
          $displaytwo = $user->displaytwo($_GET['edit']);
          $displaythree = $user->displaythree($_GET['edit']);
          $displayfour = $user->displayfour($_GET['edit']);
          $displayfive = $user->displayfive($_GET['edit']);
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
  <link rel="stylesheet" type="text/css" href="../css/info.css">
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
        <p class="mgt">登録情報変更</p>
       </div>

    <div class="private">
      <form name="form" method="post">
            <input type="hidden" name="id" value="<?php if(isset($_SESSION['User']['id'])){ echo $_SESSION['User']['id'];}else echo $result['User']['id'];?>">
            <div class="name">
              <p>ユーザネーム  <input type="text" name="username" value="<?php if(isset($_SESSION['User']['username'])){ echo $_SESSION['User']['username'];}else echo $result['User']['username'];?>">
              <p>メールアドレス <input type="text" name="mail" value="<?php if(isset($_SESSION['User']['mail'])){ echo $_SESSION['User']['mail'];}else echo $result['User']['mail'];?>">
              <p>パスワード <input type="text" name="password"></p>
              <!-- <p><font size ="3">※パスワードを入力してください。変更もできます。</font></p> -->

            </div>
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
                <td><img src="../bookimg/<?php if(!empty($_SESSION['User']['best1']))echo $displayone['image'];?>"></td>
                <?php endif ?>
                <?php if(!empty($displaytwo['id'])): ?>
                <td><img src="../bookimg/<?php if(!empty($_SESSION['User']['best2']))echo $displaytwo['image'];?>"></td>
                <?php endif ?>
                <?php if(!empty($displaythree['id'])): ?>
                <td><img src="../bookimg/<?php if(!empty($_SESSION['User']['best3']))echo $displaythree['image'];?>"></td>
                <?php endif ?>
                <?php if(!empty($displayfour['id'])): ?>
                <td><img src="../bookimg/<?php if(!empty($_SESSION['User']['best4']))echo $displayfour['image'];?>"></td>
                <?php endif ?>
                <?php if(!empty($displayfive['id'])): ?>
                <td><img src="../bookimg/<?php if(!empty($_SESSION['User']['best5']))echo $displayfive['image'];?>"></td>
                <?php endif ?>
              </tr>
              <tr>
                <td><input type="text" name="best1" value="<?php if(isset($_SESSION['User']['best1'])){ echo $result['User']['best1'];}else echo $result['User']['best1'];?>"></td>
                <td><input type="text" name="best2" value="<?php if(isset($_SESSION['User']['best2'])){ echo $result['User']['best2'];}else echo $result['User']['best2'];?>"></td>
                <td><input type="text" name="best3" value="<?php if(isset($_SESSION['User']['best3'])){ echo $result['User']['best3'];}else echo $result['User']['best3'];?>"></td>
                <td><input type="text" name="best4" value="<?php if(isset($_SESSION['User']['best4'])){ echo $result['User']['best4'];}else echo $result['User']['best4'];?>"></td>
                <td><input type="text" name="best5" value="<?php if(isset($_SESSION['User']['best5'])){ echo $result['User']['best5'];}else echo $result['User']['best5'];?>"></td>
              </tr>
              <tr>
                <td><?php if(!empty($result['User']['best1']))echo $displayone['author'];?></td>
                <td><?php if(!empty($result['User']['best2']))echo $displaytwo['author'];?></td>
                <td><?php if(!empty($result['User']['best3']))echo $displaythree['author'];?></td>
                <td><?php if(!empty($result['User']['best4']))echo $displayfour['author'];?></td>
                <td><?php if(!empty($result['User']['best5']))echo $displayfive['author'];?></td>
              </tr>
              <tr>
                <td><textarea type="text" class="bun" name="review1"><?php if(isset($_SESSION['User']['review1'])){ echo $result['User']['review1'];}else echo $result['User']['review1'];?></textarea></td>
                <td><textarea type="text" class="bun" name="review2"><?php if(isset($_SESSION['User']['review2'])){ echo $result['User']['review2'];}else echo $result['User']['review2'];?></textarea></td>
                <td><textarea type="text" class="bun" name="review3"><?php if(isset($_SESSION['User']['review3'])){ echo $result['User']['review3'];}else echo $result['User']['review3'];?></textarea></td>
                <td><textarea type="text" class="bun" name="review4"><?php if(isset($_SESSION['User']['review4'])){ echo $result['User']['review4'];}else echo $result['User']['review4'];?></textarea></td>
                <td><textarea type="text" class="bun" name="review5"><?php if(isset($_SESSION['User']['review5'])){ echo $result['User']['review5'];}else echo $result['User']['review5'];?></textarea></td>
              </tr>
            </table>
            <div class="btn">
              <input type="submit" name="submit" value="更新" class="submit_b">
            </div>
      </form>
    </div>

  </div>

  <!-- <?php
    require("../basic/footer.php");
  ?> -->

</body>
</html>
