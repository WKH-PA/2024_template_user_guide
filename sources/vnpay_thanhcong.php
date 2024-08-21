<?php
require_once("myadmin/config/function.php");
$thongtin_vnpay = DB_que("SELECT * FROM #_ship_thanhtoan_setup LIMIT 1");
$thongtin_vnpay = mysqli_fetch_assoc($thongtin_vnpay);
$json_data = $thongtin_vnpay['vnp_error'];
$error_messages = json_decode($json_data, true);
$vnp_TmnCode = ($thongtin_vnpay['check_vn_pay'] == 1) ? $thongtin_vnpay['vnp_TmnCode'] : $thongtin_vnpay['vnp_TmnCode_test'];  // Terminal Id
$vnp_HashSecret = ($thongtin_vnpay['check_vn_pay'] == 1) ? $thongtin_vnpay['vnp_HashSecret'] : $thongtin_vnpay['vnp_HashSecret_test']; // Secret key
$vnp_Url = ($thongtin_vnpay['check_vn_pay'] == 1) ? $thongtin_vnpay['vnp_Url'] : $thongtin_vnpay['vnp_Url_test']; // Payment URL
if (empty($vnp_TmnCode) || empty($vnp_HashSecret) || empty($vnp_Url)) {
    echo "<script>console.log('Thông số cấu hình VNPAY thiếu .');</script>";
}
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
$responseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : '';
$txnRef = isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : '';
$amount = isset($_GET['vnp_Amount']) ? ($_GET['vnp_Amount']/100) : '';
$orderInfo = isset($_GET['vnp_OrderInfo']) ? $_GET['vnp_OrderInfo'] : '';
$transactionStatus = isset($_GET['vnp_TransactionStatus']) ? $_GET['vnp_TransactionStatus'] : '';
$transactionNo = isset($_GET['vnp_TransactionNo']) ? $_GET['vnp_TransactionNo'] : '';
$bankCode = isset($_GET['vnp_BankCode']) ? $_GET['vnp_BankCode'] : '';
$payDate = isset($_GET['vnp_PayDate']) ? $_GET['vnp_PayDate'] : '';

// Chuẩn bị dữ liệu để lưu vào cơ sở dữ liệu
$data = array(
    'mdh' => $txnRef,
    'noidung' => $orderInfo,
    'ngaytao' => $payDate,
    'trangthai' => (($transactionStatus == '00') ? 1 : 0),
    'bankcode' => $bankCode,
    'method' => '1',
    'money' => $amount,
    'mgd_vnp' => $transactionNo,
    'error' => (($transactionStatus == '00') ? 0 : $responseCode)

);

$checkExist = DB_que("SELECT COUNT(*) as count FROM lh_buy_pay WHERE mdh = '$txnRef'");
$exist = mysqli_fetch_assoc($checkExist);
if($transactionStatus == '00'){
    $data1=['thanh_toan' => 1];
    ACTION_db($data1, '#_order', 'update', NULL, "`id` = {$txnRef}");
}
if ($exist['count'] == 0) {
    $rt = ACTION_db($data, 'lh_buy_pay', 'add');
    $message = $rt ? "Lưu data thành công: " . addslashes(json_encode($rt)) : "Lưu data thất bại";
    echo "<script>console.log('$message');</script>";
}
?>
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
        <div class="value"><?php echo htmlspecialchars($_GET['vnp_Amount']/100); ?></div>
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
            <label>Vấn đề xảy ra:</label>
            <div class="value">
                <?=  isset($error_messages[$_GET['vnp_ResponseCode']]) ? $error_messages[$_GET['vnp_ResponseCode']] : "Mã lỗi không hợp lệ."; ?>
            </div>

        </div>
    <?php endif; ?>
</div>

<style>
    body {font-family: 'Roboto', sans-serif;color: #2c3e50;background-color: #ecf0f1;margin: 0;padding: 0;}
    .container {max-width: 800px;margin: 40px auto;padding: 30px;background: #ffffff;border-radius: 12px;box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);border: 1px solid #ddd;}
    .header {border-bottom: 3px solid #3498db;margin-bottom: 30px;padding-bottom: 15px;text-align: center;}
    .header h3 {margin: 0;color: #3498db;font-size: 2em;font-weight: 700;}
    .form-group {display: flex;align-items: center;margin-bottom: 20px;border-bottom: 1px solid #eee;padding-bottom: 10px;transition: background-color 0.3s ease;}
    .form-group:hover {background-color: #f9f9f9;}
    .form-group label {font-weight: 600;margin-right: 20px;color: #2c3e50;flex: 0 0 200px;font-size: 1.1em;}
    .form-group .value {font-size: 1.2em;color: #34495e;padding: 10px;background-color: #f9f9f9;border-radius: 8px;flex: 1;border: 1px solid #ddd;transition: border-color 0.3s ease;}
    .form-group .value:hover {border-color: #3498db;}
    .result {margin-top: 30px;font-size: 1.4em;font-weight: 700;text-align: center;padding: 15px;border-radius: 8px;}
    .result {margin-top: 30px;font-size: 1.4em;font-weight: 700;text-align: center;padding: 15px;border-radius: 8px;width: 100%;box-sizing: border-box;}
    .result.success {color: #27ae60;background-color: #e9f7ef;border: 1px solid #27ae60;display: flex;align-items: center;justify-content: center;}
    .result.error {color: #e74c3c;background-color: #fdecea;border: 1px solid #e74c3c;display: flex;align-items: center;justify-content: center;}
    footer {margin-top: 30px;text-align: center;font-size: 0.95em;color: #7f8c8d;}
</style>


<!--Mảng error-->
<!--{-->
<!--"00": "Giao dịch thành công",-->
<!--"07": "Trừ tiền thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường).",-->
<!--"09": "Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng.",-->
<!--"10": "Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần.",-->
<!--"11": "Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch.",-->
<!--"12": "Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.",-->
<!--"13": "Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.",-->
<!--"24": "Giao dịch không thành công do: Khách hàng hủy giao dịch.",-->
<!--"51": "Giao dịch không thành công do: Tài khoản của quý khách không đủ số dư để thực hiện giao dịch.",-->
<!--"65": "Giao dịch không thành công do: Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày.",-->
<!--"75": "Ngân hàng thanh toán đang bảo trì.",-->
<!--"79": "Giao dịch không thành công do: KH nhập sai mật khẩu thanh toán quá số lần quy định. Xin quý khách vui lòng thực hiện lại giao dịch.",-->
<!--"99": "Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê)."-->
<!--}-->