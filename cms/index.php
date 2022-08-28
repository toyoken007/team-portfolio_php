<?php 
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: ../member/login.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS管理画面</title>
</head>
<body>
  <header>
    <h1>Demosite Hear TOYOサイトの管理ページ</h1>
  </header>
  <main>
    <ul>
      <li><a href="news_cms/index.php">News追加ページへ</a></li>
      <li><a href="blog_cms/index.php">blog追加画面へ</a></li>
      <li><a href="reserve_cms/index.php">reserve追加画面へ</a></li>
    </ul>
    <br>
    <a href="../index.php">ホームページのトップへ</a>
    <br>
    <a href="../member/logout.php">ログアウト</a>
  </main>
</body>
</html>
