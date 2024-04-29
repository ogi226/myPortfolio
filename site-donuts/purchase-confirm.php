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
  <link rel="stylesheet" href="common/css/purchase.css">
  <title>購入内容確認 | c.c.donuts オンラインショップ</title>
</head>

<body>
  <main>
    <a href="index.php"><img src="common/images/logo_sp.png" alt="ロゴ"></a>
    <h1>ご購入確認</h1>
    <div class="content">

      <?php
      if (!isset($_SESSION['customer'])) {
        echo '購入手続きを行うにはログインしてください。';
      } else 
          if (empty($_SESSION['product'])) {
        echo 'カートに商品がありません。';
      } else {
        echo '<section>';
        echo '<h2>ご購入商品</h2>';
        // $\SESSION['product']の情報から引用する、CSS装飾も必要なため、要素設定も考える必要あり
        $total = 0;
        foreach ($_SESSION['product'] as $id => $product) {
          $subtotal = $product['count'] * $product['price'];
          $subtotal = number_format($subtotal);

          echo <<<END
            <table>
<tr><th>商品名</th><td><span>{$product['name']}</span></td></tr>
<tr><th>数量</th><td><span>{$product['count']}個</span></td></tr>
<tr><th>小計</th><td><span>税込&emsp;&yen;{$subtotal}</span></td></tr>
</table>
END;
          $total += $product['count'] * $product['price'];
        }
        $total = number_format($total);
        echo <<<END
        <table class="total">
<tr><th class="bold">合計</th><td class="bold"><span>税込&emsp;{$total}</span></td></tr>
</table>

END;

        echo '</section>';

        echo '<section>';
        echo '<h2>お届け先</h2>';

        // $\SESSION['customer']の情報から引用する、CSS装飾も必要なため、要素設定も考える必要あり
        echo <<<END
          <table>
        <tr><th>お名前</th><td><span>{$_SESSION['customer']['name']}</span><td></tr>
        <tr><th>住所</th><td><span>{$_SESSION['customer']['address']}</span><td></tr>
        </table>
   END;

        echo '</section>';
      }
      ?>

      <!-- クレジットカード有無判定、empty(fetchallで判定　P284参照 -->
      <?php
      // ログインしていて、カートにデータがある場合にクレジットカードを判定する
      require 'includes/database.php';
      if (isset($_SESSION['customer']) && !empty($_SESSION['product'])) {
        // if (isset($_SESSION['customer'])) {


        $id = $_SESSION['customer']['id'];
        $sql = $pdo->prepare('select * from card where id=?');
        $sql->execute([$id]);

        echo '<section>';
        if (empty($sql->fetchAll())) {
          echo <<<END
          <h2 id="pay">お支払方法</h2>
          <hr class="red">
          <p class="red caution">お支払方法が登録されていません<br>
          クレジットカード情報を登録してください</p>
          <hr class="red">

            <form action="card-input.php" method="post">
            <input class="login_btn" type="submit" value="カード情報を登録する">
            </form>

      END;
        } else {
          echo <<<END
          <h2>お支払方法</h2>
          <table>
          <tr><th>お支払い</th><td>クレジットカード</td></tr>
    END;
          $sql = $pdo->prepare('select * from card where id=?');
          $sql->execute([$id]);
          foreach ($sql as $row) {
            echo <<<END
                <tr><th>カード種類</th><td><span>{$row['card_type']}</span></td></tr>
                <tr><th>カード番号</th><td><span>{$row['card_no']}</span></td></tr>
                </table>
          END;
          }
          echo '</section>';

          echo <<<END
            <form action="purchase-complete.php" method="post">
            <input class="login_btn" type="submit" value="ご購入を確定する">
            </form>
         END;
        }
      } else {
      }


      ?>
    </div>


  </main>
</body>

</html>

<?php require 'includes/footer.php'; ?>