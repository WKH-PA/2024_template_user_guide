<?php
include "../vendor/autoload.php";
$errorMessages = [
    'Invalid API Key or Secret.' => ['message' => "Invalid API Key or Secret.", 'reason' => "API key hoặc secret key không đúng. Vui lòng kiểm tra lại."],
    'Invalid URL.' => ['message' => "Invalid URL.", 'reason' => "URL của hình ảnh không hợp lệ hoặc không thể truy cập."],
    'File size too large' => ['message' => "File size too large.", 'reason' => "Kích thước tệp hình ảnh vượt quá giới hạn cho phép."],
    'Unsupported file type.' => ['message' => "Unsupported file type.", 'reason' => "Định dạng tệp hình ảnh không được hỗ trợ."],
    'Rate limit exceeded.' => ['message' => "Rate limit exceeded.", 'reason' => "Số lượng yêu cầu API vượt quá giới hạn cho phép trong một khoảng thời gian nhất định."],
    'Authentication error.' => ['message' => "Authentication error.", 'reason' => "Lỗi xác thực xảy ra do nhiều nguyên nhân như key sai, hết hạn, v.v."],
    'Internal server error.' => ['message' => "Internal server error.", 'reason' => "Lỗi nội bộ của server Kraken.io. Thử lại sau một thời gian hoặc liên hệ với hỗ trợ kỹ thuật của Kraken.io."],
    'Missing parameter.' => ['message' => "Missing parameter.", 'reason' => "Thiếu tham số bắt buộc trong yêu cầu."],
    'Invalid parameter.' => ['message' => "Invalid parameter.", 'reason' => "Tham số không hợp lệ. Vui lòng kiểm tra lại các giá trị được cung cấp."],
    'Quota exceeded.' => ['message' => "Quota exceeded.", 'reason' => "Đã vượt quá hạn mức sử dụng dịch vụ. Vui lòng nâng cấp gói dịch vụ hoặc chờ đến khi hạn mức được làm mới."],
    'Network error.' => ['message' => "Network error.", 'reason' => "Lỗi kết nối mạng. Vui lòng kiểm tra kết nối internet của bạn."],
    'Access denied.' => ['message' => "Access denied.", 'reason' => "Quyền truy cập bị từ chối. Vui lòng kiểm tra quyền truy cập và xác thực của bạn."],
    'Timeout error.' => ['message' => "Timeout error.", 'reason' => "Yêu cầu đã vượt quá thời gian chờ. Vui lòng thử lại sau."],
    'Invalid signature.' => ['message' => "Invalid signature.", 'reason' => "Chữ ký không hợp lệ. Vui lòng kiểm tra và đảm bảo rằng chữ ký được tạo đúng cách."],
    "Couldn't get this file from provided URL." => ['message' => "Couldn't get this file from provided URL.", 'reason' => "Không thể lấy tệp từ URL được cung cấp. Vui lòng kiểm tra lại URL."]
];

$mo = "";
$table = '#_optimized_img';
$totalImages = 0; $processedImages = 0; $pz = 0; $pzz = 0; $uri = '';
$numview = isset($_GET['numview']) ? intval($_GET['numview']) : 15;
$statuss = isset($_GET['status']) ? $_GET['status'] : 'ASC';
$s_ksearch = isset($_GET['ksearch']) ? $_GET['ksearch'] : '';
if (isset($_GET['pz'])) {
    $pz = intval($_GET['pz']);
    $pzz = ($pz > 0) ? $pz * $numview : 0;
}
$displayId = ($pz * $numview);
if ($s_ksearch != "") {
    $key_parts = explode(' ', strtolower($s_ksearch));
    $mo = " AND (";
    foreach ($key_parts as $part) {
        // Adjust to search for exact match of each part
        $mo .= "LOWER(`image_path`) LIKE '%" . $part . "%' AND ";
    }
    // Remove the last " AND " and close the parentheses
    $mo = rtrim($mo, " AND ") . ")";
    // Encode the search keyword and add it to the URI
    $uri .= '&ksearch=' . rawurlencode($s_ksearch);
}

