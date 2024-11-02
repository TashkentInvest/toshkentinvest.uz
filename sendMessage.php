<?php
// Replace with your actual bot token and chat ID
$botToken = '7675163486:AAGj0nmvogzLsrZi5RGugYua0AuuOrGevog';
$chatId = '-4592149967';

// Get the form data from the POST request
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$message = htmlspecialchars($_POST['message']);

// Construct the message
$text = "📨 *Yangi Tanlov Arizasi*\n";
$text .= "*Ism:* $name\n";
$text .= "*Email:* $email\n";
$text .= "*Telefon:* " . ($phone ?: "Qo‘shimcha ma’lumot yo‘q") . "\n";
$text .= "*Xabar:* $message";

// Send the message to Telegram
$telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";

$params = [
    'chat_id' => $chatId,
    'text' => $text,
    'parse_mode' => 'Markdown'
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($params),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents($telegramUrl, false, $context);

if ($result === FALSE) {
    // Handle error
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Message could not be sent']);
} else {
    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
}
?>
