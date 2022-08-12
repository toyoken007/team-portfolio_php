<?php 
require('library/library.php');

$db = dbconnect();
$stmt = $db->prepare('delete from blog_cms where id=?');
if (!$stmt) {
    die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$id) {
    echo 'ページが正しく指定されていません';
    exit();
}
$stmt->bind_param('i', $id);
$succes = $stmt->execute();
if (!$succes) {
    die($db->error);
}

header('Location: ../../blog/index.php');

?>