// Xây dựng điều kiện WHERE cho truy vấn SQL
$whereClause = "";
if ($statuss === 'DESC') {
    $whereClause = " WHERE `status` = 1 ".$mo;
} elseif ($statuss === 'ASC') {
    $whereClause = " WHERE `status` = 0 ".$mo;
}
// Truy vấn toàn bộ dữ liệu từ cơ sở dữ liệu
$sql_all = DB_que("SELECT * FROM `$table`");
$sql_dl = DB_que("SELECT * FROM `$table` $whereClause ORDER BY status $statuss");
$numlist = DB_num($sql_dl);
$numshow = ceil($numlist / $numview);
// Chuyển đổi kết quả truy vấn thành mảng
$data_all = mysqli_fetch_all($sql_all, MYSQLI_ASSOC);
$data_dl = mysqli_fetch_all($sql_dl, MYSQLI_ASSOC);
$data_page = array_slice($data_dl, $pzz, $numview);
$fullpath = $_SERVER['DOCUMENT_ROOT'] . '/' . $_SESSION['thumuc'];

// Thực hiện hành động khi nhấn nút laays hinh
if (isset($_POST['execute_all'])) {
    update_db_optimized_img($fullpath);
}

if (isset($_POST['execute_single'])) {
    $imagePath = isset($_POST['image_path']) ? $_POST['image_path'] : '';
    $krakenInstance = getValidKrakenInstance();
    $current_date = date('Y-m-d H:i:s');
    $result = processImage($krakenInstance, $imagePath);
    $status = $result['success'] ? 1 : 0;
    $error = $result['success'] ? '' : (isset($result['message']) ? $result['message'] : 'UNKNOWN_ERROR');
    $reason = $result['success'] ? '':(isset($errorMessages[$error]) ? $errorMessages[$error]['reason'] : $error);
    $message = $result['success'] ? $result['message'] : $reason;
    // Update the database
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $data = [
            'status' => $status,
            'updated' => $current_date,
            'error' => $reason
        ];
        ACTION_db($data, $table, 'update', NULL, "`id` = ".$_POST['id']);
    }

    // Pass the message and status to the frontend
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var url = new URL(window.location.href);
            var message = " . json_encode($message) . "; // Chuyển $message thành chuỗi JSON
            // Tạo phần tử modal
            var modal = document.createElement('div');
            modal.className = 'modal_';
            var modalContent = document.createElement('div');
            modalContent.className = 'modal-content_';
            var closeBtn = document.createElement('span');
            closeBtn.className = 'close';
            closeBtn.innerHTML = '×';
            var messageP = document.createElement('p');
            messageP.textContent = message; // Sử dụng biến message đã được chuyển đổi
            modalContent.appendChild(closeBtn);
            modalContent.appendChild(messageP);
            modal.appendChild(modalContent);
            document.body.appendChild(modal);
            
            // Hiển thị modal
            modal.style.display = 'block';
            // Đóng modal khi nhấn nút close hoặc click ra ngoài modal
            closeBtn.onclick = function() {
                modal.style.display = 'none';
               window.location.href = url.href;
                modal.remove();
            };
            modal.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                    window.location.href = url.href;
                    modal.remove();                    
                }
            }; 
        });
      </script>";
}

foreach ($data_all as $row) {
    $totalImages++;
    if ($row['status'] == 1) {
        $processedImages++;
    }
}
?>
<section class="content-header">
    <h1>Danh sách ảnh tối ưu</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách ảnh tối ưu</li>
    </ol>
