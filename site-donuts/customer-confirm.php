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
  <link rel="stylesheet" href="common/css/customer.css">
  <title>会員登録確認 | c.c.donuts オンラインショップ</title>
</head>

<body>
  <main>

    <?php
    echo '<img src="common/images/logo_sp.png" alt="ロゴ">';
    echo '<h1>ご入力内容の確認</h1>';

    // もしセッションcustomerがセットされていたら
    if (isset($_SESSION['customer'])) {
      // true セットされている=ログイン中だったら
      echo 'ログイン中です。';
      echo 'ログアウトしてから新規登録をお願いいたします。';
      echo '<a href="logout.php">ログアウトする</a>';
      $id = $_SESSION['customer']['id'];
    } else {
      // false セットされていない＝ログインしてない
      // 条件：メールアドレスが一致するデータを取得するSQL
      $sql = $pdo->prepare('SELECT * FROM customer WHERE mail=?');
      $sql->execute([htmlspecialchars($_REQUEST['mail'])]);
    }
    $name = htmlspecialchars(mb_convert_kana($_REQUEST['name']));
    $kana = htmlspecialchars(mb_convert_kana($_REQUEST['kana']));
    $postcode = htmlspecialchars(str_replace($hyphen = array('-', 'ー', '－'), '', mb_convert_kana($_REQUEST['post_code'], 'na')));
    $address =  htmlspecialchars(mb_convert_kana($_REQUEST['address'], 'a'));
    $mail = htmlspecialchars(mb_convert_kana($_REQUEST['mail']));


    if (empty($sql->fetchAll())) {
      // true 入力されたメールアドレスと一致するデータがなかった場合➡新規登録する*********  
      echo '<div class="content">';
      echo '<form id="customerForm" action="customer-complete.php" method="post">';
      // １．名前
      echo '<h2>お名前</h2>';
      echo '<p class="input_result">',  $name, '</p>';

      // ２．名前(カナ)
      echo '<h2>お名前(フリガナ)</h2>';
      echo '<p class="input_result">', $kana, '</p>';

      // ３．郵便暗号
      if (!preg_match('/^[0-9]{7}$/', $postcode)) {
        echo '<h2>郵便番号&emsp;<span class="caution">※適切な郵便番号ではありません</span></h2>';
        echo '<p class="input_result input_error">', $postcode, '</p>';
      } else {
        echo '<h2>郵便番号</h2>';
        echo '<p class="input_result">', $postcode, '</p>';
      }
      // ４．住所
      echo '<h2>住所</h2>';
      echo '<p class="input_result">', $address, '</p>';

      // ５．メールアドレス
      echo '<h2>メールアドレス</h2>';
      echo '<p class="input_result">', $mail, '</p>';

      // ６．パスワード
      $password = htmlspecialchars($_REQUEST['password']);
      $maskedPassword = str_repeat('●', strlen($password));
      if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/', $password)) {
        echo '<h2>パスワード&emsp;<span class="caution">※適切なパスワードではありません</span></h2>';
        echo '<p class="input_result input_error" id="password">', $password, '</p>';
      } else {
        echo '<h2>パスワード&emsp;<button type="button" class="display_btn" onclick="toggleDisplay();">表示する</button></h2>';
        echo '<p class="input_result password" id="maskoff">', $maskedPassword, '</p>';
        echo '<p class="input_result mask_off pass_display" id="password">', $password, '</p>';
      }

      // ボタン
      echo '<div class="textalign_center">';
      // 郵便番号またはパスワードが適切でない場合に戻る、適切な場合は登録ボタンを表示
      if (!preg_match('/^[0-9]{7}$/', $postcode) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/', $password)) {
        echo '<button class="login_btn back_btn" type="button" onclick="history.back()">戻る</button>';
      } else {
        echo '<input class="login_btn" type="submit" value="こちらの内容で登録する">';
      }

      echo '<input type="hidden" name="name" value="', $name, '"</p>';
      echo '<input type="hidden" name="kana" value="', $kana, '"</p>';
      echo '<input type="hidden" name="post_code" value="', $postcode, '"</p>';
      echo '<input type="hidden" name="address" value="', $address, '"</p>';
      echo '<input type="hidden" name="mail" value="', $mail, '"</p>';
      echo '<input type="hidden" name="password" value="', $password, '"</p>';
      echo '</form>';
      echo '</div><!-- /content -->';
    }
    // 入力されたメールアドレスが既に登録されていた場合********************************      
    else {
      echo '<div class="content">';
      echo '<div class="content_inner complete_content_inner textalign_center">';
      echo '<p class="message">このメールアドレスは<br>既に使用されていますので、<br>登録できません。</p>';
      echo '<button class="login_btn confirm_back_btn" type="button" onclick="history.back()">戻る</button>';
      echo '</div>';
      echo '</div>';
    }
    ?>
  </main>

  <script>
    function toggleDisplay() {
      let password = document.querySelector('.password');
      let password2 = document.querySelector('.mask_off');
      password.classList.toggle('pass_display');
      password2.classList.toggle('pass_display');
    }
  </script>

</body>

</html>

<?php require 'includes/footer.php'; ?>