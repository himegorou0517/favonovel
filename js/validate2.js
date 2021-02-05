$(function () {
  $('.submit_btn').on('click', function() {
    //名前アラート
    if($('input[name="title"]').val() == ''){
      alert('タイトルを入力してください');
      return false;
    }
    if($('input[name="author"]').val() == ''){
      alert('著者を入力してください');
      return false;
    }
    if($('input[name="day"]').val() == ''){
      alert('出版日を入力してください');
      return false;
    }
    if($('input[name="image"]').val() == ''){
      alert('イメージ画像を選択してください');
      return false;
    }
  });
});
