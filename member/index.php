<?php
session_start();
require('library/library.php');


if (isset($_GET['action']) && $_GET['action'] === 'rewrite' && isset($_SESSION['form'])) {
  $post = $_SESSION['from'];
} else {
  $post = [
    'name' => '',
    'email' => '',
    'password' => ''
  ];
}


$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  if ($post['name'] === '') {
    $error['name'] = 'blank';
  }

  $post['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  if ($post['email'] === '') {
    $error['email'] = 'blank';
  } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
    $error['email'] = 'email';
  } else {
    $db = dbconnect();
    $stmt = $db->prepare('select count(*) from member where email=?');
    if (!$stmt) {
      die($db->error);
    }
    $stmt->bind_param('s', $post['email']);
    $success = $stmt->execute();
    if (!$success) {
      die($db->error);
    }

    $stmt->bind_result($cnt);//true=1～, false=0
    $stmt->fetch();

    if ($cnt > 0) {
      $error['email'] = 'duplicate';
    }
  }
  $post['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  if ($post['password'] === '') {
    $error['password'] = 'blank';
  } elseif (strlen($post['password']) < 4) {
    $error['password'] = 'length';
  }

  if (count($error) === 0) {
    $_SESSION['form'] = $post;
    header('Location: check.php');
    exit();
  }
} else {
  if (isset($_SESSION['form'])) {
    $post = $_SESSION['form'];
  }
  
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMSメンバー登録</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>CMS管理メンバー登録画面</h1>
  </header>
  <main>
    <form action="" method="post">
      <div class="contact_wrap">
        <label for="name">名前</label><br>
        <input type="text" class="txt" name="name" value="<?php echo h($post['name']); ?>">
        <?php if (isset($error['name']) && $error['name'] === 'blank') : ?>
          <p class="error">*お名前を入力してください</p>
        <?php endif; ?>
      </div>
      <div class="contact_wrap">
        <label for="email">メールアドレス</label><br>
        <input type="text" class="txt" name="email" value="<?php echo h($post['email']); ?>">
        <?php if (isset($error['email']) && $error['email'] === 'blank') : ?>
          <p class="error">*メールアドレスを入力して下さい</p>
        <?php endif; ?>
        <?php if (isset($error['email']) && $error['email'] === 'duplicate') : ?>
          <p class="error">*指定されたメールアドレスは既に登録されています</p>
        <?php endif; ?>
      </div>
      <div class="contact_wrap">
        <label for="password">パスワード</label><br>
        <input type="password" class="txt" name="password" value="<?php echo h($post['password']); ?>">
        <?php if (isset($error['password']) && $error['password'] === 'blank') : ?>
          <p class="error">*パスワードを入力して下さい</p>
        <?php endif; ?>
        <?php if (isset($error['password']) && $error['password'] === 'length') : ?>
          <p class="error">*パスワードは4文字以上で入力して下さい</p>
        <?php endif; ?>
      </div>
      <input type="submit" value="送信">
    </form>
    <a href="login.php">ログイン画面へ</a>
  </main>
</body>

</html>