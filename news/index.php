<?php
require('../library/library.php');

$db = dbconnect();

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
  <meta property="og:site_name" content="site_name">
  <meta property="og:description" content="description">
  <meta property="fb:app_id" content="任意のID">
  <title>News</title>
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
  <header class="header">
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
          <li><a href="../cms/index.html">管理画面 </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <main class="news_page">
    <div class="news_wrap">
      <div class="news_h1">
        <h1>News</h1>
      </div>
      <div class="news_image"> <img src="https://placehold.jp/964x369.png" alt="ギャラリーのイメージ画像"></div>
    </div>
    <div class="news_wrapwrap">
      <div class="news_list">
        <?php
        $counts = $db->query('select count(*) as cnt from news_cms');
        $count = $counts->fetch_assoc();
        $max_page = floor(($count['cnt'] + 1) / 12 + 1);

        $stmt = $db->prepare('select id, imgfile, date, title from news_cms order by id desc limit ?, 10');
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
        $stmt->bind_result($id, $imgfile, $date, $title);
        while ($stmt->fetch()) :

        ?>
          <div class="news_box">
            <div class="news_img_box">
              <div class="news_img"><img src="../images/cms/<?php echo h($imgfile); ?>" alt=""></div>
            </div>
            <div class="news_box_wrap">
              <div class="news_logo">
                <p>News</p>
              </div>
              <div class="news_date">
                <p><?php echo h($date); ?></p>
              </div>
              <div class="news_title"><a href="../newspage/index.php?id=<?php echo h($id); ?>"><?php echo h($title); ?></a></div>
            </div>
            <div class="edit_wrap">
              <div class="edit_box">
                <a href="">編集</a>
              </div>
              <div class="edit_box">
                <a href="">削除</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
        <div class="page">
          <div class="backpage">
            <?php if ($page > 1) : ?>
              <a href="?page=<?php echo $page - 1; ?>">前のページへ</a>
            <?php endif; ?>
          </div>
          <div class="nextpage">
            <?php if ($page < $max_page) : ?>
              <a href="?page=<?php echo $page + 1; ?>">次のページへ</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="news_guidance">
        <div class="category_box">
          <div class="category">
            <h4>Category</h4>
          </div>
          <div class="category_news_box">
            <div class="category_news"> <a href="">News</a></div>
            <div class="category_news"> <a href="">お客様の未来の髪を守る</a></div>
            <div class="category_news"> <a href="../blog/index.php">スタッフブログ</a></div>
            <div class="category_news"> <a href="">育毛</a></div>
          </div>
        </div>
        <div class="archive_box">
          <div class="archive">
            <h4>Archive</h4>
          </div>
          <div class="archive_select">
            <select>
              <option value="">アーカイプを選択</option>
              <option value="">22年7月</option>
              <option value="">22年2月</option>
              <option value="">22年1月</option>
              <option value="">21年12月</option>
              <option value="">21年8月</option>
              <option value="">21年7月</option>
              <option value="">21年1月</option>
              <option value="">20年12月</option>
              <option value="">20年11月</option>
              <option value="">20年10月</option>
              <option value="">20年8月</option>
              <option value="">20年5月</option>
              <option value="">20年4月</option>
              <option value="">20年3月</option>
              <option value="">20年1月</option>
              <option value="">19年12月</option>
              <option value="">19年10月</option>
            </select>
          </div>
        </div>
        <div class="recent_post_wrap">
          <div class="recent_post">
            <h4>Recent posts </h4>
          </div>
          <?php
          $stmt = $db->prepare('select imgfile, date, title from news_cms order by id desc limit 0, 3');
          if (!$stmt) {
            die($db->error);
          }
          $succes = $stmt->execute();
          if (!$succes) {
            die($db->error);
          }
          $stmt->bind_result($imgfile, $date, $title);

          while ($stmt->fetch()) : ?>
            <div class="recent_post_box">
              <div class="recent_post_img_box">
                <div class="recent_post_img"><img src="../images/cms/<?php echo h($imgfile); ?>" alt=""></div>
              </div>
              <div class="recent_post_box_wrap">
                <div class="recent_post_logo">
                  <p>News</p>
                </div>
                <div class="recent_post_date">
                  <p><?php echo h($date); ?></p>
                </div>
                <div class="recent_post_title">
                  <p><?php echo h($title); ?></p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <div class="contact_wrap">
      <div class="contact_box">
        <p>Demosite Hair TOYO </p>
        <div class="list_box">
          <div class="list"><a href="">Concept</a><a href="">Menu</a><a href="">About</a></div>
          <div class="list"><a href="">Recruit</a><a href="">Contact</a><a href="">Privacy policy</a></div>
          <div class="list"><a href="">News</a><a href="">Gallery</a><a href="">Blog </a></div>
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
        <p class="tel">TEL:096-○○○-××××</p>営業時間：09:30～20:30
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