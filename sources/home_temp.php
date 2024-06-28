<ul>
  <a <?=full_href($rows) ?>>
    <li><?=!empty($view) && $view  == "slider" ? '<img src="'.full_src($rows).'" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).'">' : full_img($rows) ?></li>
    <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
    <h4><?=$gia['text_gia'].$gia['text_km'] ?></h4>
    <?php if($rows['p1'] != ""){ ?>
      <p><?=$glo_lang['cart_ma_sp'] ?>: <?=$rows['p1'] ?></p>
    <?php } ?>
  </a>
</ul>