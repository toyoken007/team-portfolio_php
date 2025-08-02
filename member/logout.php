<?php
session_start();

unset($_SESSION['id']);

$_SESSION = array();

    if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
    }

    
// unset($_SESSION);
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(
//       session_name(),
//       '',
//       time() - 42000,
//       $params["path"],
//       $params["domain"],
//       $params["secure"],
//       $params["httponly"]
//     );
//   }

  // 最終的に、セッションを破壊する
  session_destroy();

header('Location: login.php');
