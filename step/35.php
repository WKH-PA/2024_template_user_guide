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
  <?php if($slug_step == 14 && empty($_SESSION['id'])){
    include _source."is_check_login.php";
  }
   else { include _source."is_check_login_login.php"; ?>
  <!--  -->
  <div class="click_loc">
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
      <div class="clr"></div>
    </ul>
  </div>
  <div class="dv-table-reposive-n">
    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="table" style=" border:1px solid #09F; margin-top:20px;">
      <tbody>
        <tr>
          <th bgcolor="#227AFF" class="chu4"><?=$glo_lang['ten_file'] ?></th>
          <th bgcolor="#227AFF" class="chu4"><?=$glo_lang['ngay_ban_hanh'] ?></th>
          <th bgcolor="#227AFF" class="chu4"><?=$glo_lang['ngay_dang'] ?></th>
          <?php
            $kk = 0;
            foreach ($tinhnang_arr as $rows) {
              if($rows['id_parent'] != 0) continue;
              $kk++;
          ?>
          <th bgcolor="#227AFF" class="chu4"><?=$rows['tenbaiviet_'.$lang] ?></th>
          <?php } ?>
          <th bgcolor="#227AFF" class="chu4"><?=$glo_lang['tai_ve'] ?></th>
        </tr>
      <?php
            if($nd_total == 0){
              echo "<tr><td colspan='".(4+$kk)."'><div class='dv-notfull'>".$glo_lang['khong_tim_thay_du_lieu_nao']."</div></td></tr>";
            }
            else{
              $i = 0;
              $tinhnang_arr      = LAY_bv_tinhnang($slug_step);
              foreach ($nd_kietxuat as $rows) {
                $i++;
                $icon = '<i class="fa fa-file-excel-o"></i>';
                $link = "";
                if($rows['dowload'] != ""){
                  $link = $fullpath."/datafiles/files/".$rows['dowload'];
                  $ex = explode(".",$rows['dowload']);
                  $ex = end($ex);
                  if($ex == "pdf") $icon = '<i class="fa fa-file-pdf-o"></i>';
                  else if($ex == "doc" || $ex == "docx") $icon = '<i class="fa fa-file-word-o"></i>';
                }
                $link = $link != "" ? 'href="'.$link.'" download' : '';

                if($rows['p1'] != ""){
                  $link = 'href="'.$rows['p1'].'" target="_blank"';
                }
          ?>
          <tr>
            <!-- <td class="text-center"><?=($pzer - 1) * $numview + $i ?></td> -->
            <td><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></td>
            <td class="chu1 text-center"><?=date("d-m-Y", $rows['capnhat']) ?></td>
            <td class="chu1 text-center"><?=date("d-m-Y", $rows['ngaydang']) ?></td>
            <?php
              foreach ($tinhnang_arr as $tnc) {
                if($tnc['id_parent'] != 0) continue;
                $tnoff_child  = DB_que("SELECT * FROM `#_baiviet_select_tinhnang` WHERE `showhi` = 1 AND `id_baiviet` = '".$rows['id']."' AND `id_tinhnang` = '".$tnc['id']."' LIMIT 1");
                $tnoff_child  = DB_arr($tnoff_child, 1);
            ?>
            <td class="chu1"><?=@$tinhnang_arr[$tnoff_child['id_val']]['tenbaiviet_'.$lang] ?></td>
            <?php } ?>
            <td class="text-center"><a <?=$link ?>><?=$glo_lang['download'] ?> <i class="fa fa-download"></i></a></a></td>
          </tr>
          <?php }} ?>
      </tbody>
    </table>
  </div>
  <div class="clr"></div>
    <div class="nums no_box">
        <?=PHANTRANG($pzer, $sotrang, $full_url."/".$motty, $_SERVER['QUERY_STRING']) ?>
        <div class="clr"></div>
      </div>
  <!--  -->
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
</script>