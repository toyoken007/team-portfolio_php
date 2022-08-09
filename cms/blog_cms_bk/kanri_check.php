<?php
session_start();
require('library/library.php');

// 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form'])) {
  header('Location: index.php');
  exit();
} else {
  $post = $_SESSION['form'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $db = dbconnect();
  if (!$db) {
    die($db->error);
  }
  $stmt = $db->prepare('insert into blog_cms (imgfile, date, title, comment) VALUES (?, ?, ?, ?)');
  if (!$stmt) {
    die($db->error);
  }
  $stmt->bind_param('ssss', $post['imgfile'], $post['date'], $post['title'], $post['comment']);
  $success = $stmt->execute();
  if (!$success) {
    die($db->error);
  }

  unset($_SESSION['form']);
  header('Location: ok.html');
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理確認画面</title>
</head>

<body>
  <header>
    <h1>確認画面</h1>
  </header>
  <main>
    <div class="content">
      <div class="content_h2">
        <h2>記入した内容を確認して、「送信ボタン」を入力してください。</h2>
      </div>
      <div class="form_kakunin">
        <form action="" method="post">
          <input type="hidden" name="action" value="submit">
          <table>
            <tr>
            <th>
                <p>画像ファイル名 : </p>
              </th>
              <td>
                <?php echo h($post['imgfile']); ?>
              </td>
            </tr>
            <tr>
            <th>
                <p>投稿日付 : </p>
              </th>
              <td>
                <?php echo h($post['date']); ?>
              </td>
            </tr>
            <tr>
            <th>
                <p>タイトル : </p>
              </th>
              <td>
                <?php echo h($post['title']); ?>
              </td>
            </tr>
            <th>
                <p>タイトル : </p>
              </th>
              <td>
                <?php echo h($post['comment']); ?>
              </td>
            </tr>
          </table>
          <div class="botan">
            <div class="back">
              <a href="index.php" class="a">戻る</a>
            </div>
            <div class="next">
              <input type="submit" vuleu="送信">
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>