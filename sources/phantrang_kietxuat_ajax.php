<?php
    $page           = isset($_POST['page']) ? $_POST['page'] : "";
    $list_check_now = $list_check = isset($_POST['list_check']) ? $_POST['list_check'] : "";
    $list_check_pri = isset($_POST['list_check_pri']) ? $_POST['list_check_pri'] : "";
    $list_phantram = isset($_POST['list_phantram']) ? $_POST['list_phantram'] : "";
    $cls_idprsp     = isset($_POST['cls_idprsp']) ? $_POST['cls_idprsp'] : "";
    $tnn_pri_dm     = isset($_POST['tnn_pri_dm']) ? $_POST['tnn_pri_dm'] : "";
    $is_sapxep      = isset($_POST['is_sapxep']) ? $_POST['is_sapxep'] : "";
    $js_danhmuc     = isset($_POST['js_danhmuc']) ? $_POST['js_danhmuc'] : 0;
    $js_search      = isset($_POST['js_search']) ? $_POST['js_search'] : 0;
    $js_key         = isset($_POST['js_key']) ? $_POST['js_key'] : "";
    $th             = isset($_POST['th']) ? $_POST['th'] : 0;


    $step       = 2;
    $numview    = 24;

    $pzer                   = is_numeric($page) ? $page : 1;

    $vi_tri                 = PHANTRANG_start($pzer, $numview);
    if ($pzer               == 1 || $pzer == NULL)
        $pzz                = 0;
    else $pzz               = $pzer * $numview;
    // list tinh nang loai tru
    $list_re     = "";
    $tinhnang_rm = DB_fet("*","`#_baiviet_tinhnang`","","`id` DESC","","arr");
    foreach ($tinhnang_rm as $rows) {
      $list_re   .= $list_re != "" ? ",".$rows['id'] : $rows['id'];
    }
    //
    $wh     = "";

    if($list_check != "") {
      $list_check     = str_replace("-", ",", $list_check);
      $list_check     = trim($list_check,",");
      $list_check_arr = explode(",", $list_check);

      foreach ($tinhnang_rm as $rows) {
        if($rows['id_parent'] != 0) continue;
        ${"wh_end".$rows['id']} = "";

        foreach ($tinhnang_rm as $rows_2) {
          if($rows_2['id_parent'] != $rows['id']) continue;
          if(!in_array($rows_2['id'], $list_check_arr)) continue;

            if(${"wh_end".$rows['id']} != "") {
              ${"wh_end".$rows['id']} .= " OR ";
            }
            ${"wh_end".$rows['id']} .= " `id_val` = '".$rows_2['id']."' ";
        }

        if(${"wh_end".$rows['id']} != "") {
          //query now
          $list_id_tn_sp          = DB_que("SELECT `id_baiviet` FROM `#_baiviet_select_tinhnang`  WHERE `showhi` = 1 AND (".${"wh_end".$rows['id']}.")");
          ${"wh_end".$rows['id']}   = "0";
          while ($rows_bvv          = mysqli_fetch_assoc($list_id_tn_sp)) {
            ${"wh_end".$rows['id']} .=  ",".$rows_bvv['id_baiviet'];
          }

          $wh .= " AND `id` IN (".${"wh_end".$rows['id']}.")";
        }
      }

    }

    //tim theo dm chon
    if($tnn_pri_dm != "") {
      $wh .= " AND `id_parent` IN (".$tnn_pri_dm.")  ";
    }

    //tim theo gia
    if($list_check_pri != "") {

      $list_nhomgia     = DB_fet("*","#_lien_ket_nhanh","`id` IN ($list_check_pri)","`catasort` ASC","", "arr");
      $wh_or            = "";
      foreach ($list_nhomgia as $rows) {
        $wc     = " (`giatien` >= '".$rows['gia_min']."'";
        if($rows['gia_max'] > 0) {
          $wc  .= " AND `giatien` <= '".$rows['gia_max']."'";
        }
        $wc    .= ") ";
        $wh_or .= $wh_or == "" ? $wc  : " OR ". $wc ;
      }
      $wh      .= $wh_or != "" ? " AND ($wh_or) " : "";
    }
    // tim theo %

    if($list_phantram != "") {

      $list_nhomgia     = DB_fet("*","#_lien_ket_nhanh_phan_tram","`id` IN ($list_phantram)","`catasort` ASC","", "arr");
      $wh_or            = "";
      foreach ($list_nhomgia as $rows) {
        $wc     = " (`num_4` >= '".$rows['gia_min']."'";
        if($rows['gia_max'] > 0) {
          $wc  .= " AND `num_4` <= '".$rows['gia_max']."'";
        }
        $wc    .= ") ";
        $wh_or .= $wh_or == "" ? $wc  : " OR ". $wc ;
      }
      $wh      .= $wh_or != "" ? " AND ($wh_or) " : "";
    }
    //
    if($js_search == 1) {
      $wh .= "  AND (`tenbaiviet_vi` LIKE '%$js_key%' OR `tenbaiviet_en` LIKE '%$js_key%' OR `p1` LIKE '%$js_key%')";
    }
    //
    if($cls_idprsp != 0 || $js_danhmuc != 0){
      if($js_danhmuc != 0) {
        $lay_all_kx = LAYDANHSACH_idkietxuat($js_danhmuc, $step);
      }
      else {
        $lay_all_kx = LAYDANHSACH_idkietxuat($cls_idprsp, $step);
      }
      $wh .= "  AND `id_parent` in (".$lay_all_kx.") ";
    }
    //sap xep
    $order_by = "";
    if($is_sapxep != "") {
      if($is_sapxep == 1) $order_by = "`soluotxem` DESC,";
      else if($is_sapxep == 2) $order_by = "`opt2` DESC,";
      else if($is_sapxep == 3) $order_by = "`giatien` ASC,";
      else if($is_sapxep == 4) $order_by = "`giatien` DESC,";
    }
    //opt2
    if($th > 0) {
      $wh .= " AND `id` IN (SELECT `id_baiviet` FROM `#_baiviet_select_tinhnang` WHERE `id_val` = '".$th."' AND `showhi` = 1) ";
      $name_titile = DB_que("SELECT * FROM `#_baiviet_tinhnang` WHERE `id` = '".$th."' LIMIT 1");
      $name_titile = mysqli_result_me($name_titile, 0, "tenbaiviet_".$lang);
    }


    $nd_kietxuat  = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` = '$step' $wh ORDER BY  $order_by `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview");

    $nd_total    = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` = '$step' $wh");

    $nd_total        = @mysqli_num_rows($nd_total);
    $numshow        = ceil($nd_total / $numview);
    $sotrang        = PHANTRANG_findPages($nd_total, $numview);

    // $quatang_sp    = LAY_baiviet(14, 0, "`opt1` = 1", '', 'id');
?>
<div class="pro_home_id pro_home_id_2 flex ">
  <?php
      if($nd_total == 0){
          echo "<div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div>";
      }else{
        while ($rows = mysqli_fetch_assoc($nd_kietxuat)) {
          $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','' );
          include _source."home_temp.php";

    }}
  ?>
  <div class="clr"></div>
</div>

<div class="nums no_box">
  <ul>
    <?=PHANTRANG_ajax($pzer, $sotrang, $list_check) ?>
  </ul>
  <div class="clr"></div>
</div>