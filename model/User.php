<?php

require_once("DB.php");

class User extends DB {

// ログイン機能
public function login($arr){
  $sql = 'SELECT * FROM users WHERE mail = :mail AND password = :password AND flag = 0';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':mail' => $arr['mail'],
    ':password' => md5($arr['password'])
  );
  $stmt->execute($params);
  $result = $stmt->fetch();
  return $result;
}

//フォームに入力されたmailがすでに登録されていないかチェック
public function mailcheck($mail){
    $sql = 'SELECT * FROM users WHERE mail = :mail LIMIT 1';
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':mail' => $mail
    );
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
}

//パスワードリセット メールアドレスの確認
public function send($mail){
  $sql = 'SELECT mail FROM users WHERE mail = :mail';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':mail' => $mail,
  );
  $stmt->execute($params);
  $result = $stmt->fetch();
  return $result;
}

//パスワードリセット(メールとトークンを登録)
public function pass($mail,$token) {
  $sql = "INSERT INTO password_resets (mail, token) VALUES (:mail, :token)";
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':mail' => $mail,
    ':token' => $token
  );
  $stmt->execute($params);
}

//パスワードリセット(同じトークンのメールとトークンを探す)
public function mailfind($token){
  $sql = 'SELECT mail, token FROM password_resets WHERE token = :token';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':token' => $token,
  );
  $stmt->execute($params);
  $result = $stmt->fetch();
  return $result;
}

//パスワードリセット
public function passfind($mail,$token){
  $sql = 'SELECT u.id, u.mail, u.password, p.token FROM users u JOIN password_resets p ON u.mail = p.mail WHERE u.mail = :mail AND p.token = :token';
  $stmt = $this->connect->prepare($sql);
  $stmt->execute(array(
    ':mail' => $mail,
    ':token' => $token
  ));
  $result = $stmt->fetch();
  return $result;
}

//パスワードリセット(パスワードの更新)
public function passedit($password,$id) {
  $sql = 'UPDATE users SET password = :password WHERE id = :id';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':password' => md5($password),
     ':id' => $id
   );
 $stmt->execute($params);
}


 //ユーザ一覧
public function findAll() {
  $sql = 'SELECT * FROM users WHERE flag = 0 AND role = 0';
  $stmt = $this->connect->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();
  return $result;
  }

  //ユーザ登録
  public function add($arr) {
    $sql = "INSERT INTO users (username, mail, password, role, best1, best2, best3, best4, best5, review1, review2, review3, review4, review5, flag, created) VALUES (:username, :mail, :password, :role, :best1, :best2, :best3, :best4, :best5, :review1, :review2, :review3, :review4, :review5, :flag, :created)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':username' => $arr['username'],
      ':mail' => $arr['mail'],
      ':password' => md5($arr['password']),
      ':role' => 0,
      'flag' =>0,
      ':best1' => $arr['best1'],
      ':best2' => $arr['best2'],
      ':best3' => $arr['best3'],
      ':best4' => $arr['best4'],
      ':best5' => $arr['best5'],
      ':review1' => $arr['review1'],
      ':review2' => $arr['review2'],
      ':review3' => $arr['review3'],
      ':review4' => $arr['review4'],
      ':review5' => $arr['review5'],
      ':created' => date("Y-m-d H:i:s")
     );
    $stmt->execute($params);
  }

  //ユーザ詳細情報
  public function info($id) {
    $sql = 'SELECT * FROM users WHERE id = :id';
    $stmt = $this->connect->prepare($sql);
    $params = array(':id' => $id);
    $stmt->execute($params);
    $result = $stmt->fetch();
    return $result;
   }

  //管理者登録
  public function plus($arr) {
    $sql = "INSERT INTO users (username, mail, password, role, flag, created) VALUES (:username, :mail, :password, :role, :flag, :created)";
    $stmt = $this->connect->prepare($sql);
    $params = array(
      ':username' => $arr['username'],
      ':mail' => $arr['mail'],
      ':password' => md5($arr['password']),
      ':role' => 1,
      'flag' => 0,
      ':created' => date("Y-m-d H:i:s")
    );
    $stmt->execute($params);
  }

  //ユーザの削除
    public function delete($id = null){
      if(isset($id)){
        // $sql = "DELETE FROM users WHERE id = :id";
        $sql = 'UPDATE users SET flag = 1 WHERE id = :id';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute(array(':id' => $_GET["id"]));
      }
    }

