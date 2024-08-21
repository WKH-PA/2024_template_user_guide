<ul class="product-list">
    <a <?=full_href($rows) ?> class="product-link">
        <li class="product-item">
            <div class="product-image">
                <?=!empty($view) && $view == "slider" ? '<img src="'.full_src($rows,'').'" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).'">' : full_img($rows) ?>
            </div>
            <div class="product-details">
                <h3 class="product-title"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
                <h4 class="product-price"><?=$gia['text_gia'].$gia['text_km'] ?></h4>
                <?php if($rows['p1'] != "") { ?>
                    <p class="product-code"><?=$glo_lang['cart_ma_sp'] ?>: <?=$rows['p1'] ?></p>
                <?php } ?>
            </div>
        </li>
    </a>
</ul>

