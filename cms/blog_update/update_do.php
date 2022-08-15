<?php
session_start();

require('../../library/library.php');

$id = $_SESSION['id'];
$category = $_SESSION['category'];
$imgfile = $_SESSION['form']['imgfile'];
$date = $_SESSION['date'];
$title = $_SESSION['title'];
$comment = $_SESSION['comment'];
$category = serialize($category);

$db = dbconnect();
$stmt = $db->prepare('update blog_cms set category=?, imgfile=?, date=?, title=?, comment=? where id=?');
if (!$stmt) {
    die($db->error);
}
$stmt->bind_param('sssssi', $category, $imgfile, $date, $title, $comment, $id);
$success = $stmt->execute();
if (!$success) {
    die($db->error);
}

header('Location: ../../blogpage/index.php?id=' . $id);
