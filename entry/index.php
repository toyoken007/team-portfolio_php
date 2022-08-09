<?php
session_start();

function h($value)
{
  return htmlspecialchars($value, ENT_QUOTES);
}



$post = [
  'name' => '',
  'kana'  => '',
  'sex' => '',
  'postcord' => '',
  'addres'  => '',
  'tell' => '',
  'email' => '',
  'question' => ''
];

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  if ($post['name'] === '') {
    $error['name'] = 'blank';
  }

  $post['kana'] = filter_input(INPUT_POST, 'kana', FILTER_SANITIZE_STRING);
  if ($post['kana'] === '') {
    $error['kana'] = 'blank';
  }

  $post['sex'] = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING);
  if ($post['sex'] === '') {
    $error['sex'] = 'blank';
  }

  $post['postcord'] = filter_input(INPUT_POST, 'postcord', FILTER_SANITIZE_STRING);
  if ($post['postcord'] === '') {
    $post['postcord'] = '';
  }

  $post['addres'] = filter_input(INPUT_POST, 'addres', FILTER_SANITIZE_STRING);
  if ($post['addres'] === '') {
    $error['addres'] = 'blank';
  }

  $post['tell'] = filter_input(INPUT_POST, 'tell', FILTER_SANITIZE_STRING);
  if ($post['tell'] === '') {
    $error['tell'] = 'blank';
  }

  $post['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  if ($post['email'] === '') {
    $error['email'] = 'blank';
  } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
    $error['email'] = 'email';
  }

  $post['question'] = filter_input(INPUT_POST, 'question');
  if ($post['question'] === '') {
    $post['question'] = '';
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

if ($post['sex'] === '男性') {
  $men = 'check';
} else {
  $men = '';
}
if ($post['sex'] === '女性') {
  $women = 'check';
} else {
  $women = '';
}
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
    <h1>Entry form</h1>
  </header>
  <main>
    <div class="annai">
      <p>必要事項をご入力の上、確認ボタンを押してください。<br>
        内容を確認し、担当よりご連絡させていただきます。</p>
    </div>
    <div class="required">
      <p><span>※</span>は入力必須項目です。</p>
    </div>

    <div class="form">
      <form action="" method="post">
        <div>
          <table>
            <tr>
              <th>
                <p><span>*</span>お名前</p>
              </th>
              <td>
                <input type="text" name="name" value="<?php echo h($post['name']); ?>">
                <?php if (isset($error['name']) && $error['name'] === 'blank') : ?>
                  <p class="error">*お名前を入力してください。</p>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>
                <p><span>*</span>フリガナ</p>
              </th>
              <td>
                <input type="text" name="kana" value="<?php echo h($post['kana']); ?>">
                <?php if (isset($error['kana']) && $error['kana'] === 'blank') : ?>
                  <p class="error">*フリガナを入力してください。</p>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>
                <p><span>*</span>性別</p>
              </th>
              <td class="sex">
                <input class="sex" type="radio" name="sex" value="男性" <?php if($men === 'check') echo 'checked' ?>> <span>男性</span><br>
                <input class="sex" type="radio" name="sex" value="女性" <?php if($women === 'check') echo 'checked' ?>> <sapn>女性</span>
                  <?php if (isset($error['sex']) && $error['sex'] === 'blank') : ?>
                    <p class="error">*性別を選んでください</p>
                  <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>郵便番号</p>
              </th>
              <td>
                <input type="text" name="postcord" value="<?php echo h($post['postcord']); ?>">
              </td>
            </tr>
            <tr>
              <th>
                <p><span>*</span>住所</p>
              </th>
              <td>
                <input type="text" name="addres" value="<?php echo h($post['addres']); ?>">
                <?php if (isset($error['addres']) && $error['addres'] === 'blank') : ?>
                  <p class="error">*住所を入力してください。</p>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>
                <p><span>*</span>電話番号</p>
              </th>
              <td>
                <input type="text" name="tell" value="<?php echo h($post['tell']); ?>">
                <?php if (isset($error['tell']) && $error['tell'] === 'blank') : ?>
                  <p class="error">*電話番号を入力してください。</p>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>
                <p><span>*</span>メールアドレス</p>
              </th>
              <td>
                <input type="email" name="email" value="<?php echo h($post['email']); ?>">
                <?php if (isset($error['email']) && $error['email'] === 'blank') : ?>
                  <p class="error">*メールアドレスを入力して下さい</p>
                <?php endif; ?>
                <?php if (isset($error['email']) && $error['email'] === 'email') : ?>
                  <p class="error">*メールアドレスを正しく入力して下さい</p>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>
                <p>備考・ご質問等</p>
              </th>
              <td>
                <textarea name="question" id="" cols="60" rows="15"><?php echo h($post['question']); ?></textarea>
              </td>
            </tr>
          </table>
        </div>
        <div class="submitbox">
          <input type="submit" value="送信内容の確認" class="submit">
        </div>
      </form>
    </div>
  </main>

</body>

</html>