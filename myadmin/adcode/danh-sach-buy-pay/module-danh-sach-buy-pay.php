<?php
if(isset($_GET['chitiet']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
    include "module-danh-sach-buy-pay-chi-tiet.php";
}else {
// Initializing variables
    $mo = "";
    $table = '#_buy_pay';
    $totalImages = 0;
    $processedImages = 0;
    $pz = 0;
    $pzz = 0;
    $uri = ''; // Initialize $uri to an empty string
    $numview = isset($_GET['numview']) ? intval($_GET['numview']) : 10 ;
    $statuss = isset($_GET['status']) ? $_GET['status'] : '';
    $s_ksearch = isset($_GET['ksearch']) ? $_GET['ksearch'] : '';
    $whereConditions = [];

    if (isset($_GET['pz'])) {
        $pz = intval($_GET['pz']);
        $pzz = ($pz > 0) ? $pz * $numview : 0;
    }
    $displayId = ($pz * $numview);

if ($s_ksearch !== "") {
    $key_parts = explode(' ', strtolower($s_ksearch));
    $searchConditions = [];
    foreach ($key_parts as $part) {
        $searchConditions[] = "LOWER(`mdh`) LIKE '%" . $part . "%'";
        $searchConditions[] = "LOWER(`mgd_vnp`) LIKE '%" . $part . "%'";
        $searchConditions[] = "LOWER(`noidung`) LIKE '%" . $part . "%'";
    }
    $whereConditions[] = '(' . implode(' OR ', $searchConditions) . ')';
}

// Xây dựng điều kiện WHERE cho truy vấn SQL
if ($statuss === 'DESC') {
    $whereConditions[] = "`trangthai` = 1";
} elseif ($statuss === 'ASC') {
    $whereConditions[] = "`trangthai` = 0";
}
$whereClause = '';
if (!empty($whereConditions)) {
    $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
}
// Truy vấn toàn bộ dữ liệu từ cơ sở dữ liệu
    $sql_all = DB_que("SELECT * FROM `$table` $whereClause");
    $numlist = DB_num($sql_all); // Correct variable name
    $numshow = ceil($numlist / $numview);

// Chuyển đổi kết quả truy vấn thành mảng
    $data_all = mysqli_fetch_all($sql_all, MYSQLI_ASSOC);
    $data_page = array_slice($data_all, $pzz, $numview);

?>

<section class="content-header">
    <h1>Danh sách giao dịch</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách giao dịch</li>
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
                                    <div class="form-group">
                                        <div class="input-group-custom">
                                            <input name="ksearch" type="text" value="<?= $s_ksearch ?>" class="form-control-custom key_search" placeholder="Nhập từ khóa tìm kiếm">
                                            <button name='search' type="button" class="btn-custom btn_search_ds" onclick='SEARCH_jsstep()'><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select name="viewid" id="viewid" class="js_hienthi_ds form-control" onchange='SEARCH_jsstep()'>
                                            <option value="" selected>Hiển thị</option>
                                            <option value="15" <?= $numview == 15 ? "selected" : "" ?>>15</option>
                                            <option value="30" <?= $numview == 30 ? "selected" : "" ?>>30</option>
                                            <option value="60" <?= $numview == 60 ? "selected" : "" ?>>60</option>
                                            <option value="100" <?= $numview == 100 ? "selected" : "" ?>>100</option>
                                            <option value="200" <?= $numview == 200 ? "selected" : "" ?>>200</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select id="status-select" name="status" class="form-control modern-select">
                                            <option value="" selected>Trạng thái</option>
                                            <option value="ASC" <?= $statuss === 'ASC' ? 'selected' : '' ?>>Chưa thành công</option>
                                            <option value="DESC" <?= $statuss === 'DESC' ? 'selected' : '' ?>>Thành công</option>
                                        </select>
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
                                        $phuongthuc = ($rows['method']) == 1 ? 'VNPAY' : '' ;
                                        $status_text = ($status == 1) ? 'Thành công' : 'Thất bại ';
                                        $status_label_class = ($status == 1) ? 'label-success' : 'label-danger';
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $index + 1 + $pzz ?></td>
                                            <td class="text-center"><?= $mdh ?></td>
                                            <td class="text-center"><?= $mgd ?></td>
                                            <td class="text-center"><?= $money ?></td>
                                            <td><?= $noidung ?></td>
                                            <td class="text-center"><?= $ngaytao ?></td>

                                            <td class="text-center">
                                                <span class="label <?= $status_label_class ?>">
                                                    <?= $status_text ?>
                                                </span>
                                            </td>
                                            <td class="text-center"><?= $bank ?></td>
                                            <td class="text-center"><?= $phuongthuc ?></td>
<!--                                            <td><a href="--><?//=$url_page ?><!--&chitiet=true" class="btn btn-primary"><i class="fa fa-plus"></i> Chi tiết</a></td>-->
                                            <td>
                                                <a href="<?=$url_page ?>&chitiet=true&mdh=<?=$mdh?>" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i> Chi tiết
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
                            <? }?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const statusSelect = document.getElementById('status-select');
        const numviewSelect = document.getElementById('viewid');
        const searchInput = document.querySelector('.key_search');

        const updateURLParams = () => {
            const url = new URL(window.location.href);
            const numview = numviewSelect.value;
            const status = statusSelect.value;
            const ksearch = searchInput.value.trim();

            numview ? url.searchParams.set('numview', numview) : url.searchParams.delete('numview');
            status ? url.searchParams.set('status', status) : url.searchParams.delete('status');
            ksearch ? url.searchParams.set('ksearch', ksearch) : url.searchParams.delete('ksearch');

            window.location.href = url.href;
        };

        statusSelect.addEventListener('change', updateURLParams);
        numviewSelect.addEventListener('change', updateURLParams);

        $(document).ready(function() {
            searchInput.addEventListener("keypress", function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    updateURLParams();
                }
            });

            function updateSearchInputFromUrl() {
                const url = new URL(window.location.href);
                const ksearch = url.searchParams.get('ksearch');
                if (ksearch) {
                    searchInput.value = decodeURIComponent(ksearch);
                }
            }
            updateSearchInputFromUrl();
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
    .moern-select:focus {border-color: #286090;box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);outline: none;}
    .error-icon {color: #286090;cursor: pointer;}
    input[type="hidden"] {display: none;}
</style>
