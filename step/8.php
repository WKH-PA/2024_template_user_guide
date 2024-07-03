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
  $tenvideo = "";
  $id_video = "";
  foreach ($nd_kietxuat as $rows) {
    $tenvideo      =  $rows['tenbaiviet_'.$lang];
    $id_video      =  $rows['p1'];
    break;
  }
?>
<div class="pagewrap">
  <div class="banner_load" style="background: url(<?=full_src($thongtin_step, '') ?>)"></div>
  <div class="title_link">
    <ul>
      <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li>
      <div class="clr"></div>
    </ul>
  </div>
  <div class="page_conten">
    <div class="right_conten">
      <div class="titile_page_id"><?=$name_titile ?></div>
      <div class="title_news">
      <h2><?=$tenvideo ?></h2>
    </div>
    <div class="video_id_top video_view_top">
      <div class="id_hide_video"></div>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=GET_ID_youtube($id_video) ?>" frameborder="0" gesture="media" allow="encrypted-media" allow="autoplay; encrypted-media; fullscreen" allowfullscreen></iframe>
      <div class="clr"></div>
    </div>
    <div class="thuvienanh_id video_id dv-danhsachpto flex ">
      <?php
        $i = 0;
        foreach ($nd_kietxuat as $rows) {
          $i++;
          if($i == 1) continue;
      ?>
      <ul>
        <a onclick="PLAY_video('<?=GET_ID_youtube($rows['p1']) ?>')" class="cur ">
        <li><?=full_img($rows) ?><i class="fa fa-youtube-play" aria-hidden="true"></i></li>
          <h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
        </a>
      </ul>
      <?php } ?>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>

    <div class="nums no_box">
      <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
      <div class="clr"></div>
    </div>
    </div>
    <div class="left_conten">
      <div class="menu_left">
        <ul>
          <h3><?=$glo_lang['thu_vien'] ?></h3>
          <?php
            $step = LAY_step("9,10,11");
            foreach ($step as $rows) {
          ?>
          <li><a <?=full_href($rows) ?>><i class="fa fa-angle-right"></i><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="clr"></div>
  </div>
</div>
