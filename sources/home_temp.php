<ul class="product-list">
    <a <?=full_href($rows) ?> class="product-link">
        <li class="product-item">
            <div class="product-image">
                <?=!empty($view) && $view == "slider" ? '<img src="'.full_src($rows,'').'" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).'">' : full_img($rows) ?>
            </div>
            <div class="product-details">
                <h3 class="product-title"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
<!--                <h4 class="product-price">--><?//=$gia['text_gia'].$gia['text_km'] ?><!--</h4>-->
                <h4 class="product-price">
                    <span class="discount-price"><?=$gia['text_gia'] ?></span>
                    <span class="original-price"><?=$gia['text_km'] ?></span>
                </h4>
                <?php if($rows['p1'] != "") { ?>
                    <p class="product-code"><?=$glo_lang['cart_ma_sp'] ?>: <?=$rows['p1'] ?></p>
                <?php } ?>
            </div>
        </li>
    </a>
</ul>
<style>
    .product-price {
        font-size: 1.2em; /* Kích thước chữ của giá */
        color: #333; /* Màu chữ mặc định */
    }

    .original-price {
        display: inline-block;
        font-size: 1em; /* Kích thước chữ của giá gốc */
        color: #888; /* Màu chữ của giá gốc */
        text-decoration: line-through; /* Đường gạch ngang */
        margin-right: 10px; /* Khoảng cách giữa giá gốc và giá khuyến mãi */
    }

    .discount-price {
        font-size: 1.4em; /* Kích thước chữ của giá khuyến mãi */
        color: #e53935; /* Màu chữ của giá khuyến mãi */
        font-weight: bold; /* Làm nổi bật giá khuyến mãi */
    }

</style>
