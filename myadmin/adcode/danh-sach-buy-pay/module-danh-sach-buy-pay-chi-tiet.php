<?php
$thongtin_vnpay = DB_que("SELECT * FROM #_ship_thanhtoan_setup LIMIT 1");
$thongtin_vnpay = mysqli_fetch_assoc($thongtin_vnpay);
$json_data = $thongtin_vnpay['vnp_error'];
$error_messages = json_decode($json_data, true);

if (isset($_GET['mdh'])) {
    $mdh = $_GET['mdh'];
}

$result = DB_que("SELECT * FROM `#_buy_pay` WHERE `mdh` = '" . $mdh . "' LIMIT 1");
$order_details = mysqli_fetch_assoc($result);
?>

<section class="content-header">
    <h1>Chi Tiết Đơn Hàng</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
    </ol>
</section>
<section class="content form_create">
    <div class="row">
        <section class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="h2_title" style="width: 100%;">
                        <i class="fa fa-pencil-square-o"></i> Thông tin đơn hàng
                    </h2>
                    <h3 class="box-title box-title-td pull-right">
                        <a href="?module=<?=$module ?>&action=<?=$action ?>" class="btn btn-primary">
                            <i class="fa fa-sign-out"></i> Thoát
                        </a>
                    </h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <td><?= htmlspecialchars($order_details['mdh']) ?></td>
                        </tr>
                        <tr>
                            <th>Mã giao dịch</th>
                            <td><?= htmlspecialchars($order_details['mgd_vnp'] == 0 ? '~' : $order_details['mgd_vnp']) ?></td>
                        </tr>
                        <tr>
                            <th>Số tiền</th>
                            <td><?= number_format(htmlspecialchars($order_details['money']), 0, ',', '.') ?></td>

                        </tr>
                        <tr>
                            <th>Nội dung</th>
                            <td><?= htmlspecialchars($order_details['noidung']) ?></td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td><?= date('d-m-Y H:i', strtotime($order_details['ngaytao'])) ?></td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td><?= $order_details['trangthai'] == 1 ? 'Thành công' : 'Thất bại' ?></td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td><?= htmlspecialchars($order_details['bankcode']) ?></td>
                        </tr>
                        <tr>
                            <th>Phương thức thanh toán</th>
                            <td><?= $order_details['method'] == 1 ? 'VNPAY' : 'Khác' ?></td>
                        </tr>
                        <?php if (isset($order_details['error']) && isset($error_messages[$order_details['error']])): ?>
                            <tr>
                                <th>Lỗi</th>
                                <td><?= $error_messages[$order_details['error']] ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>