</section>
<form id="optimize-all-form" action="" method="post">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12">
                    <div class="cards-container">
                        <div class="card custom-card overflow-hidden main-content-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div>
                                        <span class="text-muted d-block mb-1">Tổng số ảnh trong hàng chờ:</span>
                                        <h4 class="fw-medium mb-0" id="total-images"><?php echo $totalImages; ?></h4>
                                    </div>
                                    <div class="lh-1">
                                        <span class="avatar avatar-md avatar-rounded bg-warning">
                                            <ion-icon name="build-sharp"></ion-icon>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card custom-card overflow-hidden main-content-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div>
                                        <span class="text-muted d-block mb-1">Số lượng đã tối ưu:</span>
                                        <h4 class="fw-medium mb-0"
                                            id="processed-images"><?php echo $processedImages; ?></h4>
                                    </div>
                                    <div class="lh-1">
                                        <span class="avatar avatar-md avatar-rounded bg-success">
                                            <ion-icon name="checkmark-done-sharp"></ion-icon>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <div class="box-tools">
                                <div class="dv-hd-locsds">
                                    <div class="form-group">
                                        <div class="input-group-custom">
                                            <input name="ksearch" type="text" value="<?=$s_ksearch ?>" class="form-control-custom key_search" placeholder="Nhập từ khóa tìm kiếm">
                                            <button name='search' type="button" class="btn-custom btn_search_ds" onclick='SEARCH_jsstep()'><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <select name="viewid" id="viewid" class="js_hienthi_ds form-control" onchange='SEARCH_jsstep()'>
                                            <option value="15" <?php if ($numview == 15) echo "selected"; ?>>15</option>
                                            <option value="30" <?php if ($numview == 30) echo "selected"; ?>>30</option>
                                            <option value="60" <?php if ($numview == 60) echo "selected"; ?>>60</option>
                                            <option value="100" <?php if ($numview == 100) echo "selected"; ?>>100</option>
                                            <option value="200" <?php if ($numview == 200) echo "selected"; ?>>200</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select id="status-select" name="status" class="form-control modern-select">
                                            <option value="ASC" <?= $statuss === 'ASC' ? 'selected' : '' ?>>Chưa tối ưu</option>
                                            <option value="DESC" <?= $statuss === 'DESC' ? 'selected' : '' ?>>Đã tối ưu</option>
                                        </select>
                                    </div>
                                </div>
                                <h3 class="box-title box-title-td pull-right">
                                    <button class="tooltip-target btn btn-primary"
                                            data-tooltip="Nhấn vào để lấy hình từ server và đẩy vào hàng chờ tối ưu hóa."
                                            type="submit" name="execute_all" onclick="return confirmAction()">
                                        <ion-icon name="cloud-upload-outline">  </ion-icon> Tải hình lên
                                    </button>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive no-padding table-danhsach-cont">
                                <table class="table table-hover table-danhsach">
                                    <thead>
                                    <tr>
                                        <th class="w80 text-center">STT</th>
                                        <th>Đường dẫn ảnh</th>
                                        <th class="w100 text-center">Ngày tạo</th>
                                        <th class="w100 text-center">Ngày cập nhật</th>
                                        <th class="w100 text-center">Trạng thái</th>
                                        <th class="w50 text-center">Vấn đề</th>
                                        <th class="w100 text-center">Tùy chọn</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($data_page as $index => $rows) {
                                        $ida = htmlspecialchars($rows['id']);
                                        $image_path = htmlspecialchars($rows['image_path']);
                                        $date = date('d-m-Y', strtotime($rows['date']));
                                        $update = date('d-m-Y', strtotime($rows['updated']));
                                        $status = $rows['status'];
                                        $status_text = ($status == 1) ? 'Đã tối ưu' : 'Chưa tối ưu';
                                        $status_label_class = ($status == 1) ? 'label-success' : 'label-danger';
                                        $error = htmlspecialchars($rows['error']);
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $index + 1 ?></td>
                                            <td><?= $image_path ?></td>
                                            <td class="text-center"><?= $date ?></td>
                                            <td class="text-center"><?= $update ?></td>
                                            <td class="text-center">
                                                <span class="label <?= $status_label_class ?>"><?= $status_text ?></span>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($error): ?>
                                                    <a href="#" class="error-icon" data-toggle="modal"
                                                       data-target="#errorModal<?= $index ?>">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="errorModal<?= $index ?>" tabindex="-1"
                                                         role="dialog" aria-labelledby="errorModalLabel<?= $index ?>"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="errorModalLabel<?= $index ?>">Chi tiết
                                                                        lỗi</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?= $error ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Đóng
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($status == 0) : ?>
                                                    <form action="" method="post" class="d-inline-block">
                                                        <input type="hidden" name="image_path"
                                                               value="<?= htmlspecialchars($image_path, ENT_QUOTES, 'UTF-8') ?>">
                                                        <input type="hidden" name="id"
                                                               value="<?= htmlspecialchars($ida, ENT_QUOTES, 'UTF-8') ?>">
                                                        <button type="submit" name="execute_single"
                                                                class="btn btn-primary">
                                                            <i class="fa fa-cog"></i> Tối ưu
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-header">
                                <div class="paging_simple_numbers">
                                    <ul class="pagination">
                                        <?php
                                        PHANTRANG_admin($numshow, $url_page.'&numview=' . $numview . '&status=' . $statuss  , $pz, $uri);
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<script src="https://unpkg.com/ionicons@6.0.0/dist/ionicons/ionicons.js"></script>
<script>
    document.getElementById('status-select').addEventListener('change', function () {
        var status = this.value;
        var url = new URL(window.location.href);
        url.searchParams.delete('pz');
        url.searchParams.set('status', status);
        window.history.pushState({}, '', url.href);
        window.location.href = url.href;
    });

    $(document).ready(function() {
        $('.key_search').bind("keypress", function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                SEARCH_jsstep();
                return false;
            }
        });

        // Make sure SEARCH_jsstep is defined before using it
        window.SEARCH_jsstep = function() {
            var numview = $('#viewid').val();
            var status = $('#status-select').val();
            var ksearch = $(".key_search").val().trim();
            var url = new URL(window.location.href);

            if (numview) {
                url.searchParams.set('numview', numview);
            } else {
                url.searchParams.delete('numview');
            }
            if (status) {
                url.searchParams.set('status', status);
            } else {
                url.searchParams.delete('status');
            }
            if (ksearch) {
                url.searchParams.set('ksearch', ksearch);
            } else {
                url.searchParams.delete('ksearch');
            }
            window.location.href = url.href;
        }

        function updateSearchInputFromUrl() {
            var url = new URL(window.location.href);
            var ksearch = url.searchParams.get('ksearch');
            if (ksearch) {
                $(".key_search").val(decodeURIComponent(ksearch));
            }
        }

        updateSearchInputFromUrl();
    });

    function updateImageCount(total, processed) {
        document.getElementById('total-images').textContent = total;
        document.getElementById('processed-images').textContent = processed;
    }

    updateImageCount(<?php echo $totalImages; ?>, <?php echo $processedImages; ?>);
    $.ajax({
        // ...
        success: function (response) {
            if (response.status == 1) {
                processedImages++; // Tăng số ảnh đã xử lý
                updateImageCount(totalImages, processedImages);
            }
        }
    });
