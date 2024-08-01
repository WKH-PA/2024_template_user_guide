<?php
include("myadmin/config/sql.php");
include "vendor/autoload.php";
// Local directory path
$webDirectory = "https://webdemo5.pavietnam.vn/document/datafiles";
$krakenInstance = getValidKrakenInstance();
$table = '#_optimized_img';
$errorMessages = [
    'Invalid API Key or Secret.' => [
        'message' => "Invalid API Key or Secret.",
        'reason' => "API key hoặc secret key không đúng. Vui lòng kiểm tra lại."
    ],
    'Invalid URL.' => [
        'message' => "Invalid URL.",
        'reason' => "URL của hình ảnh không hợp lệ hoặc không thể truy cập."
    ],
    'File size too large' => [
        'message' => "File size too large.",
        'reason' => "Kích thước tệp hình ảnh vượt quá giới hạn cho phép."
    ],
    'Unsupported file type.' => [
        'message' => "Unsupported file type.",
        'reason' => "Định dạng tệp hình ảnh không được hỗ trợ."
    ],
    'Rate limit exceeded.' => [
        'message' => "Rate limit exceeded.",
        'reason' => "Số lượng yêu cầu API vượt quá giới hạn cho phép trong một khoảng thời gian nhất định."
    ],
    'Authentication error.' => [
        'message' => "Authentication error.",
        'reason' => "Lỗi xác thực xảy ra do nhiều nguyên nhân như key sai, hết hạn, v.v."
    ],
    'Internal server error.' => [
        'message' => "Internal server error.",
        'reason' => "Lỗi nội bộ của server Kraken.io. Thử lại sau một thời gian hoặc liên hệ với hỗ trợ kỹ thuật của Kraken.io."
    ],
    'Missing parameter.' => [
        'message' => "Missing parameter.",
        'reason' => "Thiếu tham số bắt buộc trong yêu cầu."
    ],
    'Invalid parameter.' => [
        'message' => "Invalid parameter.",
        'reason' => "Tham số không hợp lệ. Vui lòng kiểm tra lại các giá trị được cung cấp."
    ],
    'Quota exceeded.' => [
        'message' => "Quota exceeded.",
        'reason' => "Đã vượt quá hạn mức sử dụng dịch vụ. Vui lòng nâng cấp gói dịch vụ hoặc chờ đến khi hạn mức được làm mới."
    ],
    'Network error.' => [
        'message' => "Network error.",
        'reason' => "Lỗi kết nối mạng. Vui lòng kiểm tra kết nối internet của bạn."
    ],
    'Access denied.' => [
        'message' => "Access denied.",
        'reason' => "Quyền truy cập bị từ chối. Vui lòng kiểm tra quyền truy cập và xác thực của bạn."
    ],
    'Timeout error.' => [
        'message' => "Timeout error.",
        'reason' => "Yêu cầu đã vượt quá thời gian chờ. Vui lòng thử lại sau."
    ],
    'Invalid signature.' => [
        'message' => "Invalid signature.",
        'reason' => "Chữ ký không hợp lệ. Vui lòng kiểm tra và đảm bảo rằng chữ ký được tạo đúng cách."
    ],
    "Couldn't get this file from provided URL." => [
        'message' => "Couldn't get this file from provided URL.",
        'reason' => "Không thể lấy tệp từ URL được cung cấp. Vui lòng kiểm tra lại URL."
    ]
];
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
    $error =  isset($result['message']) ? $result['message'] : 'UNKNOWN_ERROR';
    $reason = isset($errorMessages[$error]) ? $errorMessages[$error]['reason'] : $result['message'];
    $current_date = date('Y-m-d H:i:s');
    $data = [
        'status' => $status,
        'updated' => $current_date,
        'error' => $reason
    ];
    ACTION_db($data, $table, 'update', NULL, "`id` = {$rows['id']}");
}
}
exit;
?>