//本の一覧
public function all() {
  $sql = 'SELECT * FROM books';
  $stmt = $this->connect->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();
  return $result;

}

//本の登録
public function append($arr,$img) {
  $sql = "INSERT INTO books (title, author, day, image, created) VALUES (:title, :author, :day, :image, :created)";
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':title' => $arr['title'],
    ':author' => $arr['author'],
    ':day' => $arr['day'],
    ':image' => $img,
    ':created' => date("Y-m-d H:i:s")
   );
  $stmt->execute($params);
}

//本の詳細参照
public function show($id) {
  $sql = 'SELECT * FROM books WHERE id = :id';
  $stmt = $this->connect->prepare($sql);
  $params = array(':id' => $id);
  $stmt->execute($params);
  $result = $stmt->fetch();
  return $result;
 }

 //本の詳細編集
 public function edit($arr) {
   $sql = 'UPDATE books SET title = :title, author = :author, day = :day, image = :image WHERE id = :id';
   $stmt = $this->connect->prepare($sql);
   $params = array(
      ':title' => $arr['title'],
      ':author' => $arr['author'],
      ':day' => $arr['day'],
      ':image' => $arr['image'],
      ':id' => $arr['id']
    );
  $stmt->execute($params);
 }


//マイページに情報表示
//ベスト本1
public function displayone($id) {
  $sql = 'SELECT id, author, image FROM books WHERE title = (SELECT best1 FROM users WHERE id = :id)';
  $stmt = $this->connect->prepare($sql);
  $params = array(':id' => $id);
  $stmt->execute($params);
  $display = $stmt->fetch();
  return $display;
}
//ベスト本2
public function displaytwo($id) {
  $sql = 'SELECT id, author, image FROM books WHERE title = (SELECT best2 FROM users WHERE id = :id)';
  $stmt = $this->connect->prepare($sql);
  $params = array(':id' => $id);
  $stmt->execute($params);
  $display = $stmt->fetch();
  return $display;
}
//ベスト本3
public function displaythree($id) {
  $sql = 'SELECT id, author, image FROM books WHERE title = (SELECT best3 FROM users WHERE id = :id)';
  $stmt = $this->connect->prepare($sql);
  $params = array(':id' => $id);
  $stmt->execute($params);
  $display = $stmt->fetch();
  return $display;
}
//ベスト本4
public function displayfour($id) {
  $sql = 'SELECT id, author, image FROM books WHERE title = (SELECT best4 FROM users WHERE id = :id)';
  $stmt = $this->connect->prepare($sql);
  $params = array(':id' => $id);
  $stmt->execute($params);
  $display = $stmt->fetch();
  return $display;
}
//ベスト本5
public function displayfive($id) {
  $sql = 'SELECT id, author, image FROM books WHERE title = (SELECT best5 FROM users WHERE id = :id)';
  $stmt = $this->connect->prepare($sql);
  $params = array(':id' => $id);
  $stmt->execute($params);
  $display = $stmt->fetch();
  return $display;
}


//本の検索(会員)
public function search($search) {
  $sql = "SELECT * FROM books WHERE title LIKE :title_search";
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':title_search' => $search
  );
  $stmt->execute($params);
  $result = $stmt->fetchAll();
  return $result;
}

//本の検索(管理人)
public function lookfor($search) {
  $sql = "SELECT * FROM books WHERE title LIKE :title_search";
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':title_search' =>$search
  );
  $stmt->execute($params);
  $result = $stmt->fetchAll();
  return $result;
}

