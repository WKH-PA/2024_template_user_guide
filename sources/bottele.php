<?php
function sendMessageToTelegram($message) {
    // Lấy token và chat ID từ cơ sở dữ liệu
    $telegramApiTokenArray = DB_arr(DB_que('SELECT `token_api_tele` FROM `#_seo` LIMIT 1'),1);
    $chatIdArray = DB_arr(DB_que('SELECT `id_chat_tele` FROM `#_seo` LIMIT 1'),1);

    $telegramApiToken = isset($telegramApiTokenArray['token_api_tele']) ? $telegramApiTokenArray['token_api_tele'] : null;
    $chatId = isset($chatIdArray['id_chat_tele']) ? $chatIdArray['id_chat_tele'] : null;

    $url = "https://api.telegram.org/bot" . $telegramApiToken . "/sendMessage";


    $messageData = json_decode($message, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Lỗi khi giải mã JSON: " . json_last_error_msg();
    }

    // Đảm bảo các trường dữ liệu cần thiết tồn tại
    $timestamp = isset($messageData['timestamp']) ? $messageData['timestamp'] : 'N/A';
    $status = isset($messageData['status']) ? $messageData['status'] : 'N/A';
    $order_id = isset($messageData['order_id']) ? $messageData['order_id'] : 'N/A';
    $amount = isset($messageData['amount']) ? $messageData['amount'] : 'N/A';
    $currency = isset($messageData['currency']) ? $messageData['currency'] : 'N/A';
    $payment_method = isset($messageData['payment_method']) ? $messageData['payment_method'] : 'N/A';
    $bankpayment = isset($messageData['bankpayment']) ? $messageData['bankpayment'] : 'N/A';
    $messageText = isset($messageData['message']) ? $messageData['message'] : 'N/A';

    // Định dạng tin nhắn
    $formattedMessage = "
    *Thông tin giao dịch:*\n
    - ⏰ *Thời gian*: $timestamp\n
    - 🛠 *Trạng thái*: $status\n
    - 🆔 *Mã đơn hàng*: $order_id\n
    - 💳 *Số tiền*: $amount $currency\n
    - 💰 *Phương thức thanh toán*: $payment_method\n
    - 🏦 *Ngân hàng*: $bankpayment\n
    - 📜 *Thông báo*: $messageText\n
    ";

    // Dữ liệu cần gửi (tin nhắn và chat ID)
    $postData = array(
        'chat_id' => $chatId,
        'text' => $formattedMessage,
        'parse_mode' => 'Markdown'
    );
    echo '<pre>';
    var_dump($url,$postData);


    // Sử dụng CURL để gửi yêu cầu POST đến Telegram API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    // Kiểm tra lỗi CURL
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return "Lỗi khi gửi yêu cầu: $error_msg";
    }

    curl_close($ch);

    // Trả về phản hồi từ Telegram API
    return $response;
}
$message = "{ \"timestamp\": \"17:14:44 28-08-2024 \",
    \"status\": \"Thất bại \",
    \"order_id\": \"DH6728442\",
    \"amount\": \"120,000\",
    \"currency\": \"VND\",
    \"payment_method\": \"VNPAY\",
    \"bankpayment\": \"VNPAY\",
    \"message\": \"Giao dịch không thành công do: Khách hàng hủy giao dịch.\"}";
sendMessageToTelegram($message);

?>


