<?php
include "../vendor/autoload.php";
$table = '#_optimized_img';
$totalImages = 0;
$processedImages = 0;
$numview  = 50;
$pz       = 0;
$pzz      = 0;
$statuss = isset($_GET['status']) ? $_GET['status'] : 'ASC';
if (isset($_GET['pz'])) {
    $pz = intval($_GET['pz']);
    $pzz = ($pz > 0) ? $pz * $numview : 0;
}
$displayId = ($pz * $numview);

// Truy vấn toàn bộ dữ liệu từ cơ sở dữ liệu
$sql_all = DB_que("SELECT * FROM `$table` ORDER BY status $statuss");
$numlist = DB_num($sql_all);
$numshow = ceil($numlist / $numview);
// Chuyển đổi kết quả truy vấn thành mảng
$data_all = mysqli_fetch_all($sql_all, MYSQLI_ASSOC);
$data_page = array_slice($data_all, $pzz, $numview);
$fullpath = $_SERVER['DOCUMENT_ROOT'] . '/' . $_SESSION['thumuc'];

// Thực hiện hành động khi nhấn nút tối ưu toàn bộ
if (isset($_POST['execute_all'])) {
    update_db_optimized_img($fullpath);
}
// Thực hiện hành động khi nhấn nút tối ưu từng ảnh
if (isset($_POST['execute_single'])) {
    $imagePath = isset($_POST['image_path']) ? $_POST['image_path'] : '';
    $krakenInstance = getValidKrakenInstance();
    $current_date = date('Y-m-d H:i:s');
    // Process the image using Kraken.io
    $result = processImage($krakenInstance, $imagePath, $webDirectory);
    if ($result['success']) {
        $status = 1;
        $error = '';
        $message = 'Tối ưu ảnh thành công!';
    } else {
        $status = 0;
        $error_message = $result['message'];
        $error_code = $result['error_code'];
        $error = "Kraken error: $error_message (Code: $error_code)";
        $message = 'Có lỗi xảy ra: ' . $error;
    }
    // Update the database
    $data = [
        'status' => $status,
        'updated' => $current_date,
        'error' => $error
    ];
    ACTION_db($data, $table, 'update', NULL, "`id` = {$_POST['id']}");
    // Pass the message and status to the frontend
    echo "<script>
        $(document).ready(function() {
            // Create a modal element
            var modal = $('<div class=\"modal_\">' +
                             '<div class=\"modal-content_\">' +
                                 '<span class=\"close\">&times;</span>' +
                                 '<p>$message</p>' +
                             '</div>' +
                          '</div>');

            // Append modal to body
            $('body').append(modal);

            // Show modal
            modal.show();

            // Close modal when close button or outside modal is clicked
            $('.close, .modal').on('click', function() {
                modal.remove();
              
            });
        });
      </script>";

}
// Tạo liên kết phân trang với các tham số hiện tại
function create_pagination_links($numshow, $url_page, $pz, $status) {
    $pagination_links = '';
    for ($i = 0; $i < $numshow; $i++) {
        $active = ($i == $pz) ? 'active' : '';
        $url = $url_page . '&status=' . $status . '&pz=' . $i;
        $pagination_links .= "<li class='page-item $active'><a class='page-link' href='$url'>$i</a></li>";
    }
    return $pagination_links;
}
foreach ($data_all as $row) {
    $totalImages++;
    if ($row['status'] == 1) {
        $processedImages++;
    }
}
?>

