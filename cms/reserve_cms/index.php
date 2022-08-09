<?php
session_start();
require('library/library.php');


$post = [
  'uketuke' => '',
  'hearmenu' => '',
  'nedan' => '',
  'title' => '',
  'imgfile' => '',
  'comment' => '',
  'jouken' => '',
  'stylist' => '',
  'sonota' => ''
];

$error = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $post['uketuke'] = filter_input(INPUT_POST, 'uketuke', FILTER_SANITIZE_STRING);
  if ($post['uketuke'] === '') {
    $error['uketuke'] = 'blank';
  }

  $post['hearmenu'] = filter_input(INPUT_POST, 'hearmenu', FILTER_SANITIZE_STRING);
  if (!isset($_POST['hearmenu']) || $_POST['hearmenu'] === '') {
    $error['hearmenu'] = 'blank';
  }

  $post['nedan'] = filter_input(INPUT_POST, 'nedan', FILTER_SANITIZE_STRING);
  if ($post['nedan'] === '') {
    $error['nedan'] = 'blank';
  }

  $post['title'] = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  if ($post['title'] === '') {
    $error['title'] = 'blank';
  }

  $post['imgfile'] = filter_input(INPUT_POST, 'imgfile', FILTER_SANITIZE_STRING);
  if ($post['imgfile'] === '') {
    $error['imgfile'] = 'blank';
  }

  $post['comment'] = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
  if ($post['comment'] === '') {
    $error['comment'] = 'blank';
  }

  $post['jouken'] = filter_input(INPUT_POST, 'jouken', FILTER_SANITIZE_STRING);
  if ($post['jouken'] === '') {
    $error['jouken'] = 'blank';
  }

  $post['stylist'] = filter_input(INPUT_POST, 'stylist', FILTER_SANITIZE_STRING);
  if ($post['stylist'] === '') {
    $error['stylist'] = 'blank';
  }

  $post['sonota'] = filter_input(INPUT_POST, 'sonota', FILTER_SANITIZE_STRING);
  if ($post['sonota'] === '') {
    $error['sonota'] = 'blank';
  }

  if (count($error) === 0) {
    $_SESSION['hearmenu'] = $_POST['hearmenu'];
    $_SESSION['form'] = $post;
    header('Location: kanri_check.php');
    exit();
  }
} else {
  if (isset($_SESSION['form']) && isset($_SESSION['hearmenu'])) {
    $post = $_SESSION['form'];
    $post['hearmenu'] = $_SESSION['hearmenu'];
  }

  if (is_array($post['hearmenu'])) {

    foreach ($post['hearmenu'] as $key => $value) {
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
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理画面</title>
</head>

<body>
  <header>
    <h1>管理画面</h1>
  </header>
  <main>
    <h3>クーポン</h3>
    <form action="" method="POST">
      <div>
        <h3>新規・再来・全員</h3>
        <input type="radio" name="uketuke" value="新規" <?php if ($post['uketuke'] == "新規") echo 'checked' ?>>新規
        <input type="radio" name="uketuke" value="再来" <?php if ($post['uketuke'] == "再来") echo 'checked' ?>>再来
        <input type="radio" name="uketuke" value="全員" <?php if ($post['uketuke'] == "全員") echo 'checked' ?>>全員
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
      <input type="text" name="nedan" value="<?php echo h($post['nedan']); ?>">
      </div>
      <div>
        <h3>タイトル</h3>
        <input type="text" name="title" value="<?php echo h($post['title']); ?>">
      </div>
      <div>
        <h3>画像ファイル名</h3>
        <input type="text" name="imgfile" value="<?php echo h($post['imgfile']); ?>">
      </div>
      <div>
        <h3>コメント</h3>
        <textarea name="comment" id="" cols="70" rows="10"><?php echo h($post['comment']); ?></textarea>
      </div>
      <div>
        <h3>来店日条件</h3>
        <input type="text" name="jouken" value="<?php echo h($post['jouken']); ?>">
      </div>
      <div>
        <h3>対象スタイリスト</h3>
        <input type="text" name="stylist" value="<?php echo h($post['stylist']); ?>">
      </div>
      <div>
        <h3>その他条件</h3>
        <input type="text" name="sonota" value="<?php echo h($post['sonota']); ?>">
      </div>
      <input type="submit" value="送信">
    </form>
  </main>
  <footer>
    <a href="../index.html">メインメニューへ</a>
  </footer>
</body>

</html>