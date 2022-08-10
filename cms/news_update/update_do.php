<?php
require('library/library.php');

$db = dbconnect();
$stmt = $db->prepare('update news_cms set imgfile=?, date=?, title=?, comment=? where id=?');
if (!$stmt) {
    die($db->error);
}
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$imgfile = filter_input(INPUT_POST, 'imgfile', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
$stmt->bind_param('ssssi', $imgfile, $date, $title, $comment, $id);
$success = $stmt->execute();
if (!$success) {
    die($db->error);
}

header('Location: ../../newspage/index.php?id=' . $id);
?>

