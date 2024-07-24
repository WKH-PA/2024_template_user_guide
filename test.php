<?php

//// up url
//include "vendor/autoload.php";
//
//$kraken = new Kraken("11514c60bb216e287a2b6f357663f8e9", "e64668f982d3b443cbaa0cf0034aeb1dff2da906");
//
//$params = array(
//    "url" => "https://d1hjkbq40fs2x4.cloudfront.net/2016-01-31/files/1045-2.jpg",
//    "wait" => true
//);
//
//$data = $kraken->url($params);
//echo '<pre>';
//var_dump($data);









include "vendor/autoload.php";

$kraken = new Kraken("11514c60bb216e287a2b6f357663f8e9", "e64668f982d3b443cbaa0cf0034aeb1dff2da906");

// Đường dẫn tới thư mục chứa hình ảnh trên máy chủ công khai
$localDirectory = '/opt/lampp/htdocs/2024_template_user_guide/datafiles/images/img'; // Đường dẫn thư mục cục bộ
$webDirectory = 'https://webdemo5.pavietnam.vn/document/datafiles/images/img'; // URL thư mục công khai

// Lấy danh sách hình ảnh từ thư mục cục bộ
$images = glob($localDirectory . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

// Xử lý từng hình ảnh
foreach ($images as $imagePath) {
    $imageName = basename($imagePath);
    $imageUrl = $webDirectory . '/' . $imageName;

    // Tạo các tham số cho Kraken
    $params = array(
        "url" => $imageUrl,
        "wait" => true
    );

    // Gửi yêu cầu đến Kraken
    $data = $kraken->url($params);

    if ($data['success']) {
        $optimizedImageUrl = $data['kraked_url'];
        $optimizedImageContent = file_get_contents($optimizedImageUrl);

        // Lưu tệp hình ảnh đã tối ưu hóa với tên gốc
        file_put_contents("../upload/" . $imageName, $optimizedImageContent);
        echo "Image optimized and saved: " . $imageName . "\n";
    } else {
        echo "Failed to optimize image: " . $imageName . "\n";
        echo "Response: " . print_r($data, true) . "\n";
    }
}

