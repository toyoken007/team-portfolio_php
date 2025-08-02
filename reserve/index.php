<?php
session_start();
require('../library/library.php');

if (!isset($_SESSION['id'])) {
  $_SESSION['id'] = '';
}

if (!isset($hearmenu)) {
  $hearmenu = '';
}

$db = dbconnect();
$stmt = $db->prepare('select id from member');
if (!$stmt) {
  die($db->error);
}
$succes = $stmt->execute();
if (!$succes) {
  die($db->error);
}

$stmt->bind_result($id);
$stmt->fetch();

$member_id = $id;


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);



?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="description">
  <meta name="keywords">
  <meta name="author" content="">
  <meta property="og:title" content="title">
  <meta property="og:type" content="website">
  <meta property="og:url" content="http://#{metas.url}">
  <meta property="og:image" content="http://#{metas.image}/og_image.png">
  <meta property="og:site_name" content="ネット予約ページ">
  <meta property="og:description" content="description">
  <meta property="fb:app_id" content="任意のID">
  <title>Reserve</title>
  <link rel="stylesheet" href="../css/style.css">
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-XXXXXXXX-Y', 'example.com');
    ga('send', 'pageview');
  </script>
</head>

<body>
  <header class="reserve_header">
    <div class="header_wrap">
      <div class="header_top">
        <a href="../index.php">
          <p>Demosite Hair<span class="header_red">TOYO</span></p>
        </a>
      </div>
      <nav class="nav">
        <ul class="list-menu">
          <li><a href="../concept/index.html">Concept</a>
          </li>
          <li><a href="../menu/index.html">Menu</a>
          </li>
          <li><a href="../about/index.html">About</a>
          </li>
          <li><a href="../gallery/index.html">Gallery </a>
          </li>
          <li><a href="../recruit/index.html">Recruit </a>
          </li>
          <li><a href="../contact/index.html">Contact </a>
          </li>
          <li><a href="../reserve/index.php">Reserve </a>
          </li>
          <?php
          // $db = dbconnect();
          // $stmt = $db->prepare('select id from member');
          // if (!$stmt) {
          //   die($db->error);
          // }
          // $succes = $stmt->execute();
          // if (!$succes) {
          //   die($db->error);
          // }

          // $stmt->bind_result($id);
          // $stmt->fetch();

          // if ($_SESSION['id'] === $id) :
          if ($_SESSION['id']) :
          ?>
            <div class="cms_top">
              <a href="../cms/index.php">管理画面</a>
            </div>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>
  <main id="reserve_body">
    <p class="header_txt">Demosite Hair TOYO【デモサイト ヘアー マーダ】　ネット予約ページ</p>
    <section class="shop_wrap" id="shop_wrap">
      <ul class="detail_wrap">
        <li class="shop_img"><img src="https://placehold.jp/150x150.png" alt="ダミー画像"></li>
        <li class="shop_detail">
          <h1>Demosite Hair TOYO【デモサイト ヘアー トヨ】</h1><small>デモサイトヘアートヨ</small>
          <div class="tags">即時予約OK</div>
          <p class="address">熊本県人吉市中青井町<br>人吉駅徒歩９９分</p>
        </li>
      </ul>
    </section>
    <div class="notes">
      <p>※即時予約は、予約完了時点で予約が確定します。そのままご来店ください。</p>
    </div>
    <div class="step_list">
      <ul>
        <li class="steps_item"><span class="icons"></span>
          <ul class="list_txt active_items">
            <li class="step_num">STEP1</li>
            <li>クーポン・メニューを選ぶ</li>
          </ul>
        </li>
        <li class="steps_item"><span class="icons"></span>
          <ul class="list_txt">
            <li class="step_num">STEP2</li>
            <li>日時を指定する</li>
          </ul>
        </li>
        <li class="steps_item">
          <ul class="list_txt">
            <li class="step_num">STEP3</li>
            <li>お客様情報入力</li>
          </ul>
        </li>
        <li class="steps_item">
          <ul class="list_txt">
            <li class="step_num">STEP4</li>
            <li>予約内容の確認</li>
          </ul>
        </li>
        <li class="steps_item">
          <ul class="list_txt">
            <li class="finish_step">登録完了</li>
          </ul>
        </li>
      </ul>
    </div>
    <section class="shop_list_deta" id="shop_list_deta">
      <ul class="shop_card_list">
        <?php
        $db = dbconnect();
        $counts = $db->query('select count(*) as cnt from news_cms');
        $count = $counts->fetch_assoc();
        $max_page = floor(($count['cnt'] + 1) / 12 + 1);

        $stmt = $db->prepare('select id, uketuke, hearmenu, nedan, title, imgfile, comment, jouken, stylist, sonota from reserve_cms order by id desc limit ?, 10');
        if (!$stmt) {
          die($db->error);
        }
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
        $page = ($page ?: 1);
        $start = ($page - 1) * 10;
        $stmt->bind_param('i', $start);
        $succes = $stmt->execute();
        if (!$succes) {
          die($db->error);
        }
        $stmt->bind_result($id, $uketuke, $hearmenu, $nedan, $title, $imgfile, $comment, $jouken, $stylist, $sonota);
        while ($stmt->fetch()) :

          $hearmenu = unserialize($hearmenu);

        ?>
          <li class="card_lists">
            <ul class="list_inner">
              <li class="new"><?php echo h($uketuke); ?></li>
              <li class="inner_items">
                <ul class="items_section">
                  <li class="section_head">
                    <ul class="head_list">
                      <li class="list_tags">
                        <?php foreach ($hearmenu as $value) : ?>
                          <p class="tag"><?php echo h($value); ?></p>
                        <?php endforeach; ?>
                      </li>
                      <li class="price">¥<?php echo h($nedan); ?></li>
                    </ul>
                  </li>
                  <li class="section_title">
                    <h3><?php echo h($title); ?></h3>
                  </li>
                  <li class="section_detail">
                    <ul class="detail_datas">
                      <li class="data_image"><img src="../cms/cms_picture/<?php echo h($imgfile); ?>" alt=""></li>
                      <li class="data_txt">
                        <p class="txt_cap"><?php echo h($comment); ?></p>
                        <div class="txt_conditions">
                          <p class="conditions_txt"><span>来店日条件：</span><?php echo h($jouken); ?></p>
                          <p class="conditions_txt"><span>対象スタイリスト：</span><?php echo h($stylist); ?></p>
                          <p class="conditions_txt"><span>その他条件：</span><?php echo h($sonota); ?></p>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="reserve">
                <ul class="reserve_inner">
                  <?php
                  if ($_SESSION['id']) :
                  ?>
                    <div class="edit_wrap">
                      <div class="edit_box">
                        <a href="../cms/reserve_update/index.php?id=<?php echo $id; ?>">編集</a>
                      </div>
                      <div class="edit_box">
                        <a href="../cms/reserve_delete/index.php?id=<?php echo $id; ?>">削除</a>
                      </div>
                    </div>
                  <?php endif; ?>

                  <li class="inner_coupon_btn"><a href="">このクーポンで<br>空席確認・予約する</a></li>
                  <li class="inner_addition_btn"><a href="">メニューを追加して予約</a></li>
                </ul>
              </li>
            </ul>
          </li>
        <?php endwhile; ?>
      </ul>
    </section>
  </main>
  <footer class="reserve_footer">
    <div class="contact_wrap">
      <div class="contact_box">
        <p>Demosite Hair TOYO </p>
        <div class="list_box">
          <div class="list"><a href="../concept/index.html">Concept</a><a href="../menu/index.html">Menu</a><a href="../about/index.html">About</a></div>
          <div class="list"><a href="../recruit/index.html">Recruit</a><a href="../contact/index.html">Contact</a><a href="">Privacy policy</a></div>
          <div class="list"><a href="../news/index.php">News</a><a href="../gallery/index.html">Gallery</a><a href="../blog/index.php">Blog </a></div>
        </div>
        <div class="copyright">
          <p>&copy; 2022 Demosite Hair TOYO</p>
        </div>
      </div>
    </div>
    <div class="contact">
      <div class="contact_box">
        <h4>Contact </h4>
        <p class="contact_comment">ご予約は全て電話にて承っております。</p>お気軽にご連絡くださいませ。
        <p class="tel">TEL:038-○○○-××××</p>営業時間：09:30～19:30
      </div>
    </div>
  </footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
  <script>
    (window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>'));
  </script>
  <script src="../js/main.js"></script>
  <script src="../js/slick_slide.js"></script>
</body>

</html>