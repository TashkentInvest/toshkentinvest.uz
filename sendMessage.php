<?php
// Replace with your actual bot token and updated chat ID
$botToken = '7675163486:AAGj0nmvogzLsrZi5RGugYua0AuuOrGevog';
$chatId = '-1002371894579';  // Updated chat ID from getUpdates response

// Ensure the form data is provided
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'N/A';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : 'N/A';
$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : 'Qo‘shimcha ma’lumot yo‘q';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : 'N/A';

// Construct the message
$text = "📨 *Yangi Tanlov Arizasi*\n";
$text .= "*Ism:* $name\n";
$text .= "*Email:* $email\n";
$text .= "*Telefon:* $phone\n";
$text .= "*Xabar:* $message";

// Send the message to Telegram using cURL
$telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";

$params = [
    'chat_id' => $chatId,
    'text' => $text,
    'parse_mode' => 'Markdown'  // You can switch to 'HTML' if necessary
];

// Initialize cURL session
$ch = curl_init($telegramUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

// Execute cURL request
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Check for errors
if (curl_errno($ch)) {
    // cURL error occurred
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Telegram API response
    if ($httpCode == 200) {
        // Success
        header("Location: index.html");
        exit();
    } else {
        // Print out the error message from the Telegram API
        echo 'Telegram API Error: HTTP Status Code ' . $httpCode . ' - Response: ' . $result;
    }
}

// Close cURL session
curl_close($ch);
?>
