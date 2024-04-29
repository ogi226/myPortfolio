<?php require 'includes/header.php' ?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="common/css/reset.css">
  <link rel="stylesheet" href="common/css/cart.css">

  <title>数量変更完了 | c.c.donuts オンラインショップ</title>

</head>

<body>




  <main>

    <ul>
      <li><a href="index.php">top</a></li>
      <li>></li>
      <li>カート</li>
    </ul>

    <hr>

    <?php
    if (isset($_SESSION['customer'])) {
      // ログインしている

      echo '<p class="id_name_no_cart">ようこそ　', $_SESSION['customer']['name'], '様</p> ';
    } else {
      // ログアウトしている
      echo '<p class="id_name_no_cart">ようこそ　ゲスト様</p> ';
    }

    echo '<hr>';


    $id = $_REQUEST['id'];

    $count = $_SESSION['product'][$id]['count'];








    if ($_SESSION['product'][$id]['count'] > 0) {
      // $_SESSION['product'][$id]['count']が0より大きい場合　true

      $count = $_SESSION['product'][$id]['count'];
      // 変数$countに元の数を代入

      require 'includes/database.php';
      // データベース読み込み








      if ($_REQUEST['add'] + $count < 1) {
        // ($_REQUEST['add'] + $count が1未満の場合　true

        $_SESSION['product'][$id]['count'] = 1;
        // $_SESSION['product'][$id]['count']に「1」を代入

        $sql = $pdo->prepare('select * from product where id=?');
        // product内のidと　Web内idが同じものを確認

        $sql->execute([$_REQUEST['id']]);
        // データベースからいidを読み込み

        foreach ($sql as $cart) {

          $_SESSION['product'][$id] = [
            'name' => $cart['name'],
            'price' => $cart['price'],
            'count' => $_SESSION['product'][$id]['count']
          ];
          // idが同じもののデータを読み込み

        }

        echo '<p class="id_name_no_cart">', $_SESSION['product'][$id]['name'], 'の数量　1　に変更しました。</p>';
      } else {
        // ($_REQUEST['add'] + $count が2以上の場合　false

        $sql = $pdo->prepare('select * from product where id=?');
        $sql->execute([$_REQUEST['id']]);

        foreach ($sql as $cart) {

          $_SESSION['product'][$id] = [
            'name' => $cart['name'],
            'price' => $cart['price'],
            'count' => $count + $_REQUEST['add']
          ];
        }

        echo '<p class="id_name_no_cart">', $_SESSION['product'][$id]['name'], 'の数量を変更しました。</p>';
      }
    } else {
      // 数量がマイナスの場合　false　

      $_SESSION['product'][$id]['count'] = 1;

      $count = $_SESSION['product'][$id]['count'];



      $sql = $pdo->prepare('select * from product where id=?');
      $sql->execute([$_REQUEST['id']]);

      foreach ($sql as $cart) {

        $_SESSION['product'][$id] = [
          'name' => $cart['name'],
          'price' => $cart['price'],
          'count' => $count
        ];
      }

      echo '<p class="id_name_no_cart">', $_SESSION['product'][$id]['name'], 'の数量を　1　に変更しました。</p>';
    }


    require 'cart.php';
    echo '</main>';

    ?>




</body>

</html>


<?php require 'includes/footer.php'; ?>