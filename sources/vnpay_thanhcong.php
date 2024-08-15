<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/>
    <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
</head>
<body>
<?php
require_once("myadmin/config/function.php");

// Lấy thông tin cấu hình từ cơ sở dữ liệu
$thongtin_vnpay = DB_que("SELECT * FROM #_ship_thanhtoan_setup LIMIT 1");
$thongtin_vnpay = mysqli_fetch_assoc($thongtin_vnpay);
$vnp_HashSecret = $thongtin_vnpay['vnp_HashSecret'];

// Lấy dữ liệu từ GET
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

// Xác thực dữ liệu và lưu vào cơ sở dữ liệu
$responseCode = $_GET['vnp_ResponseCode'];
$txnRef = $_GET['vnp_TxnRef'];
$amount = $_GET['vnp_Amount'];
$orderInfo = $_GET['vnp_OrderInfo'];
$transactionStatus = $_GET['vnp_TransactionStatus'];
$transactionNo = $_GET['vnp_TransactionNo'];
$bankCode = $_GET['vnp_BankCode'];
$payDate = $_GET['vnp_PayDate'];
$vnp_PayDate =$_GET['vnp_PayDate'];

// Chuẩn bị dữ liệu để lưu vào cơ sở dữ liệu
$data = array(
    'mdh' => $txnRef,
    'noidung' => $orderInfo,
    'ngaytao' => $vnp_PayDate,
    'trangthai' => $transactionStatus,
    'method' => 1,
    'money' => $_GET['vnp_Amount'],
    'mgd_vnp' => $transactionNo,
    'error' => ''
);
// Kiểm tra mã đơn hàng đã tồn tại chưa
$checkExist = DB_que("SELECT COUNT(*) as count FROM lh_buy_pay WHERE mdh = '$txnRef'");
$exist = mysqli_fetch_assoc($checkExist);
// Ghi dữ liệu vào cơ sở dữ liệu
if ($secureHash == $vnp_SecureHash) {
    $data['trangthai'] = ($responseCode == '00') ? 1 : 0;
} else {
    $data['error'] = '$responseCode';
}
// Cập nhật hoặc chèn dữ liệu vào bảng `lh_buy_pay`
if ($exist['count'] > 0) {
    // Nếu mã đơn hàng đã tồn tại, thực hiện cập nhật
    ACTION_db($data, 'lh_buy_pay', 'update', array(), "mdh = '$txnRef'");
} else {
    // Nếu mã đơn hàng chưa tồn tại, thực hiện chèn mới
    ACTION_db($data, 'lh_buy_pay', 'add');
}
?>
<!--Begin display -->
<div class="container">
    <div class="header clearfix">
        <h3 class="text-muted">VNPAY RESPONSE</h3>
    </div>
    <div class="table-responsive">
        <div class="form-group">
            <label>Mã đơn hàng:</label>
            <label><?php echo $_GET['vnp_TxnRef'] ?></label>
        </div>
        <div class="form-group">
            <label>Số tiền:</label>
            <label><?php echo $_GET['vnp_Amount'] ?></label>
        </div>
        <div class="form-group">
            <label>Nội dung thanh toán:</label>
            <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
        </div>
<!--        <div class="form-group">-->
<!--            <label>Tình trạng:</label>-->
<!--            <label>--><?php //echo $_GET['vnp_TransactionStatus'] ?><!--</label>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label>Mã phản hồi (vnp_ResponseCode):</label>-->
<!--            <label>--><?php //echo $_GET['vnp_ResponseCode'] ?><!--</label>-->
<!--        </div>-->
        <div class="form-group">
            <label>Mã GD Tại VNPAY:</label>
            <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
        </div>
        <div class="form-group">
            <label>Mã Ngân hàng:</label>
            <label><?php echo $_GET['vnp_BankCode'] ?></label>
        </div>
        <div class="form-group">
            <label>Thời gian thanh toán:</label>
            <label><?php echo $_GET['vnp_PayDate'] ?></label>
        </div>
        <div class="form-group">
            <label>Kết quả:</label>
            <label>
                <?php
                if ($secureHash == $vnp_SecureHash) {
                    if ($_GET['vnp_ResponseCode'] == '00') {
                        echo "<span style='color:blue'>GD Thanh cong</span>";
                    } else {
                        echo "<span style='color:red'>GD Khong thanh cong</span>";
                    }
                } else {
                    echo "<span style='color:red'>Chu ky khong hop le</span>";
                }
                ?>
            </label>
        </div>
    </div>
    <p>
        &nbsp;
    </p>
    <footer class="footer">
        <p>&copy; VNPAY <?php echo date('Y')?></p>
    </footer>
</div>
</body>
</html>
