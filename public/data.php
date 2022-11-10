<?php

require_once '../defines.php';

if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

spl_autoload_register(function ($class) {
    require_once WEB_ROOT_DIR.'/classes/' . $class . '.class.php';
});

if (USE_REMOTE_FILES) {
    $pathToLogs = substr(REMOTE_PATH , -1) == '/' ? REMOTE_PATH : REMOTE_PATH.'/';
} else {
    $pathToLogs = substr(LOCAL_PATH , -1) == '/' ? LOCAL_PATH : LOCAL_PATH.'/';
}

$journalParser = new JournalParser($pathToLogs.'journal.txt');
$journalData = $journalParser->fetchData('data');
$journalWithNames = $journalParser->fetchData('clients-data');
$names = $journalParser->fetchData('names');

ob_start();
$journalTemp = include WEB_ROOT_DIR.'/templates/journal.template.php';
$journal = ob_get_clean();


$statusParser = new StatusParser($pathToLogs.'status.log', USE_CUSTOM_NAMES ? USER_NAMES : $names);
$statusData = $statusParser->fetchData('data');

ob_start();
$statusTemp = include WEB_ROOT_DIR.'/templates/status.template.php';
$status = ob_get_clean();

$lastUpdate = $statusParser->fetchData('lastUpdate');

header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'lastUpdate' => $lastUpdate,
    'statusContent' => $status,
    'journalContent' => $journal,
]);