<?php
// Mengganti TOKEN_BOT dengan token bot Telegram Anda
define('TOKEN_BOT', '6777989005:AAEvhHDXBZOCOTgt7BWxZoD20Ey9kzvzv1A');

// Mengganti CHAT_ID dengan chat ID Telegram tempat Anda ingin menerima pesan
define('CHAT_ID', '@ppsiluang_bot');

// Mengambil data dari formulir
$judul = $_POST['judul'];
$artikel = $_POST['artikel'];
$username = $_POST['username'];

// Mengupload gambar
$gambarTmp = $_FILES['gambar']['tmp_name'];
$gambarName = $_FILES['gambar']['name'];
move_uploaded_file($gambarTmp, 'uploads/' . $gambarName);

// Mengupload foto profil
$profilTmp = $_FILES['profil']['tmp_name'];
$profilName = $_FILES['profil']['name'];
move_uploaded_file($profilTmp, 'uploads/' . $profilName);

// Mengirim pesan ke bot Telegram
$message = "Judul: $judul\nArtikel: $artikel\nUsername Instagram: $username";
$photo = new CURLFile(realpath('uploads/' . $gambarName));
$photoProfile = new CURLFile(realpath('uploads/' . $profilName));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot"6777989005:AAEvhHDXBZOCOTgt7BWxZoD20Ey9kzvzv1A"/sendPhoto");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'chat_id' => CHAT_ID,
    'caption' => $message,
    'photo' => $photo,
]);
curl_exec($ch);

// Menutup koneksi cURL
curl_close($ch);

// Hapus file yang diupload
unlink('uploads/' . $gambarName);
unlink('uploads/' . $profilName);

// Redirect kembali ke halaman formulir
header('Location: idx.html');
?>
