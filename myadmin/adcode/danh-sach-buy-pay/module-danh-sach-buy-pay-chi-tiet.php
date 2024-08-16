<?php
$error_messages = [
    "00" => "Giao dịch thành công",
    "07" => "Trừ tiền thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường).",
    "09" => "Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng.",
    "10" => "Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần.",
    "11" => "Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch.",
    "12" => "Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.",
    "13" => "Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.",
    "24" => "Giao dịch không thành công do: Khách hàng hủy giao dịch.",
    "51" => "Giao dịch không thành công do: Tài khoản của quý khách không đủ số dư để thực hiện giao dịch.",
    "65" => "Giao dịch không thành công do: Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày.",
    "75" => "Ngân hàng thanh toán đang bảo trì.",
    "79" => "Giao dịch không thành công do: KH nhập sai mật khẩu thanh toán quá số lần quy định. Xin quý khách vui lòng thực hiện lại giao dịch.",
    "99" => "Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê).",
];
if (isset($_GET['mdh'])) {
    $mdh = $_GET['mdh'];
}

// Query to fetch order details based on the provided 'mdh'
$result = DB_que("SELECT * FROM `#_buy_pay` WHERE `mdh` = '" . $mdh . "' LIMIT 1");
$order_details = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Đơn Hàng</title>
    <link rel="stylesheet" href="path/to/your/css/file.css"> <!-- Adjust the path -->
</head>
<body>
<section class="content-header">
    <h1>Chi Tiết Đơn Hàng</h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li><a href="danhsach.php">Danh sách giao dịch</a></li>
        <li class="active">Chi Tiết Đơn Hàng</li>
    </ol>
</section>

<section class="content">
    <div class="order-details">
        <h2>Thông tin đơn hàng</h2>
        <table class="table table-bordered">
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
                <td><?= htmlspecialchars($order_details['money']) ?></td>
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
        </table>
    </div>
</section>

</body>
</html>



