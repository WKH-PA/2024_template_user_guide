<?php

$table = '#_baiviet';
$name_baiviet = "bài viết";
if ($id_step == 2)
    $name_baiviet = "sản phẩm";

$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key}           = $value;
    }

    $catasort   = str_replace(".", "", @$catasort);
    $giatien    = str_replace(",", "", @$giatien);
    $giatien    = str_replace(".", "", @$giatien);
    $giakm      = str_replace(",", "", @$giakm);
    $giakm      = str_replace(".", "", @$giakm);


    $seo_title_vi       = LAY_uutien(@$seo_title_vi, @$tenbaiviet_vi);
    $seo_title_en       = LAY_uutien(@$seo_title_en, @$tenbaiviet_en);
    $seo_title_cn       = LAY_uutien(@$seo_title_cn, @$tenbaiviet_cn);
    $seo_description_vi = LAY_uutien(@$seo_description_vi, @$tenbaiviet_vi);
    $seo_description_en = LAY_uutien(@$seo_description_en, @$tenbaiviet_en);
    $seo_description_cn = LAY_uutien(@$seo_description_cn, @$tenbaiviet_cn);
    $seo_keywords_vi    = LAY_uutien(@$seo_keywords_vi, @$tenbaiviet_vi);
    $seo_keywords_en    = LAY_uutien(@$seo_keywords_en, @$tenbaiviet_en);
    $seo_keywords_cn    = LAY_uutien(@$seo_keywords_cn, @$tenbaiviet_cn);

    $showhi             = isset($_POST["showhi"]) ? "1" : "0";
    $opt_km             = isset($_POST["opt_km"]) ? "1" : "0";

    $ngaydang   = @explode("/", $ngaydang);
    $capnhat    = @explode("/", $capnhat);
    $ngaydang   = @strtotime($ngaydang[2] . "-" . $ngaydang[1] . "-" . $ngaydang[0] . " " . @date("H:i:s", time()));
    $capnhat    = @strtotime($capnhat[2] . "-" . $capnhat[1] . "-" . $capnhat[0] . " " . @date("H:i:s", time()));


    $id_parent_muti          = "";
    if(isset($_POST['id_parent_muti'])) {
        foreach ($_POST['id_parent_muti'] as $val) {
            $id_parent_muti .= $val.",";
        }
        $id_parent_muti      = trim($id_parent_muti,",");
    }
    $tinh_nang = "";
    if(isset($_POST['tinh_nang'])) {
        foreach ($_POST['tinh_nang'] as $val) {
            $tinh_nang .= $val.",";
        }
        $tinh_nang      = trim($tinh_nang,",");
    }
    $diem_con_hang = "";
    if(isset($_POST['diem_con_hang'])) {
        foreach ($_POST['diem_con_hang'] as $val) {
            $diem_con_hang .= $val.",";
        }
        $diem_con_hang      = trim($diem_con_hang,",");
    }

    //luu % kn
    if($giakm != 0) {
        $num_4 = 100 - ($giatien / $giakm * 100);
    }
    //
}

