<?php require 'includes/header.php'; ?>
<?php require 'includes/database.php'; ?>

<link rel="stylesheet" href="common/css/reset.css">
<link rel="stylesheet" href="common/css/favorite.css">
<title>お気に入り商品一覧 | c.c.donuts オンラインショップ</title>
<html>

<body>
  <main>

    <?php
    echo '<p class="breadcrumb">&nbsp;<a href="index.php">TOP</a>&nbsp;&gt;&nbsp;<a href="product.php">商品一覧</a>&nbsp;&gt;&nbsp;お気に入り一覧</p>';
    echo '<hr>';
    if (isset($_SESSION['customer'])) {
      echo '<p class="user_name">ようこそ&emsp;', $_SESSION['customer']['name'], '様</p>';
      echo '<hr>';
      echo '<h1>お気に入り商品一覧</h1>';

      $favorite = $pdo->prepare('SELECT * FROM favorite ,product WHERE customer_id=? AND product_id=id');
      $favorite->execute([$_SESSION['customer']['id']]);

      if (!empty($favorite->fetchAll())) {

        $favorite = $pdo->prepare('SELECT * FROM favorite ,product WHERE customer_id=? AND product_id=id');
        $favorite->execute([$_SESSION['customer']['id']]);
        foreach ($favorite as $row) {

          $id = $row['id'];
          $price = number_format($row['price']);

          echo '<div class="content">';
          echo '<div class="content_inner content_flex">';
          echo '<div class="content_1">';
          echo '<a  href="detail-', $row['category'], '.php?id=', $id, '" class=img_link><img class="product_photo sp_only" src="common/images/', $id, '_sp.png" alt="商品画像"></a>';
          echo '<a  href="detail-', $row['category'], '.php?id=', $id, '" class=img_link><img class="product_photo pc_only" src="common/images/', $id, '_pc.png" alt="商品画像"></a>';
          echo '</div><!-- /content_1 -->';
          echo '<div class="content_2">';
          echo '<p class="product_name">', $row['name'], '</p>';
          echo '<div class="content_2_inner">';
          echo '<p class="product_price">税込&emsp;&yen;', $price, '</p>';
          echo '<form action="cart-input.php?id=', $id, '" method="post"">';
          echo '<input type="hidden" name="count" value=1>';
          echo '<input class="btn_cart" type="submit" value="カートに入れる "><br>';
          echo '</form>';
          echo '<i class="fa-thin fa-trash"></i>';
          echo '<p class="favorite_delete"><a href="favorite-delete.php?id=', $id, ' ">お気に入りから削除する</a></p>';
          echo '</div><!-- /content_2_inner -->';
          echo '</div><!-- /content_2 -->';
          echo '</div><!-- /content_inner -->';
          echo '</div><!-- /content -->';
        }
      } else {
        echo '<div class="content">';
        echo '<div class="content_inner content_flame textalign_center">';
        echo '<p>お気に入り登録されている商品が<br>ありません。</p><br>';
        echo '<p class="message"><a href="product.php">商品一覧へ</a></p>';
        echo '</div><!-- /content_2_inner -->';
        echo '</div><!-- /content -->';
      }
    } else {
      echo '<p class="user_name">ようこそ&emsp;ゲスト様</p>';
      echo '<hr>';
      echo '<div class="content">';
      echo '<h1>ご案内</h1>';
      echo '<div class="content_inner content_flame textalign_center">';
      echo '<p>お気に入りに商品を追加するには<br>ログインしてください。</p>';
      echo '<p class="message"><a href="login-input.php">ログインページへ</a></p>';
      echo '</div><!-- /content_inner -->';
      echo '<div class="content">';
    }
    ?>

  </main>
  <?php require 'includes/footer.php'; ?>