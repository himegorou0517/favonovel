<?php
session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($post){
  return htmlspecialchars($post,ENT_QUOTES,'UTF-8');
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
  $result = $user->bookall($_SESSION['User']['id']);

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
    require("../basic/header2.php");
  ?>

  <div id="wrapper">
    <div class="front">
      <p class="mgt">My本棚</p>
    </div>

    <div class="novel">
      <?php foreach($result as $value):?>
           <div class="pic">
             <a href="search.php?detail=<?= ($value['id']);?>"><img src="../bookimg/<?php echo $value['image'];?>" hspace="20"></a>
             <p class="title"><?php echo $value['title'];?></p>
             <p class="author"><?php echo $value['author'];?></p>
             <!-- <p class="memo"><?php if(isset($value['comment'])){ echo $value['comment'];};?></p> -->

           </div>
       <?php endforeach;?>
    </div>
    <!-- <div  class="submit_btn">
      <a href="edit_hondana.php?edit=<?= ($_SESSION['User']['id']);?>">編集する</a>
    </div> -->



  </div>

  <!-- <?php
    require("../basic/footer.php");
  ?> -->

</body>
</html>
