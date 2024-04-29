<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="common/css/reset.css">
  <link rel="stylesheet" href="common/css/purchase.css">
  <title>購入完了 | c.c.donuts オンラインショップ</title>
</head>

<body>

  <?php

  $purchase_id = 1;
  require 'includes/database.php';
  foreach ($pdo->query('select max(id) from purchase') as $row) {
    $purchase_id = $row['max(id)'] + 1;
  }
  $sql = $pdo->prepare('insert into purchase values(?,?)');
  if ($sql->execute([$purchase_id, $_SESSION['customer']['id']])) {
    foreach ($_SESSION['product'] as $product_id => $product) {
      $sql = $pdo->prepare('insert into purchase_detail values(?,?,?)');
      $sql->execute([$purchase_id, $product_id, $product['count']]);
    }
    unset($_SESSION['product']);
    echo <<<END
    <main>
    <a href="index.php"><img src="common/images/logo_sp.png" alt="ロゴ"></a>
    <h1>ご購入完了</h1>
    <div class="content content_complete">
      <div class="content_inner complete_content_inner textalign_center">
        <p class="message">ご購入が完了しました。</p>
        <p class="sub-message">今後ともご愛顧の程、宜しくお願いいたします。</p>
      </div><!-- /content_inner -->
      <div class="textalign_right">
        <a class="memo" href="index.php">TOPページへ戻る</a>
      </div>
    </div><!-- /content -->

  </main>        
  END;
  } else {
    echo '購入手続き中にエラーが発生しました。申し訳ございません。';
  }

  ?>


</body>

</html>

<?php require 'includes/footer.php'; ?>