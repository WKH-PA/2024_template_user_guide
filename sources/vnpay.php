<?php
function processPayment($amount, $txnRef, $language = 'vn') {
    // Lấy thông tin từ cơ sở dữ liệu
    $thongtin_vnpay = DB_que("SELECT * FROM #_ship_thanhtoan_setup LIMIT 1");
    $thongtin_vnpay = mysqli_fetch_assoc($thongtin_vnpay);
    // Cấu hình VNPAY
    $vnp_Url = ($thongtin_vnpay['check_vn_pay'] == 1) ? $thongtin_vnpay['vnp_Url'] : $thongtin_vnpay['vnp_Url_test'];
    $vnp_TmnCode = ($thongtin_vnpay['check_vn_pay'] == 1) ? $thongtin_vnpay['vnp_TmnCode'] : $thongtin_vnpay['vnp_TmnCode_test'];
    $vnp_HashSecret = ($thongtin_vnpay['check_vn_pay'] == 1) ? $thongtin_vnpay['vnp_HashSecret'] : $thongtin_vnpay['vnp_HashSecret_test'];
    $returnUrl = "http://localhost/2024_template_user_guide/vnpay_thanhcong.php";

    // Tạo dữ liệu đầu vào cho VNPAY
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $amount * 100, // Số tiền
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
        "vnp_Locale" => $language,
        "vnp_OrderInfo" => "Thanh toan GD:" . $txnRef,
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => $returnUrl,
        "vnp_TxnRef" => $txnRef,
    );

    ksort($inputData);
    $hashdata = "";
    $query = "";

    foreach ($inputData as $key => $value) {
        $hashdata .= ($hashdata ? '&' : '') . urlencode($key) . "=" . urlencode($value);
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $query .= 'vnp_SecureHash=' . urlencode($vnpSecureHash);
//    echo ($query);
    $paymentUrl = $vnp_Url . "?" . $query;
    echo "<script>window.location.href = '$paymentUrl';</script>";
    exit();
}

// Xử lý yêu cầu GET nếu có đủ dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['num_vnp']) && isset($_GET['ma_donhang_vnp'])) {
    $amount = floatval($_GET['num_vnp']);
    $num_vnp = intval($_GET['ma_donhang_vnp']);
    $language = isset($_GET['language']) ? trim($_GET['language']) : 'vn';
    $sql = DB_que("SELECT `id`, `madh` FROM `#_order` WHERE `id` = $num_vnp LIMIT 1");
    $madh = mysqli_fetch_assoc($sql);
    $txnRef = trim($madh['madh']);
//    echo '<pre>';
//    var_dump($amount, $txnRef ,$num_vnp, $madh['madh']);
//    exit;
    processPayment($amount, $txnRef, $language);
}
?>
<script>
    function TIEN_VNPAY(amount, txnRef) {
        console.log(amount, txnRef)
        var data = {
            num_vnp: amount,
            ma_donhang_vnp: txnRef,
            language: 'vn'
        };

        var query = new URLSearchParams(data).toString();
        const fullUrl = window.location.href;
        const baseUrl = fullUrl.split('/').slice(0, 4).join('/');
        fetch(window.location.href.split('?')[0], {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: query
        })
            .then(response => response.text())
            .then(data => {
                console.log('Success:', data);

                console.log(baseUrl + "vnpay?" + query);
                window.location.href = baseUrl + "/vnpay?" + query;
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
    // Gọi hàm TIEN_VNPAY với giá trị mẫu
    // TIEN_VNPAY(100000, 'ORD123456789');
</script>
