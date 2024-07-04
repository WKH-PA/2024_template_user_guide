<?php
include "../initLoader.php";
define("_src", "src/");

// Lấy danh sách menu
$list_tn = DB_que("SELECT * FROM `#_module_tinhnang` WHERE `showhi`= 1 ORDER BY `sort` ASC");
$md_tinhnang = array();
$list_tn = DB_arr($list_tn);

foreach ($list_tn as $r) {
    $md_tinhnang[$r['m_action']] = $r;
}
$module_setting = DB_que("SELECT * FROM `#_module_setting`");
$module_setting = DB_arr($module_setting);
foreach ($module_setting as $rows) {
    if($rows['id'] == 38) $array_only_bv  = explode(",", $rows['ten_key']);
    if($rows['id'] == 39) $array_tn       = explode(",", $rows['ten_key']);
    if($rows['id'] == 43) $danhmuc_slider = explode(",", $rows['ten_key']);
    if($rows['id'] == 46) $st_dowload_fl  = explode(",", $rows['ten_key']);
    if($rows['id'] == 47) $st_danhmuc_mt  = explode(",", $rows['ten_key']);
    if($rows['id'] == 48) $st_danhmuc_nd  = explode(",", $rows['ten_key']);
    if($rows['id'] == 49) $st_nhom_opt    = explode(",", $rows['ten_key']);
    if($rows['id'] == 50) $st_nhom_opt1   = explode(",", $rows['ten_key']);
    if($rows['id'] == 51) $st_nhom_opt2   = explode(",", $rows['ten_key']);
    if($rows['id'] == 52) $st_bv_mota     = explode(",", $rows['ten_key']);
    if($rows['id'] == 53) $st_bv_noidung  = explode(",", $rows['ten_key']);
    if($rows['id'] == 55) $st_an_nhom_bv  = explode(",", $rows['ten_key']);
    if($rows['id'] == 11) $check_sp_hove  = explode(",", $rows['ten_key']);
    if($rows['id'] == 59) $check_img_step = explode(",", $rows['ten_key']);
    if($rows['id'] == 57) $check_video    = explode(",", $rows['ten_key']);
    if($rows['id'] == 54) $st_anhmenu     = $rows['ten_key'];
    if($rows['id'] == 60) $check_anh_dm   = explode(",", $rows['ten_key']);
    if($rows['id'] == 61) $check_anh_dm_hv= explode(",", $rows['ten_key']);
    if($rows['id'] == 63) $sl_quanlybaiviet= explode(",", $rows['ten_key']);
    if($rows['id'] == 62) $name_list_opti = $rows['ten_key'];
}
$module = isset($_GET['module']) ? $_GET['module'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Debugging line to check the value of $action
// echo "Action: " . htmlspecialchars($action) . "<br>";

$module_setting = DB_que("SELECT * FROM `#_module_setting`");
$module_setting = DB_arr($module_setting);
foreach ($module_setting as $rows) {
    switch ($rows['id']) {
        // Handle each case as needed...
    }
}
?>
<!DOCTYPE html>
<html>

<body>
<div class="page-wrapper" id="pageWrapper">
    <?php include _src ."header1.php"; ?>
    <div class="page-body-wrapper">
        <?php
        include _src."sidebar.php";
        if ($module != '') {
            include _src ."noidung.php";
        } else {
            include _src. "home.php";
        }
        include _src ."footer.php";
        ?>
    </div>
</div>
<!-- latest jquery-->
</body>
</html>
