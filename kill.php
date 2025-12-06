<?php
// Konfigurasi server
$server_ip = "139.59.239.42";
$server_port = 80;

function connect_to_server() {
    $fp = fsockopen($server_ip, $server_port, $errno, $errstr, 30);
    if (!$fp) {
        echo "Error: $errno - $errstr<br />\n";
        sleep(10);  // Tunggu 10 detik sebelum mencoba kembali
        connect_to_server();
    } else {
        echo "Connected to server<br />\n";
        while ($fp) {
            $out = "Hello Server\r\n";
            fwrite($fp, $out);
            $response = fread($fp, 2048);
            echo "Received: $response<br />\n";
        }
        fclose($fp);
    }
}

connect_to_server();
?>
