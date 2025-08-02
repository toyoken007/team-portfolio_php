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
  <title>Gallery</title>
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
        <a href="index.php">
          <p>Demosite Hair<span class="header_red">TOYO</span></p>
        </a>
      </div>
      <nav class="nav" id="js_nav">
        <ul class="list-menu">
          <li class="title">Demosite Hair<span>TOYO</span>
          </li>
          <li><a href="../index.php">top</a>
          </li>
          <li><a href="../index.php">top</a>
          </li>
          <li><a href="../concept/index.php">Concept</a>
          </li>
          <li><a href="../menu/index.php">Menu</a>
          </li>
          <li><a href="../about/index.php">About</a>
          </li>
          <li><a href="#">Gallery </a>
          </li>
          <li><a href="../recruit/index.php">Recruit </a>
          </li>
          <li><a href="#contact">Contact </a>
          </li>
          <li class="sp_size"><a href="../blog/index.php">blog </a>
          </li>
          <li class="sp_size"><a href="../news/index.php">news </a>
          </li>
          <li><a href="../reserve/index.php">Reserve </a>
          </li>
        </ul>
      </nav>
      <div class="ham_reseve"><a href="../reserve/index.php">Reserve </a>
      </div>
      <button class="openbtn" id="js_hamburger"><span> </span><span> </span><span></span></button>
    </div>
  </header>
  <main class="gallery_page">
    <div class="gallery_wrap">
      <div class="gallery_h1">
        <h1>Gallery</h1>
      </div>
      <div class="gallery_image"> <img src="../images/gallery/gallery.jpg" alt="ギャラリーのイメージ画像"></div>
    </div>
    <div class="gallery_wrapwrap">
      <div class="gallery_img"><img src="../images/gallery/man1.jpg" alt="ギャラリーのイメージ画像"></div>
      <div class="gallery_img"><img src="../images/gallery/man2.jpg" alt="ギャラリーのイメージ画像"></div>
      <div class="gallery_img"><img src="../images/gallery/man3.jpg" alt="ギャラリーのイメージ画像"></div>
      <div class="gallery_img"><img src="../images/gallery/man4.jpg" alt="ギャラリーのイメージ画像"></div>
      <div class="gallery_img"><img src="../images/gallery/woman1.jpg" alt="ギャラリーのイメージ画像"></div>
      <div class="gallery_img"><img src="../images/gallery/woman2.jpg" alt="ギャラリーのイメージ画像"></div>
      <div class="gallery_img"><img src="../images/gallery/woman3.jpg" alt="ギャラリーのイメージ画像"></div>
      <div class="gallery_img"><img src="../images/gallery/woman4.jpg" alt="ギャラリーのイメージ画像"></div>
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
    <div class="contact" id="contact">
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