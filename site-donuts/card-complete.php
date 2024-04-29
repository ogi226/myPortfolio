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
  <link rel="stylesheet" href="common/css/customer.css">
  <title>カード情報－登録完了 | c.c.donuts オンラインショップ</title>
</head>

<body>
  <main>

    <?php

    // ログインの確認し、カード情報の登録
    if (isset($_SESSION['customer'])) {
      require 'includes/database.php';
      $sql = $pdo->prepare('select * from card where id=?');
      $sql->execute([$_SESSION['customer']['id']]);

      if (empty($sql->fetchAll())) {


        $sql = $pdo->prepare('insert into card values(?,?,?,?,?,?,?)');
        $sql->execute([$_SESSION['customer']['id'], $_REQUEST['card_name'], $_REQUEST['card_type'], $_REQUEST['card_no'], (int)$_REQUEST['card_month'], (int)$_REQUEST['card_year'], (int)$_REQUEST['card_security_code']]);

        echo <<< END
      <p class="img_logo">
        <img src="common/images/logo_sp.png" alt="ロゴ">
      </p>
      <h1>カード情報登録完了</h1>
      <div class="content">
        <div class="content_inner complete_content_inner textalign_center">
          <p class="message">クレジットカード情報を登録しました。</p>
          <div class="textalign_center">
            <a class="memo" href="purchase-confirm.php">購入手続きを続ける</a>
          </div>
        </div><!-- /content_inner -->
      </div><!-- /content -->
    END;
      } else {
        echo  '<p>既に登録されています。</p>';
      }
    } else {
      echo  '<p>ログインしてください</p>';
    }
    //検証用
    // var_dump($_SESSION['customer']['id']);
    //     var_dump((int)$_REQUEST['card_month']);
    //     var_dump((int)$_REQUEST['card_year']);
    //     var_dump((int)$_REQUEST['card_security_code']);
    //     var_dump($_REQUEST['card_no']);
    ?>


  </main>
</body>

</html>

<?php require 'includes/footer.php'; ?>