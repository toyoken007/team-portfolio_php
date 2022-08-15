<?php 
session_start();
// var_dump($_SESSION['category']);
$category = serialize($_SESSION['category']);
// $category = $_SESSION['category'];
// $imgfile = $_SESSION['imgfile'];
// $date = $_SESSION['date'];
// $title = $_SESSION['title'];
// $comment = $_SESSION['comment'];
// // $post = $_SESSION['form'];
var_dump($category);
var_dump($_SESSION['imgfile']);
var_dump($_SESSION['date']);
var_dump($_SESSION['title']);
var_dump($_SESSION['comment']);

// unset($_SESSION['category']);
// unset($_SESSION['imgfile']);
// unset($_SESSION['date']);
// unset($_SESSION['title']);
// unset($_SESSION['comment']);






?>