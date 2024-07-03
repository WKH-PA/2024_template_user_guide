<?php
  $kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '".$slug_step."' AND `id` = '".$arr_running['id_parent']."'", "`id` DESC", 1, "id");
  if(empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_'.$lang];
  }
  else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_'.$lang];
  }

  $lay_all_kx   = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

  $wh           = "  AND `id_parent` = (".$lay_all_kx.") AND `id` <>  '".$arr_running['id']."'";
  $numview      = 12;

  $nd_kietxuat  = DB_fet_rd(" * "," `#_baiviet` "," `step` IN (".$slug_step.") $wh "," `catasort` DESC ", $numview);

  // $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  // $nd_total = mysqli_num_rows($nd_total);
  // $retuen_arr = array();
  // while ($r   = mysqli_fetch_assoc($nd_kietxuat)) {
  //   $retuen_arr[] = $r;
  // }
  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);
  // $img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);

  // if($arr_running['icon_hover'] != "") {
  //   $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
  // }
  // full_src($thongtin_step, '')

?>
<!-- <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->

<div class="right_conten">
  <div class="box_page_id">
    <div class="title_page">
      <h3><?=$kietxuat_name ?></h3>
      <div class="clr"></div>
    </div>
    <div class="title_news">
      <h2><?=SHOW_text($arr_running['tenbaiviet_'.$lang]) ?></h2>
      <div>
        <?=SHOW_text($arr_running['mota_'.$lang]) ?>
      </div>
    </div>
    <div class="showText">
      <?=SHOW_text($arr_running['noidung_'.$lang]); ?><div class="clr"></div>
    </div>
    <div id="sharelink">
        <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
      </div>
      <div class="dv-fb_coment">
        <?php include _source."fb_coment.php"; ?>
      </div>
  </div>
  <div class="box_page_id">
    <div class="title_page">
      <h3><?=$glo_lang['don_vi_truc_thuoc'] ?></h3>
      <div class="clr"></div>
    </div>
    <div class="services_id pro_list_slider no_box">
      <!--  -->
      <?php $data = array("1","1","2","2","2","2") ?>
        <div class="owl-auto-sp owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="0">
      <?php
        foreach ($nd_kietxuat as $rows) {
      ?>
        <div class="item">
          <ul>
            <a  <?=full_href($rows) ?>>
            <li><?=full_img($rows) ?></li>
            <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
            <div>
              <?=SHOW_text($rows['mota_'.$lang]) ?>
            </div>
            </a>
          </ul>
        </div>
       <?php } ?>
      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
<div class="left_conten">
  <?php include _source."left_conten.php";?>
</div>