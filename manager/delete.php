<?php
session_start();

require_once("../config/config.php");
require_once("../model/User.php");


try {
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  if(isset($_GET['id'])) {
    $user->delete($_GET['id']);
  }
   // echo "削除しました";

} catch(PDOException $e){
          echo 'エラーが発生しました。:' . $e->getMessage();
}

 ?>

 <!DOCTYPE html>
 <html lang="ja">
 <head>
   <meta charset="UTF-8">
   <title>本と出会う-webサービス</title>
   <link rel="stylesheet" type="text/css" href="../css/user_list.css">
   <link rel="stylesheet" type="text/css" href="../css/common1.css">
   <link rel="icon" href="../image/favicon3.ico">
   <script type="text/javascript" src="js/jquery.js"></script>
 </head>
 <body>

   <?php
     require("../basic/header.php")
   ?>

   <div id="wrapper">
     <h1>管理者ページ</h1>
     <p class="index">削除しました！</p>

     <div class="moji">
       <p><a href="user_list.php">一覧に戻る</a></p>
     </div>

   </div>

   <?php
     require("../basic/footer.php")
   ?>

 </body>
 </html>
