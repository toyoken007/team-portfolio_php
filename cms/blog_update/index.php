<?php
require('library/library.php');

$db = dbconnect();
$stmt = $db->prepare('select * from blog_cms where id=?');
if (!$stmt) {
  die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$stmt->bind_param('i', $id);
$stmt->execute();

$stmt->bind_result($id, $category, $imgfile, $date, $title, $comment);
$result = $stmt->fetch();
if (!$result) {
  die('Blogの指定が正しくありません');
}
$category = unserialize($category);

if (is_array($category)) {

  foreach ($category as $key => $value) {
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
    <form action="update_do.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
      <h3>画像</h3>
      <div>
        <h3>画像ファイル名</h3>
        <input type="text" name="imgfile" value="<?php echo h($imgfile); ?>">
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