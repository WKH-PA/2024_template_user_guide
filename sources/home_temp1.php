<ul>
  <a <?=full_href($rows) ?>>
    <?=$gia['pt'] != 0 ? '<div class="discount-tag">-'.$gia['pt']."%</div>" : "" ?>
    <li><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
    <?php if($rows['icon_hover']) { ?>
      <li class="pro_1_b"><img src="<?=full_src_muti($rows,'thumb_','icon_hover') ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
    <?php } ?>
    <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
    <h4><?=$gia['text_gia'].$gia['text_km'] ?></h4>
  </a>
  <p><?= GET_sao_sp($rows['num_1'], $rows['num_2'], $rows['id']) ?></p>
  <div class="view_more_pro">
    <div class="clolum_id">
      <a class="cur p_yeuthich  p_yeuthich_<?=$rows['id'] ?>" onclick="yeu_thich(this, <?=$rows['id'] ?>)" data="0"><i class="fa fa-heart-o"></i></a>
    </div>
    <div class="clolum_id">
      <a class="cur" onclick="load_view_sp(<?=$rows['id'] ?>, this)"><i class="fa fa-eye"></i></a>
    </div>
    <div class="clolum_id">
      <a href="<?=$full_url."/gio-hang/?id=".$rows['id'] ?>"><i class="fa fa-cart-plus"></i></a>
    </div>
    <div class="clr"></div>
  </div>
</ul>