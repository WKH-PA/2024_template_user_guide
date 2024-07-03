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
