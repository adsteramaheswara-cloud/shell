<?php
require_once('wp-load.php');

$slug = get_option('aiowps_login_page_slug');

echo "Login URL kamu adalah: https://".$_SERVER['HTTP_HOST']."/".$slug;
?>