if (!empty($_POST)) {
    $seo_name                       = LAY_uutien($seo_name, $tenbaiviet_vi);
    if($upckfinder != true){
        $hinhanh                        = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
        $icon_hover                     = UPLOAD_image("icon_hover", "../" . $duongdantin . "/", time());
        $dowload                        = UPLOAD_file("dowload", "../datafiles/files/", time());
    }else{
        $hinhanh                        = $icon;
        $icon_hover                     = $icon_hover;
        $dowload                        = $dowload;
    }


    $data = array();
    $data['tenbaiviet_vi']         = @$tenbaiviet_vi;
    $data['tenbaiviet_en']         = @$tenbaiviet_en;
    $data['tenbaiviet_cn']         = @$tenbaiviet_cn;

    $data['mota_vi']               = @$mota_vi;
    $data['mota_en']               = @$mota_en;
    $data['mota_cn']               = @$mota_cn;

    $data['noidung_vi']            = @$noidung_vi;
    $data['noidung_en']            = @$noidung_en;
    $data['noidung_cn']            = @$noidung_cn;

    $data['tags_vi']               = @$tags_vi;
    $data['tags_en']               = @$tags_en;
    $data['tags_cn']               = @$tags_cn;

    $data['seo_name']              = @$seo_name;
    $data['id_parent']             = is_numeric(@$id_parent) ? @$id_parent : 0;
    $data['id_parent_muti']        = @$id_parent_muti;
    $data['duongdantin']           = @$duongdantin;

    
    $data['catasort']              = is_numeric(@$catasort) ? @$catasort : 0;
    $data['ngaydang']              = is_numeric(@$ngaydang) ? @$ngaydang : 0;
    $data['capnhat']               = is_numeric(@$capnhat) ? @$capnhat : 0;
    $data['showhi']                = is_numeric(@$showhi) ? @$showhi : 0;

    $data['seo_title_vi']          = @$seo_title_vi;
    $data['seo_title_en']          = @$seo_title_en;
    $data['seo_title_cn']          = @$seo_title_cn;

    $data['seo_description_vi']    = @$seo_description_vi;
    $data['seo_description_en']    = @$seo_description_en;

    $data['seo_keywords_vi']       = @$seo_keywords_vi;
    $data['seo_keywords_en']       = @$seo_keywords_en;
    $data['seo_keywords_cn']       = @$seo_keywords_cn;

    $data['p1']                    = @$p1;
    $data['p3']                    = @$p3;
    $data['link_video']            = @$link_video;

    $data['num_3']                 = is_numeric(@$num_3) ? @$num_3 : 0;
    $data['num_4']                 = is_numeric(@$num_4) ? @$num_4 : 0;
    $data['step']                  = is_numeric(@$step) ? @$step : 0;
    $data['p2']                    = is_numeric(@$p2) ? @$p2 : 0;


    $data['giatien']               = is_numeric(@$giatien) ? @$giatien : 0;
    $data['giakm']                 = is_numeric(@$giakm) ? @$giakm : 0;
    $data['tinh_nang']             = @$tinh_nang;


    $data['thuoc_tinh_1_vi']       = @$thuoc_tinh_1_vi; 
    $data['thuoc_tinh_1_en']       = @$thuoc_tinh_1_en;
    $data['thuoc_tinh_2_vi']       = @$thuoc_tinh_2_vi; 
    $data['thuoc_tinh_2_en']       = @$thuoc_tinh_2_en;
    $data['thuoc_tinh_3_vi']       = @$thuoc_tinh_3_vi; 
    $data['thuoc_tinh_3_en']       = @$thuoc_tinh_3_en; 

    $data['gia_tri_1_vi']          = trim_val(@$gia_tri_1_vi); 
    $data['gia_tri_2_vi']          = trim_val(@$gia_tri_2_vi); 
    $data['gia_tri_3_vi']          = trim_val(@$gia_tri_3_vi); 

    $data['opt_km']                = @$opt_km;

    if ($id > 0) {
        $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
        $sql_thongtin = DB_arr($sql_thongtin, 1);
    }
    if($upckfinder != true){
        if ($hinhanh != false) {
            $data['icon'] = $hinhanh;
            if ($_REQUEST['anh_sp'] != '') {
                $anh_sp = explode("x", $_REQUEST['anh_sp']);
                $wid = $anh_sp[0];
                $hig = $anh_sp[1];
                TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, $wid, $hig, "images/trang_" . $wid . "_" . $hig . ".png");
            } else {
                TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 500, 500);
            }
            TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumbnew_" . $hinhanh, 300, 300);
            if ($id > 0 && is_array($sql_thongtin)) {
//                @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon"]);
                @unlink("../" . $sql_thongtin["duongdantin"] . "/thumb_" . $sql_thongtin["icon"]);
                @unlink("../" . $sql_thongtin["duongdantin"] . "/thumbnew_" . $sql_thongtin["icon"]);
            }
        }

        if ($icon_hover != false) {
            $data['icon_hover'] = $icon_hover;
            if ($_REQUEST['anh_sp'] != '') {
                $anh_sp = explode("x", $_REQUEST['anh_sp']);
                $wid = $anh_sp[0];
                $hig = $anh_sp[1];
                TAO_anhthumb("../" . $duongdantin . "/" . $icon_hover, "../" . $duongdantin . "/thumb_" . $icon_hover, $wid, $hig, "images/trang_" . $wid . "_" . $hig . ".png");
            } else {
                TAO_anhthumb("../" . $duongdantin . "/" . $icon_hover, "../" . $duongdantin . "/thumb_" . $icon_hover, 500, 500, "images/trang_500_500.png");
            }
            TAO_anhthumb("../" . $duongdantin . "/" . $icon_hover, "../" . $duongdantin . "/thumbnew_" . $icon_hover, 300, 300);

            if ($id > 0 && is_array($sql_thongtin)) {
//                @unlink("../" . $sql_thongtin["duongdantin"] . "/" . $sql_thongtin["icon_hover"]);
                @unlink("../" . $sql_thongtin["duongdantin"] . "/thumb_" . $sql_thongtin["icon_hover"]);
                @unlink("../" . $sql_thongtin["duongdantin"] . "/thumbnew_" . $sql_thongtin["icon_hover"]);
            }
        }

        if ($dowload != false && $id > 0) {
            $data['dowload'] = $dowload;
            if ($id > 0 && is_array($sql_thongtin)) {
//                @unlink("../datafiles/files/" . $sql_thongtin["dowload"]);
            }
        }
    }else{
        $data['icon'] = $hinhanh;
        $data['icon_hover'] = $icon_hover;
        $data['dowload'] = $dowload;
    }


    //update mu nguyen lieu
    if($upckfinder != true){
        $bc_ctiet_pmutn                        = UPLOAD_file("bc_ctiet_pmutn", "../datafiles/files/", time());
        $bc_ctiet_pmunm                        = UPLOAD_file("bc_ctiet_pmunm", "../datafiles/files/", time());
        $bc_ctiet_pmunt                        = UPLOAD_file("bc_ctiet_pmunt", "../datafiles/files/", time());

    }else{
        $bc_ctiet_pmutn                        = $bc_ctiet_pmutn  ;
        $bc_ctiet_pmunm                        = $bc_ctiet_pmunm ;
        $bc_ctiet_pmunt                        = $bc_ctiet_pmunt  ;

    }

    if($step == 5){ //mu nguyen lieu
        if($bc_ctiet_pmutn != false) {
            $data['bc_ctiet_pmutn'] = $bc_ctiet_pmutn;
            if ($id > 0) {
                @unlink("../datafiles/files/" . $sql_thongtin["bc_ctiet_pmutn"]);
            }
        }
        if($bc_ctiet_pmunm != false) {
            $data['bc_ctiet_pmunm'] = $bc_ctiet_pmunm;
            if ($id > 0) {
                @unlink("../datafiles/files/" . $sql_thongtin["bc_ctiet_pmunm"]);
            }
        }
        if($bc_ctiet_pmunt != false) {
            $data['bc_ctiet_pmunt'] = $bc_ctiet_pmunt;
            if ($id > 0) {
                @unlink("../datafiles/files/" . $sql_thongtin["bc_ctiet_pmunt"]);
            }
        }
    }
    //

    $array_loai = array("themmoi", "anh_sp", "mutifile", "tinhnang_arr","anh_sp_hv");

    if ($id == 0) {
        $data['id_user']               = $_SESSION['luluwebproadmin'];
        //
        $id = ACTION_db($data, $table, 'add', $array_loai, NULL);
        $_SESSION['show_message_on'] = "Thêm $name_baiviet thành công!";
        // luu anh danh sach
        DB_que("UPDATE `#_baiviet_img` SET `id_parent` = '$id' WHERE `id_parent` = 0 AND  `the_loai` = 0 ", "#_baiviet_img");
        // 
        //
        if($seo_name != "[no_seo_name]"){
            THEM_seoname($id, $seo_name, $table, $step, "0");
        }
        
    } else {
        ACTION_db($data, $table, 'update', $array_loai, "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật $name_baiviet thành công!";
        if($seo_name != "[no_seo_name]"){
            THEM_seoname($id, $seo_name, $table, $step, "1");
        }
    }

    // option thuoc tinh
    // update tinh nang
    if(isset($_POST['tinhnang_arr'])){
        DB_que("UPDATE `#_baiviet_select_tinhnang` SET `showhi` = 0 WHERE `id_baiviet` = '$id' AND `loaihienthi` = 1", "#_baiviet_select_tinhnang");
        foreach ($_POST['tinhnang_arr'] as $key) {
            if($key != 0 && $key != "") {
                $k_arr      = explode('_', $key);
                $k          = $k_arr[0];
                $v          = $k_arr[1];
                $check      = DB_que("SELECT * FROM `#_baiviet_select_tinhnang` WHERE `id_baiviet` = '$id' AND `id_tinhnang` = '$k' LIMIT 1");
                if(!DB_num($check)) {
                    DB_que("INSERT INTO `#_baiviet_select_tinhnang` (`id_baiviet`,`id_tinhnang`,`id_val`, `loaihienthi`, `showhi`) VALUES ('$id', '$k', '$v', 1, 1)", "#_baiviet_select_tinhnang");
                }
                else {
                    DB_que("UPDATE `#_baiviet_select_tinhnang` SET `id_val` = '$v', `showhi` = 1 WHERE `id_baiviet` = '$id' AND `id_tinhnang` = '$k' LIMIT 1", "#_baiviet_select_tinhnang");
                }
            }
        }
    }
    
    if(isset($_POST['tinhnang_key_arr'])){
        DB_que("UPDATE `#_baiviet_select_tinhnang` SET `showhi` = 0 WHERE `id_baiviet` = '$id' AND `loaihienthi` = 0", "#_baiviet_select_tinhnang");
        $num_post_tn        = count($_POST['tinhnang_key_arr']);
        $tinhnang_key_arr       = $_POST['tinhnang_key_arr'];
        $tinhnang_arr_input     = $_POST['tinhnang_arr_input'];
        $tinhnang_arr_input_en  = $_POST['tinhnang_arr_input_en'];
        for ($i=0; $i < $num_post_tn; $i++) { 

            if($tinhnang_arr_input[$i] == "" && $tinhnang_arr_input_en[$i] == "") continue;
            $k          = $tinhnang_key_arr[$i];
            $mota_vi    = $tinhnang_arr_input[$i];
            $mota_en    = $tinhnang_arr_input_en[$i];

            $check      = DB_que("SELECT * FROM `#_baiviet_select_tinhnang` WHERE `id_baiviet` = '$id' AND `id_tinhnang` = '$k' LIMIT 1");
            if(!DB_num($check)) {
                DB_que("INSERT INTO `#_baiviet_select_tinhnang` (`id_baiviet`,`id_tinhnang`,`mota_vi`,`mota_en`, `loaihienthi`, `showhi`) VALUES ('$id', '$k', '$mota_vi', '$mota_en', 0, 1)", "#_baiviet_select_tinhnang");
            }
            else {
                DB_que("UPDATE `#_baiviet_select_tinhnang` SET `mota_vi` = '$mota_vi',`mota_en` = '$mota_en', `showhi` = 1 WHERE `id_baiviet` = '$id' AND `id_tinhnang` = '$k' LIMIT 1", "#_baiviet_select_tinhnang");
            }
        }
    }


    // option thuoc tinh
    if(isset($_POST['js_vitri']) && is_numeric($_POST['js_vitri'])){
        $key_update = md5(time());
        for ($i=0; $i <= $_POST['js_vitri']; $i++) { 
            $gia        = isset($_POST['thuoctinh_pri_'.$i]) ? $_POST['thuoctinh_pri_'.$i] : "";
            $phien_ban  = isset($_POST['thuoctinh_name_'.$i]) ? $_POST['thuoctinh_name_'.$i] : "";
            $sort       = isset($_POST['thuoctinh_sort_'.$i]) ? $_POST['thuoctinh_sort_'.$i] : "";

            $gia    = str_replace(",", "", @$gia);
            $gia    = str_replace(".", "", @$gia);
 

            if($gia == "" || $phien_ban == "") continue;
            $data   = array();

            //
            $phien_ban = trim_val($phien_ban);
            $phien_ban = explode(",", $phien_ban);
            $n_phienban = "";
            foreach ($phien_ban as $ke) {
                $ke = explode("_",$ke);
                $ke = $ke[1];
                $n_phienban .= $n_phienban == "" ? $ke : ",".$ke;
            }
            $n_phienban = explode(",",$n_phienban);
            sort($n_phienban);
            $n_phienban = implode(",",$n_phienban);
            //
            $data['id_sp']      = $id;
            $data['phien_ban']  = trim_val($n_phienban);
            $data['catasort']   = $sort;
            $data['gia']        = $gia;
            $data['showhi']     = isset($_POST['thuoctinh_showhi_'.$i]) ? 1 : 0;
            $data['key_update'] = $key_update;

            $check = DB_que("SELECT * FROM `#_baiviet_thuoctinh` WHERE `id_sp` = '$id' AND `catasort` = '$sort' LIMIT 1 ");
            if(DB_num($check)) {
                ACTION_db($data, "#_baiviet_thuoctinh", 'update', NULL, "`id_sp` = '$id' AND `catasort` = '$sort'");
            }
            else {
                ACTION_db($data, "#_baiviet_thuoctinh", 'add', NULL, NULL);
            }

        }
        DB_que("DELETE FROM `#_baiviet_thuoctinh` WHERE `id_sp` = '$id' AND `key_update` <> '$key_update'");
    }
    else {
        DB_que("DELETE FROM `#_baiviet_thuoctinh` WHERE `id_sp` = '$id'");
    }
    //
    // update tinh nang dat hang
    if(isset($_POST['tinhnang_dh'])){
        DB_que("UPDATE `#_baiviet_select_tinhnang` SET `showhi` = 0 WHERE `id_baiviet` = '$id'");
        foreach ($_POST['tinhnang_dh'] as $key) {
            if($key != 0 && $key != "") {
                $k_arr      = explode('_', $key);
                $k          = $k_arr[0];
                $v          = $k_arr[1];
                $check      = DB_que("SELECT * FROM `#_baiviet_select_tinhnang` WHERE `id_baiviet` = '$id' AND `id_tinhnang` = '$k' AND `id_val` = '".$v."' LIMIT 1");

                if($upckfinder != true){
                    $hinhanh = UPLOAD_image("upload_file_".$key, "../" . $duongdantin . "/", time());

                }else{
                    $hinhanh = $upload_file_.$key;

                }

                if(!DB_num($check)) {
                    if(!$hinhanh) $hinhanh = "";
                    DB_que("INSERT INTO `#_baiviet_select_tinhnang` (`id_baiviet`,`id_tinhnang`,`id_val`, `showhi`, `duongdantin`, `icon`) VALUES ('$id', '$k', '$v', 1, '$duongdantin', '$hinhanh')");
                }
                else {
                    $iadd  = "";
                    if($hinhanh) {
                        $iadd  = ", `icon` = '$hinhanh' ";
                    }
                    DB_que("UPDATE `#_baiviet_select_tinhnang` SET  `showhi` = 1, `duongdantin` = '$duongdantin' $iadd WHERE `id_baiviet` = '$id' AND `id_tinhnang` = '$k' AND `id_val` = '".$v."' LIMIT 1");
                }
            }
        }
    }
    //
    //
    //
    if($step == 5){ //mu nguyen lieu
        $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
        $sql_thongtin = DB_arr($sql_thongtin, 1);

        $bc_ctiet_pmutn_url = "../datafiles/files/" . $sql_thongtin["bc_ctiet_pmutn"];
        $bc_ctiet_pmunm_url = "../datafiles/files/" . $sql_thongtin["bc_ctiet_pmunm"];
        $bc_ctiet_pmunt_url = "../datafiles/files/" . $sql_thongtin["bc_ctiet_pmunt"];

        include 'readexcel/simplexlsx.class.php';

        function return_col($kv){
            $col_xlx = "";
            if($kv          == 0) $col_xlx = "col_a";
            else if($kv     == 1) $col_xlx = "col_b";
            else if($kv     == 2) $col_xlx = "col_c";
            else if($kv     == 3) $col_xlx = "col_d";
            else if($kv     == 4) $col_xlx = "col_e";
            else if($kv     == 5) $col_xlx = "col_f";
            else if($kv     == 6) $col_xlx = "col_g";
            else if($kv     == 7) $col_xlx = "col_h";
            else if($kv     == 8) $col_xlx = "col_i";
            else if($kv     == 9) $col_xlx = "col_j";
            return $col_xlx;
        }
        function unixstamp( $excelDateTime ) {
            $d = floor( $excelDateTime ); 
            $t = $excelDateTime - $d;
            return ($d > 0) ? ( $d - 25569 ) * 86400 + $t * 86400 : $t * 86400;
        }
        if($sql_thongtin["bc_ctiet_pmutn"] != "" && ($bc_ctiet_pmutn != false || isset($_POST['check_bc_ctiet_pmutn']))){
            if(is_file($bc_ctiet_pmutn_url)){
                if ($xlsx = SimpleXLSX::parse($bc_ctiet_pmutn_url)) {
                    $list_row = $xlsx->rows();
                    // xoa all data cu
                    DB_que("DELETE FROM `#_baiviet_excel` WHERE `id_parent` = '$id' AND `is_file` = 1 ");
                    //
                    foreach ($list_row as $value) {
                        $data_xlx  = array();
                        $data_xlx['id_parent']  = $id;
                        $data_xlx['is_file']    = 1;
                        foreach ($value as $kv => $r_v) {
                            $col_xlx = return_col($kv);
                            if($col_xlx != "") {

                                if($kv == 0 && is_numeric($r_v)) {
                                    $r_v = unixstamp($r_v);
                                }
                                $data_xlx[$col_xlx]  = $r_v;
                            }
                        }
                        ACTION_db($data_xlx, "#_baiviet_excel", 'add', NULL, NULL);
                    }
                }
                else {
                    echo SimpleXLSX::parse_error();
                }
            }
        }
        if($sql_thongtin["bc_ctiet_pmunm"] != "" && ($bc_ctiet_pmunm != false || isset($_POST['check_bc_ctiet_pmunm']))){
            if(is_file($bc_ctiet_pmunm_url)){
                if ($xlsx = SimpleXLSX::parse($bc_ctiet_pmunm_url)) {
                    $list_row = $xlsx->rows();
                    // xoa all data cu
                    DB_que("DELETE FROM `#_baiviet_excel` WHERE `id_parent` = '$id'  AND `is_file` = 2");
                    //
                    foreach ($list_row as $value) {
                        $data_xlx  = array();
                        $data_xlx['id_parent']  = $id;
                        $data_xlx['is_file']    = 2;
                        foreach ($value as $kv => $r_v) {
                            $col_xlx = return_col($kv);
                            if($col_xlx != "") {
                                if($kv == 1 && is_numeric($r_v)) {
                                    $r_v = unixstamp($r_v);
                                }
                                $data_xlx[$col_xlx]  = $r_v;
                            }
                        }
                        ACTION_db($data_xlx, "#_baiviet_excel", 'add', NULL, NULL);
                    }
                }
                else {
                    echo SimpleXLSX::parse_error();
                }
            }
        }
        if($sql_thongtin["bc_ctiet_pmunt"] != "" && ($bc_ctiet_pmunt != false || isset($_POST['check_bc_ctiet_pmunt']))){
            if(is_file($bc_ctiet_pmunt_url)){
                if ($xlsx = SimpleXLSX::parse($bc_ctiet_pmunt_url)) {
                    $list_row = $xlsx->rows();
                    // xoa all data cu
                    DB_que("DELETE FROM `#_baiviet_excel` WHERE `id_parent` = '$id' AND `is_file` = 3 ");
                    //
                    foreach ($list_row as $value) {
                        $data_xlx  = array();
                        $data_xlx['id_parent']  = $id;
                        $data_xlx['is_file']    = 3;
                        foreach ($value as $kv => $r_v) {
                            $col_xlx = return_col($kv);
                            if($col_xlx != "") {
                                // if($kv == 1 && is_numeric($r_v)) {
                                if($kv == 1 && is_numeric($r_v)) {
                                    $r_v = unixstamp($r_v);
                                }
                                $data_xlx[$col_xlx]  = $r_v;
                            }
                        }
                        ACTION_db($data_xlx, "#_baiviet_excel", 'add', NULL, NULL);
                    }
                }
                else {
                    echo SimpleXLSX::parse_error();
                }
            }
        }
    }
    //

    LOCATION_js($url_page . "&step=" . @$_GET['step'] . "&id_step=" . @$id_step . "&edit=" . $id);
    exit();
    //
}


