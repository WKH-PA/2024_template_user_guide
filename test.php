<?php
include("myadmin/config/sql.php");
include "vendor/autoload.php";
// Local directory path
$webDirectory = "https://webdemo5.pavietnam.vn/document/datafiles";
$krakenInstance = getValidKrakenInstance();
$table = '#_optimized_img';
if (!$krakenInstance) {
    console.error('Error fetching data:', error);
}

// Thực hiện truy vấn để lấy đường dẫn ảnh
$sql = DB_que("SELECT * FROM `$table` WHERE `status` = 0 LIMIT {$thongtin['sl_toiuu']}");

$sql = DB_arr($sql);

// Lặp qua các kết quả và lấy đường dẫn ảnh
foreach ($sql as $rows) {
    $imagePath = $rows['image_path']; // Sử dụng dấu $ để chỉ định biến và tên trường đúng cách
    $status     =$rows['status'];
    $error      =$rows['error'];
    // Thực hiện hành động với $image nếu cần
    $result = processImage($krakenInstance, $imagePath, $webDirectory);


if ($result['success']) {
        $status = 1;
        $error = '';
    // Cập nhật cơ sở dữ liệu
    $current_date = date('Y-m-d H:i:s');
    $data = [
        'status' => $status,
        'updated' => $current_date,
        'error' => $error
    ];
    ACTION_db($data, $table, 'update', NULL, "`id` = {$rows['id']}");

} else {
    $status = 0;
    $error_message = $result['message'];
    $error_code = $result['error_code'];
    $error = "Kraken error: $error_message (Code: $error_code)";
    $current_date = date('Y-m-d H:i:s');
    $data = [
        'status' => $status,
        'updated' => $current_date,
        'error' => $error
    ];
    ACTION_db($data, $table, 'update', NULL, "`id` = {$rows['id']}");
}
}
exit;
?>



