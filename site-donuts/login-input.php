<?php require 'includes/header.php'; ?>

<link rel="stylesheet" href="common/css/reset.css">
<link rel="stylesheet" href="common/css/login.css">
<title>ログイン | c.c.donuts オンラインショップ</title>
<html>

<body>


  <main>

    <?php
    if (isset($_SESSION['customer'])) {
      echo '<p class="user_name">ようこそ&emsp;', $_SESSION['customer']['name'], '様</p>';
      echo '<hr>';
      echo '<div class="content">';
      echo '<h1>ログイン中</h1>';
      echo '<div class="content_inner complete_content_inner textalign_center">';
      echo '<p class="message">すでにログインしています。</p>';
      // echo '<div class="textalign_center">';
      echo '<a class="flamein_memo textalign_center" href="logout-input.php">ログアウト画面へ進む</a>';
      // echo '</div>';
      echo '</div><!-- /content_inner -->';
      echo '<div class="textalign_right">';
      echo '<a href="index.php" class="memo">TOPページへ戻る</a>';
      echo '</div>';
      echo '</div><!-- /content -->';
    } else {
      echo '<p class="user_name">ようこそ&emsp;ゲスト様</p>';
      echo '<hr>';
      echo '<div class="content">';
      echo '<h1>ログイン</h1>';
      echo '<div class="content_inner">';
      echo '<form action="login-complete.php?login=1" method="post">';
      echo '<h2>メールアドレス</h2>';
      echo '<input class="input" type="mail" name="mail"><br>';
      // echo '<h2>パスワード</h2>';
      echo '<h2>パスワード&emsp;<button type="button" class="display_btn" onclick="toggleDisplay();">表示する</button></h2>';
      echo '<input id="password" class="input" type="password" name="password"><br>';
      echo '<div class="textalign_center">';
      echo '<input class="login_btn" type="submit" value="ログインする">';
      echo '</div>';
      echo '</form>';
      echo '</div><!-- /content_inner -->';
      echo '<div class="textalign_right">';
      echo '<a href="customer-input.php">';
      echo '<p class="memo">会員登録がお済みでない方はこちら</p>';
      echo '</a>';
      echo '</div>';
      echo '</div><!-- /content -->';
    }
    ?>

  </main>

  <script>
    window.addEventListener('DOMContentLoaded', function() {

      // (1)パスワード入力欄とボタンのHTMLを取得
      let btn_passview = document.querySelector('.display_btn');
      let input_pass = document.getElementById("password");

      // (2)ボタンのイベントリスナーを設定
      btn_passview.addEventListener("click", (e) => {

        // (3)ボタンの通常の動作をキャンセル（フォーム送信をキャンセル）
        e.preventDefault();

        // (4)パスワード入力欄のtype属性を確認
        if (input_pass.type === 'password') {

          // (5)パスワードを表示する
          input_pass.type = 'text';
          btn_passview.textContent = '非表示';

        } else {

          // (6)パスワードを非表示にする
          input_pass.type = 'password';
          btn_passview.textContent = '表示';
        }
      });

    });
  </script>
</body>

</html>


<?php require 'includes/footer.php'; ?>