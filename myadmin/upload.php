<?php

include("config/sql.php");
include "../vendor/autoload.php";
// Lấy dữ liệu từ cơ sở dữ liệu
$result = DB_que("SELECT `api_kraken` FROM `#_seo` LIMIT 1");
$sql_se = DB_arr($result, 1);
// Kiểm tra nếu dữ liệu không tồn tại hoặc không hợp lệ
$json_data = $sql_se['api_kraken'] ?? '[]'; // Đảm bảo rằng biến có giá trị hợp lệ
// Giải mã dữ liệu JSON
$api_keys = json_decode($json_data, true);

// Hàm để tạo đối tượng Kraken nếu thông tin API hợp lệ
function createKrakenInstance($api_key, $api_secret) {
    if ($api_key && $api_secret) {
        return new Kraken($api_key, $api_secret);
    }
    return null; // Hoặc xử lý khi không có thông tin hợp lệ
}

// Sử dụng dữ liệu từ nhóm API
$kraken = null;

// Lặp qua các nhóm API từ group_1 đến group_5
foreach (range(1, 5) as $group_number) {
    $group_key = 'group_' . $group_number;
    if (isset($api_keys[$group_key])) {
        $api_key = $api_keys[$group_key]['api_key'];
        $api_secret = $api_keys[$group_key]['api_secret'];
        $kraken = createKrakenInstance($api_key, $api_secret);
        if ($kraken) {
            break; // Ngừng lặp khi đã tạo được đối tượng Kraken thành công
        }
    }
}

//$kraken = new Kraken("11514c60bb216e287a2b6f357663f8e9", "e64668f982d3b443cbaa0cf0034aeb1dff2da906");
$localDirectory = '/opt/lampp/htdocs/2024_template_user_guide/datafiles/images/img'; // Local directory path
$webDirectory = "https://webdemo5.pavietnam.vn/document/datafiles/images/img";

echo $webDirectory;
// Get the list of images from the local directory
$images = glob($localDirectory . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
$totalImages = count($images);

// Function to process an image
function processImage($kraken, $imagePath, $webDirectory) {
    $imageName = basename($imagePath);
    $Url = dirname($imagePath);
    $imageUrl = $webDirectory . '/' . $imageName;

    // Create parameters for Kraken
    $params = array(
        "url" => $imageUrl,
        "wait" => true
    );

    // Send request to Kraken
    $data = $kraken->url($params);

    if ($data['success']) {
        $optimizedImageUrl = $data['kraked_url'];
        $optimizedImageContent = file_get_contents($optimizedImageUrl);
        // Delete the uploaded image
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        // Save the optimized image file with the original name
        file_put_contents($Url . '/' . $imageName, $optimizedImageContent);
        return true;
    } else {
        return false;
    }
}

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $imagePath = $input['imagePath'];

    if (processImage($kraken, $imagePath, $webDirectory)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}
echo $api_key;
echo $api_secret;
?>
<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 20px;
    }
    #progress-container {
        width: 100%;
        background-color: #f3f3f3;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin: 20px auto;
        max-width: 600px;
        padding: 5px;
    }
    #progress-bar {
        height: 30px;
        width: 0;
        background-color: #4caf50;
        border-radius: 5px;
    }
    #status {
        margin-top: 10px;
    }
</style>

<h1>Image Optimization Progress</h1>
<div id="status">
    <p>Images to process: <span id="total-images"><?php echo $totalImages; ?></span></p>
    <p>Images processed: <span id="processed-images">0</span></p>
</div>
<div id="progress-container">
    <div id="progress-bar"></div>
</div>
<button id="start-button">Start Optimization</button>

<script>
    document.getElementById('start-button').addEventListener('click', function() {
        var images = <?php echo json_encode($images); ?>;
        var totalImages = images.length;
        var processedImages = 0;

        function updateProgress() {
            processedImages++;
            document.getElementById('processed-images').innerText = processedImages;
            var progressBar = document.getElementById('progress-bar');
            progressBar.style.width = (processedImages / totalImages) * 100 + '%';
        }

        images.forEach(function(imagePath) {
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ imagePath: imagePath })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateProgress();
                    } else {
                        console.error('Failed to process image:', imagePath);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
