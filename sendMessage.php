<?php
// Replace with your actual bot token and chat ID
$botToken = '7675163486:AAGj0nmvogzLsrZi5RGugYua0AuuOrGevog';
$chatId = '-4592149967';

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

// Check if the cURL request was successful
if(curl_errno($ch)) {
    // cURL error occurred, print error message
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // If HTTP request is successful
    if ($httpCode == 200) {
        // Redirect to a success page
        header("Location: index.html");
        exit();
    } else {
        // Redirect to an error page or handle the failure
        echo "Telegram API error: HTTP Status Code $httpCode";
    }
}

// Close the cURL session
curl_close($ch);
?>
