
<div class="right_conten">
  <?php include _source."banner_top.php";?>
  <?php
    $noidung    = LAYTEXT_rieng(77);
    if(is_array($noidung)){
  ?>
  <div class="box_page_id">
    <div class="title_page">
      <h3><?=SHOW_text($noidung['tenbaiviet_'.$lang]) ?></h3>
      <div class="clr"></div>
    </div>
    <div class="gioithieu_home">
      <li><?=full_img($noidung, 'thumb_') ?></li>
      <ul>
        <h3><?=SHOW_text($noidung['p1_'.$lang]) ?></h3>
        <div>
          <?=SHOW_text($noidung['noidung_'.$lang]) ?>
        </div>
        <h2><a <?=full_href($noidung) ?>><?=$glo_lang['xem_chi_tiet'] ?></a></h2>
        <div class="clr"></div>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
<?php } ?>
<?php
  $sp_baiviet   = LAY_baiviet(2, 12, "`opt` = 1");
  $sp_step      = LAY_step(2, 1);
  if(count($sp_baiviet)){
?>
  <div class="box_page_id">
    <div class="title_page">
      <h3><?=$glo_lang['san_pham_cua_chung_toi'] ?></h3>
      <ul>
        <li><a <?=full_href($sp_step) ?>><?=$glo_lang['xem_tat_ca'] ?><i class="fa fa-angle-double-right"></i></a> </li>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="pro_list flex">
      <?php
        foreach ($sp_baiviet as $rows) {
      ?>
      <ul>
        <a <?=full_href($rows) ?>>
        <li><?=full_img($rows) ?></li>
        <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
        </a>
      </ul>
      <?php } ?>
      <div class="clr"></div>
    </div>
  </div>
<?php } ?>
<?php
  $sp_danhmuc   = LAY_danhmuc(7, 0, "`opt` = 1");
  // $sp_step      = LAY_step(2, 1);
  if(count($sp_danhmuc)){
    foreach ($sp_danhmuc as $dm) {
      $sp_baiviet   = LAY_baiviet(7, 6, "`opt` = 1");
      if(!count($sp_baiviet)) continue;
?>
  <div class="box_page_id">
    <div class="title_page">
      <h3><?=SHOW_text($dm['tenbaiviet_'.$lang]) ?></h3>
      <ul>
        <li><a <?=full_href($dm) ?>><?=$glo_lang['xem_tat_ca'] ?><i class="fa fa-angle-double-right"></i></a> </li>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="new_top_id">
      <?php
        $i = 0;
        foreach ($sp_baiviet as $rows) {
          $i++;
          if($i > 1) continue;
      ?>
      <div class="one_new_home">
        <li><a <?=full_href($rows) ?>><?=full_img($rows) ?></a></li>
        <ul>
          <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
          <p><span class="lm_4"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></p>
        </ul>
        <div class="clr"></div>
      </div>
      <?php } ?>
      <div class="one_new_home_right">
        <?php
          $i = 0;
          foreach ($sp_baiviet as $rows) {
            $i++;
            if($i == 1) continue;
        ?>
        <ul>
          <li><a <?=full_href($rows) ?>><?=full_img($rows) ?></a></li>
          <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
          <div class="clr"></div>
        </ul>
        <?php } ?>
      </div>
      <div class="clr"></div>
    </div>
  </div>
<?php }} ?>
</div>
<div class="left_conten">
  <?php include _source."left_conten.php";?>
</div>
<div class="clr"></div>