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

// if($_SESSION['User']['role'] == 0) {
//     $result['User'] = $_SESSION['User'];
//     $result['User'];
// }

try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

//検索結果
  if(isset($_GET['title_search'])){
    $title_search = $_GET['title_search'];
    $result = $user->search($title_search);
    foreach($result as $value) {
    $rank = $user->account($value['id']);
    $check = $user->favo($_SESSION['User']['id'],$value['id']);
    $ck = $user->bookcheck($_SESSION['User']['id'],$value['id']);
    }
  }

//マイページの本画像から飛んでくる
  if(isset($_GET['detail'])) {
    $result['Book'] = $user->show($_GET['detail']);
    $rank = $user->account($result['Book']['id']);
    $check = $user->favo($_SESSION['User']['id'],$_GET['detail']);
    $ck = $user->bookcheck($_SESSION['User']['id'],$_GET['detail']);
    // foreach($rank as $pea) {
    // $img = $user->findById($pea['id']);
    // $res = $user->findimg($pea['id']);
    // $one = $user->takeone($rank['id']);
    // $two = $user->taketwo($img['id']);
    // $three = $user->takethree($img['id']);
    // $four = $user->takefour($img['id']);
    // $five = $user->takefive($img['id']);
   // }
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
  <script type="text/javascript" src="../js/jquery.js"></script>
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
    <p class="index"></p>

    <div class="top">
      <?php foreach($result as $value):?>
      <div class="left">
        <a href="#"><img src="../bookimg/<?php echo $value['image'];?>"></a>
      </div>
      <div class="more">
          <p>本のタイトル：<?php echo $value['title'];?></p>
          <p>著者：<?php echo $value['author'];?></p>
          <p>出版日：<?php echo $value['day'];?></p>
            <div class="big">
              <form class="favorite_b" action="#" method="post">
                <div class="small">
                  <input type="hidden" name="heart">
              　　  <?php if($check == 0):?>
                <div class="heart">
                  <img src="../image/heart.png">
                </div>
                　  <?php else:?>
                <div class="heart on">
                  <img src="../image/heart1.png">
                </div>
                　  <?php endif;?>
                </div>
              </form>

                <form class="favorite_b" action="#" method="post">
                  <div class="small">
                   <input type="hidden" name="star">
                  　　<?php if($ck == 0):?>
                      <button type="button" class="book_btn" name="shelves">
                        +本棚
                      </button>
                　　  <?php else:?>
                      <button type="button" class="book_btn on" name="shelves">
                        本棚追加済み
                      </button>
                  　　<?php endif;?>
                  </div>
                </form>
              </div>
      </div>
      <?php endforeach;?>
    </div>


    <div class="bottom">
      <table>

          <div class="more">
            <tr>
              <td></td>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
            </tr>
            <?php foreach($rank as $row):?>
            <tr>
              <td class="en"><a href="rank.php?id=<?= ($row['id']);?>"><?php echo $row['username'];?></a></td>
              <td><?php echo $row['best1'];?></td>
              <td><?php echo $row['best2'];?></td>
              <td><?php echo $row['best3'];?></td>
              <td><?php echo $row['best4'];?></td>
              <td><?php echo $row['best5'];?></td>
            </tr>

            <!-- <tr>

              <td></td>

              <td><img src="../bookimg/<?php echo $one;?>"></td>


              <td><img src="../bookimg/<?php echo $two;?>"></td>


              <td><img src="../bookimg/<?php echo $three;?>"></td>


              <td><img src="../bookimg/<?php echo $four;?>"></td>


              <td><img src="../bookimg/<?php echo $five;?>"></td>
            </tr> -->

          </div>
          <?php endforeach;?>
        </table>
    </div>
  </div>

  <!-- <?php
    require("../basic/footer.php");
  ?> -->
  <script>

  $(function(){
     $('.heart').click(function() {
       var user_id = <?php echo $_SESSION["User"]["id"]; ?>;
       var book_id = <?php echo $value["id"]; ?>;

       if($(this).hasClass("on")){
         $(this).removeClass("on");
         // $(this).text("Favorite");
         $(this).html("<img src='../image/heart.png'>");
         $(this).addClass("off");
         $.ajax({
           url:'ajax2.php',
           type:'POST',
           data:{
             "user_id" : user_id,
             "book_id" : book_id
           },
         })
         // .done(function(data){
         //   alert("解除しました");
         // }).fail(function(data){
         //   alert("失敗");
         // });

       }else{
         $(this).removeClass("off");
         $(this).addClass("on");
         // $(this).text("♡");
         $(this).html("<img src='../image/heart1.png'>");
         $.ajax({
           url:'ajax.php',
           type:'POST',
           data:{
             "user_id" : user_id,
             "book_id" : book_id
           }
         })
         // .done(function(data){
         //   alert("登録しました");
         // }).fail(function(data){
         //   alert("登録できなかった");
         // });
       }
     });

     $('.book_btn').click(function() {
       var user_id = <?php echo $_SESSION["User"]["id"]; ?>;
       var book_id = <?php echo $value["id"]; ?>;

       if($(this).hasClass("on")){
         $(this).removeClass("on");
         $(this).text("+本棚");
         $(this).addClass("off");
         $.ajax({
           url:'ajax4.php',
           type:'POST',
           data:{
             "user_id" : user_id,
             "book_id" : book_id
           },
         })
         // .done(function(data){
         //   alert("解除しました");
         // }).fail(function(data){
         //   alert("失敗");
         // });

       }else{
         $(this).removeClass("off");
         $(this).addClass("on");
         $(this).text("本棚追加済み");
         $.ajax({
           url:'ajax3.php',
           type:'POST',
           data:{
             "user_id" : user_id,
             "book_id" : book_id
           }
         })
         // .done(function(data){
         //   alert("登録しました");
         // }).fail(function(data){
         //   alert("登録できなかった");
         // });
       }
     });
   });

  </script>


</body>
</html>
