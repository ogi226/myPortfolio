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
  <link rel="stylesheet" href="common/css/common.css">
  <link rel="stylesheet" href="common/css/customer.css">
  <title>会員登録入力 | c.c.donuts オンラインショップ</title>
</head>

<?php
$name = $kana = $post_code = $address = $mail = $password = '';
if (isset($_SESSION['customer'])) {
  $name = $_SESSION['customer']['name'];
  $kana = $_SESSION['customer']['kana'];
  $post_code = $_SESSION['customer']['post_code'];
  $address = $_SESSION['customer']['address'];
  $mail = $_SESSION['customer']['mail'];
  $password = $_SESSION['customer']['password'];
}
?>

<body>
  <main>
    <a href="index.php"> <img src="common/images/logo_sp.png" alt="ロゴ"></a>

    <?php
    if (isset($_SESSION['customer'])) {
      // true セットされている=ログイン中だったら
      echo '<h1>ログイン中です</h1>';
      echo '<div class="content">';
      echo '<div class="content_inner complete_content_inner textalign_center">';
      echo '<p class="message">ログアウトしてから<br>新規登録をお願いいたします。</p>';
      echo '<div class="textalign_center">';
      echo '<a class="memo" href="logout-input.php">ログアウト画面へ進む</a>';
      echo '</div>';
      echo '</div><!-- /content_inner -->';
      echo '</div><!-- /content -->';
    } else {
    ?>
      <h1>会員登録</h1>
      <div class="content">
      <?php
      // フォームの出力
      echo <<<END
<form action="customer-confirm.php" method="post">

<h2>お名前<span class="must">（必須）</span></h2>
    <input type="text" id="inputField" name="name" value="{$name}" pattern="[^\s]+" title="空白以外の文字を入力してください" required>

<h2>お名前（フリガナ）<span class="must">（必須）</span></h2>
    <input type="text" id="inputField" name="kana" value="{$kana}" pattern="[^\s]+" title="空白以外の文字を入力してください" required>

<h2>郵便番号<span class="must">（必須）</span></h2>
    <input class=mini-input type="text" id="inputField" name="post_code" value="{$post_code}" pattern="[^\s]+" title="空白以外の文字を入力してください" required>

<h2>住所<span class="must">（必須）</span></h2>
  <input type="text" id="inputField" name="address" value="{$address}" pattern="[^\s]+" title="空白以外の文字を入力してください" required>

<h2>メールアドレス<span class="must">（必須）</span></h2>
<input type="email" name="mail"  value="{$mail}" required><br>
<h2>パスワード<span class="must" required>（必須）</span></h2>
<p class="caution">A-Z、a-z、0-9を少なくとも各1つは含めて8文字以上で入力してください。</p>
  <input type="password" id="inputField" name="password" value="{$password}" pattern="[^\s]+" title="空白以外の文字を入力してください" required>
<div class="textalign_center">
<input class="login_btn" type="submit" value="ご入力内容を確認する">
</div>
</form>


END;
    }
      ?>


      </div><!-- /content -->
  </main>
</body>

</html>

<?php require 'includes/footer.php'; ?>