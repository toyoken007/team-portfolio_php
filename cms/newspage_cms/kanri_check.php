<?php
session_start();
require('../../library/library.php');

// 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form']) && !isset($_SESSION['hearmenu'])) {
  header('Location: index.php');
  exit();
} else {
  $post = $_SESSION['form'];
  $post['hearmenu'] = $_SESSION['hearmenu'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $hearmenu = serialize($post['hearmenu']);

  $db = dbconnect();
  if (!$db) {
    die($db->error);
  }
  $stmt = $db->prepare('insert into cms (uketuke, hearmenu, nedan, title, imgfile, comment, jouken, stylist, sonota) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
  if (!$stmt) {
    die($db->error);
  }
  $stmt->bind_param('sssssssss', $post['uketuke'], $hearmenu, $post['nedan'], $post['title'], $post['imgfile'], $post['comment'], $post['jouken'], $post['stylist'], $post['sonota']);
  $success = $stmt->execute();
  if (!$success) {
    die($db->error);
  }

  unset($_SESSION['form']);
  unset($_SESSION['hearmenu']);
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
                <p>新規・再来・全員 : </p>
              </th>
              <td>
                <?php echo h($post['uketuke']); ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>ヘアーメニュー : </p>
              </th>
              <td>
                <?php
                foreach ($post['hearmenu'] as $key => $value) {
                  echo "<li>" . $value . "</li>";
                }
                ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>値段・割引 : </p>
              </th>
              <td>
                <?php echo h($post['nedan']); ?>
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
                <p>コメント : </p>
              </th>
              <td>
                <?php echo h($post['comment']); ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>来店日条件 : </p>
              </th>
              <td>
                <?php echo h($post['jouken']); ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>対象スタイリスト : </p>
              </th>
              <td>
                <?php echo h($post['stylist']); ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>その他条件 : </p>
              </th>
              <td>
                <?php echo h($post['sonota']); ?>
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