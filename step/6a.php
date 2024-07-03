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
  $numview      = 6;

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
<link href="css/lightgallery.min.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/lightgallery-all.min.js"></script>
<div class="right_conten">
  <div class="box_page_id">
    <div class="title_page">
      <h3><?=$kietxuat_name ?></h3>
      <div class="clr"></div>
    </div>
    <div class="title_news">
      <h2><?=SHOW_text($arr_running['tenbaiviet_'.$lang]) ?></h2>
    </div>
    <!--  -->
    <div  id="lightgallery" class="album-zoom-gallery flex no_box" >
    <?php
      $danhsach_img = LAY_hinhanhcon($arr_running['id']);
      foreach ($danhsach_img as $rows) {
    ?>
      <div data-src="<?=full_src($rows, '') ?>">
        <a ><?=full_img($rows, "thumbnew_") ?></a>
      </div>
      <?php } ?>
    </div>
    <!--  -->
    <div class="clr"></div>
  </div>
  <div class="box_page_id">
    <div class="title_page">
      <h3><?=$glo_lang['thu_vien_anh_khac'] ?></h3>
      <div class="clr"></div>
    </div>
    <div class="services_id services_id_hinhanh  pro_list_slider no_box">
        <!--  -->
        <?php $data = array("2","2","2","3","3","3") ?>
          <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
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
<?php include _source."left_conten.php";?>
<div class="clr"></div>
</div>
