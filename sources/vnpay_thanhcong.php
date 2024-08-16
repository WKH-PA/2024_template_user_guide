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
require_once("myadmin/config/function.php");

// Lấy thông tin cấu hình từ cơ sở dữ liệu
$thongtin_vnpay = DB_que("SELECT * FROM #_ship_thanhtoan_setup LIMIT 1");
$thongtin_vnpay = mysqli_fetch_assoc($thongtin_vnpay);
$vnp_TmnCode = ($thongtin_vnpay['check_vn_pay'] == 1) ? $thongtin_vnpay['vnp_TmnCode'] : $thongtin_vnpay['vnp_TmnCode_test'];  // Terminal Id
$vnp_HashSecret = ($thongtin_vnpay['check_vn_pay'] == 1) ? $thongtin_vnpay['vnp_HashSecret'] : $thongtin_vnpay['vnp_HashSecret_test']; // Secret key
$vnp_Url = ($thongtin_vnpay['check_vn_pay'] == 1) ? $thongtin_vnpay['vnp_Url'] : $thongtin_vnpay['vnp_Url_test']; // Payment URL
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

// Chuẩn bị dữ liệu để lưu vào cơ sở dữ liệu
$data = array(
    'mdh' => $txnRef,
    'noidung' => $orderInfo,
    'ngaytao' => $payDate,
    'trangthai' => $transactionStatus,
    'bankcode' => $bankCode,
    'method' => '1',
    'money' => $amount,
    'mgd_vnp' => $transactionNo,
    'error' => ''
);
// Kiểm tra mã đơn hàng đã tồn tại chưa
$checkExist = DB_que("SELECT COUNT(*) as count FROM lh_buy_pay WHERE mdh = '$txnRef'");
$exist = mysqli_fetch_assoc($checkExist);

// Ghi dữ liệu vào cơ sở dữ liệu
if ($responseCode == '00') {
    $data['trangthai'] = ($responseCode == '00') ? 1 : 0;
} else {
    $data['trangthai'] = ($responseCode == '00') ? 1 : 0;
    $data['error'] = $responseCode;
}

// Cập nhật hoặc chèn dữ liệu vào bảng `lh_buy_pay`
if ($exist['count'] == 0) {
    ACTION_db($data, 'lh_buy_pay', 'add');
    $logMessage = "ACTION_db called to add data to lh_buy_pay at " . date('Y-m-d H:i:s') . "\n";
    echo "<script>console.log(" . json_encode($logMessage) . ");</script>";
}

?>
<!-- Begin display -->
<div class="container">
    <div class="header clearfix">
        <h3 class="text-muted">Kết quả giao dịch VNPAY</h3>
    </div>
    <div class="form-group">
        <label>Mã đơn hàng:</label>
        <div class="value"><?php echo htmlspecialchars($_GET['vnp_TxnRef']); ?></div>
    </div>
    <div class="form-group">
        <label>Số tiền:</label>
        <div class="value"><?php echo htmlspecialchars($_GET['vnp_Amount']); ?></div>
    </div>
    <div class="form-group">
        <label>Nội dung thanh toán:</label>
        <div class="value"><?php echo htmlspecialchars($_GET['vnp_OrderInfo']); ?></div>
    </div>
    <div class="form-group">
        <label>Mã GD Tại VNPAY:</label>
        <div class="value"><?php echo htmlspecialchars($_GET['vnp_TransactionNo']); ?></div>
    </div>
    <div class="form-group">
        <label>Mã Ngân hàng:</label>
        <div class="value"><?php echo htmlspecialchars($_GET['vnp_BankCode']); ?></div>
    </div>
    <div class="form-group">
        <label>Thời gian thanh toán:</label>
        <div class="value"><?php $dateTime = DateTime::createFromFormat('YmdHis', $_GET['vnp_PayDate']); echo $dateTime ? htmlspecialchars($dateTime->format('d/m/Y H:i:s')) : 'Không hợp lệ'; ?></div>
    </div>
    <div class="form-group">
    <div class="result <?php echo ($secureHash == $vnp_SecureHash) ? ($_GET['vnp_ResponseCode'] == '00' ? 'success' : 'error') : 'error'; ?>">
        <?php
        if ($secureHash == $vnp_SecureHash) {
            echo ($_GET['vnp_ResponseCode'] == '00') ? "Giao dịch thành công" : "Giao dịch không thành công";
        } else {
            echo "Chữ ký không hợp lệ";
        }
        ?>
    </div>
    </div>
    <?php if ($_GET['vnp_ResponseCode'] != '00'): ?>
        <div class="form-group">
            <label>Lỗi:</label>
            <?= $error_messages[$_GET['vnp_ResponseCode']] ?>
        </div>

    <?php endif; ?>


</div>


<style>
    body {font-family: Arial, sans-serif;color: #333;background-color: #f4f4f4;margin: 0;padding: 0;}
    .container {max-width: 800px;margin: 0 auto;padding: 20px;background: #fff;border-radius: 8px;box-shadow: 0 2px 4px rgba(0,0,0,0.1);}
    .header {border-bottom: 2px solid #007bff;margin-bottom: 20px;padding-bottom: 10px;}
    .header h3 {margin: 0;color: #007bff;}
    .form-group {margin-bottom: 15px;}
    .form-group label {display: block;font-weight: bold;margin-bottom: 5px;}
    .form-group .value {font-size: 1.1em;}
    .result {margin-top: 20px;font-size: 1.2em;font-weight: bold;}
    .result.success {color: #28a745;}
    .result.error {color: #dc3545;}
    footer {margin-top: 20px;text-align: center;font-size: 0.9em;color: #888;}
</style>