if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = DB_arr($sql_se, 1);

    foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
    }

    $catasort = number_format($catasort, 0, ',', '.');
    $ngaydang = date("d/m/Y", $ngaydang);
    $capnhat  = date("d/m/Y", $capnhat);

    $giatien = number_format($giatien, 0, ',', '.');
    $giakm = number_format($giakm, 0, ',', '.');


    if ($icon != '') {
        $full_icon  = $fullpath."/".$duongdantin."/".$icon;
    }
    if ($icon_hover != '') {
        $full_icon_hover    = $fullpath."/".$duongdantin."/".$icon_hover;
    }
} else {
    $id_parent = 0;
    $catasort  = layCatasort($table, '`step` = ' . $step);
    $catasort  = number_format(SHOW_text($catasort), 0, ',', '.');

    $ngaydang   = date("d/m/Y");
    $capnhat    = date('d/m/Y');
    if($id_step == 11){
        $mt_10_vi = date('d/m/Y', strtotime("10 days", time()));
    }
}

$thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = '$step' LIMIT 1");
$thongtin_step = DB_arr($thongtin_step, 1);

?>
    <section class="content-header">
        <h1><?php if(isset($_SESSION['admin'])){ ?><a style="cursor: pointer;" onclick="AUTO_dich(this)">[NGÔN NGỮ]</a> <a class="js_okkk" style="cursor: pointer;" onclick="OKKK_by_lh()">[UPDATE]</a> <?php } ?>Danh sách <?=  $thongtin_step['tenbaiviet_vi'] ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Danh sách <?= $thongtin_step['tenbaiviet_vi'] ?></li>
        </ol>
    </section>
    <form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>

        <section class="content form_create">
            <div class="row">
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h2 class="h2_title">
                                <i class="fa fa-pencil-square-o"></i><?= GETNAME_step($step) ?>
                                > <?= $id > 0 ? 'Cập nhật' : 'Thêm' ?> <?= $thongtin_step['tenbaiviet_vi'] ?>
                            </h2>
                            
                            <h3 class="box-title box-title-td pull-right">
                                <button onclick="return checkSubmit();" type="submit" class="btn btn-primary"><i
                                            class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                                <a href="<?= $url_page ?>&them-moi=true&step=<?= @$_GET['step'] ?>&id_step=<?= @$_GET['id_step'] ?>"
                                   class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                                <a href="<?= $url_page ?>&step=<?= @$_GET['step'] ?>&id_step=<?= @$_GET['id_step'] ?>"
                                   class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                            </h3>
                        </div>
                        
                        <?php
                        //                        echo $id_step;
                        if (is_file("step/" . $id_step . ".php")) include("step/" . $id_step . ".php"); ?>
                        
                    </div>
                </section>
            </div>
        </section>

        <div class="box-header mb-60">
            <h3 class="box-title box-title-td pull-right">
                <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                            class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                <a href="<?= $url_page ?>&them-moi=true&step=<?= @$_GET['step'] ?>&id_step=<?= @$_GET['id_step'] ?>"
                   class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                <a href="<?= $url_page ?>&step=<?= @$_GET['step'] ?>&id_step=<?= @$_GET['id_step'] ?>"
                   class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
            </h3>
        </div>
    </form>


