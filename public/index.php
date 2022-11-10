<?php

require_once '../defines.php';

if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

if (defined(TIMEZONE) && !empty(TIMEZONE)) {
    date_default_timezone_set(TIMEZONE);
}


$head = [
    'title' => META_TITLE,
    'description' => META_DESCRIPTION,
    'rating' => META_RATING,
    'distribution' => META_DISCTRIBUTION,
    'company' => META_COMPANY,
    ];

$vpnName = VPN_NAME;

require_once WEB_ROOT_DIR.'/templates/index.template.php';