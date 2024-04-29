<!-- サーバーの登録商品データを読み取る -->

<?php

// データベースのカート内を確認
if (!empty($_SESSION['product'])) {

    // 商品データがある場合

    // 合計金額計算用の変数設定
    $total = 0;

    // データベースのカート内情報を呼び出し
    // productテーブル内の各商品データの変数$idを変数$productに変更(他のデータと重複しないため)
    foreach ($_SESSION['product'] as $id => $product) {

        // 各商品データごとに　価格×個数を変数に保管
        $subtotal = $product['price'] * $product['count'];

        //合計金額
        $total += $subtotal;

        // var_dump($product);
        // var_dump($_SESSION['product']);
        // var_dump($_SESSION['product'][$id]);

        $id_number = intval($id);
        // 文字情報を数字情報に変換

        // var_dump($id_number);

        // $id_kana=mb_convert_kana($id_number,'A');

        $count_change = $product['count'] - 1;
        // 個数変更のminの数値決め


        echo <<< END

<form action="count_change.php" method="post">

    <input type="hidden" name="id" value="{$id_number}">
    <input type="hidden" name="price" value="{$product['price']}">
    <input type="hidden" name="name" value="{$product['name']}">

    <div id="merchandise">
        <a href="detail-1.php?id={$id}" id="img_link">
            <img src="common/images/{$id_number}_sp.png" alt="商品画像">
        </a>
        
        
        <div id="detail">
            <a href="detail-1.php?id={$id}" id="name_link">
                <p id="name">{$product['name']}</p>
            </a>

            <div class="price">
                <a href="detail-1.php?id={$id}" id="price_link">
END;
        echo '<p id="price">税込&ensp;&yen;', number_format($product['price']), '</p>';
        echo <<<END
                </a>

                <p  class="count">数量
                {$product['count']}
                    個

                </p>
            </div>
            
            <div class="price">
            <p class="hidden">　　</p>
            <p class="count">
                <input type="number" min="-{$count_change}" max="99" name="add" width=20px value="0">個

                <input type="submit" value="変更">
            </p>
            </div>

            
           

            <div id="delete">
                <a href="cart-delete.php?id={$id_number}" id="delete">削除する</a>
            </div>

            
          

        </div>
    </div>
    </form>
END;

        // <a href="count_change.php?id={$id_number}" id="delete">更新する</a>



        // var_dump($id);
        // var_dump($id_number);
        // var_dump($_SESSION['product'][$id]['count'] );
    }

    echo <<< END

    <div id="total">
        <ul>
            <li> ご注文合計：</li>
END;
    echo '<li>税込み&nbsp;&yen;', number_format($total), '</li>';

    echo <<< END
        </ul>
    
    
       <p> 
            <a href="purchase-confirm.php">ご購入確認へ進む</a>
       </p>
       
    </div>
   
    <p id="continue">
        <a  href="product.php">買い物を続ける</a>
    </p>


    
END;
} else {

    // 商品データがない場合
    echo '<p class="id_name_no_cart">カートに商品がありません。</p>';
}
// var_dump($_SESSION['product']);


?>