<!-- Form cho chức năng tối ưu toàn bộ -->
<form id="optimize-all-form" action="" method="post">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <p>Images to process: <span id="total-images"><?php echo $sl; ?></span></p>
                        <p>Images processed: <span id="processed-images"><?php echo $ht; ?></span></p>
                        <div class="card-header">
                            <h3 class="card-title">Danh sách ảnh tối ưu</h3>
                            <div class="form-inline">
                                <select id="status-select" name="status" class="form-control modern-select">
                                    <option value="ASC" <?= $statuss === 'ASC' ? 'selected' : '' ?>>Chưa tối ưu</option>
                                    <option value="DESC" <?= $statuss === 'DESC' ? 'selected' : '' ?>>Đã tối ưu</option>
                                </select>
                                <button type="submit" name="execute_all" class="btn" onclick="return confirmAction()">
                                    <i class="fa fa-cogs"></i> Lấy hình
                                </button>
                                <!-- Bootstrap Modal for Confirmation -->
                                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmModalLabel">Xác nhận hành động</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="confirmation-message">
                                                <p>Bạn có chắc chắn muốn đưa vào hàng chờ tối ưu không?</p>
                                                <p class="note">Lưu ý rằng những mục trùng tên sẽ không được thêm vào.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button type="button" class="btn btn-primary" id="confirmButton">Xác nhận</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Đường dẫn ảnh</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Trạng thái</th>
                                        <th>Lỗi</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($data_page as $rows) {
                                        $ida        = SHOW_text($rows['id']);
                                        $image_path = SHOW_text($rows['image_path']);
                                        $date       = date('d-m-Y', strtotime(SHOW_text($rows['date'])));
                                        $update     = date('d-m-Y', strtotime(SHOW_text($rows['updated'])));
                                        $status     = SHOW_text($rows['status']);
                                        $error      = SHOW_text($rows['error']);
                                        $displayId++;
                                        ?>
                                        <tr>
<!--                                            <td class="text-center">--><?//= htmlspecialchars($rows['id']) ?><!--</td>-->
                                            <td class="text-center"><?= $displayId ?></td>
                                            <td><?= strstr($image_path, 'datafiles') ?></td>
                                            <td><?= $date ?></td>
                                            <td><?= $update ?></td>
                                            <td><?= $status ?></td>
                                            <td>
                                                <?php if ($error): ?>
                                                    <a href="#" class="error-icon" data-toggle="modal" data-target="#errorModal<?= $cl ?>">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="errorModal<?= $cl ?>" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel<?= $cl ?>" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="errorModalLabel<?= $cl ?>">Error Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?= $error ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($status == 0) : ?>
                                                    <form action="" method="post" class="d-inline-block">
                                                        <input type="hidden" name="image_path" value="<?= htmlspecialchars($image_path, ENT_QUOTES, 'UTF-8') ?>">
                                                        <input type="hidden" name="id" value="<?= htmlspecialchars($ida, ENT_QUOTES, 'UTF-8') ?>">
                                                        <button type="submit" name="execute_single" class="btn btn-primary">Tối ưu</button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <nav aria-label="Page navigation" class="pagination-container">
                                    <ul class="pagination justify-content-end">
                                        <?php
                                        $url_page = isset($url_page) ? $url_page : '';
                                        echo create_pagination_links($numshow, $url_page, $pz, $statuss);
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<script>
    document.getElementById('status-select').addEventListener('change', function() {
        // Lấy giá trị từ dropdown
        var status = this.value;
        // Tạo một URL đối tượng mới từ URL hiện tại
        var url = new URL(window.location.href);
        url.searchParams.delete('pz');
        // Cập nhật tham số 'status'
        url.searchParams.set('status', status);
        // Cập nhật URL mà không tải lại trang
        window.history.pushState({}, '', url.href);
        window.location.reload();
    });
    function updateImageCount(total, processed) {
        document.getElementById('total-images').textContent = total;
        document.getElementById('processed-images').textContent = processed;
    }
    updateImageCount(<?php echo $totalImages; ?>, <?php echo $processedImages; ?>);
    $.ajax({
        // ...
        success: function(response) {
            // ... (Xử lý kết quả trả về từ server)

            // Cập nhật số lượng ảnh
            if (response.status == 1) {
                processedImages++; // Tăng số ảnh đã xử lý
                updateImageCount(totalImages, processedImages);
            }
        }
    });

</script>

<style>
    .pagination-container {
        display: flex;
        justify-content: flex-end; /* Align pagination to the right */
        margin-top: 10px; /* Margin from the table */
        margin-bottom: 40px; /* Margin from the bottom */
    }
    .card-header {
        display: flex;
        justify-content: space-between; /* Align header content */
        align-items: center; /* Vertical alignment */
    }
    .btn {
        background-color: #30a800; /* Primary color */
        border: none; /* Remove default border */
        padding: 7px 14px; /* Smaller padding for a more compact button */
        border-radius: 6px; /* Slightly rounded corners */
        font-size: 16px; /* Smaller font size */
        color: #fff; /* Text color */
        transition: background-color 0.3s ease; /* Smooth transition effect */
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
        border-radius: 5px; /* Rounded corners */
        background-color: #f9f9f9; /* Background color */
        -webkit-appearance: none; /* Remove default arrow in Safari */
        -moz-appearance: none; /* Remove default arrow in Firefox */
        appearance: none; /* Remove default arrow in other browsers */
    }
    .modern-select:focus {
        border-color: #007bff; /* Border color on focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Shadow on focus */
        outline: none; /* Remove default outline */
    }
    .btn-modern {
        font-size: 16px; /* Adjust font size as needed */
        padding: 5px 20px; /* Adjust padding as needed */
        border-radius: 5px; /* Rounded corners */
    }
    .error-icon {
        color: #007bff; /* Icon color */
        cursor: pointer; /* Pointer cursor */
    }

    .btn-primary {
        background-color: #007bff; /* Primary color */
        border: none; /* Remove default border */
        padding: 5px 10px; /* Smaller padding for a more compact button */
        border-radius: 6px; /* Slightly rounded corners */
        font-size: 12px; /* Smaller font size */
        color: #fff; /* Text color */
        transition: background-color 0.3s ease; /* Smooth transition effect */
    }

    .btn-primary:hover,
    btn:hover{
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
    }




</style>
