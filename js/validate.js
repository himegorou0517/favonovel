$(function () {
  $('.submit_btn').on('click', function() {
    //名前アラート
    if($('input[name="username"]').val() == ''){
      alert('ユーザーネームを入力してください');
      return false;
    }

    //メールアドレスアラート
    if($('input[name="mail"]').val() == ''){
      alert('メールアドレスを入力してください');
      return false;
    }
    if(!$('input[name="mail"]').val().match(/.+@.+\..+/g)){
      alert('正しいメールアドレスを入力してください');
      return false;
    }
    if(!$('input[name="password"]').val().match(/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,15}$/i)){
     alert('パスワードは半角英数字をそれぞれ8文字以上含んだ15文字以上で設定してください。');
     return false;
   }

  });
});
