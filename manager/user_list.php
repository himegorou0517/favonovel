<?php

session_start();

require_once("../config/config.php");
require_once("../model/User.php");

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

// ログイン画面を経由しているか
if(!isset($_SESSION['User'])) {
  header('Location: /php_book/basic/login.php');
  exit;
}

try{
  $user = new User($host, $dbname, $user, $pass);
  $user->connectDb();

  //一覧表示
  $result = $user->findAll();

  //削除処理
  if(isset($_GET['id'])){
    $user->delete($_GET['id']);
    $result = $user->findAll();
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
  <link rel="stylesheet" type="text/css" href="../css/user_list.css">
  <link rel="stylesheet" type="text/css" href="../css/common1.css">
  <link rel="icon" href="../image/favicon3.ico">
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>

  <?php
    require("../basic/header.php");
  ?>

  <div id="wrapper">
    <h1>管理者ページ</h1>
    <p class="index">ユーザ一覧</p>

    <div class="list">
      <div class="user">
        <table>
          <tr>
            <th>ID</th>
            <th>ユーザネーム</th>
            <th>メールアドレス</th>
          </tr>

          <?php foreach($result as $row):?>
          <tr>
            <td><?php echo h($row['id']);?></td>
            <td><?php echo h($row['username']);?></td>
            <td><?php echo h($row['mail']);?></td>
            <td>
                <a href="delete.php?id=<?= h($row['id']);?>" onClick="if(!confirm('ID:<?=$row['id']?>を削除しますが大丈夫ですか？')) return false;">削除</a>
            </td>
          </tr>
          <?php endforeach;?>
        </table>

      </div>

    </div>

  </div>



</body>
</html>
