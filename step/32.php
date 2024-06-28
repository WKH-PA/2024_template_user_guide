<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 12;
  else $numview         = $thongtin_step['num_view'];

  $key       = isset($_GET['key']) ? $_GET['key'] : '';
  $tn        = isset($_GET['tn']) ? $_GET['tn'] : '';


  $lay_all_kx = "";
  $name_titile      = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";
  if($slug_table != 'step'){
      $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
  }
  $wh = "";
  if($lay_all_kx != "") {
    $wh = "  AND `id_parent` in (".$lay_all_kx.") ";
  }


  // //check tieu thuyet
  if($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
  }
  //
  if($key != ""){
    $key_er = explode("/",$key);
    $time_bg = mktime(0,0,0, $key_er[1],$key_er[0],$key_er[2]);
    $time_en = mktime(23,59,59, $key_er[1],$key_er[0],$key_er[2]);
    $wh .= " AND `capnhat` > $time_bg AND `capnhat` < $time_en ";
  }
  if($tn != "") {
    $tn_z = str_replace("-", ",", $tn);
    $tn_c = explode(",", $tn_z);
    $tn_c = count($tn_c);
    $wh .= " AND `id` IN (SELECT `id_baiviet`  
          FROM `#_baiviet_select_tinhnang` 
          WHERE `id_val` IN ($tn_z) 
          GROUP BY `id_baiviet`
          HAVING COUNT(*) = $tn_c) ";
    // $wh .= " AND `id` IN (SELECT `id_baiviet`  
    //       FROM `#_baiviet_select_tinhnang` 
    //       WHERE `id_val` = '$tn_z' ) ";
  }
  $catasort = "`opt` DESC";
  include _source."phantrang_kietxuat.php";
  // include _source."phantrang_danhmuc.php";

  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);


  $link_p =  GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/');


  // full_src($thongtin_step, '')
  $tinhnang_arr      = LAY_bv_tinhnang($slug_step);

  