</script>

<style>
    .input-group-custom {
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-control-custom {
        flex: 1;
        padding: 8px;
        border: none;
        border-radius: 4px 0 0 4px;
        font-size: 14px;
        box-sizing: border-box; /* Đảm bảo padding không làm thay đổi kích thước */
    }

    .btn-custom {
        padding: 8px 12px;
        border: none;
        background-color: #f8f8f8;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-custom i {
        color: #333;
    }

    .btn-custom:hover {
        background-color: #e0e0e0;
    }

    .btn-custom:active {
        background-color: #d0d0d0;
    }

    /* Căn chỉnh khoảng cách bên dưới cho các phần tử */
    .paging_simple_numbers {
        margin-bottom: 10px; /* Căn lề dưới cho box-header và paging_simple_numbers */
    }

    /* Nếu bạn chỉ muốn thêm khoảng cách bên trong cho paging_simple_numbers */
    .paging_simple_numbers {
        padding-bottom: 10px; /* Thêm khoảng cách bên trong paging_simple_numbers */
    }

    /* Thêm khoảng cách giữa biểu tượng và chữ */
    .tooltip-target .ion-icon {
        margin-right: 8px; /* Điều chỉnh khoảng cách theo ý muốn */
    }

    .tooltip-target {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Tùy chỉnh button để trông đẹp hơn */
    .tooltip-target .button-text {
        font-size: 16px; /* Điều chỉnh kích thước chữ theo ý muốn */
        font-weight: bold; /* Làm cho chữ đậm hơn */
    }


    /* Optional: Tooltip styling */

    /* Show the tooltip */
    .tooltip-target[data-tooltip]:hover:before {
        content: "";
        position: absolute;
        border-width: 5px;
        border-style: solid;
        border-color: transparent transparent transparent #333;
        top: 50%;
        left: 100%;
        transform: translateY(-50%);
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease;
    }


    .box-header {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px; /* Khoảng cách giữa các phần tử con */
    }

    .box-title-td {
        margin: 0;
    }
    .box-header>.box-tools {
        display: flex;
        top: 10px;
        gap: 10px; /* Khoảng cách giữa các phần tử con */
    }
    .form-group {
        margin: 0;
    }


    .cards-container {
        display: flex;
        flex-wrap: wrap; /* Allow cards to wrap if the screen is too small */
        width: 100%; /* Full width */
        padding: 0,5rem; /* Optional: Add padding around the container */
        justify-content: space-between; /* Distribute space evenly between cards */
        box-sizing: border-box; /* Include padding and border in element's total width and height */
    }

    /* Card styling */
    .card.custom-card {
        flex: 1 1 calc(50% - 1rem); /* Each card takes 50% width minus the total horizontal margin */
        max-width: calc(50% - 1rem);
        border-radius: 0.75rem; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow */
        background-color: #ffffff; /* White background */
        transition: box-shadow 0.3s ease-in-out; /* Smooth shadow transition */
        margin-bottom: 2rem; /* Space below each card */
        /*margin-right: 1rem; !* Horizontal spacing between cards *!*/
        /*margin-left: 1rem; !* Horizontal spacing between cards *!*/
    }

    /* Add hover effect */
    .card.custom-card:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Enhanced shadow on hover */
    }

    /* Responsive design for smaller screens */
    @media (max-width: 992px) {
        .card.custom-card {
            flex: 1 1 calc(50% - 2rem); /* 2 cards per row for medium screens */
            max-width: calc(50% - 2rem);
        }
    }

    @media (max-width: 576px) {
        .card.custom-card {
            flex: 1 1 calc(100% - 2rem); /* 1 card per row for small screens */
            max-width: calc(100% - 2rem);
        }
    }



    @media (max-width: 768px) {
        .card.custom-card {
            flex: 1 1 100%; /* 1 card per row for small screens */
            max-width: 100%;
        }
    }

    /* Card body styling */
    .card.custom-card .card-body {
        padding: 1.5rem; /* Padding inside the card */
    }

    /* Flex container for title and avatar */
    .d-flex {
        display: flex;
    }

    .align-items-start {
        align-items: flex-start; /* Align items at the start of the container */
    }

    .justify-content-between {
        justify-content: space-between; /* Space out items */
    }

    /* Title and metrics */
    .text-muted {
        color: #6c757d; /* Gray color for muted text */
    }

    .fw-medium {
        font-weight: 500; /* Medium font weight */
    }

    .mb-0 {
        margin-bottom: 0; /* Remove bottom margin */
    }

    .mb-1 {
        margin-bottom: 0.5rem; /* Margin below the text */
    }

    .fs-13 {
        font-size: 0.875rem; /* Adjust font size */
    }

    /* Avatar styling */
    .avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 4rem; /* Width of avatar */
        height: 4rem; /* Height of avatar */
        border-radius: 50%; /* Circle shape */
        background-color: #17a2b8; /* Background color for the icon (info blue) */
        color: #ffffff; /* White icon color */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Light shadow for 3D effect */
        font-size: 2rem; /* Size of the icon */
        transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transitions */
    }

    /* Hover effect */
    .avatar:hover {
        background-color: #286090; /* Slightly darker blue on hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Enhance shadow on hover */
    }

    /* Adjust icon size inside the avatar */
    ion-icon {
        font-size: 2rem; /* Adjust the size of the icon */
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .avatar {
            width: 3rem;
            height: 3rem;
            font-size: 1.5rem; /* Adjust font size for smaller screens */
        }
    }

    .bg-primary {
        background-color: #286090; /* Primary color background */
    }

    .text-success {
        color: #28a745; /* Success color for text */
    }

    .fs-16 {
        font-size: 1.125rem; /* Larger font size for icons */
    }

    .ti {
        font-family: 'Icons', sans-serif; /* Replace with your icon font */
    }

    .card-header {
        display: flex;
        justify-content: space-between; /* Align header content */
        align-items: center; /* Vertical alignment */
    }

    .form-inline {
        display: flex;
        align-items: center; /* Align items vertically in the center */
    }

    .form-inline select {
        margin-right: 10px; /* Add some space between the select and the button */
    }

    .modern-select {
        width: 200px; /* Adjust width as needed */
        height: 40px; /* Adjust height as needed */
        font-size: 16px; /* Adjust font size as needed */
        padding: 5px 10px; /* Adjust padding as needed */
        border: 1px solid #ccc; /* Border color */
        /*border-radius: 5px; !* Rounded corners *!*/
        background-color: #f9f9f9; /* Background color */
        /*-webkit-appearance: none; !* Remove default arrow in Safari *!*/
        -moz-appearance: none; /* Remove default arrow in Firefox */
        /*appearance: none; !* Remove default arrow in other browsers *!*/
    }

    .modern-select:focus {
        border-color: #286090; /* Border color on focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Shadow on focus */
        outline: none; /* Remove default outline */
    }

    .btn-modern {
        font-size: 16px; /* Adjust font size as needed */
        padding: 5px 20px; /* Adjust padding as needed */
        border-radius: 5px; /* Rounded corners */
    }

    .error-icon {
        color: #286090; /* Icon color */
        cursor: pointer; /* Pointer cursor */
    }

    .btn-primary {
        background-color: #286090; /* Primary color */
        border: none; /* Remove default border */
        padding: 5px 10px; /* Smaller padding for a more compact button */
        border-radius: 6px; /* Slightly rounded corners */
        font-size: 12px; /* Smaller font size */
        color: #fff; /* Text color */
        transition: background-color 0.3s ease; /* Smooth transition effect */
    }

    .btn-primary:hover,
    btn:hover {
        background-color: #0056b3; /* Darker color on hover */
    }


    input[type="hidden"] {
        display: none; /* Hide the hidden inputs */
    }

    .modal_ {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content_ {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        position: relative;
        pointer-events: none;
    }


</style>
