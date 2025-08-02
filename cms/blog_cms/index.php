<?php
session_start();
require('../../library/library.php');

$post = [
  'category' => '',
  'imgfile' => '',
  'date' => '',
  'title' => '',
  'comment' => ''
];

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post['category'] = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
  if (!isset($_POST['category']) || $_POST['category'] === '') {
    $error['category'] = 'blank';
  }

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


  //  画像のチェック
  $imgfile = $_FILES['imgfile'];
  if ($imgfile['name'] !== '' && $imgfile['error'] === 0) {
    $type = mime_content_type($imgfile['tmp_name']);
    if ($type !== 'image/png' && $type !== 'image/jpeg') {
      $error['image'] = 'type';
    }
  }


  if (count($error) === 0) {
    $_SESSION['category'] = $_POST['category'];
    $_SESSION['form'] = $post;

    // 画像のアップロード
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
  if (isset($_SESSION['form']) && isset($_SESSION['category'])) {
    $post = $_SESSION['form'];
    $post['category'] = $_SESSION['category'];

    if (is_array($post['category'])) {

      foreach ($post['category'] as $key => $value) {
        if ($value == 'News') {
          $chk1 = 'checked';
        }
        if ($value == 'お客様の髪の未来を守る') {
          $chk2 = 'checked';
        }
        if ($value == 'ブログ') {
          $chk3 = 'checked';
        }
        if ($value == '育毛') {
          $chk4 = 'checked';
        }
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
    <form action="" method="POST" enctype="multipart/form-data">
      <div>
        <h3>カテゴリー</h3>
        <input type="checkbox" name="category[]" value="News" <?php if (isset($chk1)) {
                                                                echo $chk1;
                                                              } ?>>News
        <input type="checkbox" name="category[]" value="お客様の髪の未来を守る" <?php if (isset($chk2)) {
                                                                        echo $chk2;
                                                                      } ?>>お客様の髪の未来を守る
        <input type="checkbox" name="category[]" value="ブログ" <?php if (isset($chk3)) {
                                                                echo $chk3;
                                                              } ?>>ブログ
        <input type="checkbox" name="category[]" value="育毛" <?php if (isset($chk4)) {
                                                              echo $chk4;
                                                            } ?>>育毛
      </div>
      <div>
        <h3>投稿日付</h3>
        <input type="date" name="date" value="<?php echo h($post['date']); ?>">
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
      <input type="submit" value="送信">
    </form>
  </main>
  <footer>
    <div style="margin-top: 50px">
      <a href="../index.php">メインメニューへ</a>
    </div>
    <div style="margin: 50px 0">
      <a href="../../blog/index.php">Blogページへ</a>
    </div>
  </footer>
</body>

</html>