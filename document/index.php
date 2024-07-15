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
$id = isset($_GET['id']) ? $_GET['id'] : '';
$url_page = "id=$id";
$module_setting = DB_que("SELECT * FROM `#_module_setting`");
$module_setting = DB_arr($module_setting);
foreach ($module_setting as $rows) {
    if ($rows['id'] == 38) $array_only_bv = explode(",", $rows['ten_key']);
    if ($rows['id'] == 39) $array_tn = explode(",", $rows['ten_key']);
    if ($rows['id'] == 43) $danhmuc_slider = explode(",", $rows['ten_key']);
    if ($rows['id'] == 46) $st_dowload_fl = explode(",", $rows['ten_key']);
    if ($rows['id'] == 47) $st_danhmuc_mt = explode(",", $rows['ten_key']);
    if ($rows['id'] == 48) $st_danhmuc_nd = explode(",", $rows['ten_key']);
    if ($rows['id'] == 49) $st_nhom_opt = explode(",", $rows['ten_key']);
    if ($rows['id'] == 50) $st_nhom_opt1 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 51) $st_nhom_opt2 = explode(",", $rows['ten_key']);
    if ($rows['id'] == 52) $st_bv_mota = explode(",", $rows['ten_key']);
    if ($rows['id'] == 53) $st_bv_noidung = explode(",", $rows['ten_key']);
    if ($rows['id'] == 55) $st_an_nhom_bv = explode(",", $rows['ten_key']);
    if ($rows['id'] == 11) $check_sp_hove = explode(",", $rows['ten_key']);
    if ($rows['id'] == 59) $check_img_step = explode(",", $rows['ten_key']);
    if ($rows['id'] == 57) $check_video = explode(",", $rows['ten_key']);
    if ($rows['id'] == 54) $st_anhmenu = $rows['ten_key'];
    if ($rows['id'] == 60) $check_anh_dm = explode(",", $rows['ten_key']);
    if ($rows['id'] == 61) $check_anh_dm_hv = explode(",", $rows['ten_key']);
    if ($rows['id'] == 63) $sl_quanlybaiviet = explode(",", $rows['ten_key']);
    if ($rows['id'] == 62) $name_list_opti = $rows['ten_key'];
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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Hướng dẫn sử dụng ">
    <meta name="keywords"
          content="Hướng dẫn sử dụng ">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="images/logo/logo.png" type="image/x-icon">
    <link rel="shortcut icon" src="https://www.pavietnam.vn/images/home_version_new/pa2023_logo_ver3.svg" type="image/x-icon">
    <title>Hướng dẫn sử dụng</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&amp;family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="css/vendors/datatable/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/vendors/prism.css">
    <link rel="stylesheet" type="text/css" href="css/vendors/vector-map.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link id="color" rel="stylesheet" href="css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

</head>

<body>
<div class="page-wrapper" id="pageWrapper">
    <?php include _src . "header1.php"; ?>
    <div class="page-body-wrapper">
        <?php
        include _src . "sidebar.php";
        $id = !empty($id) ? $id : 36;
        include _src . "noidung.php";
        include _src . "footer.php";
        ?>
    </div>
</div>
<!-- latest jquery-->
</body>
</html>
