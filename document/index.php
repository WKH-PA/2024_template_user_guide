<?php
<<<<<<< Updated upstream
include "../initLoader.php";
define("_src", "src/");

// Lấy danh sách menu
$list_tn = DB_que("SELECT * FROM `#_module_tinhnang` WHERE `showhi`= 1 ORDER BY `sort` ASC");
$md_tinhnang = array();
$list_tn = DB_arr($list_tn);

foreach ($list_tn as $r) {
    $md_tinhnang[$r['m_action']] = $r;
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
<!-- Loader starts-->

<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <?php include "header1.php"; ?>

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start menu-->
        <?php include "sidebar.php"; ?>
        <?php include _src ."noidung.php"; ?>

        <!-- footer start-->
        <?php include "footer.php"; ?>
    </div>
</div>
<!-- latest jquery-->
</body>
</html>
=======
include("myadmin/config/sql.php");
define('MOTTY', TRUE);
define('_document', "document/");


$lang_group = array("en");

$lang       = "vi";
$full_url   = $fullpath;
if (in_array($motty, $lang_group)) {
    $lang       = $motty;
    $full_url   = $fullpath . "/".$motty;
    $motty      = @$haity;
    $haity      = @$baty;
    $baty       = @$bonty;
    $bonty      = @$namty;
}
// xu ly truy cap lan dau
if(empty($_SESSION["lang"]) && $motty == "" && $thongtin['is_tiengviet'] == 0) {
    $_SESSION["lang"] = $lang_group[0];
    LOCATION_js($fullpath . "/".$lang_group[0]);
    exit();
}
// redic lang
if(isset($_SESSION["lang"]) && $_SESSION["lang"] != $lang && !isset($_GET['actilang'])) {
    LOCATION_js(las_url_lang($_SESSION["lang"], $motty, $haity, $baty, $bonty, $namty));
    exit();
}
//
$_SESSION["lang"]   = $lang;
//define
$danhsach_define = DB_fet_rd("*", "`#_clanguage`");
$glo_lang        = array();
foreach ($danhsach_define as $rows) {
    $glo_lang[$rows['code_lang']] = $rows['lang_' . $lang];
}

//couter
if (!isset($_SESSION['ttwebsession'])) {
    $_SESSION['ttwebsession'] = md5(uniqid(rand(), true));
}

$baygio     = time();
$timeroff   = 7884000; // 3 thang
$online_tv  = ONLINE_user(600, $_SESSION['ttwebsession']);
$thongke_tv = THONGKE_online();
// end
$check_slug = DB_fet_rd("*", "#_slug", "", "", 1, "", "`slug` = '$motty'");

$slug_step  = "";
$slug_page  = "";
$slug_table = "";
$slug_id    = "";

if (count($check_slug) > 0) {
    $check_slug  = $check_slug[0];
    $slug_step   = $check_slug['step'];
    $slug_table  = $check_slug['bang'];
    $slug_id     = $check_slug['id_bang'];

    $arr_running = DB_fet_rd("*", "`#_$slug_table`", "`showhi` = 1 AND `seo_name` = '" . $motty . "'", "", 1);
    $arr_running = @$arr_running[0];
}
// get page
if ($slug_step) {
    $thongtin_step = DB_fet_rd("*", "`#_step`", "`id` = '" . $slug_step . "'", "", 1);
    $thongtin_step = $thongtin_step[0];
}

//
$seo_description    = "";
$seo_keywords       = "";
$seo_title          = "";








//end login
$_SESSION['token'] = md5(RANDOM_chuoi(5));


if (!isset($thongtin_step) || !in_array($thongtin_step['step'], ["36", "37", "38"])) {
    include _document . "header1.php";
}

include _document . "body.php";

if (!isset($thongtin_step) || !in_array($thongtin_step['step'], ["36", "37", "38"])) {
    include _document . "footer.php";
}

?>
>>>>>>> Stashed changes
