<?php
if(isset($_GET['chitiet']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
    include "module-danh-sach-thanh-toan-vnpay-chi-tiet.php";
}else {
$mo = "";
$table = '#_buy_pay';
$totalImages = 0;
$processedImages = 0;
$pz = 0;
$pzz = 0;
$uri = '';
$numview = isset($_GET['numview']) ? intval($_GET['numview']) : 14 ;
$statuss = isset($_GET['status']) ? $_GET['status'] : '';
$s_ksearch = isset($_GET['ksearch']) ? $_GET['ksearch'] : '';
$bankFilter = isset($_GET['bank']) ? $_GET['bank'] : '';
$methodFilter = isset($_GET['method']) ? $_GET['method'] : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$whereConditions = [];

if (isset($_GET['pz'])) {
    $pz = intval($_GET['pz']);
    $pzz = ($pz > 0) ? $pz * $numview : 0;
}
$displayId = ($pz * $numview);

if ($s_ksearch !== "") {
    $s_ksearch = strtolower($s_ksearch); // Chuyển toàn bộ chuỗi tìm kiếm thành chữ thường
    $searchConditions = [];
    $searchConditions[] = "LOWER(`mdh`) LIKE '%" . $s_ksearch . "%'";
    $searchConditions[] = "LOWER(`mgd_vnp`) LIKE '%" . $s_ksearch . "%'";
    $searchConditions[] = "LOWER(`noidung`) LIKE '%" . $s_ksearch . "%'";

    $whereConditions[] = '(' . implode(' OR ', $searchConditions) . ')';
}

if (!empty($start_date) && !empty($end_date)) {
    $whereConditions[] = "DATE(`ngaytao`) BETWEEN '$start_date' AND '$end_date'";
} elseif (!empty($start_date)) {
    $whereConditions[] = "DATE(`ngaytao`) >= '$start_date'";
} elseif (!empty($end_date)) {
    $whereConditions[] = "DATE(`ngaytao`) <= '$end_date'";
}

if ($statuss === 'DESC') {
    $whereConditions[] = "`trangthai` = 1";
} elseif ($statuss === 'ASC') {
    $whereConditions[] = "`trangthai` = 0";
}

if (!empty($bankFilter)) {
    $whereConditions[] = "`bankcode` = '$bankFilter'";
}

if (!empty($methodFilter)) {
    $whereConditions[] = "`method` = '$methodFilter'";
}

$whereClause = '';
if (!empty($whereConditions)) {
    $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
}

$sql_all = DB_que("SELECT * FROM `$table` $whereClause ORDER BY `ngaytao` DESC");
$sql_bankcode = DB_que("SELECT DISTINCT bankcode FROM `$table` WHERE bankcode IS NOT NULL");
$numlist = DB_num($sql_all); // Correct variable name
$numshow = ceil($numlist / $numview);

$data_all = mysqli_fetch_all($sql_all, MYSQLI_ASSOC);
$data_page = array_slice($data_all, $pzz, $numview);
$data_bankcode = mysqli_fetch_all($sql_bankcode, MYSQLI_ASSOC);
$banks = [];
foreach ($data_bankcode as $row) {
    $banks[$row['bankcode']] = $row['bankcode'];
}
if (empty($banks)) {
    echo "<script>console.log('Không có ngân hàng nào được tìm thấy.');</script>";
}
?>
<section class="content-header">
    <h1>Danh sách thanh toán VNPAY</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách thanh toán VNpay</li>
    </ol>
</section>
<form id="optimize-all-form" action="" method="post">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="box-tools">
                                <div class="dv-hd-locsds">
                                    <div class="form-group search-group">
                                        <div class="input-group-custom">
                                            <input name="ksearch" type="text" value="<?= $s_ksearch ?>" class="form-control-custom key_search" placeholder="Nhập từ khóa tìm kiếm">
                                        </div>
                                        <div class="date-group">
                                            <input type="date" id="start-date" name="start_date" class="form-control modern-select" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                                            <input type="date" id="end-date" name="end_date" class="form-control modern-select" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                                        </div>
<!--                                        <button name='search' type="button" class="btn btn-primary btn_search_ds" id="save-button"><i class="fa fa-floppy-o"></i> Tìm</button>-->
                                        <button name='search' type="button" class="btn-custom btn_search_ds" onclick='SEARCH_jsstep()'>
                                            <i class="fa fa-search"></i> Tìm
                                        </button>
                                    </div>
                                    <div class="dv-hd-locsds">
                                        <div class="form-group filter-group">
                                            <select name="viewid" id="viewid" class="js_hienthi_ds form-control" onchange='SEARCH_jsstep()'>
                                                <option value="" selected>Hiển thị</option>
                                                <option value="15" <?= $numview == 15 ? "selected" : "" ?>>15</option>
                                                <option value="30" <?= $numview == 30 ? "selected" : "" ?>>30</option>
                                                <option value="60" <?= $numview == 60 ? "selected" : "" ?>>60</option>
                                                <option value="100" <?= $numview == 100 ? "selected" : "" ?>>100</option>
                                                <option value="200" <?= $numview == 200 ? "selected" : "" ?>>200</option>
                                            </select>
                                        </div>
                                        <div class="form-group filter-group">
                                            <select id="status-select" name="status" class="form-control modern-select">
                                                <option value="" selected>Trạng thái</option>
                                                <option value="ASC" <?= $statuss === 'ASC' ? 'selected' : '' ?>>Thất bại</option>
                                                <option value="DESC" <?= $statuss === 'DESC' ? 'selected' : '' ?>>Thành công</option>
                                            </select>
                                        </div>
                                        <div class="form-group filter-group">
                                            <select name="bank" id="bank-select" class="form-control modern-select">
                                                <option value="" selected>Chọn Ngân hàng</option>
                                                <?php
                                                foreach ($banks as $code => $name) {
                                                    $selected = ($bankFilter == $code) ? 'selected' : '';
                                                    echo "<option value='$code' $selected>$name</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group filter-group">
                                            <select name="method" id="method-select" class="form-control modern-select">
                                                <option value="" selected>Chọn Phương thức</option>
                                                <option value="1" <?= ($methodFilter == '1') ? 'selected' : '' ?>>VNPAY</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive no-padding table-danhsach-cont">
                                <table class="table table-hover table-danhsach">
                                    <thead>
                                    <tr>
                                        <th class="w60 text-center">STT</th>
                                        <th class="w90 text-center">Mã đơn hàng</th>
                                        <th class="w90 text-center">Mã giao dịch </th>
                                        <th class="w150 text-center"> Số tiền </th>
                                        <th>Nội dung</th>
                                        <th class="w120 text-center">Ngày tạo</th>
                                        <th class="w90 text-center">Trạng thái</th>
                                        <th class="w90 text-center">Bank</th>
                                        <th class="w150 text-center">Phương thức thanh toán</th>
                                        <th class="w100 text-center">Tùy chọn</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data_page as $index => $rows) :
                                        $mdh = htmlspecialchars($rows['mdh']);
                                        $mgd =($rows['mgd_vnp'])==0 ? '~' :htmlspecialchars($rows['mgd_vnp']);
                                        $money = htmlspecialchars($rows['money']);
                                        $noidung = htmlspecialchars($rows['noidung']);
                                        $ngaytao = date('d-m-Y H:i', strtotime($rows['ngaytao']));
                                        $status = $rows['trangthai'];
                                        $bank = $rows['bankcode'];
                                        $phuongthuc = ($rows['method']) == 1 ? 'VNPAY' : (($rows['method'] == 2) ? 'Momo' : ''); // Thay đổi logic hiển thị phương thức thanh toán
                                        $status_text = ($status == 1) ? 'Thành công' : 'Thất bại ';
                                        $status_label_class = ($status == 1) ? 'label-success' : 'label-danger';
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $index + 1 + $pzz ?></td>
                                            <td class="text-center"><?= $mdh ?></td>
                                            <td class="text-center"><?= $mgd ?></td>
                                            <td class="text-center"><?= number_format($money, 0, ',', '.') ?></td>
                                            <td><?= $noidung ?></td>
                                            <td class="text-center"><?= $ngaytao ?></td>
                                            <td class="text-center">
                                                <span class="label <?= $status_label_class ?>">
                                                    <?= $status_text ?>
                                                </span>
                                            </td>
                                            <td class="text-center"><?= $bank ?></td>
                                            <td class="text-center"><?= $phuongthuc ?></td>
                                            <td>
                                                <a href="<?=$url_page ?>&chitiet=true&mdh=<?=$mdh?>" class="btn btn-modern">
                                                    <i class="fa fa-eye"></i> Chi tiết
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-header">
                                <div class="paging_simple_numbers">
                                    <ul class="pagination">
                                        <?php PHANTRANG_admin($numshow, $url_page . '&numview=' . $numview . '&status=' . $statuss, $pz, $uri); ?>
                                    </ul>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const updateURLParams = () => {
            const url = new URL(window.location.href);
            const numview = document.getElementById('viewid').value;
            const status = document.getElementById('status-select').value;
            const ksearch = document.querySelector('.key_search').value.trim();
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            const bank = document.getElementById('bank-select').value;
            const method = document.getElementById('method-select').value;

            // Cập nhật hoặc xóa các tham số URL tương ứng
            numview ? url.searchParams.set('numview', numview) : url.searchParams.delete('numview');
            status ? url.searchParams.set('status', status) : url.searchParams.delete('status');
            ksearch ? url.searchParams.set('ksearch', ksearch) : url.searchParams.delete('ksearch');
            startDate ? url.searchParams.set('start_date', startDate) : url.searchParams.delete('start_date');
            endDate ? url.searchParams.set('end_date', endDate) : url.searchParams.delete('end_date');
            bank ? url.searchParams.set('bank', bank) : url.searchParams.delete('bank');
            method ? url.searchParams.set('method', method) : url.searchParams.delete('method');

            // Điều hướng đến URL mới
            window.location.href = url.href;
        };

        document.getElementById('viewid').addEventListener('change', updateURLParams);
        document.getElementById('status-select').addEventListener('change', updateURLParams);
        document.querySelector('.btn_search_ds').addEventListener('click', updateURLParams);
        document.getElementById('bank-select').addEventListener('change', updateURLParams);
        document.getElementById('method-select').addEventListener('change', updateURLParams);

        // Sự kiện nhấn phím Enter trong ô tìm kiếm
        document.querySelector('.key_search').addEventListener('keypress', function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                updateURLParams();
            }
        });
    });

