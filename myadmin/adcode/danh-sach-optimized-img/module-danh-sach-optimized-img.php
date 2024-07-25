<?php
$table = '#_optimized_img';

$uri      = '';
$numview  = 50;
$pz       = 0;
$pzz      = 0;
// Xử lý khi người dùng chọn trạng thái từ form
$filterStatus = isset($_POST['viewid']) ? intval($_POST['viewid']) : 0;
if (isset($_GET['pz'])) {
    $pz = intval($_GET['pz']);
    $pzz = ($pz > 0) ? $pz * $numview : 0;
}

// Truy vấn toàn bộ dữ liệu từ cơ sở dữ liệu
$sql_all = DB_que("SELECT * FROM `$table` ORDER BY `id` DESC");
$numlist = DB_num($sql_all);
$numshow = ceil($numlist / $numview);

// Chuyển đổi kết quả truy vấn thành mảng
$data_all = mysqli_fetch_all($sql_all, MYSQLI_ASSOC);


// Lọc dữ liệu dựa trên trạng thái đã chọn
$data_all = array_filter($data_all, function($row) use ($filterStatus) {
    $status = SHOW_text($row['status']);
    return ($filterStatus === 0 || ($filterStatus === 1 && $status == 0) || ($filterStatus === 2 && $status == 1));
});

usort($data_all, function($a, $b) use ($filterStatus) {
    $statusA = SHOW_text($a['status']);
    $statusB = SHOW_text($b['status']);

    if ($statusA == $statusB) {
        return 0;
    }

    return ($statusA == $filterStatus) ? -1 : 1;
});

// Lấy dữ liệu cho trang hiện tại
$data_page = array_slice($data_all, $pzz, $numview);

$fullpath = $_SERVER['DOCUMENT_ROOT'] . '/' . $_SESSION['thumuc'];

if (isset($_POST['execute'])) {
    update_db_optimized_img($fullpath);
}
?>

<!-- Chỉ sử dụng một thẻ form -->
<form action="" method="post">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách ảnh tối ưu </h3>
                            <div class="form-group">
                                <select name="viewid" class="form-control" onchange="this.form.submit()">
                                    <option selected="selected"  value="0" >Trạng thái</option>
                                    <option value="1" <?= $filterStatus === 1 ? 'selected' : '' ?>>Chưa tối ưu</option>
                                    <option value="2" <?= $filterStatus === 2 ? 'selected' : '' ?>>Đã tối ưu</option>
                                </select>
                            </div>
                            <!-- Nút gửi form nằm trong thẻ form -->
                            <button type="submit" name="execute" class="btn btn-primary">
                                <i class="fa fa-cogs"></i> Tối ưu
                            </button>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $cl = 0;
                                    foreach ($data_page as $rows) {
                                        $ida        = SHOW_text($rows['id']);
                                        $image_path = SHOW_text($rows['image_path']);
                                        $date       = date('d-m-Y', strtotime(SHOW_text($rows['date'])));
                                        $update     = date('d-m-Y', strtotime(SHOW_text($rows['updated'])));
                                        $status     = SHOW_text($rows['status']);
                                        $error      = SHOW_text($rows['error']);
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= ++$cl ?></td>
                                            <td><?= strstr($image_path, $_SESSION['thumuc']) ?></td>
                                            <td><?= $date ?></td>
                                            <td><?= $update ?></td>
                                            <td><?= $status ?></td>
                                            <td><?= $error ?></td>
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
                                        PHANTRANG_admin($numshow, $url_page, $pz, $uri);
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

<style>
    .pagination-container {
        display: flex;
        justify-content: flex-end; /* Căn chỉnh phân trang sang bên phải */
        margin-top: 10px; /* Khoảng cách từ bảng */
        margin-bottom: 40px; /* Khoảng cách từ đáy */
    }
    .card-header {
        display: flex;
        justify-content: space-between; /* Căn chỉnh nội dung thẻ tiêu đề */
        align-items: center; /* Căn chỉnh theo chiều dọc */
    }
</style>
