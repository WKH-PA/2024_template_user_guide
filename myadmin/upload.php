<?php
//include("config/sql.php");
//include "../vendor/autoload.php";
//
//// Lấy dữ liệu từ cơ sở dữ liệu
//$result = DB_que("SELECT `api_kraken` FROM `#_seo` LIMIT 1");
//$sql_se = DB_arr($result, 1);
//$json_data = $sql_se['api_kraken'] ?? '[]'; // Đảm bảo rằng biến có giá trị hợp lệ
//$api_keys = json_decode($json_data, true);
//echo $sql_se['api_kraken'];
//echo $api_keys;
//echo $api_secret;
//$kraken = null;
//// Lặp qua các nhóm API từ group_1 đến group_5
//foreach (range(1, 5) as $group_number) {
//    $group_key = 'group_' . $group_number;
//    if (isset($api_keys[$group_key])) {
//        $api_key = $api_keys[$group_key]['api_key'];
//        $api_secret = $api_keys[$group_key]['api_secret'];
//        $kraken = createKrakenInstance($api_key, $api_secret);
//        if ($kraken && checkQuota($kraken)) {
//            break; // Ngừng lặp khi đã tạo được đối tượng Kraken thành công và còn quota
//        }
//    }
//}
//
//$localDirectory = '/opt/lampp/htdocs/2024_template_user_guide/datafiles/images/img'; // Local directory path
//$webDirectory = "https://webdemo5.pavietnam.vn/document/datafiles/images/img";
//// Get the list of images from the local directory
//$images =getImagesFromDirectory($localDirectory);
////$totalImages = count($images);
//$table = '#_optimized_img';
//
//// Thêm hình ảnh vào cơ sở dữ liệu
//foreach ($images as $image) {
//    $imagePath = $conn->real_escape_string($image);
//    $sql = "INSERT INTO `$table` (image_path, status) VALUES ('$imagePath', 0)";
//    $conn->query($sql);
//}
//// Handle AJAX request
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    $input = json_decode(file_get_contents('php://input'), true);
//    $imagePath = $input['imagePath'];
//    if (processImage($kraken, $imagePath, $webDirectory)) {
//        echo json_encode(['success' => true]);
//    } else {
//        echo json_encode(['success' => false]);
//    }
//    exit;
//}
//?>
<!---->
<!--<h1>Image Optimization Progress</h1>-->
<!--<div id="status">-->
<!--    <p>Images to process: <span id="total-images">--><?php //echo $totalImages; ?><!--</span></p>-->
<!--    <p>Images processed: <span id="processed-images">0</span></p>-->
<!--</div>-->
<!--<div id="progress-container">-->
<!--    <div id="progress-bar"></div>-->
<!--</div>-->
<!--<button id="start-button">Start Optimization</button>-->
<!--<script>-->
<!--    document.getElementById('start-button').addEventListener('click', function() {-->
<!--        // Lấy danh sách hình ảnh từ biến PHP và chuyển nó thành mảng JavaScript-->
<!--        var images = --><?php //echo json_encode($images); ?>//;
//        var totalImages = images.length; // Lấy tổng số lượng hình ảnh
//        var processedImages = 0; // Biến để đếm số lượng hình ảnh đã được xử lý
//
//        // Hàm cập nhật tiến trình xử lý
//        function updateProgress() {
//            processedImages++; // Tăng số lượng hình ảnh đã được xử lý lên 1
//            document.getElementById('processed-images').innerText = processedImages; // Cập nhật số lượng hình ảnh đã xử lý trên giao diện
//            var progressBar = document.getElementById('progress-bar'); // Lấy thanh tiến trình
//            progressBar.style.width = (processedImages / totalImages) * 100 + '%'; // Cập nhật chiều rộng của thanh tiến trình theo phần trăm hình ảnh đã xử lý
//        }
//
//        // Duyệt qua từng hình ảnh trong mảng
//        images.forEach(function(imagePath) {
//            // Gửi yêu cầu POST để xử lý từng hình ảnh
//            fetch('', {
//                method: 'POST',
//                headers: {
//                    'Content-Type': 'application/json'
//                },
//                body: JSON.stringify({ imagePath: imagePath }) // Gửi đường dẫn hình ảnh trong phần thân của yêu cầu
//            })
//                .then(response => response.json()) // Chuyển đổi phản hồi thành JSON
//                .then(data => {
//                    if (data.success) {
//                        updateProgress(); // Nếu xử lý thành công, cập nhật tiến trình
//                    } else {
//                        console.error('Failed to process image:', imagePath); // Nếu xử lý thất bại, ghi log lỗi
//                    }
//                })
//                .catch(error => console.error('Error:', error)); // Xử lý lỗi nếu có trong quá trình gửi yêu cầu
//        });
//    });
//</script>
//
//<style>
//    body {font-family: Arial, sans-serif;text-align: center;margin: 20px;}
//    #progress-container {width: 100%;background-color: #f3f3f3;border: 1px solid #ddd;border-radius: 5px;margin: 20px auto;max-width: 600px;padding: 5px;}
//    #progress-bar {height: 30px;width: 0;background-color: #4caf50;border-radius: 5px;}
//    #status {margin-top: 10px;}
//</style>