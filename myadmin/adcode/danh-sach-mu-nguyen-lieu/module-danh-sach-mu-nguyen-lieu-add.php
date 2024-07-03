<?php
 
  $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
  if($_SERVER['REQUEST_METHOD']=='POST')
    {
      foreach ($_POST as $key => $value) {
        ${$key}           = $value;
      }
      $catasort           = str_replace(".", "", $_REQUEST['catasort']);
      $showhi             = isset($_POST['showhi']) ? 1 : 0; 
      
      $cap_nhat    = @explode("/", $cap_nhat);
      $ngay        = $cap_nhat[0];
      $thang       = $cap_nhat[1];
      $nam         = $cap_nhat[2];


      $ngay_dang   = @explode("/", $ngay_dang);
      $ngay_dang   = @strtotime($ngay_dang[2] . "-" . $ngay_dang[1] . "-" . $ngay_dang[0] . " " . @date("H:i:s", time()));
    }


  if(!empty($_POST))
    {
      $hinhanh                      = UPLOAD_image("icon", "../".$duongdantin."/", time());

      $data                    = array(); 
      $data['tenbaiviet_vi']   = $tenbaiviet_vi;
      $data['tenbaiviet_en']   = $tenbaiviet_en;
      $data['catasort']        = $catasort;
      $data['showhi']          = $showhi;

      $data['ngay_dang']       = is_numeric($ngay_dang) ? $ngay_dang : 0;
      $data['ngay']            = is_numeric($ngay) ? $ngay : 0;
      $data['thang']           = is_numeric($thang) ? $thang : 0;
      $data['nam']             = is_numeric($nam) ? $nam : 0;
      $data['khpd']            = is_numeric($khpd) ? $khpd : 0;
      $data['khn']             = is_numeric($khn) ? $khn : 0;
      $data['tong_cong']       = is_numeric($tong_cong) ? $tong_cong : 0;

      for ($i=1; $i <= 12; $i++) { 
        
        $data['thang_'.$i]     = is_numeric(${'thang_'.$i}) ? ${'thang_'.$i} : 0;
      }


      if($id == 0){
        $id                           = ACTION_db($data, $table , 'add',NULL,NULL);
        $_SESSION['show_message_on']  =  "Thêm dữ liệu thành công!";
      }else{
        ACTION_db($data, $table, 'update', NULL, "`id` = ".$id);
        $_SESSION['show_message_on'] =  "Cập nhật dữ liệu thành công!";
      }
      LOCATION_js($url_page."&edit=".$id);
      exit();
    }
 
    
  if($id > 0)
    {
      $sql_se             = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
      $sql_se             = DB_arr($sql_se, 1);

      foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
      }
      $ngay_dang  = date("d/m/Y", $ngay_dang);
    }
    else 
    {
      $catasort   = @layCatasort($table);
      $catasort   = number_format(SHOW_text($catasort),0,',','.');
      $ngay_dang  = date("d/m/Y", time());
      $ngay   = date("d", time());
      $thang  = date("m", time());
      $nam    = date("Y", time());
    }
?>

<section class="content-header">
  <h1><?php if(isset($_SESSION['admin'])){ ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NGÔN NGỮ]</a> <a class="js_okkk" style="cursor: pointer;" onclick="OKKK_by_lh()">[UPDATE] </a> <?php } ?><?=$full_name ?></h1> 
  <ol class="breadcrumb">
      <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
      <li class="active"><?=$full_name ?></li>
  </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post"  enctype='multipart/form-data'>
  <section class="content form_create">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">
          <div class="box-header with-border">
            <h2 class="h2_title">
                <i class="fa fa-pencil-square-o"></i><?=$id > 0 ? 'Sửa' : 'Thêm mới' ?>
            </h2>
            <h3 class="box-title box-title-td pull-right">
                <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
            </h3>
          </div>
        </div>
      </section>
      <section class="col-lg-12">
        <div class="nav-tabs-custom" style="margin-bottom: 0;">
          <?php //include _source."lang.php" ?>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" class="form-control" value="<?=!empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : ''?>" name="tenbaiviet_vi" id="tenbaiviet_vi">
              </div>
            </div>
          </div>
        </div>
        <div class="box p10">
          <div class="form-group">
            <label>KHPĐ</label>
            <input type="text" class="form-control" name="khpd" value="<?=!empty($khpd) ? $khpd : "" ?>">
          </div>
          <div class="form-group">
            <label>KHN</label>
            <input type="text" class="form-control" name="khn" value="<?=!empty($khn) ? $khn : "" ?>">
          </div>
          <?php for ($i=1; $i <= 12 ; $i++) {  ?>
          <div class="form-group">
            <label>Tháng <?=$i ?></label>
            <input type="text" class="form-control" name="thang_<?=$i ?>" value="<?=!empty(${"thang_".$i}) ? ${"thang_".$i} : "" ?>">
          </div>
          <?php } ?>
          <!-- <div class="form-group">
            <label>Tổng cộng</label>
            <input type="text" class="form-control" name="tong_cong" value="<?=!empty($tong_cong) ? $tong_cong : "" ?>">
          </div> -->
          
          <div class="form-group">
            <label>Chọn đơn vị</label>
            <select name="tenbaiviet_en" class="form-control">
              <?php foreach ($array_manongtruong as $k => $vl) { ?>
              <option value="<?=$k ?>" <?=LAY_selected($k, @$tenbaiviet_en) ?>><?=$vl ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Ngày Ban Hành</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="cap_nhat" type="text" class="form-control pull-right datepicker" value='<?=$ngay."/".$thang."/".$nam ?>'>
            </div>
          </div>
          <div class="form-group">
            <label>Ngày đăng</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="ngay_dang" type="text" class="form-control pull-right datepicker" value='<?=$ngay_dang ?>'>
            </div>
          </div>

          <div class="form-group">
            <label>Số thứ tự</label>
            <input type="text" class="form-control" name="catasort" id="catasort" value="<?=SHOW_text($catasort)?>" onkeyup="SetCurrency(this)">
          </div>
          <div class="form-group">
            <label class="mr-20 checkbox-mini">
              <input type="checkbox" name="showhi" class="minimal" <?=isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>> Hiển thị
            </label>
          </div>
        </div>
      </section>
    </div>
  </section>

  <div class="box-header mb-60">
  <h3 class="box-title box-title-td pull-right">
    <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
    <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
    <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
  </h3>
</div>
</form>
<script>
  function checkSubmit(){
    if($("#tenbaiviet_vi").val() == '')
    {
      $("#tenbaiviet_vi").focus();
      return false;
    }
    return true;
  }
</script>