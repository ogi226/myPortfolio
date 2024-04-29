<?php require 'includes/header.php'; ?>

<?php require 'includes/database.php'; ?>

<link rel="stylesheet" href="common/css/detail.css">

<?php
$id = $_REQUEST['id'];

$sql = $pdo->prepare('SELECT * FROM product WHERE id=:id');
$sql->execute(['id' => $_REQUEST['id']]);
foreach ($sql as $row) {
  echo '<main>';
  echo '<p class="breadcrumb">&nbsp;<a href="index.php">TOP</a>&nbsp;&gt;&nbsp;<a href="product.php">商品一覧</a>&nbsp;&gt;&nbsp;', $row['name'], '</p>';
  echo '<hr>';
  if (isset($_SESSION['customer'])) {
    // ログインしてる
    echo '<p class="user_name">ようこそ&emsp;', $_SESSION['customer']['name'], '様</p>';
    echo '<hr>';
  } else {
    // ログインしてない
    echo '<p class="user_name">ようこそ&emsp;ゲスト様</p>';
    echo '<hr>';
  }
  echo '<div class="content">';
  echo '<div class="product_photo group_left">';
  if ($row['category'] == 2) {
    $id = $row['id'] - 6;
    echo '<img class="sp_only" src="common/images/goodslist_cont', $row['category'], '_no', $id, '_sp.png" alt="', $row['name'], 'の写真">';
    echo '<img class="pc_only" src="common/images/goodslist_cont', $row['category'], '_no', $id, '_pc.png" alt="', $row['name'], 'の写真">';
  } else {
    echo '<img class="sp_only" src="common/images/goodslist_cont', $row['category'], '_no', $row['id'], '_sp.png" alt="', $row['name'], 'の写真">';
    echo '<img class="pc_only" src="common/images/goodslist_cont', $row['category'], '_no', $row['id'], '_pc.png" alt="', $row['name'], 'の写真">';
  }
  echo '</div>';
  echo '<div class="group_right">';
  echo '<p class="product_name">', $row['name'], '</p>';
  echo '<p class="product_info">', $row['description'], '</p>';

  if (isset($_SESSION['customer'])) {
    $favorite = $pdo->prepare('SELECT * FROM favorite WHERE customer_id=? AND product_id=?');
    $favorite->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
    if (empty($favorite->fetchAll())) {
      echo '<p class="price">税込&emsp;&yen;', number_format($row['price']), '&emsp;<button><a href="favorite-insert.php?id=', $_REQUEST['id'], '"><img class="favorite_icon" src="common/images/heart.svg" alt="お気に入りボタン"></a></button></p>';
    } else {
      echo '<p class="price">税込&emsp;&yen;', number_format($row['price']), '&emsp;<button><a href="favorite-insert.php?id=', $_REQUEST['id'], '"><img class="favorite_icon" src="common/images/heart.png" alt="お気に入りボタン"></a></button></p>';
    }
  } else {
    echo '<p class="price">税込&emsp;&yen;', number_format($row['price']), '&emsp;<button><a href="favorite-insert.php?id=', $_REQUEST['id'], '"><img class="favorite_icon" src="common/images/heart.svg" alt="お気に入りボタン"></a></button></p>';
  }
  echo '<div class="form_inner">';
  echo '<form class="form_inner" action="cart-input.php" method="post">';
  echo '<input type="hidden" name="id" value ="', $row['id'], '" >';
  echo '<input class="product_count" type="number" min="0" max="99" name="count"  required>';
  echo '<span class="bottom_align">個</span>';
  echo '<input class="cartin_btn" type="submit" value="カートに入れる ">';
  echo '</form>';
  echo '</div><!-- /form_inner -->';
  echo '</div>';
  echo '</div><!-- /content -->';
  echo '</main>';
}

// タイトルの記述
$_REQUEST['id'];

echo <<<END
<title>{$row['name']} | c.c.donuts オンラインショップ</title>
END;

// var_dump ($_REQUEST['id']);
?>
<?php require 'includes/footer.php'; ?>