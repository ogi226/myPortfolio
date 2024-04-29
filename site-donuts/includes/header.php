<?php session_start(); ?>
<?php require 'includes/database.php'; ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="common/css/reset.css">
  <link rel="stylesheet" href="common/css/common.css">
  <link rel="stylesheet" href="common/css/header copy.css">

  <!-- <title>header確認</title> -->

</head>



<body>

  <header>


    <div class="header_content1">
      <!-- ②企業ロゴ -->
      <div id="header_top">
        <a class="logo" href="index.php"><img src="common/images/logo_sp.png" alt="ハンバーガーストア-ロゴ"></a>


        <!-- ①メニューボタン -->
        <div id=header_max>
          <nav>
            <div class="nav">
              <div class="nav_icon_bg">
              </div>
              <input type="checkbox" class="menu_botan" id="menu_botan">
              <label for="menu_botan" class="menu_icon">

                <span class="nav_icon"></span>
              </label>

              <ul class="nav_menu">

                <li><img src="common/images/logo_sp.png" alt="C.C.Donuts画像"></li>

                <!-- メニュー一覧 -->

                <li><a href="index.php">top</a></li>


                <li><a href="product.php">商品一覧</a></li>


                <li><a href="favorite-list.php">お気に入り商品一覧</a></li>


                <li><a href="#">よくある質問</a></li>


                <li><a href="#">問い合わせ</a></li>


                <li><a href="#">当サイトのポリシー</a></li>


              </ul>
            </div>

          </nav>
        </div>


        <!-- ③お気に入りンアイコン -->
        <?php require 'includes/database.php'; ?>

        <?php
        if (isset($_SESSION['customer'])) {
          // ログインしてる
          $favorite = $pdo->prepare('SELECT * FROM favorite ,product WHERE customer_id=? AND product_id=id');
          $favorite->execute([$_SESSION['customer']['id']]);
          if (!empty($favorite->fetchAll())) {
            // お気に入りに商品がある場合　♡表示
            echo '<a class="heart" href="favorite-list.php"><img src="common/images/heart.svg" width=4% alt="お気に入りアイコン"></a>';
          }
        }
        ?>

        <!-- ④ログインアイコン -->
        <?php
        $basename = basename((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        if (isset($_SESSION['customer'])) {
          // ログインしてる

          if ($basename == 'logout-complete.php?logout=1') {
            echo  '<a class="login" href="login-input.php"><img src="common/images/icon_login_sp.svg" alt="ログインアイコン"></a>';
          } else {
            echo '<a class="login" href="logout-input.php"><img src="common/images/icon_logout_sp.svg" alt="ログアウトアイコン"></a>';
          }
        } else {
          // ログインしてない
          if ($basename == 'login-complete.php?login=1') {
            echo '<a class="login" href="logout-input.php"><img src="common/images/icon_logout_sp.svg" alt="ログアウトアイコン"></a>';
          } else {
            echo '<a class="login" href="login-input.php"><img src="common/images/icon_login_sp.svg" alt="ログインアイコン"></a>';
          }
        }
        ?>

        <!-- ⑤ログインアイコン -->
        <a class="cart" href="cart-show.php"><img src="common/images/icon_cart_sp.svg" alt="カートアイコン"></a>

      </div>
    </div><!--header_content1  -->

    <div class="header_content2">
      <div id="header_search">

        <form action="search.php" method="post">
          <ul>
            <li>
              <button type="submit"><img src="common/images/icon_search_sp.svg" alt="🔍"></button>
            </li>
            <li id=text>
              <input type="text" name="keyword">
            </li>

          </ul>
        </form>
      </div>


    </div><!--header_content2  -->


  </header>

</body>

</html>