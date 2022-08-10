<?php
require('library/library.php');

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