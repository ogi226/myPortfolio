<?php require 'includes/header.php'; ?>

<link rel="stylesheet" href="common/css/logout.css">
<title>ログアウト完了 | c.c.donuts オンラインショップ</title>

<main>

  <?php
  if (isset($_SESSION['customer'])) {
    unset($_SESSION['customer']);
    echo '<p class="user_name">ようこそ&emsp;ゲスト様</p>';
    echo '<hr>';
    echo '<h1>ログアウト完了</h1>';
    echo '<div class="content">';
    echo '<div class="content_inner complete_content_inner textalign_center">';
    echo '<p class="message">ログアウトが完了しました</p>';
    echo '</div><!-- /content_inner -->';
    echo '<div class="textalign_right">';
    echo '<a href="index.php" class="memo">TOPページへ戻る</a>';
    echo '</div>';
    echo '</div><!-- /content -->';
  } else {
    echo '<p class="user_name">ようこそ&emsp;ゲスト様</p>';
    echo '<hr>';
    echo '<h1>ログアウト完了</h1>';
    echo '<div class="content">';
    echo '<div class="content_inner complete_content_inner textalign_center">';
    echo '<p class="message">すでにログアウトしています。</p>';
    echo '</div><!-- /content_inner -->';
    echo '<div class="textalign_right">';
    echo '<a href="index.php" class="memo">TOPページへ戻る</a>';
    echo '</div>';
    echo '</div><!-- /content -->';
  }
  ?>

</main>

<?php require 'includes/footer.php'; ?>