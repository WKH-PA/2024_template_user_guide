<?php
include("initLoader.php");
if (!isset($thongtin_step) || !in_array($thongtin_step['step'], ["36", "37"])) {
    include _source . "tren.php";
}

include _source . "router.php";

if (!isset($thongtin_step) || !is_array($thongtin_step) || !isset($thongtin_step['step']) || !in_array($thongtin_step['step'], ["36", "37"])) {
    include _source . "duoi.php";
}


?>