</script>
<style>
    .input-group-custom {display: flex;align-items: center;width: 100%;max-width: 400px;margin: 0 auto;border: 1px solid #ccc;border-radius: 4px;}
    .form-control-custom {flex: 1;padding: 8px;border: none;border-radius: 4px 0 0 4px;font-size: 14px;box-sizing: border-box;}
    .btn-custom {padding: 8px 12px;border: none;background-color: #f8f8f8;border-radius: 0 4px 4px 0;cursor: pointer;display: flex;align-items: center;justify-content: center;}
    .btn-custom i {color: #333;}
    .btn-custom:hover {background-color: #e0e0e0;}
    .btn-custom:active {background-color: #d0d0d0;}
    .paging_simple_numbers {margin-bottom: 10px;padding-bottom: 10px;}
    .box-header {display: flex;justify-content: flex-end;align-items: center;gap: 10px;}
    .box-header>.box-tools {display: flex;top: 10px;gap: 10px;}
    .form-group {margin: 0;}
    ion-icon {font-size: 2rem;}
    .form-inline select {margin-right: 10px;}
    .modern-select {width: 200px;height: 40px;font-size: 16px;padding: 5px 10px;border: 1px solid #ccc;background-color: #f9f9f9;-moz-appearance: none;}
    input[type="hidden"] {display: none;}
    .dv-hd-locsds {display: flex;flex-wrap: wrap;gap: 10px;align-items: flex-start;}
    .search-group, .date-group {display: flex;align-items: center;gap: 10px;flex: 1 1 auto;min-width: 250px; }
    .filter-group {flex: 1 1 auto;margin-bottom: 10px;}
    .form-control-custom, .form-control, .btn-custom, .btn-primary {flex-grow: 1;width: 100%;}
    .btn-custom {
        background-color: #007bff;
        color: white;
        font-size: 16px;
        padding: 5px 20px;
        border-radius: 5px;
        display: inline-flex;
        cursor: pointer;
    }



    .btn-custom:hover {
        background-color: #0462c7; /* Màu xanh đậm hơn khi hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bóng nhẹ khi hover */
    }







</style>
}