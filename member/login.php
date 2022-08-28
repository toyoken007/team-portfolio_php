<?php 
session_start();
require('library/library.php');
$error = [];
$email = '';
$password = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	if ($email === '' || $password === '') {
		$error['login'] = 'blank';
	} else {
		// ログインチェック
		$db = dbconnect();
		$stmt = $db->prepare('select id, name, password from member where email=? limit 1');
		if (!$stmt) {
			die($db->error);
		}

		$stmt->bind_param('s', $email);
		$success = $stmt->execute();
		if (!$stmt) {
			die($db->error);
		}


		$stmt->bind_result($id, $name, $hash);
		$stmt->fetch();

		if (password_verify($password, $hash)) {
			// ログイン成功
			session_regenerate_id();
			$_SESSION['id'] = $id;

			header('Location: ../cms/index.php');
			exit();
		} else {
			$error['login'] = 'failed';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ログイン画面</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<header>
		<h1>ログイン画面</h1>
	</header>
	<main>
		<form action="" method="post">
			<div>
				<p>メールアドレス</p>
				<input type="text" name="email" value="<?php echo h($email); ?>">
				<?php if (isset($error['login']) && $error['login'] === 'blank'): ?>
				<p>*メールアドレスとパスワードを入力してください</p>
				<?php endif; ?>
				<?php if (isset($error['login']) && $error['login'] === 'failed'): ?>
				<p>*ログインに失敗しました。正しくご記入ください</p>
				<?php endif; ?>
			</div>
			<div>
				<p>パスワード</p>
				<input type="text" name="password" value="<?php echo h($password); ?>">
			</div>
			<div>
				<input type="submit" value="ログインする">
			</div>
		</form>
		<a href="index.php">会員登録画面へ</a>
		<br>
		<a href="../index.php">ホームページのトップへ</a>
	</main>
</body>

</html>