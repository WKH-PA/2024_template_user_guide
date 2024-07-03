<?php
  $table      = '#_danhsach_munguyenlien';
  $full_name  = 'Danh sách mủ nguyên liệu';
  $array_manongtruong = array(
        "0" => "Thuộc công ty",
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

  if(isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-danh-sach-mu-nguyen-lieu-add.php";
  }
  else{

    if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
      {
        for($i=1;$i <= $_REQUEST['maxvalu'];$i++)
          {
            $idofme         = $_POST["idme$i"];
            // $target         = $_POST["target$i"];

            if(isset($_POST["coppy_row$i"])){
              COPPY_row($table, $idofme, 0);
            }

            if(isset($_POST["xoa_gr_arr_$i"])){
              $sql_se   = DB_que("SELECT * FROM `$table` WHERE `id`='".$idofme."' LIMIT 1"); 
              if(DB_num($sql_se) > 0)
              {
                DB_que("DELETE from $table WHERE `id` ='".$idofme."' LIMIT 1");
              }
            }
            else {

              $hinhanh      = UPLOAD_image("upload_$i", "../".$duongdantin."/", time());
              if($hinhanh != false)
              {
                
                TAO_anhthumb("../".$duongdantin."/".$hinhanh, "../".$duongdantin."/thumb_".$hinhanh, 100, 100);

                $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='".$idofme."' LIMIT 1");
                $sql_thongtin = DB_arr($sql_thongtin, 1);
                @unlink("../".$sql_thongtin["duongdantin"]."/".$sql_thongtin["icon"]);
                @unlink("../".$sql_thongtin["duongdantin"]."/thumb_".$sql_thongtin["icon"]);
                $data         = array();
                $data['icon'] = $hinhanh;
                ACTION_db($data, $table, 'update', NULL, "`id` = '$idofme' ");
              }
            }
          }
          $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
      }
    $js_thuoctinh = isset($_GET['js_thuoctinh']) ? $_GET['js_thuoctinh'] : 0;
    $wh = "";
    if($js_thuoctinh != 0){
      $wh = "WHERE  `nam` = '$js_thuoctinh' ";  
    }
    else {
      $wh = "WHERE `nam` = '".date("Y", time())."' ";  
    }
    
    $sql   = DB_que("SELECT * FROM `$table` $wh ORDER BY `catasort` DESC ");
    $sql_array  = DB_arr($sql);

?>
<section class="content-header">
    <h1> <?=$full_name ?></h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active"><?=$full_name ?></li>
    </ol>
</section>

<form action="" method="post" enctype='multipart/form-data'>
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                      <div class="form-group" style="width: 300px; display: inline-block;">
                          <select name='docid' class="js_thuoctinh form-control" onchange='SEARCH_jsstep()'>
                              <option selected="selected" value="0">Lọc năm</option>
                              <?php for ($i=date("Y", time()) + 1; $i > (date("Y", time()) - 4) ; $i--) {  ?>
                              <option value="<?=$i ?>" <?=LAY_selected($js_thuoctinh, $i) ?>><?=$i ?></option>
                              <?php } ?>
                          </select>
                          <script>
                            function SEARCH_jsstep() {
                              var url              = "";
                              if($(".js_thuoctinh").length > 0){
                                var js_thuoctinh    = $(".js_thuoctinh").val().trim();
                                if(js_thuoctinh != 0) url += "&js_thuoctinh="+js_thuoctinh;
                              }
                              window.location.href = "<?=$url_page ?>"+url;
                          }
                          </script>
                      </div>
                        <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        </h3>
                    </div>
                    <style type="text/css">
                      .name { width: 48%; float: left; margin: 1px 0.5%; min-width: 200px}
                      th { white-space: nowrap; min-width: 60px;  }
                      td, th { position: relative; font-size: 12px; padding: 1px !important; }
                      .js_nutnumber { padding: 4px 0 !important; min-width: 60px; }
                      tr.tr_foot td { padding: 10px 5px !important; font-size: 13px !important; font-weight: 600; }
                      tr.tr_foot { background: #e8e8e8; }
                    </style>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                      <table class="table table-hover table-danhsach">
                        <tbody>
                          <tr>
                            <th class="w50 text-center">STT</th>
                            <th class="w150">Tiêu đề</th>
                            <th>Ngày BH</th>
                            <th>KHPĐ</th>
                            <th>KHN</th>
                            <?php for ($i=1; $i <= 12 ; $i++) {  ?>
                            <th>Tháng <?=$i ?></th>
                            <?php } ?>
                            <!-- <th>Tổng cộng</th> -->
                            <th class="w50 text-center">Hiển thị</th>
                            <th class="w50 text-center">
                              <label>
                                <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
                              </label>
                            </th>
                          </tr>
                          <?php
                            $cl = 0;
                            $khpd_all = 0;
                            $khn_all = 0;
                            for ($i=1; $i <= 12; $i++) { 
                              ${"thang_".$i."_all"} = 0;
                            }
                            

                            foreach ($sql_array as $rows) 
                            {
                              $cl++;
                              $ida                = SHOW_text($rows['id']);
                              foreach ($rows as $key => $value) {
                                ${$key} = $value;
                              }
                              $catasort           = number_format($catasort,0,',','.');

                              $tongcong = $khpd + $khn;
                              for ($i=1; $i <= 12 ; $i++) { 
                                $tongcong += ${"thang_".$i};
                              }
                              $khpd_all += $khpd;
                              $khn_all  += $khn;
                              for ($i=1; $i <= 12; $i++) { 
                                ${"thang_".$i."_all"} += ${"thang_".$i};
                              }
                          ?>
                          <tr>
                            
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                              <input type="text" class="text-center" value="<?=$catasort ?>" onchange="UPDATE_colum(this, '<?=$ida ?>', 'catasort','<?=$table ?> ')">
                            </td>
                            <td>
                              <div class="name " style="min-width: 150px; width: 100%; margin: 0;">
                                <a href="<?=$url_page ?>&edit=<?=$ida ?>" title="Cập nhật">
                                  <span style="color: #ff000b; display: block;"><?=$array_manongtruong[$tenbaiviet_en] ?></span>
                                  <?=$tenbaiviet_vi ?>
                                </a>
                                <p class="p_lang_en">Ngày đăng: <?=date("d/m/Y", $ngay_dang) ?></p>
                                <p class="p_lang_en" style="color: #00a65a">Tổng cộng: <?=$tongcong ?></p>
                              </div>
                            </td>
                            <td class="text-center"><?=$ngay."/".$thang."/".$nam ?></td>
                            <td class="text-center">
                              <input type="text" class="text-center js_nutnumber" value="<?=$khpd ?>" onchange="UPDATE_colum(this, '<?=$ida ?>', 'khpd','<?=$table ?>')">    
                            </td>
                            <td class="text-center">
                              <input type="text" class="text-center js_nutnumber" value="<?=$khn ?>" onchange="UPDATE_colum(this, '<?=$ida ?>', 'khn','<?=$table ?>')">    
                            </td>
                            <?php for ($i=1; $i <= 12 ; $i++) {  ?>
                            <td class="text-center">
                              <input type="text" class="text-center js_nutnumber" value="<?=${"thang_".$i} ?>" onchange="UPDATE_colum(this, '<?=$ida ?>', '<?="thang_".$i ?>','<?=$table ?>')">
                            </td>
                            <?php } ?>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input showhi type='checkbox' class='minimal minimal_click' colum="showhi" idcol="<?=$ida ?>" table="<?=$table ?>" value='1' <?=LAY_checked($showhi, 1)?>></label>
                              </div>
                            </td>
                            
                            <td class="text-center">
                              <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                            </td>
                          </tr>
                        <?php }  ?> 
                        <tr class="tr_foot">
                            <td></td>
                            <td colspan="2" >
                              Tổng cộng
                            </td>
                            <td class="text-center">
                              <?=$khpd_all ?>
                            </td>
                            <td class="text-center">
                              <?=$khn_all ?>
                            </td>
                            <?php for ($i=1; $i <= 12 ; $i++) {  ?>
                            <td class="text-center">
                              <?=${"thang_".$i."_all"} ?>
                            </td>
                            <?php } ?>
                            
                            <td class="text-center">
                              
                            </td>
                            
                            <td class="text-center">
                              
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <input type='hidden' value='<?=$cl?>' name='maxvalu'>
                    </div>
                    <div class="box-header">
                      <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                      </h3>
                    </div>
                    <!--  -->
                </div>
            </section>
        </div>
    </section>
</form>
<?php } ?>