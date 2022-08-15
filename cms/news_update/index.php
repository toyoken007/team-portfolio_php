<?php
session_start();
require('../../library/library.php');

$db = dbconnect();
$stmt = $db->prepare('select * from news_cms where id=?');
if (!$stmt) {
  die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$stmt->bind_param('i', $id);
$stmt->execute();

$stmt->bind_result($id, $imgfile, $date, $title, $comment);
$result = $stmt->fetch();
if (!$result) {
  die('Newsの指定が正しくありません');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // $imgfile = filter_input(INPUT_POST, 'imgfile', FILTER_SANITIZE_STRING);
  // // if ($post['imgfile'] === '') {
  // //   $error['imgfile'] = 'blank';
  // // }

  // $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
  // // if ($post['date'] === '') {
  // //   $error['date'] = 'blank';
  // // }

  // $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  // // if ($post['title'] === '') {
  // //   $error['title'] = 'blank';
  // // }

  // $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
  // if ($post['comment'] === '') {
  //   $error['comment'] = 'blank';
  // }

  $imgfile = $_FILES['imgfile'];
  if ($imgfile['name'] !== '' && $imgfile['error'] === 0) {
    $type = mime_content_type($imgfile['tmp_name']);
    if ($type !== 'image/png' && $type !== 'image/jpeg') {
      $error['image'] = 'type';
    }
  }


  $_SESSION['date'] = $_POST['date'];
  $_SESSION['title'] = $_POST['title'];
  $_SESSION['comment'] = $_POST['comment'];
  $_SESSION['id'] = $_POST['id'];


  if ($imgfile !== '') {
    $filename = date('YmdHis') . '_' . $imgfile['name'];
    if (!move_uploaded_file($imgfile['tmp_name'], '../cms_picture/' . $filename)) {
      die('ファイルのアップロードに失敗しました');
    }
    $_SESSION['form']['imgfile'] = $filename;
  } else {
    $_SESSION['form']['imgfile'] = '';
  }


  // var_dump($comment);
  // var_dump($_SESSION['form']['imgfile']);
  // $_SESSION['form'] = $post;
  header('Location: update_do.php');
  // exit();
  // unset($comment);

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
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <h3>画像</h3>
      <div>
        <h3>画像ファイル名</h3>
        <input type="file" name="imgfile" value="<?php echo h($imgfile); ?>">
        <p style="margin: 0; color: red;">※恐れ入りますが改めて画像の指定してください。</p>
      </div>
      <div>
        <h3>投稿日付</h3>
        <input type="date" name="date" value="<?php echo h($date); ?>">
      </div>
      <div>
        <h3>タイトル</h3>
        <input type="text" name="title" value="<?php echo h($title); ?>">
      </div>
      <div>
        <h3>コメント</h3>
        <textarea name="comment" id="" cols="70" rows="10"><?php echo h($comment); ?></textarea>
      </div>
      <input type="submit" value="編集送信">
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