//本の詳細ページにユーザ表示
public function account($id) {
  $sql = "SELECT id, username, best1, best2, best3, best4, best5 FROM users WHERE best1 = (SELECT title FROM books WHERE id = :id) OR best2 = (SELECT title FROM books WHERE id = :id) OR best3 = (SELECT title FROM books WHERE id = :id) OR best4 = (SELECT title FROM books WHERE id = :id) OR best5 = (SELECT title FROM books WHERE id = :id)";
  $stmt = $this->connect->prepare($sql);
  $params = array(':id' => $id);
  $stmt->execute($params);
  $result = $stmt->fetchAll();
  return $result;
}

// public function take($id) {
//   $sql = "SELECT image FROM books JOIN users WHERE best1 = (SELECT title FROM books WHERE id = :id) OR best2 = (SELECT title FROM books WHERE id = :id) OR best3 = (SELECT title FROM books WHERE id = :id) OR best4 = (SELECT title FROM books WHERE id = :id) OR best5 = (SELECT title FROM books WHERE id = :id)";
//   $stmt = $this->connect->prepare($sql);
//   $params = array(':id' => $id);
//   $stmt->execute($params);
//   $result = $stmt->fetch();
//   return $result;
// }

// public function takeone($id) {
//   $sql = "SELECT image FROM books WHERE title = (SELECT best1 FROM users WHERE id = :id)";
//   $stmt = $this->connect->prepare($sql);
//   $params = array(':id' => $id);
//   $stmt->execute($params);
//   $result = $stmt->fetch();
//   return $result;
// }
//
// public function taketwo($id) {
//   $sql = "SELECT image FROM books WHERE title = (SELECT best2 FROM users WHERE id = :id)";
//   $stmt = $this->connect->prepare($sql);
//   $params = array(':id' => $id);
//   $stmt->execute($params);
//   $result = $stmt->fetch();
//   return $result;
// }
// public function takethree($id) {
//   $sql = "SELECT image FROM books WHERE title = (SELECT best3 FROM users WHERE id = :id)";
//   $stmt = $this->connect->prepare($sql);
//   $params = array(':id' => $id);
//   $stmt->execute($params);
//   $result = $stmt->fetch();
//   return $result;
// }
// public function takefour($id) {
//   $sql = "SELECT image FROM books WHERE title = (SELECT best4 FROM users WHERE id = :id)";
//   $stmt = $this->connect->prepare($sql);
//   $params = array(':id' => $id);
//   $stmt->execute($params);
//   $result = $stmt->fetch();
//   return $result;
// }
// public function takefive($id) {
//   $sql = "SELECT image FROM books WHERE title = (SELECT best5 FROM users WHERE id = :id)";
//   $stmt = $this->connect->prepare($sql);
//   $params = array(':id' => $id);
//   $stmt->execute($params);
//   $result = $stmt->fetch();
//   return $result;
// }

//登録情報編集
public function editing($arr) {
  $sql = 'UPDATE users SET username = :username, mail = :mail, password = :password, best1 = :best1, best2 = :best2, best3 = :best3, best4 = :best4, best5 = :best5, review1 = :review1, review2 = :review2, review3 = :review3, review4 = :review4, review5 = :review5 WHERE id = :id';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':id' => $arr['id'],
    ':username' => $arr['username'],
    ':mail' => $arr['mail'],
    ':password' => md5($arr['password']),
    ':best1' => $arr['best1'],
    ':best2' => $arr['best2'],
    ':best3' => $arr['best3'],
    ':best4' => $arr['best4'],
    ':best5' => $arr['best5'],
    ':review1' => $arr['review1'],
    ':review2' => $arr['review2'],
    ':review3' => $arr['review3'],
    ':review4' => $arr['review4'],
    ':review5' => $arr['review5']
   );
  $stmt->execute($params);
}

//テーブルの情報最新の情報をひっぱってきてくれる
public function findById($id) {
  $sql = 'SELECT * FROM users WHERE id = :id';
  $stmt = $this->connect->prepare($sql);
  $params = array(':id' => $id);
  $stmt->execute($params);
  $result = $stmt->fetch();
  return $result;
}

