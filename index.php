<?php
include("initLoader.php");
if (!isset($thongtin_step) || !in_array($thongtin_step['step'], ["36", "37", "38"])) {
    include _source . "tren.php";
}

include _source . "router.php";

if (!isset($thongtin_step) || !in_array($thongtin_step['step'], ["36", "37", "38"])) {
    include _source . "duoi.php";
}

?>
