<?php
session_start();
require('../../library/library.php');


$db = dbconnect();
$stmt = $db->prepare('select * from reserve_cms where id=?');
if (!$stmt) {
  die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$stmt->bind_param('i', $id);
$stmt->execute();

$stmt->bind_result($id, $uketuke, $hearmenu, $nedan, $title, $imgfile, $comment, $jouken, $stylist, $sonota);
$result = $stmt->fetch();
if (!$result) {
  die('Reserveの指定が正しくありません');
}

$hearmenu = unserialize($hearmenu);

foreach ($hearmenu as $key => $value) {
  if ($value == 'カット') {
    $chk1 = 'checked';
  }
  if ($value == 'カラー') {
    $chk2 = 'checked';
  }
  if ($value == 'トリートメント') {
    $chk3 = 'checked';
  }
  if ($value == 'ヘッドスパ') {
    $chk4 = 'checked';
  }
  if ($value == 'その他') {
    $chk5 = 'checked';
  }
  if ($value == 'メニューを選択してご利用いただくクーポンです') {
    $chk6 = 'checked';
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $imgfile = $_FILES['imgfile'];
  if ($imgfile['name'] !== '' && $imgfile['error'] === 0) {
    $type = mime_content_type($imgfile['tmp_name']);
    if ($type !== 'image/png' && $type !== 'image/jpeg') {
      $error['image'] = 'type';
    }
  }


  if ($imgfile !== '') {
    $filename = date('YmdHis') . '_' . $imgfile['name'];
    if (!move_uploaded_file($imgfile['tmp_name'], '../cms_picture/' . $filename)) {
      die('ファイルのアップロードに失敗しました');
    }
    $_SESSION['form']['imgfile'] = $filename;
  } else {
    $_SESSION['form']['imgfile'] = '';
  }

  $_SESSION['id'] = $_POST['id'];
  $_SESSION['uketuke'] = $_POST['uketuke'];
  $_SESSION['hearmenu'] = $_POST['hearmenu'];
  $_SESSION['nedan'] = $_POST['nedan'];
  $_SESSION['title'] = $_POST['title'];
  $_SESSION['comment'] = $_POST['comment'];
  $_SESSION['jouken'] = $_POST['jouken'];
  $_SESSION['stylist'] = $_POST['stylist'];
  $_SESSION['sonota'] = $_POST['sonota'];
  
  header('Location:update_do.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>編集画面</title>
</head>

<body>
  <header>
    <h1>編集画面</h1>
  </header>
  <main>
    <h3>クーポン</h3>
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div>
        <h3>新規・再来・全員</h3>
        <input type="radio" name="uketuke" value="新規" <?php if ($uketuke == "新規") echo 'checked' ?>>新規
        <input type="radio" name="uketuke" value="再来" <?php if ($uketuke == "再来") echo 'checked' ?>>再来
        <input type="radio" name="uketuke" value="全員" <?php if ($uketuke == "全員") echo 'checked' ?>>全員
      </div>
      <div>
        <h3>ヘアーメニュー</h3>
        <input type="checkbox" name="hearmenu[]" value="カット" <?php if (isset($chk1)) {
                                                                echo $chk1;
                                                              } ?>>カット
        <input type="checkbox" name="hearmenu[]" value="カラー" <?php if (isset($chk2)) {
                                                                echo $chk2;
                                                              } ?>>カラー
        <input type="checkbox" name="hearmenu[]" value="トリートメント" <?php if (isset($chk3)) {
                                                                    echo $chk3;
                                                                  } ?>>トリートメント
        <input type="checkbox" name="hearmenu[]" value="ヘッドスパ" <?php if (isset($chk4)) {
                                                                  echo $chk4;
                                                                } ?>>ヘッドスパ
        <input type="checkbox" name="hearmenu[]" value="その他" <?php if (isset($chk5)) {
                                                                echo $chk5;
                                                              } ?>>その他
        <input type="checkbox" name="hearmenu[]" value="メニューを選択してご利用いただくクーポンです" <?php if (isset($chk6)) {
                                                                                  echo $chk6;
                                                                                } ?>>メニューを選択してご利用いただくクーポンです
      </div>
      <h3>値段・割引</h3>
      <input type="text" name="nedan" value="<?php echo h($nedan); ?>">
      </div>
      <div>
        <h3>タイトル</h3>
        <input type="text" name="title" value="<?php echo h($title); ?>">
      </div>
      <div>
        <h3>画像ファイル名</h3>
        <input type="file" name="imgfile">
        <p style="margin: 0; color: red;">※恐れ入りますが改めて画像の指定してください。</p>
      </div>
      <div>
        <h3>コメント</h3>
        <textarea name="comment" id="" cols="70" rows="10"><?php echo h($comment); ?></textarea>
      </div>
      <div>
        <h3>来店日条件</h3>
        <input type="text" name="jouken" value="<?php echo h($jouken); ?>">
      </div>
      <div>
        <h3>対象スタイリスト</h3>
        <input type="text" name="stylist" value="<?php echo h($stylist); ?>">
      </div>
      <div>
        <h3>その他条件</h3>
        <input type="text" name="sonota" value="<?php echo h($sonota); ?>">
      </div>
      <input type="submit" value="送信">
    </form>
  </main>
  <footer>
    <a href="../index.html">メインメニューへ</a>
  </footer>
</body>

</html>