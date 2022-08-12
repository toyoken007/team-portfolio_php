<?php
session_start();
require('library/library.php');
var_dump($_SESSION);
// 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form']) && !isset($_SESSION['category'])) {
  header('Location: index.php');
  exit();
} else {
  $id = $_SESSION['id'];
  $category = $_SESSION['category'];
  $imgfile = $_SESSION['imgfile'];
  $date = $_SESSION['date'];
  $title = $_SESSION['title'];
  $comment = $_SESSION['comment'];
  // $post['category'] = $_SESSION['category'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $category = serialize($category);

  $db = dbconnect();
  $stmt = $db->prepare('update blog_cms set category=?, imgfile=?, date=?, title=?, comment=? where id=?');
  if (!$stmt) {
    die($db->error);
  }
  // $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  // $post['category'] = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
  // $poat['imgfile'] = filter_input(INPUT_POST, 'imgfile', FILTER_SANITIZE_STRING);
  // $post['date'] = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
  // $post['title'] = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  // $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
  $stmt->bind_param('sssssi', $category, $imgfile, $date, $title, $comment, $id);
  $success = $stmt->execute();
  if (!$success) {
    die($db->error);
  }

  unset($_SESSION['form']);
  unset($_SESSION['category']);
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
                <p>カテゴリー : </p>
              </th>
              <td>
                <?php
                foreach ($category as $key => $value) {
                  echo "<li>" . $value . "</li>";
                }
                ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>画像ファイル名 : </p>
              </th>
              <td>
                <?php echo h($imgfile); ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>投稿日付 : </p>
              </th>
              <td>
                <?php echo h($date); ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>タイトル : </p>
              </th>
              <td>
                <?php echo h($title); ?>
              </td>
            </tr>
            <th>
              <p>タイトル : </p>
            </th>
            <td>
              <?php echo h($comment); ?>
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