<?php
session_start();
require('../../library/library.php');

$id = $_SESSION['id'];
$imgfile = $_SESSION['form']['imgfile'];
$date = $_SESSION['date'];
$title = $_SESSION['title'];
$comment = $_SESSION['comment'];

$db = dbconnect();
$stmt = $db->prepare('update news_cms set imgfile=?, date=?, title=?, comment=? where id=?');
if (!$stmt) {
    die($db->error);
}
$stmt->bind_param('ssssi', $imgfile, $date, $title, $comment, $id);
$success = $stmt->execute();
if (!$success) {
    die($db->error);
}

unset($_SESSION);
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),
      '',
      time() - 42000,
      $params["path"],
      $params["domain"],
      $params["secure"],
      $params["httponly"]
    );
  }

  // 最終的に、セッションを破壊する
  session_destroy();
  header('Location: ok.html');
  exit();
header('Location: ../../newspage/index.php?id=' . $id);
?>

