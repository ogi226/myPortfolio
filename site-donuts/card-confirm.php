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
  <title>カード情報－入力確認 | c.c.donuts オンラインショップ</title>
</head>

<body>
  <main>

    <?php
    //変数に受け取った値を代入する

    $name = htmlspecialchars($_REQUEST['card_name']);
    $type = htmlspecialchars($_REQUEST['card_type']);
    $cardno = (int)htmlspecialchars($_REQUEST['card_no']);
    $month = (int)htmlspecialchars($_REQUEST['card_month']);
    $year = (int)htmlspecialchars($_REQUEST['card_year']);
    $security = (int)htmlspecialchars($_REQUEST['card_security_code']);

    // 入力情報を出力する
    echo <<< END
<a href="index.php"><img src="common/images/logo_sp.png" alt="ロゴ"></a>
<h1>ご入力内容の確認</h1>
<div class="content">
<p>お名前</p>
<p class="input_result">{$name}</p>
<p>カード会社</p>
<p class="input_result">{$type}</p>
END;

    echo '<div class="input_group">';
    echo '<p>カード番号</p>';
    echo '<p class="input_result">', $cardno, '</p>';
    require 'includes/database.php';
    $sql = $pdo->prepare('select * from card where card_no=?');
    $sql->execute([$cardno]);
    if (!preg_match('/^[0-9]{14}$|^[0-9]{16}$/', $cardno)) {
      echo '<p class="redtext">誤ったカード番号です</p>';
    } elseif (!empty($sql->fetchAll())) {
      echo '<p class="redtext">既に登録されているカード番号です</p>';
    }

    echo '</div>';

    //日付の判別
    echo '<div class="input_group">';
    echo '<p>有効期限</p>';
    echo '<p class="input_result">', $month, '/', $year, '</p>';
    if (preg_match('/^[1-9]{1}$|^[1-9]{1}[0-2]{1}$/', $month) && preg_match('/^[0-9]{2}$/', $year)) {
      date_default_timezone_set('Asia/Tokyo');
      $currenttime = mktime(0, 0, 0, date('m'), 1, date('Y'));
      $inputdate = mktime(0, 0, 0, $month, 28, $year);
      $y = date('Y', $inputdate);
      $m = date('m', $inputdate);

      if (checkdate($m, 1, $y)) {
        if ($inputdate < $currenttime) {
          echo '<p class="redtext" >古い有効期限年月です</p>';
        }
      } else {
        echo '<p class="redtext" >正しい有効期限年月ではありません</p>';
      }
    } else {
      echo '<p class="redtext" >2桁の正しい年月をご入力ください</p>';
    }
    echo '</div>';


    echo '<div class="input_group">';
    echo '<p>セキュリティコード</p>';
    echo '<p class="input_result">', $security, '</p>';
    if (!preg_match('/^[0-9]{3}$/', $security)) {
      echo '<p class="redtext" >セキュリティコードは正しくありません。</p>';
    }
    echo '</div>';

    // クレカ番号の重複確認用sql
    $sql = $pdo->prepare('select * from card where card_no=?');
    $sql->execute([$cardno]);

    // 上記の各種条件を網羅している
    if (preg_match('/^[0-9]{14}$|^[0-9]{16}$/', $cardno) && empty($sql->fetchAll()) && preg_match('/^[1-9]{1}$|^[1-9]{1}[0-2]{1}$/', $month) && preg_match('/^[0-9]{2}$/', $year) && preg_match('/^[0-9]{3}$/', $security) && checkdate($m, 1, $y) && $inputdate > $currenttime) {
      echo <<<END
      <form  class="form_inner" action="card-complete.php" method="post">
      <input type="hidden" name="card_name" value="{$name}">
      <input type="hidden" name="card_type" value="{$type}">
      <input type="hidden" name="card_no" value="{$cardno}">
      <input type="hidden" name="card_month" value="{$month}">
      <input type="hidden" name="card_year" value="{$year}">
      <input type="hidden" name="card_security_code" value="{$security}">
      <input class="login_btn" type="submit" value="この内容で登録する">
      </form>
      </div>
      END;
    } else {
      echo <<< END
  <form action="card-input.php" method="post">
  <p>登録できません。やり直して下さい。</p>
        <input class="login_btn" type="submit" value="戻る" >
  </form>
END;
    }

    ?>
  </main>
</body>

</html>
<?php require 'includes/footer.php'; ?>