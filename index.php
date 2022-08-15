<?php 
require('library/library.php');

$db = dbconnect();

$stmt = $db->prepare('select date, title from news_cms order by id desc');
if (!$stmt) {
  die($db->error);
}
$succes = $stmt->execute();
if (!$succes) {
  die($db->error);
}

$stmt->bind_result($date, $title);
$stmt->fetch();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="description">
        <meta name="keywords" content="keywords">
        <meta name="author" content="">
        <meta property="og:title" content="team-portfolio">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://#{metas.url}">
        <meta property="og:image" content="http://#{metas.image}/og_image.png">
        <meta property="og:site_name" content="site_name">
        <meta property="og:description" content="description">
        <meta property="fb:app_id" content="任意のID">
    <title>team-portfolio</title>
    <link rel="stylesheet" href="./css/style.css">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      
      ga('create', 'UA-XXXXXXXX-Y', 'example.com');
      ga('send', 'pageview');
    </script>
  </head>
  <body>
    <header class="header">
      <div class="header_wrap">
        <div class="header_top">
          <a href="index.php">
            <p>Demosite Hair<span class="header_red">TOYO</span></p>
          </a>
        </div>
        <nav class="nav">
          <ul class="list-menu">
            <li><a href="concept/index.html">Concept</a>
            </li>
            <li><a href="menu/index.html">Menu</a>
            </li>
            <li><a href="about/index.html">About</a>
            </li>
            <li><a href="gallery/index.html">Gallery </a>
            </li>
            <li><a href="recruit/index.html">Recruit </a>
            </li>
            <li><a href="contact/index.html">Contact </a>
            </li>
            <li><a href="reserve/index.php">Reserve </a>
            </li>
            <li><a href="cms/index.html">管理画面 </a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    <main class="top">
      <div class="josei_warp">
        <div class="josei"><img src="./images/top/top_hair.jpg" alt="女性の画像"></div>
        <div class="top_comment">
          <h3>TOYO FOR<br>ALWAYS<br>BE YOURSELF.</h3>
        </div>
      </div>
      <div class="news_warp">
        <div class="news"> 
          <h4>News</h4>
          <ul class="news_list"> 
            <li>
              <p class="days"><?php echo h($date); ?></p>
              <p class="news_comment"><?php echo h($title); ?></p>
            </li>
          </ul>
        </div>
        <div class="news_link">
          <p><a href="news/index.php">View more</a></p>
        </div>
      </div>
      <div class="concept_wrap">
        <h3 class="title">Concept</h3>
        <div class="concept_box">
          <div class="moji hogehoge">
            <div class="concept_comment">
              <p>あなたらしさに寄り添い<br>あなたの魅力を引き出す。</p>
              <div class="concept_link">
                <p><a href="concept/index.html">View more</a></p>
              </div>
            </div>
          </div>
          <div class="images hogehoge"><img src="./images/top/cut_image.jpg" alt="カットイメージ画像"></div>
        </div>
        <div class="menu_box">
          <div class="moji hogehoge">
            <div class="concept_comment">
              <h4>Menu</h4>
              <p>あなたに合わせたメニューで、<br>毎日が輝くようなスタイル創りを。</p>
              <div class="concept_link">
                <p><a href="menu/index.html">View more</a></p>
              </div>
            </div>
          </div>
          <div class="images hogehoge"><img src="./images/top/hair_room.jpg" alt="カットイメージ画像"></div>
        </div>
      </div>
      <div class="gallery_wrap"> 
        <div class="gallery_title"> 
          <h3 class="title">Gallery </h3>
        </div>
        <div class="gallery_box"> 
          <ul class="gallery_images1">
            <li><img src="./images/top/man1.jpg" alt="男性1画像"></li>
            <li><img src="./images/top/man2.jpg" alt="男性2画像"></li>
            <li><img src="./images/top/man3.jpg" alt="男性3画像"></li>
            <li><img src="./images/top/man4.jpg" alt="男性4画像"></li>
            <li><img src="./images/top/woman1.jpg" alt="女性1画像"></li>
            <li><img src="./images/top/woman2.jpg" alt="女性2画像"></li>
            <li><img src="./images/top/woman3.jpg" alt="女性3画像"></li>
            <li><img src="./images/top/woman4.jpg" alt="女性4画像"></li>
          </ul>
          <div class="gallery_link">
            <p><a href="gallery/index.html">View more</a></p>
          </div>
        </div>
      </div>
      <div class="about_wrap">
        <div class="about_comment hogehoge">
          <div class="about_comment_box"></div>
          <h4>About </h4>
          <p class="about_title">Demosite Hair <span class="about_red">TOYO</span></p>
          <p class="about_name">インヴィンシブル ヘアートヨ</p><br>
          <p class="about_address">〒868-0008</p>熊本県人吉市中青井町
          <div class="about_link">
            <div class="about_link1"> 
              <p><a href="about/index.html">View more</a></p>
            </div>
            <div class="about_link2"> 
              <p><a href="">Google Map</a></p>
            </div>
          </div>
        </div>
        <div class="about_map hogehoge"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3375.5585365310835!2d130.75153001450224!3d32.21612431968026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x353f7174da299197%3A0x4fd91ab8c025d86f!2z5Lq65ZCJ6aeF!5e0!3m2!1sja!2sjp!4v1649048075618!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
      </div>
      <div class="recruit_wrap"> 
        <div class="recruit_img"> <img src="./images/top/recruit.jpg" alt="散髪風景の画像"></div>
        <div class="recruit_box">
          <h4>Recruit </h4>
          <p class="recruit_title">「愛」 「真心」 「美」 「感動」を与える。</p><br>
          <p class="recruit_comment">お客様に美と感動を与えるためには「愛」と「真心」が不可欠です。</p>
          <p class="recruit_comment">心を込めておもてなしすれば必ずお客様に伝わり、そしてあなたにとって必ず大切なお客様となります。</p>
          <div class="recruit_link"> 
            <p><a href="recruit/index.html">View more</a></p>
          </div>
        </div>
      </div>
      <div class="blog_wrap">
        <h4>blog</h4>
        <div class="blog_list">
          <?php 
          $db = dbconnect();
          $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

          $stmt = $db->prepare('select imgfile, date, title from blog_cms order by id desc limit 0, 4');
          if (!$stmt) {
            die($db->error);
          }
          $succes = $stmt->execute();
          if (!$succes) {
            die($db->error);
          }
          $stmt->bind_result($imgfile, $date, $title);

          while ($stmt->fetch()):
          
          ?>
          <div class="blog_box">
            <div class="blog_box1"><img src="cms/cms_picture/<?php echo h($imgfile); ?>" alt=""></div>
            <div class="blog_box2">
              <p class="blog_days"><?php echo h($date); ?></p><?php echo h($title); ?>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
        <div class="blog_link">
          <p><a href="blog/index.php">View more</a></p>
        </div>
      </div>
    </main>
    <footer>
      <div class="contact_wrap"> 
        <div class="contact_box">
          <p>Demosite Hair TOYO </p>
          <div class="list_box">
            <div class="list"><a href="concept/index.html">Concept</a><a href="menu/index.html">Menu</a><a href="about/index.html">About</a></div>
            <div class="list"><a href="recruit/index.html">Recruit</a><a href="contact/index.html">Contact</a><a href="">Privacy policy</a></div>
            <div class="list"><a href="news/index.php">News</a><a href="gallery/index.html">Gallery</a><a href="blog/index.php">Blog </a></div>
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
    <script>(window.jQuery || document .write('<script src="js/jquery-1.11.2.min.js"><\/script>'));</script>
    <script src="../js/main.js"></script>
    <script src="../js/slick_slide.js"></script>
  </body>
</html>