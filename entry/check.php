<?php
session_start();

function h($value)
{
  return htmlspecialchars($value, ENT_QUOTES);
}

if (!isset($_SESSION['form'])) {
  header('Location: index.php');
  exit();
} else {
  $post = $_SESSION['form'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  unset($_SESSION['form']);
  header('Location: thanks.html');
  exit();
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   // メールを送信する
//   $to = 'toyoken007@gmail.com';
//   $from = $post['email'];
//   $subject = 'お問い合わせが届きました';
//   $body = <<<EOT
// 名前：{$post['name']}
// メールアドレス：{$post['email']}
// 内容：
// {$post['name']}
// {$post['kana']}
// {$post['sex']}
// {$post['addres']}
// {$post['tell']}
// {$post['question']}
// EOT;
//   mb_send_mail($to, $subject, $body, "From: {$post}");

//   unset($_SESSION['form']);
//   header('Location: thanks.html');
//   exit();
// }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エントリーフォーム</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <h1>送信内容の確認</h1>
  </header>
  <main class="check_page">
    <div class="annai">
      <p>必要事項を確認の上、送信ボタンを押してください。<br>
        内容を確認し、担当よりご連絡させていただきます。</p>
    </div>


    <div class="form">
      <form action="" method="post">
        <div>
          <table>
            <tr>
              <th>
                <p>お名前</p>
              </th>
              <td>
                <p><?php echo h($post['name']); ?></p>
              </td>
            </tr>
            <tr>
              <th>
                <p>フリガナ</p>
              </th>
              <td>
                <p><?php echo h($post['kana']); ?></p>
              </td>
            </tr>
            <tr>
              <th>
                <p>性別</p>
              </th>
              <td class="sex">
                <p><?php echo h($post['sex']); ?></p>
              </td>
            </tr>
            <tr>
              <th>
                <p>郵便番号</p>
              </th>
              <td>
                <p><?php echo h($post['postcord']); ?></p>
              </td>
            </tr>
            <tr>
              <th>
                <p>住所</p>
              </th>
              <td>
                <p><?php echo h($post['addres']); ?></p>
              </td>
            </tr>
            <tr>
              <th>
                <p>電話番号</p>
              </th>
              <td>
                <p><?php echo h($post['tell']); ?></p>
              </td>
            </tr>
            <tr>
              <th>
                <p>メールアドレス</p>
              </th>
              <td>
                <p><?php echo h($post['email']); ?></p>
              </td>
            </tr>
            <tr>
              <th>
                <p>備考・ご質問等</p>
              </th>
              <td>
                <p><?php echo h($post['question']); ?></p>
              </td>
            </tr>
          </table>
        </div>
        <div class="botan">
          <div class="back">
            <a href="index.php" class="modoru">戻る</a>
          </div>
          <div class="next">
            <input type="submit" vuleu="送信">
          </div>
        </div>
      </form>
    </div>
    <div class="tyui">
      <p>※ページは飛びますが送信機能を止めています</p>
    </div>

  </main>

</body>

</html>