// public function findimg($id) {
//   $sql =
//   'SELECT u.id, u.username, u.best1, u.best2, u.best3, u.best4, u.best5, b.image
//   FROM users u JOIN books b ON u.best1 = b.title AND u.best2 = b.title AND u.best3 = b.title AND u.best4 = b.title AND u.best5 = b.title WHERE u.id = :id';
//   $stmt = $this->connect->prepare($sql);
//   $params = array(':id' => $id);
//   $stmt->execute($params);
//   $result = $stmt->fetch();
//   return $result;
// }



//お気に入り登録
public function favoriteadd($arr) {
  $sql = 'INSERT INTO favorites (user_id, book_id, created) VALUES (:user_id, :book_id, :created)';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':user_id' => $arr['user_id'],
    ':book_id' => $arr['book_id'],
    ':created' => date("Y-m-d H:i:s")
  );
  $stmt->execute($params);
}

// //お気に入り削除
public function favoritedel($arr) {
  $sql = 'DELETE FROM favorites WHERE :user_id = user_id AND :book_id = book_id';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':user_id' => $arr['user_id'],
    ':book_id' => $arr['book_id']
  );
  $stmt->execute($params);
}

//同じ人、本を登録しないようにチェック
public function favo($user_id,$book_id) {
  $sql = 'SELECT * FROM favorites WHERE user_id = :user_id AND book_id = :book_id';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':user_id' => $user_id,
    ':book_id' => $book_id
  );
  $stmt->execute($params);
  $result = $stmt->rowCount();
  return $result;
}

//お気に入り参照
public function favoall($user_id) {
  $sql = 'SELECT b.title, b.author, b.image, f.book_id, b.id FROM favorites f JOIN books b ON f.book_id = b.id WHERE f.user_id = :user_id';
  $stmt = $this->connect->prepare($sql);
  $params = array(':user_id' => $user_id);
  $stmt->execute($params);
  $result = $stmt->fetchAll();
  return $result;
}


//本棚追加
public function bookadd($arr) {
  $sql = 'INSERT INTO hondana (user_id, book_id, comment, created) VALUES (:user_id, :book_id, :comment, :created)';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':user_id' => $arr['user_id'],
    ':book_id' => $arr['book_id'],
    ':comment' => $arr['comment'],
    ':created' => date("Y-m-d H:i:s")
  );
  $stmt->execute($params);
}

// //本棚削除
public function bookdel($arr) {
  $sql = 'DELETE FROM hondana WHERE :user_id = user_id AND :book_id = book_id';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':user_id' => $arr['user_id'],
    ':book_id' => $arr['book_id']
  );
  $stmt->execute($params);
}

//同じ人、本を登録しないようにチェック
public function bookcheck($user_id,$book_id) {
  $sql = 'SELECT * FROM hondana WHERE user_id = :user_id AND book_id = :book_id';
  $stmt = $this->connect->prepare($sql);
  $params = array(
    ':user_id' => $user_id,
    ':book_id' => $book_id
  );
  $stmt->execute($params);
  $result = $stmt->rowCount();
  return $result;
}

//My本棚参照
public function bookall($user_id) {
  $sql = 'SELECT b.title, b.author, b.image, h.comment, h.book_id, b.id FROM hondana h JOIN books b ON h.book_id = b.id WHERE h.user_id = :user_id';
  $stmt = $this->connect->prepare($sql);
  $params = array(':user_id' => $user_id);
  $stmt->execute($params);
  $result = $stmt->fetchAll();
  return $result;
}

//本棚編集
// public function change($arr) {
//   $sql = 'UPDATE hondana SET comment = :comment,id WHERE user_id = :user_id AND book_id = :book_id';
//   $stmt = $this->connect->prepare($sql);
//   $params = array(
//      'comment' => $arr['comment'],
//      ':user_id' => $arr['user_id'],
//      ':book_id' => $arr['book_id']
//    );
//  $stmt->execute($params);
// }

}
