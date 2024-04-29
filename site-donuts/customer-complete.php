<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="common/css/reset.css">
  <link rel="stylesheet" href="common/css/customer.css">
  <title>会員登録完了 | c.c.donuts オンラインショップ</title>
</head>

<?php require 'includes/database.php'; ?>
<?php
$sql = $pdo->prepare('INSERT INTO customer VALUES(null,?,?,?,?,?,?)');
$sql->execute([$_REQUEST['name'], $_REQUEST['kana'], $_REQUEST['post_code'], $_REQUEST['address'], $_REQUEST['mail'], $_REQUEST['password']]);
?>

<body>
  <main>
    <img src="common/images/logo_sp.png" alt="ロゴ">
    <h1>会員登録完了</h1>
    <div class="content">
      <div class="content_inner complete_content_inner textalign_center">
        <p class="message">会員登録が完了しました</p>
        <div class="textalign_center">
          <a class="memo" href="login-input.php">ログイン画面へ進む</a>
        </div>
      </div><!-- /content_inner -->
    </div><!-- /content -->

  </main>
</body>

</html>

<?php require 'includes/footer.php'; ?>