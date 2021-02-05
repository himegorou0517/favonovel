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

try {
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

// $post = $user->findById($_SESSION['Book']['id']);

  // if($_SESSION['User']['role'] == 1) {
  //     $result['User'] = $post;
  // }

  if($_SESSION['User']){
    // print_r ($_SESSION['User']);
      if(isset($_GET['edit'])) {
        // print_r($_GET['edit']);
        // print_r($_POST);
        if($_POST) {
          // print_r($_POST);
          $result = $user->edit($_POST);
          header('Location:detail_book.php?id='.$_POST["id"]);
           }
          }
          $result['Book'] = $user->show($_GET['edit']);
          // print_r($result['Book']);
      }

} catch (Exception $e) {
  echo '接続エラー:' . $e->getMessage();
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
         <input type="test" name="title">
         <input type="submit" name="submit" value="検索" class="submit_btn">
       </div>
     </div>

     <span>
       <p><?php if(isset($message['title'])) echo $message['title'];?></p>
       <p><?php if(isset($message['author'])) echo $message['author'];?></p>
       <p><?php if(isset($message['day'])) echo $message['day'];?></p>
       <!-- <p><?php if(isset($message['image'])) echo $message['image'];?></p> -->
     </span>

        <form action="" name="form" method="post">
          <input type="hidden" name="id" value="<?php if(isset($_SESSION['id'])){ echo $_SESSION['id'];}else echo $result['Book']['id'];?>">
          <div class="big">
            <div class="detail">
              <div class="left">
                <form action="#">
                  <img src="../bookimg/<?php if(isset($_SESSION['image'])){ echo $_SESSION['image'];}else echo $result['Book']['image'];?>">
                  <!-- <form action="#"> -->
        　　　　　　　　　<p id="file">アップロードするファイルを選択して下さい。</p>
                       <p><input type="file" name="image"></p>
                       <!-- <p><input type="file" name="image" accept = "image/*" value="<?php if(isset($_SESSION['image'])){echo h($_SESSION['image']);}?>"></p>
                       <input type = "hidden" name = "image"> -->
                  </form>
               </div>

               <div class="more">
                  <p>本のタイトル：<input type="text" name="title" value="<?php if(isset($_SESSION['title'])){ echo $_SESSION['title'];}else echo $result['Book']['title'];?>"></p>
                  <p>著者名：<input type="text" name="author" value="<?php if(isset($_SESSION['author'])){ echo $_SESSION['author'];}else echo $result['Book']['author'];?>"></p>
                  <p>出版日：<input type="text" name="day" value="<?php if(isset($_SESSION['day'])){ echo $_SESSION['day'];}else echo $result['Book']['day'];?>"></p>
               </div>
            </div>

            <div  class="submit_btn">
              <a href="detail_book.php?id=<?= $result['Book']['id'];?>">戻る</a>
              <input type="submit" name="submit" value="更新する">
            </div>
          </div>
         </form>

   </div>

   <?php
     // session_destroy();
     // require("../basic/footer.php");
   ?>

 </body>
 </html>
