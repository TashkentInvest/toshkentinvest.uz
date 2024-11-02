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

// Send the message to Telegram using cURL
$telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";

$params = [
    'chat_id' => $chatId,
    'text' => $text,
    'parse_mode' => 'Markdown'
];

// Initialize cURL session
$ch = curl_init($telegramUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

// Execute cURL request
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Check if the request was successful
if ($httpCode == 200) {
    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Message could not be sent']);
}
?>