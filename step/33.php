<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 12;
  else $numview         = $thongtin_step['num_view'];

  $key       = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
  $is_search = isset($_GET['key']) ? true : false;

  $lay_all_kx = "";
  $name_titile      = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";
  if($is_search){
    $slug_step      = "1,3,4";
    $name_titile    = $glo_lang['tim_kiem']; 
    // $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = '6' LIMIT 1");
    // $thongtin_step = mysqli_fetch_assoc($thongtin_step);
  }
  else if($slug_table != 'step'){
      $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
  }
  $wh = "";
  if($lay_all_kx != "") {
    $wh = "  AND `id_parent` in (".$lay_all_kx.") ";
  }
  
  if($is_search) {
    $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%')";
  }

  // //check tieu thuyet
  if($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
  }
  //

  include _source."phantrang_kietxuat.php";
  // include _source."phantrang_danhmuc.php";

  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);

  if($is_search != "") {
    $link_p = '<span>/</span><a>'.$glo_lang['tim_kiem']."</a>";
    $thongtin_step   = LAY_anhstep_now(3);
  }
 
  else {
    $link_p =  GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/');
  }

  // full_src($thongtin_step, '')
 
?>
<!-- <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="link_page">
  <div class="pagewrap">
    <ul>
      <h3><?=$name_titile ?></h3>
      <li><a href="<?=$full_url ?>"><i class="fa fa-home"></i><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/') ?></li>
    </ul>
  </div>
</div>
<div class="page_conten">
  <div class="pagewrap">
    <div class="right_conten">
      <ul class="accordion" id="accordion-1">
        <?php
          if($nd_total == 0){
            echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
          }
          else{
            $i = 0;
            foreach ($nd_kietxuat as $rows) {
              $i++;
        ?>
        <li><a class="menu_parent" class="cur" onclick="show_hoidap(<?=SHOW_text($rows['id']) ?>)"><?=number_format(($pzer - 1) * $numview + $i) ?>. <?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a>
          <ul class="dv-nd-r dv-nd-r-<?=SHOW_text($rows['id']) ?>">
            <?=SHOW_text($rows['noidung_'.$lang]) ?>
          </ul>
        </li>
        <?php }} ?>
        
      </ul>
      <div class="clr"></div>
      <div class="nums no_box">
          <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
          <div class="clr"></div>
        </div>
    </div>
    <div class="left_conten">
      <?php include _source."left_conten.php"; ?>
    </div>
    <div class="clr"></div>
  </div>
</div>
<script type="text/javascript">
  function show_hoidap(id) {
    if($(".dv-nd-r-"+id).hasClass("acti")){
      $(".dv-nd-r-"+id).removeClass("acti");
      $(".dv-nd-r-"+id).hide(200);
    }
    else {
      $(".dv-nd-r").hide(200);
      $(".dv-nd-r").removeClass("acti");
      $(".dv-nd-r-"+id).show(200);
      $(".dv-nd-r-"+id).addClass("acti");
    }
  }
</script>