<ul class="product-list">
    <li class="product-item">
        <a <?=full_href($rows) ?> class="product-link">
            <div class="product-image">
                <?=!empty($view) && $view == "slider" ? '<img src="'.full_src($rows,'').'" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).'">' : full_img($rows) ?>
            </div>
            <div class="product-details">
                <h3 class="product-title"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
                <h4 class="product-price">
                    <span class="discount-price"><?=$gia['text_gia'] ?></span>
                    <span class="original-price"><?=$gia['text_km'] ?></span>
                </h4>
                <?php if($rows['p1'] != "") { ?>
                    <p class="product-code"><?=$glo_lang['cart_ma_sp'] ?>: <?=$rows['p1'] ?></p>
                <?php } ?>
            </div>
        </a>
    </li>
</ul>

