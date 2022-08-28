<?php
session_start();

require('library/library.php');

if (!isset($_SESSION['form'])) {
	header('Location: index.php');
	exit();
} else {
	$post = $_SESSION['form'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$db = dbconnect();
	if (!$db) {
		die($db->error);
	}
	$stmt = $db->prepare('insert into member (name, email, password) VALUES (?, ?, ?)');
	if (!$stmt) {
		die($db->error);
	}
	$password = password_hash($post['password'], PASSWORD_DEFAULT); //パスワード暗号化
	$stmt->bind_param('sss', $post['name'], $post['email'], $password);
	$success = $stmt->execute();
	if (!$success) {
		die($db->error);
	}


	unset($_SESSION['form']);
	header('Location: thanks.html');
	exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>確認画面</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<header>
		<h1>確認画面</h1>
	</header>
	<main>
		<div class="content">
			<div class="content_h2">
				<h2>記入した内容を確認して、「送信ボタン」を入力してください。</h2>
			</div>
			<div class="form_kakunin">
				<form action="" method="post">
					<input type="hidden" name="action" value="submit">
					<table>
						<tr>
							<th>
								<p>名前 : </p>
							</th>
							<td><?php echo h($post['name']); ?></td>
						</tr>
						<tr>
							<th>
								<p>メールアドレス : </p>
							</th>
							<td><?php echo h($post['email']); ?></td>
						</tr>
						<tr>
							<th>
								<p>お問い合わせ内容 : </p>
							</th>
							<td><?php echo h($post['password']); ?></td>
						</tr>
					</table>
					<div class="botan">
						<div class="back">
							<a href="index.php?action=rewrite">戻る</a>
						</div>
						<div class="next">
							<input type="submit" vuleu="送信">
						</div>
					</div>
				</form>
			</div>
		</div>
	</main>
</body>

</html>