?>
<div class="box_page_id">
  <div class="title_page">
    <h3><?=$name_titile ?></h3>
    <div class="clr"></div>
  </div>
  <?php if($slug_step == 5 && empty($_SESSION['id'])){
    include _source."is_check_login.php";
  }
  else { include _source."is_check_login_login.php"; ?>
    <div class="click_loc click_loc_mnl">
      <ul>
        <li>
          <div class="col-md-2 row-frm">
            <input type="text" name="cont_cmnd" class="form-control datepicker js_key" placeholder="<?=$glo_lang['chon_ngay_can_tim'] ?>">
          </div>
        </li>
        <?php
          $tn_arr = explode("-", $tn);
           foreach ($tinhnang_arr as $rows) {
            if($rows['id_parent'] != 0) continue;
        ?>
        <li>
          <div class="col-md-2 row-frm">
            <select name="city" id="city" class="js_tinhnang form-control">
              <option value="0"><?=$rows['tenbaiviet_'.$lang] ?></option>
              <?php
                foreach ($tinhnang_arr as $rows_2) {
                  if($rows_2['id_parent'] != $rows['id']) continue;
              ?>
              <option value="<?=$rows_2['id'] ?>" <?=in_array($rows_2['id'] , $tn_arr) ? 'selected="selected"' : "" ?>><?=$rows_2['tenbaiviet_'.$lang] ?></option>
              <?php } ?>
            </select>
          </div>
        </li>
        <?php } ?>

        <h3><a class="cur" onclick="js_timkiem('<?=$full_url."/".$thongtin_step['seo_name']."/" ?>')"><?=$glo_lang['tim_kiem'] ?></a></h3>
        <h3><a class="cur" onclick="printDiv()"><?=$glo_lang['in_trang_nay'] ?></a></h3>
        <div class="clr"></div>
      </ul>
    </div>
    <?php $i = 0; foreach ($nd_kietxuat as $rows) { $i++; if($i > 1) continue; ?>
    <div id="dv-js-print">
    <div class="title_tl">
      <ul>
        <h4>
          <p><?=$glo_lang['ten_cong_ty'] ?></p>
        </h4>
        <h2>
          <?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>
          <span><?=$glo_lang['date'].": ".date('d-m-Y', $rows['capnhat']) ?></span>
        </h2>
        <p><?=$glo_lang['ms'] ?>:<?=SHOW_text($rows['p1']) ?></p>
        <div class="clr"></div>
      </ul>
    </div>
    <div class="showText showText_onlytable">
      <?php 
        if($rows['noidung_'.$lang] != ""){
          echo SHOW_text($rows['noidung_'.$lang]);
        }else{
      ?>
      <!-- // filex excel -->
      <?php
        $array_manongtruong = array(
          "01" => "Nông trường 1",
          "02" => "Nông trường 2",
          "03" => "Nông trường 3",
          "04" => "Nông trường 4",
          "05" => "Nông trường 5",
          "06" => "Nông trường 6",

          "08" => "Nông trường 8",
          "09" => "Nông trường 9",
          "10" => "Phú Riềng đỏ",
          "11" => "NT Nghĩa Trung",
          "12" => "NT Minh Hưng",
          "13" => "NT Thọ Sơn",
          "15" => "NLT Tuy Đức"
        );
        function check_ma_tt_ok($ma){
          $ma = substr($ma, 6, 2); 
          return $ma;
        }

      ?>
      <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="table">
        <tbody>
          <tr></tr>
          <tr></tr>
          <tr>
            <th width="11%" rowspan="2" align="center" bgcolor="#ff6600" class="chu4"><?=$glo_lang['don_vi'] ?></th>
            <th colspan="8%" align="center" bgcolor="#ff6600" class="chu4"><?=$glo_lang['mu_nguyen_lieu_nong_truong'] ?></th>
            <th colspan="8%" align="center" bgcolor="#ff6600" class="chu4"><?=$glo_lang['mu_nguyen_lieu_nha_may'] ?></th>
            <th width="5%" rowspan="2" bgcolor="#ff6600" class="chu4"><?=$glo_lang['lkt_chia_kht'] ?></th>
            <th width="4%" rowspan="2" bgcolor="#ff6600" class="chu4"><?=$glo_lang['lkn_chia_khn'] ?></th>
            <th width="5%" rowspan="2" bgcolor="#ff6600" class="chu4"><?=$glo_lang['lkn_chia_khpd'] ?></th>
          </tr>
          <tr bgcolor="#ff6600" class="chu4">
            <th width="" bgcolor="#ff6600" class="chu4"><?=$glo_lang['slg'] ?></th>
            <th width="" bgcolor="#ff6600" class="chu4"><?=$glo_lang['dgc'] ?></th>
            <th width="" bgcolor="#ff6600" class="chu4"><?=$glo_lang['nuoc'] ?></th>
            <th width="" bgcolor="#ff6600" class="chu4"><?=$glo_lang['t_thu'] ?></th>
            <th width="" bgcolor="#ff6600" class="chu4"><?=$glo_lang['pt_tt'] ?></th>
            <th width="" bgcolor="#ff6600" class="chu4"><?=$glo_lang['dong'] ?></th>
            <th width="" bgcolor="#ff6600" class="chu4"><?=$glo_lang['tl_thang'] ?></th>
            <th width="" bgcolor="#ff6600" class="chu4"><?=$glo_lang['tl_nam'] ?></th>
            <th bgcolor="#ff6600" class="chu4"><?=$glo_lang['slg'] ?></th>
            <th bgcolor="#ff6600" class="chu4"><?=$glo_lang['dgc'] ?></th>
            <th bgcolor="#ff6600" class="chu4"><?=$glo_lang['nuoc'] ?></th>
            <th bgcolor="#ff6600" class="chu4"><?=$glo_lang['t_thu'] ?></th>
            <th bgcolor="#ff6600" class="chu4"><?=$glo_lang['pt_tt'] ?></th>
            <th bgcolor="#ff6600" class="chu4"><?=$glo_lang['dong'] ?></th>
            <th bgcolor="#ff6600" class="chu4"><?=$glo_lang['tl_thang'] ?></th>
            <th bgcolor="#ff6600" class="chu4"><?=$glo_lang['tl_nam'] ?></th>
          </tr>
          <?php
            function lamtron_so($num){
              $num     = round($num, 1); 
              $num_arr = explode(".",$num);
              return NUMBER_fomat(@$num_arr[0]).(@$num_arr[1] != "" ? ",".@$num_arr[1] : "");
              
            }
            function round_num($num){
              return NUMBER_fomat(round($num));
            }
            $ngay_now  = (int)date('d', $rows['capnhat']);
            $thang_now = (int)date('m', $rows['capnhat']);
            $nam_now   = (int)date('Y', $rows['capnhat']);

            foreach ($array_manongtruong as $key_ma => $value) {
              ${"slg_bg_".$key_ma}    = 0;
              ${"drc_bg_".$key_ma}    = 0;
              ${"nuoc_bg_".$key_ma}   = 0;
              ${"tthu_bg_".$key_ma}   = 0;
              ${"tt_bg_".$key_ma}     = 0;
              ${"dong_bg_".$key_ma}   = 0;
              ${"lk_thg_bg_".$key_ma} = 0;
              ${"lk_nam_bg_".$key_ma} = 0;


              ${"tap1_bg_".$key_ma}   = 0;
              ${"day_bg_".$key_ma}    = 0;
              ${"dong2_bg_".$key_ma}  = 0;
   
              ${"tongnuoc_bg_".$key_ma}  = 0;

              ${"slg_end_".$key_ma}    = 0;
              ${"drc_end_".$key_ma}    = 0;
              ${"nuoc_end_".$key_ma}   = 0;
              ${"tthu_end_".$key_ma}   = 0;
              ${"tt_end_".$key_ma}     = 0;
              ${"dong_end_".$key_ma}   = 0;
              ${"lk_thg_end_".$key_ma} = 0;
              ${"lk_nam_end_".$key_ma} = 0;

              ${"tap1_end_".$key_ma}   = 0;
              ${"day_end_".$key_ma}    = 0;
              ${"dong2_end_".$key_ma}  = 0;

   

              ${"tongnuoc_end_".$key_ma}  = 0;
            }

            $bc_ctiet_pmunt = DB_que("SELECT * FROM `#_baiviet_excel` WHERE `id_parent` = '".$rows['id']."' AND `is_file` = 3 ORDER BY `id` ASC ");
            $bc_ctiet_pmunt = DB_arr($bc_ctiet_pmunt);

            $i = 0;


            $tongso_drc_bg = 0;
            $tongso_drc_end = 0;
            $tongnuoc_bg   = 0;
            $tongnuoc_end   = 0;


            foreach ($bc_ctiet_pmunt as $c_row) {
              $i++;
              if($i == 1) continue;
              $key_ma = check_ma_tt_ok($c_row['col_a']);

              $khoi_luong = (float) ($c_row['col_e']);
              $h_luong    = (float) ($c_row['col_f']);
              $kq         = (float) ($khoi_luong * $h_luong / 100);

              if(is_numeric($c_row['col_b'])){
                $ngay_d  = (int)date("d", $c_row['col_b']);
                $thang_d = (int)date("m", $c_row['col_b']);
                $nam_d   = (int)date("Y", $c_row['col_b']);
              }
              else {
                $day_vachar = explode(" ", $c_row['col_b']);
                $day_vachar = explode("-", $day_vachar[0]);
                $ngay_d  = $day_vachar[2];
                $thang_d = $day_vachar[1];
                $nam_d   = $day_vachar[0];
              }
              

              $col      = strtolower($c_row['col_d']);

              if($col == 'nl1' || $col == 'nl2') {
                ${"nuoc_bg_".$key_ma} += $kq;

                ${"drc_bg_".$key_ma} += $kq;
                ${"tongnuoc_bg_".$key_ma}  += $khoi_luong;

                $tongso_drc_bg += $kq;
                $tongnuoc_bg   += $khoi_luong;
                // 
              }

              if($col == 'dong1' || $col == 'ndong') {
                ${"dong_bg_".$key_ma} += $kq;
              }

              if($col == 'tap1') {
                ${"tap1_bg_".$key_ma} += $kq;
              }
              if($col == 'day') {
                ${"day_bg_".$key_ma} += $kq;
              }
              if($col == 'dong2') {
                ${"dong2_bg_".$key_ma} += $kq;
              }

            }

            // bc_ctiet_pmunm
            $bc_ctiet_pmunm = DB_que("SELECT * FROM `#_baiviet_excel` WHERE `id_parent` = '".$rows['id']."' AND `is_file` = 2 ORDER BY `id` ASC ");
            $bc_ctiet_pmunm = DB_arr($bc_ctiet_pmunm);

            $i = 0;
            foreach ($bc_ctiet_pmunm as $c_row) {
              $i++;
              if($i == 1) continue;
              $key_ma = check_ma_tt_ok($c_row['col_a']);

              $khoi_luong = (float) ($c_row['col_e']);
              $h_luong    = (float) ($c_row['col_f']);
              $kq         = (float) ($khoi_luong * $h_luong / 100);

              if(is_numeric($c_row['col_b'])){
                $ngay_d  = (int)date("d", $c_row['col_b']);
                $thang_d = (int)date("m", $c_row['col_b']);
                $nam_d   = (int)date("Y", $c_row['col_b']);
              }
              else {
                $day_vachar = explode(" ", $c_row['col_b']);
                $day_vachar = explode("-", $day_vachar[0]);
                $ngay_d  = $day_vachar[2];
                $thang_d = $day_vachar[1];
                $nam_d   = $day_vachar[0];
              }

              $col      = strtolower($c_row['col_d']);

              if($col == 'nl1' || $col == 'nl2') {
                ${"nuoc_end_".$key_ma} += $kq;

                ${"drc_end_".$key_ma} += $kq;
    
                ${"tongnuoc_end_".$key_ma}  += $khoi_luong;

                $tongso_drc_end += $kq;
                $tongnuoc_end   += $khoi_luong;
                // 
              }

              if($col == 'dong1' || $col == 'ndong') {
                ${"dong_end_".$key_ma} += $kq;
              }

              if($col == 'tap1') {
                ${"tap1_end_".$key_ma} += $kq;
              }
              if($col == 'day') {
                ${"day_end_".$key_ma} += $kq;
              }
              if($col == 'dong2') {
                ${"dong2_end_".$key_ma} += $kq;
              }
            }


            $slg_bg         = 0;
            $drc_bg         = 0;
            $nuoc_bg        = 0;
            $tthu_bg        = 0;
            $tt_bg          = 0;
            $dong_bg        = 0;
            $lk_thg_bg      = 0;
            $lk_nam_bg      = 0;
            $slg_end        = 0;
            $drc_end        = 0;
            $nuoc_end       = 0;
            $tthu_end       = 0;
            $tt_end         = 0;
            $dong_end       = 0;
            $lk_thg_end     = 0;
            $lk_nam_end     = 0;


            $tong_1     = 0;
            $tong_2     = 0;
            $tong_3     = 0;


            //tinh luy ke nam
            $check_lknawm_bg = DB_que("SELECT * FROM `#_baiviet_excel` WHERE `id_parent` IN (SELECT `id` FROM `#_baiviet` WHERE `step` = '5' AND `showhi` = 1) AND `is_file` = 3 ORDER BY `id` ASC ");
            $check_lknawm_bg = DB_arr($check_lknawm_bg);

            foreach ($check_lknawm_bg as $c_row) {

              if($c_row['col_b'] == 'ngay') continue;

              $key_ma = check_ma_tt_ok($c_row['col_a']);

              $khoi_luong = (float) ($c_row['col_e']);
              $h_luong    = (float) ($c_row['col_f']);
              $kq         = (float) ($khoi_luong * $h_luong / 100);

              if(is_numeric($c_row['col_b'])){
                $nam_d   = (int)date("Y", $c_row['col_b']);
                $thang_d = (int)date("m", $c_row['col_b']);
                $ngay_d  = (int)date("d", $c_row['col_b']);
              }
              else {
                $day_vachar = explode(" ", $c_row['col_b']);
                $day_vachar = explode("-", $day_vachar[0]);
                $nam_d   = $day_vachar[0];
                $thang_d = $day_vachar[1];
                $ngay_d  = $day_vachar[2];
              }

              if($thang_now == $thang_d && $nam_now == $nam_d && $ngay_d <= $ngay_now) { //trong thang
                ${"lk_thg_bg_".$key_ma} += $kq;
              }
              if($nam_d <= $nam_now) { //trong nam
                if($nam_d < $nam_now) {
                  ${"lk_nam_bg_".$key_ma} += $kq;
                }
                else {
                  if($thang_d < $thang_now) ${"lk_nam_bg_".$key_ma} += $kq;
                  else if($thang_d == $thang_now) {
                    if($ngay_d <= $ngay_now) ${"lk_nam_bg_".$key_ma} += $kq;
                  }
                }
                
              }
            }

            //lk nam end
            $check_lknawm_end = DB_que("SELECT * FROM `#_baiviet_excel` WHERE `id_parent` IN (SELECT `id` FROM `#_baiviet` WHERE `step` = '5' AND `showhi` = 1) AND `is_file` = 2 ORDER BY `id` ASC ");
            $check_lknawm_end = DB_arr($check_lknawm_end);
            foreach ($check_lknawm_end as $c_row) {

              if($c_row['col_b'] == 'ngay') continue;

              $key_ma = check_ma_tt_ok($c_row['col_a']);

              $khoi_luong = (float) ($c_row['col_e']);
              $h_luong    = (float) ($c_row['col_f']);
              $kq         = (float) ($khoi_luong * $h_luong / 100);

              if(is_numeric($c_row['col_b'])){
                $nam_d   = (int)date("Y", $c_row['col_b']);
                $thang_d = (int)date("m", $c_row['col_b']);
                $ngay_d  = (int)date("d", $c_row['col_b']);
              }
              else {
                $day_vachar = explode(" ", $c_row['col_b']);
                $day_vachar = explode("-", $day_vachar[0]);
                $nam_d   = $day_vachar[0];
                $thang_d = $day_vachar[1];
                $ngay_d  = $day_vachar[2];
              }

              if($thang_now == $thang_d && $nam_now == $nam_d && $ngay_d <= $ngay_now) { //trong thang
                ${"lk_thg_end_".$key_ma} += $kq;
              }
              if($nam_d <= $nam_now) { //trong nam
                if($nam_d < $nam_now) {
                  ${"lk_nam_end_".$key_ma} += $kq;
                }
                else {
                  if($thang_d < $thang_now) ${"lk_nam_end_".$key_ma} += $kq;
                  else if($thang_d == $thang_now) {
                    if($ngay_d <= $ngay_now) ${"lk_nam_end_".$key_ma} += $kq;
                  }
                }
              }
            }
            // end
            


            foreach ($array_manongtruong as $key => $value) {
              // T.THU =TAP1+DAY+DONG2
              ${"tthu_bg_".$key} = ${"tap1_bg_".$key} + ${"day_bg_".$key} + ${"dong2_bg_".$key};
              // SLG = NƯỚC+T.THU+ĐÔNG
              ${"slg_bg_".$key}  = ${"nuoc_bg_".$key} + ${"tthu_bg_".$key} + ${"dong_bg_".$key};
              // %TT=T.THU/SLG x 100
              if(${"slg_bg_".$key} == 0){
                ${"tt_bg_".$key}   = (float)(${"tthu_bg_".$key} / 1 * 100);
              }
              else {
                ${"tt_bg_".$key}   = (float)(${"tthu_bg_".$key} / ${"slg_bg_".$key} * 100);
              }

              if(${"tongnuoc_bg_".$key} == 0){
                ${"drc_bg_".$key} = (float)(${"drc_bg_".$key} / 1) * 100;
              }
              else {
                ${"drc_bg_".$key} = (float)(${"drc_bg_".$key} / ${"tongnuoc_bg_".$key}) * 100;
              }
              
              // T.THU =TAP1+DAY+DONG2
              ${"tthu_end_".$key} = ${"tap1_end_".$key} + ${"day_end_".$key} + ${"dong2_end_".$key};
              // SLG = NƯỚC+T.THU+ĐÔNG
              ${"slg_end_".$key}  = ${"nuoc_end_".$key} + ${"tthu_end_".$key} + ${"dong_end_".$key};
              // %TT=T.THU/SLG x 100
              if(${"slg_end_".$key} == 0){
                ${"tt_end_".$key}   = (float)(${"tthu_end_".$key} / 1 * 100);
              }
              else {
                ${"tt_end_".$key}   = (float)(${"tthu_end_".$key} / ${"slg_end_".$key} * 100);
              }
              
              if(${"tongnuoc_end_".$key} == 0){
                ${"drc_end_".$key} = (float)(${"drc_end_".$key} / 1) * 100;
              }
              else {
                ${"drc_end_".$key} = (float)(${"drc_end_".$key} / ${"tongnuoc_end_".$key}) * 100;
              }


              $check_nd_mcs = DB_que("SELECT * FROM `#_danhsach_munguyenlien` WHERE `showhi` = 1 AND `nam` = '$nam_now' AND `tenbaiviet_en` = '$key' ORDER BY `catasort` DESC LIMIT 1");
              $check_khpd   = 1;
              $check_khn    = 1;
              $check_thang  = 1;

              if(DB_num($check_nd_mcs)){
                $check_nd_mcs =DB_arr($check_nd_mcs, 1);
                $check_khpd   = $check_nd_mcs['khpd'];
                $check_khn    = $check_nd_mcs['khn'];
                $check_thang  = $check_nd_mcs['thang_'.$thang_now];
              }


              $slg_bg         += ${"slg_bg_".$key};
              $drc_bg         += ${"drc_bg_".$key};
              $nuoc_bg        += ${"nuoc_bg_".$key};
              $tthu_bg        += ${"tthu_bg_".$key};
              $tt_bg          += ${"tt_bg_".$key};
              $dong_bg        += ${"dong_bg_".$key};
              $lk_thg_bg      += ${"lk_thg_bg_".$key};
              $lk_nam_bg      += ${"lk_nam_bg_".$key};
              $slg_end        += ${"slg_end_".$key};
              $drc_end        += ${"drc_end_".$key};
              $nuoc_end       += ${"nuoc_end_".$key};
              $tthu_end       += ${"tthu_end_".$key};
              $tt_end         += ${"tt_end_".$key};
              $dong_end       += ${"dong_end_".$key};
              $lk_thg_end     += ${"lk_thg_end_".$key};
              $lk_nam_end     += ${"lk_nam_end_".$key};

              $lk_thg_1 = ${"lk_thg_end_".$key} / $check_thang * 100;
              $lk_thg_2 = ${"lk_nam_end_".$key} / $check_khn * 100;
              $lk_thg_3 = ${"lk_nam_end_".$key} / $check_khpd * 100;
          ?>
          <tr>
            <td class="chu2"><?=$value ?></td>
            <td class="chu1"><?=@round_num(${"slg_bg_".$key}) ?></td>
            <td class="chu1">
              <?=@lamtron_so(${"drc_bg_".$key}) ?>
            </td>
            <td class="chu1"><?=@round_num(${"nuoc_bg_".$key}) ?></td>
            <td class="chu1"><?=@round_num(${"tthu_bg_".$key}) ?></td>
            <td class="chu1"><?=@lamtron_so(${"tt_bg_".$key}) ?></td>
            <td class="chu1"><?=@round_num(${"dong_bg_".$key}) ?></td>
            <td class="chu1"><?=@round_num(${"lk_thg_bg_".$key}) ?></td>
            <td class="chu1"><?=@round_num(${"lk_nam_bg_".$key}) ?></td>
            <td class="chu1"><?=@round_num(${"slg_end_".$key}) ?></td>
            <td class="chu1">
              <?=@lamtron_so(${"drc_end_".$key}) ?>
            </td>
            <td class="chu1"><?=@round_num(${"nuoc_end_".$key}) ?></td>
            <td class="chu1"><?=@round_num(${"tthu_end_".$key}) ?></td>
            <td class="chu1"><?=@lamtron_so(${"tt_end_".$key}) ?></td>
            <td class="chu1"><?=@round_num(${"dong_end_".$key}) ?></td>
            <td class="chu1"><?=@round_num(${"lk_thg_end_".$key}) ?></td>
            <td class="chu1"><?=@round_num(${"lk_nam_end_".$key}) ?></td>
            <td class="chu1">
              <?=lamtron_so($lk_thg_1) ?>
            </td>
            <td class="chu1">
              <?=lamtron_so($lk_thg_2) ?>
            </td>
            <td class="chu1">
              <?=lamtron_so($lk_thg_3) ?>
            </td>
          </tr>
          <?php } ?>
          <tr>
            <td class="chu2">TỔNG CỘNG</td>
            <td class="chu1"><?=@round_num($slg_bg) ?></td>
            <td class="chu1">
              <?php 
                if($tongnuoc_bg == 0) $tongnuoc_bg = 1;
                $tongso_drc_bg_kq = (float)($tongso_drc_bg / $tongnuoc_bg) * 100;
                echo @lamtron_so($tongso_drc_bg_kq);

                if($slg_bg == 0) $slg_bg = 1;
                $tt_bg_kq = (float)($tthu_bg / $slg_bg * 100);

                if($slg_end == 0) $slg_end = 1;
                $tt_end_kq = (float)($tthu_end / $slg_end * 100);


                
                $check_khpd   = 1;
                $check_khn    = 1;
                $check_thang  = 1;

                $check_nd_mcs = DB_que("SELECT * FROM `#_danhsach_munguyenlien` WHERE `showhi` = 1 AND `nam` = '$nam_now'  ORDER BY `catasort` DESC ");
                $check_nd_mcs = DB_arr($check_nd_mcs);
                foreach ($check_nd_mcs as $k_val) {
                  $check_khpd   += $k_val['khpd'];
                  $check_khn    += $k_val['khn'];
                  $check_thang  += $k_val['thang_'.$thang_now];
                }
              

                $lk_thg_1 = $lk_thg_end / $check_thang * 100;
                $lk_thg_2 = $lk_nam_end / $check_khn * 100;
                $lk_thg_3 = $lk_nam_end / $check_khpd * 100;

              ?>
            </td>
            <td class="chu1"><?=@round_num($nuoc_bg) ?></td>
            <td class="chu1"><?=@round_num($tthu_bg) ?></td>
            <td class="chu1"><?=@lamtron_so($tt_bg_kq) ?></td>
            <td class="chu1"><?=@round_num($dong_bg) ?></td>
            <td class="chu1"><?=@round_num($lk_thg_bg) ?></td>
            <td class="chu1"><?=@round_num($lk_nam_bg) ?></td>

            <td class="chu1"><?=@round_num($slg_end) ?></td>
            <td class="chu1">
              <?php 
                if($tongnuoc_end == 0) $tongnuoc_end = 1;
                $tongso_drc_end_kq = (float)($tongso_drc_end / $tongnuoc_end) * 100;
                echo @lamtron_so($tongso_drc_end_kq);
              ?>
            </td>
            <td class="chu1"><?=@round_num($nuoc_end) ?></td>
            <td class="chu1"><?=@round_num($tthu_end) ?></td>
            <td class="chu1"><?=@lamtron_so($tt_end_kq) ?></td>
            <td class="chu1"><?=@round_num($dong_end) ?></td>
            <td class="chu1"><?=@round_num($lk_thg_end) ?></td>
            <td class="chu1"><?=@round_num($lk_nam_end) ?></td>
            <td class="chu1">
              <?=lamtron_so($lk_thg_1) ?>
              </td>
            <td class="chu1"><?=lamtron_so($lk_thg_2) ?></td>
            <td class="chu1"><?=lamtron_so($lk_thg_3) ?></td>
          </tr>
          
        </tbody>
      </table>
      <!-- /nha may -->
      <?php

        $bc_ctiet_pmutn = DB_que("SELECT * FROM `#_baiviet_excel` WHERE `id_parent` IN (SELECT `id` FROM `#_baiviet` WHERE `step` = '5' AND `showhi` = 1) AND `is_file` = 1 ORDER BY `id` ASC ");

        $bc_ctiet_pmutn = DB_arr($bc_ctiet_pmutn);


        $i = 0;
        $longha_ngay  = 0;
        $longha_thang = 0;
        $longha_nam   = 0;

        $trungt_ngay  = 0;
        $trungt_thang = 0;
        $trungt_nam   = 0;
        foreach ($bc_ctiet_pmutn as $rows_mtn) {

          $i++;
          if($rows_mtn['col_a'] == 'ngay') continue;
          
          $nhamay  = substr($rows_mtn['col_b'], 0, 2); 

          if(is_numeric($rows_mtn['col_a'])){
            $ngay_d  = (int)date("d", $rows_mtn['col_a']);
            $thang_d = (int)date("m", $rows_mtn['col_a']);
            $nam_d   = (int)date("Y", $rows_mtn['col_a']);
          }
          else {
            $day_vachar = explode(" ", $rows_mtn['col_a']);
            $day_vachar = explode("-", $day_vachar[0]);
            $ngay_d  = $day_vachar[2];
            $thang_d = $day_vachar[1];
            $nam_d   = $day_vachar[0];
          }

          $so_luong = (float) ($rows_mtn['col_d']);
          $h_luong  = (float) ($rows_mtn['col_e']);
          $kq       = (float) ($so_luong * $h_luong / 100);


          if(strtolower($nhamay) == 'pb') { // long ha
            if($ngay_now == $ngay_d && $thang_now == $thang_d && $nam_now == $nam_d) { //trong ngay
              $longha_ngay += $kq;
            }

            ////////////////////
            if($thang_now == $thang_d && $nam_now == $nam_d && $ngay_d <= $ngay_now) { //trong thang
              $longha_thang += $kq;
            }
            if($nam_d <= $nam_now) { //trong nam
              if($nam_d < $nam_now) {
                $longha_nam += $kq;
              }
              else {
                if($thang_d < $thang_now) $longha_nam += $kq;
                else if($thang_d == $thang_now) {
                  if($ngay_d <= $ngay_now) $longha_nam += $kq;
                }
              }
            }
            ///
            ////////////////////
          }

          if(strtolower($nhamay) == 'tt') { // trung tam
            if($ngay_now == $ngay_d && $thang_now == $thang_d && $nam_now == $nam_d) { //trong ngay
              $trungt_ngay += $kq;
            }
    
            // /////////////
            if($thang_now == $thang_d && $nam_now == $nam_d && $ngay_d <= $ngay_now) { //trong thang
              $trungt_thang += $kq;
            }
            if($nam_d <= $nam_now) { //trong nam
              if($nam_d < $nam_now) {
                $trungt_nam += $kq;
              }
              else {
                if($thang_d < $thang_now) $trungt_nam += $kq;
                else if($thang_d == $thang_now) {
                  if($ngay_d <= $ngay_now) $trungt_nam += $kq;
                }
              }
            }
            // 
            // ////////////
          }
          
        }
        
      ?>
      <div class="dv-row-caosu no_box">
        <div class="dv-left-cs">
          <?=$glo_lang['cao_su_tieu_dien'] ?>
        </div>
        <div class="tb">
        <table border="1" align="center" cellpadding="0" cellspacing="0" class="table" style=" border:1px solid #09F;">
          <tbody>
          <tr>
            <th bgcolor="#ff6600" class="chu4"><strong><?=$glo_lang['nha_may'] ?></strong></th>
            <th bgcolor="#ff6600" class="chu4"><strong><?=$glo_lang['trong_ngay'] ?></strong></th>
            <th bgcolor="#ff6600" class="chu4"><strong><?=$glo_lang['luy_ke_thang'] ?></strong></th>
            <th bgcolor="#ff6600" class="chu4"><strong><?=$glo_lang['luy_ke_nam'] ?></strong></th>
          </tr>
           
            <tr><td class="chu2"><?=$glo_lang['long_ha'] ?></td>
              <td class="chu1"><?=round_num($longha_ngay) ?></td>
              <td class="chu1"><?=round_num($longha_thang) ?></td>
              <td class="chu1"><?=round_num($longha_nam) ?></td>
           </tr>
           <tr>
            <td class="chu2"><?=$glo_lang['trung_tam'] ?></td>
              <td class="chu1"><?=round_num($trungt_ngay) ?></td>
              <td class="chu1"><?=round_num($trungt_thang) ?></td>
              <td class="chu1"><?=round_num($trungt_nam) ?></td>
           </tr>
           
            <tr><td class="chu6"><?=$glo_lang['cong'] ?></td>
              <td class="chu1"><?=round_num($longha_ngay + $trungt_ngay) ?></td>
              <td class="chu1"><?=round_num($longha_thang + $trungt_thang) ?></td>
              <td class="chu1"><?=round_num($longha_nam + $trungt_nam) ?></td>
           </tr>
         </tbody>
        </table>
        </div>
        <div class="clr"></div>
      </div>

      
      <!-- end -->
      <?php } ?>
    </div>
    </div>
    <?php } ?>
    <div class="clr"></div>
  <?php } ?>
</div>
<script src="myadmin/js/jquery-ui.js?v=2"></script>
<link rel="stylesheet" href="myadmin/css/jquery-ui.css?v=2">
<script type="text/javascript">
  $('.datepicker').attr('autocomplete','off');
  $(".datepicker").each(function(){
      $(this).datepicker({
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        format: 'dd/mm/yyyy'
      });
    });
  function js_timkiem(url) {
    var key = $(".js_key").val();
    var tn =  "";
    $( ".js_tinhnang" ).each(function( index ) {
      if($( this ).val() != 0) {
        if(tn == "") tn += $( this ).val();
        else tn += "-"+$( this ).val();
      }
    });
    window.location.href = url + "?key="+key+"&tn=" + tn;
  }
  function printDiv() {

  var divToPrint=document.getElementById('dv-js-print');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);
}
</script>
