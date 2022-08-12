<?php
session_start();

require('library/library.php');


$id = $_SESSION['id'];
$uketuke = $_SESSION['uketuke'];
$hearmenu = $_SESSION['hearmenu'];
$nedan = $_SESSION['nedan'];
$title = $_SESSION['title'];
$imgfile = $_SESSION['imgfile'];
$comment = $_SESSION['comment'];
$jouken = $_SESSION['jouken'];
$stylist = $_SESSION['stylist'];
$sonota = $_SESSION['sonota'];
$hearmenu = serialize($hearmenu);


$db = dbconnect();
$stmt = $db->prepare('update reserve_cms set uketuke=?, hearmenu=?, nedan=?, title=?, imgfile=? ,comment=?, jouken=?, stylist=?, sonota=? where id=?');
if (!$stmt) {
    die($db->error);
}
$stmt->bind_param('sssssssssi', $uketuke, $hearmenu, $nedan, $title, $imgfile, $comment, $jouken, $stylist, $sonota, $id);
$success = $stmt->execute();
if (!$success) {
    die($db->error);
}


header('Location: ../../reserve/index.php?id=' . $id);
