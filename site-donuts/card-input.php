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
  <link rel="stylesheet" href="common/css/card.css">
  <title>カード情報 | c.c.donuts オンラインショップ</title>
</head>
<?php
//ログイン確認
if (isset($_SESSION['customer'])) {
  echo <<< END
<body>
  <main>
    <a href="index.php"><img src="common/images/logo_sp.png" alt="ロゴ"></a>
    <h1>カード情報登録</h1>
    <div class="content">
      <!-- <div class="content_inner"> -->
      <form action="card-confirm.php" method="post">
        <h2>お名前<span class="must">（必須）</span></h2>
        <input class="input_wide" type="text" name="card_name" required><br>
        <h2>カード会社<span class="must">（必須）</span></h2>
        <div class="radio_wrap">
          <label for="card_type"><input type="radio" name="card_type" value="JCB" checked> JCB</label>
          <label for="card_type"><input type="radio" name="card_type" value="Visa"> Visa</label>
          <label for="card_type"><input type="radio" name="card_type" value="Mastercard"> Mastercard</label>
        </div>
        <h2>カード番号<span class="must">（必須）</span></h2>
        <input class="input_wide" type="text" name="card_no" required><br>
        <h2>有効期限<span class="must">（必須）</span></h2>
        <div class="expiration_wrap">
          <input class="input_mini" type="text" name="card_month" required>月<br>
          <input class="input_mini" type="text" name="card_year" required>年<br>
        </div>
        <h2>セキュリティコード<span class="must">（必須）</span></h2>
        <div class="security_code_wrap">
          <input class="input_mini" type="text" name="card_security_code" required><br>
        </div>
        <div class="textalign_center">

          <input class="login_btn confirm_btn" type="submit" value="ご入力内容を確認する">
        </div>

      </form>

  </main>
</body>
END;
} else {
  echo 'ログインしてください';
}

?>


</html>

<?php require 'includes/footer.php'; ?>