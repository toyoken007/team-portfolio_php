<?php
session_start();
require('../../library/library.php');

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

  $imgfile = $_FILES['imgfile'];
  if ($imgfile['name'] !== '' && $imgfile['error'] === 0) {
    $type = mime_content_type($imgfile['tmp_name']);
    if ($type !== 'image/png' && $type !== 'image/jpeg') {
      $error['image'] = 'type';
    }
  }


  if (count($error) === 0) {
    $_SESSION['form'] = $post;

    if ($imgfile !== '') {
      $filename = date('YmdHis') . '_' . $imgfile['name'];
      if (!move_uploaded_file($imgfile['tmp_name'], '../cms_picture/' . $filename)) {
        die('ファイルのアップロードに失敗しました');
      }
      $_SESSION['form']['imgfile'] = $filename;
    } else {
      $_SESSION['form']['imgfile'] = '';
    }
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
    <form action="" method="POST" enctype="multipart/form-data">
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
      <h3>画像</h3>
      <div>
        <h3>画像ファイル名</h3>
        <input type="file" name="imgfile" value="<?php echo h($post['imgfile']); ?>">
      </div>
      <br>
      <input type="submit" value="送信">
    </form>
  </main>
  <footer>
    <div style="margin-top: 50px">
      <a href="../index.html">メインメニューへ</a>
    </div>
    <div style="margin: 50px 0">
      <a href="../../news/index.php">Newsページへ</a>
    </div>
  </footer>
</body>

</html>