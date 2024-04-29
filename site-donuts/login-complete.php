<?php require 'includes/header.php'; ?>
<?php require 'includes/database.php'; ?>

<?php
unset($_SESSION['customer']);
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
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="common/css/reset.css">
  <link rel="stylesheet" href="common/css/login.css">
  <title>ログイン完了 | c.c.donuts オンラインショップ</title>
</head>

<body>
  <main>

    <?php

    if (isset($_SESSION['customer'])) {
      echo '<p class="user_name">ようこそ&emsp;', $_SESSION['customer']['name'], '様</p>';
      echo '<hr>';
      echo '<div class="content">';
      echo '<h1>ログイン完了</h1>';
      echo '<div class="content_inner complete_content_inner textalign_center">';
      echo '<p class="message">ログインが完了しました。</p>';
      echo '</div><!-- /content_inner -->';
      echo '<div class="textalign_right">';
      echo '<a href="index.php" class="memo">TOPページへ戻る</a>';
      echo '</div>';
      echo '</div><!-- /content -->';
    } else {
      echo '<p class="user_name">ようこそ&emsp;ゲスト様</p>';
      echo '<hr>';
      echo '<h1>ログイン失敗</h1>';
      echo '<div class="content">';
      echo '<div class="content_inner complete_content_inner textalign_center">';
      echo '<p class="message">メールアドレスまたはパスワードが違います</p>';
      echo '</div><!-- /content_inner -->';
      echo '<div class="textalign_right">';
      echo '<a href="login-input.php" class="memo">ログインページへ戻る</a>';
      echo '</div>';
      echo '</div><!-- /content -->';
    }

    ?>

    </div><!-- /content -->
  </main>
</body>

</html>
<?php require 'includes/footer.php'; ?>