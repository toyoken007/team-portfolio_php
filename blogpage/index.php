<?php
require('../library/library.php');

$db = dbconnect();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$id) {
  header('Location: ../blog/index.php');
}

$stmt = $db->prepare('select category, imgfile, date, title, comment from blog_cms where id=?');
if (!$stmt) {
  die($db->error);
}

$stmt->bind_param('i', $id);
$succes = $stmt->execute();
if (!$succes) {
  die($db->error);
}
$stmt->bind_result($category, $imgfile, $date, $title, $comment);
$stmt->fetch();
$category = unserialize($category);
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
  <title>Blog</title>
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
  <main class="newspage_page">
    <div class="newspage_wrap">
      <div class="newspage_h1">
        <h1>Blog</h1>
      </div>
      <div class="newspage_image"> <img src="../images/news_blog/biyousitu.jpg" alt=""></div>
    </div>
    <div class="newspage_wrapwrap">
      <div class="newspage_main">
        <div class="newspage_title">
          <h4><?php echo h($title); ?></h4>
        </div>
        <div class="newspage_time">
          <p><?php echo h($date); ?></p>
        </div>
        <div class="blogpage_logo_box">
          <?php foreach ($category as $value) : ?>
            <div class="blogpage_logo">
              <p><?php echo h($value); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="newspage_comment">
          <p><?php echo h($comment); ?></p>
        </div>
        <div class="newspage_img">
          <?php if (isset($imgfile)) : ?>
            <img src="../cms/cms_picture/<?php echo h($imgfile); ?>" alt="">
          <?php endif; ?>
        </div>
        <div class="edit_wrap">
          <div class="edit_box">
            <a href="../cms/blog_update/index.php?id=<?php echo $id; ?>">編集</a>
          </div>
          <div class="edit_box">
            <a href="../cms/blog_delete/index.php?id=<?php echo $id; ?>">削除</a>
          </div>
        </div>
        <div class="newspage_share">
          <div class="share">
            <p>Share</p>
          </div>
          <div class="share_sns">
            <div class="sns"> <img src="https://placehold.jp/35x35.png" alt="titterロゴ"></div>
            <div class="sns"> <img src="https://placehold.jp/35x35.png" alt="facebookロゴ"></div>
          </div>
        </div>
        <!-- <div class="newspage_link">
          <div class="link_backpage"> <a href="">サロンリフレッシュ</a></div>
          <div class="link_back"><a href="">Back</a></div>
          <div class="link_nextpage"><a href="">次へ</a></div>
        </div> -->
      </div>
      <div class="news_guidance">
        <div class="category_box">
          <div class="category">
            <h4>Category</h4>
          </div>
          <div class="category_news_box">
            <div class="category_news"> <a href="../news/index.php">News</a></div>
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
          $db = dbconnect();
          $stmt = $db->prepare('select category, imgfile, date, title from blog_cms order by id desc limit 0, 3');
          if (!$stmt) {
            die($db->error);
          }
          $succes = $stmt->execute();
          if (!$succes) {
            die($db->error);
          }
          $stmt->bind_result($category, $imgfile, $date, $title);

          while ($stmt->fetch()) :
            $category = unserialize($category);
          ?>
            <div class="recent_post_box">
              <div class="recent_post_img_box">
                <div class="recent_post_img"><img src="../cms/cms_picture/<?php echo h($imgfile); ?>" alt=""></div>
              </div>
              <div class="recent_post_box_wrap">
                <div class="logo_box">
                  <?php foreach ($category as $value) : ?>
                    <div class="recent_post_blog_logo">
                      <p><?php echo h($value); ?></p>
                    </div>
                  <?php endforeach; ?>
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