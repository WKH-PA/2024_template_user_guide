<?php
  $hinhanh        = LAY_banner_new("`id_parent` = 26", 1);
?>

<div class="header">
  <div class="header_top" style="background: url(<?=full_src($hinhanh, '') ?>) center center no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; -ms-background-size: cover;">
    <div class="logo_top">
      <li><a href="<?=$full_url ?>"><img src="<?=full_src($thongtin,'') ?>" alt="<?=$thongtin['tenbaiviet_'.$lang] ?>"></a></li>
      <ul>
        <h3 class="tlt"><?=$glo_lang['slugan_1'] ?></h3>
        <h2 class="tlt2"><?=$glo_lang['slugan_2'] ?></h2>
        <h5><?=$glo_lang['slugan_3'] ?></h5>
      </ul>
      <div class="clr"></div>
    </div>
    <?php include _source."lang.php"; ?>
    <div class="clr"></div>
  </div>
  <div class="box_menu">
    <?php include _source."menu_top.php"; ?>
      <div class="timkiem_top no_box">
          <div class="search">
              <a onClick="SEARCH_timkiem('<?=$full_url?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') " style="cursor:pointer; display: flex; align-items: center;">
                  <i class="fa fa-search" style="margin-right: 5px;"></i>
                  <i class="fa fa-times" style="margin-right: 5px; display: none;"></i>
                  <input class="input_search input_search_enter" type="text" value=""  data=".input_search_enter" data-href="<?=$full_url?>/search/?key=" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem']?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
              </a>
          </div>
      </div>
    <div class="clr"></div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $('.input_search_enter').on('focus', function() {
            $(this).prev('a').find('.fa-search').hide();
            $(this).prev('a').find('.fa-times').show();
        });
        $('.input_search_enter').on('blur', function() {
            if ($(this).val() == '') {
                $(this).prev('a').find('.fa-search').show();
                $(this).prev('a').find('.fa-times').hide();
            }
        });
    });
</script>