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

header('Location: ../../newspage/index.php?id=' . $id);
?>

