<?php
include("config/sql.php");
// Initialize variables to prevent "Undefined variable" notices
$amount = $language = $txnRef = $returnUrl = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and assign POST data to variables
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $language = isset($_POST['language']) ? $_POST['language'] : null;
    $txnRef = isset($_POST['txnRef']) ? $_POST['txnRef'] : null;
    $returnUrl = isset($_POST['returnUrl']) ? $_POST['returnUrl'] : null;
    // Proceed if all required fields are present
    if ($amount && $language && $txnRef && $returnUrl) {
        $thongtin_vnpay = DB_que("SELECT * FROM #_ship_thanhtoan_setup LIMIT 1");
        $thongtin_vnpay = mysqli_fetch_assoc($thongtin_vnpay);

        $vnp_TmnCode = $thongtin_vnpay['vnp_TmnCode']; // Terminal Id
        $vnp_HashSecret = $thongtin_vnpay['vnp_HashSecret']; // Secret key
        $vnp_Url = $thongtin_vnpay['vnp_Url'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => GET_ip(),
            "vnp_Locale" => $language,
            "vnp_OrderInfo" => "Thanh toan GD:" . date('YmdHis'),
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

        $paymentUrl = $vnp_Url . "?" . $query;

        // Redirect to the payment URL
        header('Location: ' . $paymentUrl);
        exit();
    } else {
        // Handle missing input
        echo "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn {
            background-color: #28a745;
            color: #fff;
        }
        .btn:hover {
            background-color: #218838;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>
<div class="container">
    <h3 class="text-center">Tạo mới đơn hàng</h3>
    <form action="" id="frmCreateOrder" method="post">
        <div class="form-group">
            <label for="amount">Số tiền</label>
            <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="amount" type="number" value="10000" />
        </div>
        <div class="form-group">
            <h5>Chọn ngôn ngữ giao diện thanh toán:</h5>
            <div>
                <input type="radio" id="language_vn" name="language" value="vn" checked>
                <label for="language_vn">Tiếng Việt</label>
            </div>
            <div>
                <input type="radio" id="language_en" name="language" value="en">
                <label for="language_en">Tiếng Anh</label>
            </div>
        </div>
        <div class="form-group">
            <label for="returnUrl">URL Trả Về</label>
            <input class="form-control" id="returnUrl" name="returnUrl" type="text" value="http://localhost/2024_template_user_guide/myadmin/upload.php" />
        </div>
        <div class="form-group">
            <label for="txnRef">Mã Giao Dịch</label>
            <input class="form-control" id="txnRef" name="txnRef" type="text" value="<?php echo rand(1, 10000); ?>" />
        </div>
        <button type="submit" class="btn btn-success btn-block">Thanh toán</button>
    </form>
    <footer class="footer">
    <?
        echo $ip = $_SERVER['HTTP_CLIENT_IP'];

         echo $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

        echo $ip = $_SERVER['REMOTE_ADDR'];
    ?>
        <p>&copy; VNPAY 2024</p>
        <??>
    </footer>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
