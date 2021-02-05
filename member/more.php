<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>本と出会う-webサービス</title>
  <link rel="stylesheet" type="text/css" href="../css/more.css">
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
      <p class="best">この本をベスト本に入れてる人は...</p>
      <div class="search">
        <input type="test" name="title">
        <input type="submit" name="submit" value="検索" class="submit_btn">
      </div>
    </div>

    <div class="left">
      <ul class="detail">
        <li>本のタイトル</li>
        <li>著者</li>
        <li>出版社</li>
        <li><img src="../image/star.jpg" alt="本の画像"></li>
      </ul>
      <div  class="submit_btn">
        <input type="submit" name="submit" value="＋本棚登録">
      </div>
    </div>

    <div class="user">
      <div class="name">
        <p class="name">ユーザネーム名</p>
        <img src="" alt="アイコン">
      </div>
      <div class="five">
        <table>
          <tr>
            <th>1位</th>
            <th>2位</th>
            <th>3位</th>
            <th>4位</th>
            <th>5位</th>
          </tr>
          <tr>
            <td><a href="#"><img src="../image/star.jpg" alt="本の画像"></a></td>
            <td><a href="#"><img src="../image/star.jpg" alt="本の画像"></a></td>
            <td><a href="#"><img src="../image/star.jpg" alt="本の画像"></a></td>
            <td><a href="#"><img src="../image/star.jpg" alt="本の画像"></a></td>
            <td><a href="#"><img src="../image/star.jpg" alt="本の画像"></a></td>
          </tr>
          <tr>
            <td><a href="#">タイトル</a></td>
            <td><a href="#">タイトル</a></td>
            <td><a href="#">タイトル</a></td>
            <td><a href="#">タイトル</a></td>
            <td><a href="#">タイトル</a></td>
          </tr>
          <tr>
            <td>著者名</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>出版社</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
      </div>
    </div>

  </div>

  <?php
    require("../basic/footer.php");
  ?>

</body>
</html>