<script>
    function checkSubmit() {
        if ($("#tenbaiviet_vi").val().trim() == '') {
            alert("Vui lòng nhập tiêu đề");
            $("#tenbaiviet_vi").focus();
            return false;
        }
        if ($(".cls_giatien_f").length > 0 && $(".cls_giatien_f").val() < 0) {
            alert("Giá bán không được phép âm. Vui lòng kiểm tra lại!");
            $(".cls_giatien_f").focus();
            return false;
        }
        if ($(".cls_giatien_khuyenmai_f").length > 0 && $(".cls_giatien_khuyenmai_f").val() != 0) {
            var gia_ban = parseInt($(".cls_giatien_f").val().replace(/\./g, ""));
            var gia_km = parseInt($(".cls_giatien_khuyenmai_f").val().replace(/\./g, ""));

            if (gia_km < gia_ban) {
                alert("Giá so sánh không được nhỏ hơn giá bán. Vui lòng kiểm tra lại!");
                $(".cls_giatien_khuyenmai_f").focus();
                return false;
            }

        }
        if($(".time_js_date_1").length > 0 && $(".time_js_date_2").length > 0){
            var time_1 = $(".time_js_date_1").val();
            var time_2 = $(".time_js_date_2").val();
                time_1 = time_1.split("/");
                time_2 = time_2.split("/");
                time_1 = new Date(time_1[2], time_1[1] - 1, time_1[0], 23, 59, 0).getTime()/1000;
                time_2 = new Date(time_2[2], time_2[1] - 1, time_2[0], 23, 59, 0).getTime()/1000;
                if(time_1 > time_2) {
                    alert("Ngày khởi hành không được lớn hơn ngày kết thúc!");
                    $(".time_js_date_1").focus();
                    return false;
                }
        }
        return true;
    }
</script>
