<?php
session_start();
require('library/library.php');

$post = [
  'imgfile' => '',
  'date' => '',
  'title' => '',
  'comment' => ''
];

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $post['imgfile'] = filter_input(INPUT_POST, 'imgfile', FILTER_SANITIZE_STRING);
  if ($post['imgfile'] === '') {
    $error['imgfile'] = 'blank';
  }

  $post['date'] = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
  if ($post['date'] === '') {
    $error['date'] = 'blank';
  }

  $post['title'] = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  if ($post['title'] === '') {
    $error['title'] = 'blank';
  }

  $post['comment'] = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
  if ($post['comment'] === '') {
    $error['comment'] = 'blank';
  }

  if (count($error) === 0) {
    $_SESSION['form'] = $post;
    header('Location: kanri_check.php');
    exit();
  }
} else {
  if (isset($_SESSION['form'])) {
    $post = $_SESSION['form'];
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
    <form action="" method="POST">
      <h3>画像</h3>
      <div>
        <h3>画像ファイル名</h3>
        <input type="text" name="imgfile" value="<?php echo h($post['imgfile']); ?>">
      </div>
      <div>
        <h3>投稿日付</h3>
        <input type="date" name="date">
      </div>
      <div>
        <h3>タイトル</h3>
        <input type="text" name="title" value="<?php echo h($post['title']); ?>">
      </div>
      <div>
        <h3>コメント</h3>
        <textarea name="comment" id="" cols="70" rows="10"><?php echo h($post['comment']); ?></textarea>
      </div>
      <input type="submit" value="送信">
    </form>
  </main>
  <footer>
    <a href="../index.html">メインメニューへ</a>
  </footer>
</body>

</html>