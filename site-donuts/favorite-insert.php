<?php require 'includes/header.php'; ?>
<?php require 'includes/database.php'; ?>

<!-- <?php
      $favorite = $pdo->prepare('SELECT * FROM favorite WHERE customer_id=? and product_id=?');
      $favorite->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
      ?> -->


<link rel="stylesheet" href="common/css/reset.css">
<link rel="stylesheet" href="common/css/favorite.css">
<title>お気に入り商品追加 | c.c.donuts オンラインショップ</title>
<html>

<body>


  <main>

    <?php
    if (isset($_SESSION['customer'])) {
      echo '<p class="user_name">ようこそ&emsp;', $_SESSION['customer']['name'], '様</p>';
      echo '<hr>';
      $favorite = $pdo->prepare('SELECT * FROM favorite WHERE customer_id=? and product_id=?');
      $favorite->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
      if (!empty($favorite->fetchAll())) {
        echo '<div class="content">';
        echo '<h1>登録済み</h1>';
        echo '<div class="content_inner content_flame textalign_center">';
        echo '<p>既にお気に入りに登録済です。</p>';
        echo '<p class="message"><a href="favorite-list.php?id=', $_REQUEST['id'], '">お気に入り一覧を見る</a></p>';
        echo '</div><!-- /content_inner -->';
        // echo '<div class="textalign_right">';
        echo '<button onclick="goBack()"><span class="memo" >前のページに戻る<span></button>';
        // echo '</div>';
        echo '<div class="content">';
      } else {
        $sql = $pdo->prepare('INSERT INTO favorite VALUES(?,?)');
        $sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
        echo '<div class="content">';
        echo '<h1>登録成功</h1>';
        echo '<div class="content_inner content_flame textalign_center">';
        echo '<p>お気に入りに商品を追加しました。</p>';
        echo '<p class="message"><a href="favorite-list.php?id=', $_REQUEST['id'], '">お気に入り一覧を見る</a></p>';
        echo '</div><!-- /content_inner -->';
        // echo '<div class="textalign_right">';
        echo '<button onclick="goBack()"><span class="memo" >前のページに戻る<span></button>';
        // echo '</div>';
        echo '<div class="content">';
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
  <script>
    function goBack() {
      window.history.back(); // ブラウザの履歴を1つ戻る
    }
  </script>

  <?php require 'includes/footer.php'; ?>