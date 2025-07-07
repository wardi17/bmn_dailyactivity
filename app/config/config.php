<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "https://" : "http://";

$host = $_SERVER['HTTP_HOST'];

$currentUrl = $protocol . $host.'/wardibaset';
define('base_url', $currentUrl.'/bmn_dayactivity/public');

define('DB_HOST', 'localhost');
define('DB_USER', 'sa');
define('DB_PASS', '');
define('DB_NAME', 'bmn');
define('SESSION_TIMEOUT', 1800);