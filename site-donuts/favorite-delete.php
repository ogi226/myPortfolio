<?php require 'includes/header.php'; ?>
<?php require 'includes/database.php'; ?>

<link rel="stylesheet" href="common/css/favorite.css">
<title>お気に入り商品削除 | c.c.donuts オンラインショップ</title>

<main>
  <!-- <?php
        if (isset($_REQUEST['mail']) && isset($_REQUEST['password'])) {
          $sql = $pdo->prepare('SELECT * FROM customer WHERE mail=? and password=?');
          $sql->execute([$_REQUEST['mail'], $_REQUEST['password']]);
          foreach ($sql as $row) {
            $_SESSION['customer'] = [
              'id' => $row['id'],
              'name' => $row['name'],
              'kana' => $row['kana'],
              'post_code' => $row['post_code'],
              'address' => $row['address'],
              'mail' => $row['mail'],
              'password' => $row['password']
            ];
          }
        }
        ?> -->


  <?php
  if (isset($_SESSION['customer'])) {
    echo '<p class="user_name">ようこそ&emsp;', $_SESSION['customer']['name'], '様</p>';
    echo '<hr>';
    echo '<div class="content">';
    echo '<h1>削除成功</h1>';
    echo '<div class="content_inner content_flame textalign_center">';
    $sql = $pdo->prepare('DELETE FROM favorite WHERE customer_id=? AND product_id=?');
    $sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);

    echo '<p>お気に入りの削除に成功しました。</p>';
    echo '<div class="textalign_center">';
    echo '<p class="message"><a href="favorite-list.php?">お気に入り一覧に戻る</a></p>';
    echo '</div>';
    echo '</div><!-- /content_inner -->';
    echo '</div><!-- /content -->';
  } else {
    echo '<p class="user_name">ようこそ&emsp;ゲスト様</p>';
    echo '<hr>';
    echo '<h1>ログイン</h1>';
    echo '<div class="content">';
    echo '<div class="content_inner complete_content_inner textalign_center">';
    echo '<p class="message">ログインしていません</p>';
    echo '</div><!-- /content_inner -->';
    echo '<div class="textalign_right">';
    echo '<a href="login-input.php" class="memo">ログインページへ戻る</a>';
    echo '</div>';
    echo '</div><!-- /content -->';
  }

  ?>

  </div><!-- /content_inner -->
  </div><!-- /content -->


</main>

<?php require 'includes/footer.php'; ?>