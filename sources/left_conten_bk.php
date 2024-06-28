<?php
  $thuoctinhchung = LAY_dulieusn();
  if(count($thuoctinhchung)){
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$glo_lang['danh_muc_san_pham'] ?></h3>
    <div class="clr"></div>
  </div>
  <div class="menu_left">
    <ul>
      <?php foreach ($thuoctinhchung as $rows) { ?>
      <li><a <?=full_href($rows) ?>><i class="fa fa-angle-right"></i><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
      <?php } ?>
    </ul>
  </div>
</div>
<?php } ?>

<?php
  $sp_baiviet   = LAY_baiviet(15, 1, "`opt` = 1");
  $sp_baiviet_5 = LAY_baiviet(15, 7, "`id` <> '".$sp_baiviet[0]['id']."'");
  // $sp_step      = LAY_step(15, 1);
  if(count($sp_baiviet)){
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$sp_step['tenbaiviet_'.$lang] ?></h3>
    <div class="clr"></div>
  </div>
  <div class="dv-ndgia-mua">
    <h3><?=$glo_lang['date'] ?>: <?=date("d/m/Y", $sp_baiviet[0]['capnhat']) ?></h3>
    <div>
      <div class="dv-conten-ngay-bg no_box">
        <div class="dv-ro flex">
          <div class="dv-r-1"><?=$glo_lang['mu_nuoc'] ?></div>
          <div class="dv-r-2 ct"><?=SHOW_text($sp_baiviet[0]['thuoc_tinh_1_vi']) ?></div>
          <div class="dv-r-3"><?=$glo_lang['dong_tren_tsc'] ?></div>
          <div class="clr"></div>
        </div>
        <div class="dv-ro flex">
          <div class="dv-r-1"><?=$glo_lang['mu_tap'] ?></div>
          <div class="dv-r-2 ct"><?=SHOW_text($sp_baiviet[0]['thuoc_tinh_2_vi']) ?></div>
          <div class="dv-r-3"><?=$glo_lang['dogn_drc'] ?></div>
          <div class="clr"></div>
        </div>
      </div>
    </div>
    <p><a class='cur' onclick="$('.dv-bangngia-khac').toggle(200)"><?=$glo_lang['bang_gia_ngay_khac'] ?></a></p>
    <div class="dv-bangngia-khac">
      <div class="dv-conten-ngay-bg no_box">
        <div class="dv-ro hd flex">
          <div class="dv-r-1 ct"><?=$glo_lang['date'] ?></div>
          <div class="dv-r-2 ct"><?=$glo_lang['mu_nuoc'] ?> </div>
          <div class="dv-r-3 ct"><?=$glo_lang['mu_tap'] ?></div>
          <div class="clr"></div>
        </div>
        <?php foreach ($sp_baiviet_5 as $rows) { ?>
        <div class="dv-ro flex">
          <div class="dv-r-1 ct"><?=date("d/m/Y", $rows['capnhat']) ?></div>
          <div class="dv-r-2 ct"><?=SHOW_text($rows['thuoc_tinh_1_vi']) ?></div>
          <div class="dv-r-3 ct"><?=SHOW_text($rows['thuoc_tinh_2_vi']) ?></div>
          <div class="clr"></div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php
  $rows = LAY_banner_new("`id_parent` = 27", 1);
  if(is_array($rows)){
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$rows['tenbaiviet_'.$lang] ?></h3>
    <div class="clr"></div>
  </div>
  <div class="video_left">
    <iframe width="560" height="315" class="iframe_load" iframe-src="https://www.youtube.com/embed/<?=GET_ID_youtube($rows['seo_name']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
</div>
<?php } ?>
<?php
  $sp_baiviet   = LAY_baiviet(13, 15, "`opt` = 1");
  $sp_step      = LAY_step(13, 1);
  if(count($sp_baiviet)){
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=SHOW_text($sp_step['tenbaiviet_'.$lang]) ?></h3>
    <div class="clr"></div>
  </div>
  <div class="hinhanh_left">
    <div class="marquee">
      <?php
        foreach ($sp_baiviet as $rows) {
      ?>
      <ul>
        <a <?=full_href($rows) ?>>
        <li><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
        <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
        </a>
      </ul>
      <?php } ?>
    </div>
    <script>$('.marquee').marquee({
        duration: 19000,
        gap: 0,
        delayBeforeStart: 0,
        direction: 'up',
        duplicated: true,
        startVisible: true
    });
    </script>
  </div>
</div>
<?php } ?>
<?php
  $sp_baiviet   = LAY_baiviet(7, 5);
  if(count($sp_baiviet)){
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$glo_lang['tin_tuc_su_kien'] ?></h3>
    <div class="clr"></div>
  </div>
  <div class="tin_left">
    <?php
      foreach ($sp_baiviet as $rows) {
    ?>
    <ul>
      <a <?=full_href($rows) ?>>
      <li><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
      <h4><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h4>
      </a>
      <div class="clr"></div>
    </ul>
    <?php } ?>
  </div>
</div>
<?php } ?>
<?php
  $thuoctinhchung = LAY_thuoctinhchung();
  if(count($thuoctinhchung)){
?>
<div class="box_id_home">
  <div class="title_tin_id">
    <h3><?=$glo_lang['lien_ket_web_site'] ?></h3>
    <div class="clr"></div>
  </div>
  <div class="col-md-2 row-frm">
    <select onchange="window.open($(this).val(),'_blank');" class="form-control">
      <option value=""><?=$glo_lang['select'] ?></option>
      <?php foreach ($thuoctinhchung as $rows) { ?>
      <option value="<?=GET_link($full_url, $rows['seo_name']) ?>" target="<?=$rows['blank'] ?>"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<?php } ?>